/**
 * Antigravity High-Fidelity ESC/POS Web Bluetooth Printing Engine
 * 
 * Features:
 * - Persistent connection caching ("no-delay subsequent prints")
 * - Universal write-characteristic auto-discovery
 * - High-speed canvas-to-monochrome ESC/POS bitmask rasterizer (GS v 0)
 * - MTU-safe chunked transmission
 */

let cachedBluetoothDevice = null;
let cachedWriteCharacteristic = null;

// Standard POS printer GATT services and common fallback UUIDs
const PRINTER_SERVICE_UUIDS = [
    '000018f0-0000-1000-8000-00805f9b34fb', // Standard BLE POS printers
    '00004953-0000-1000-8000-00805f9b34fb', // Qirui/Goojprt POS
    '0000e7e1-0000-1000-8000-00805f9b34fb', // Feasycom BLE
    '0000ffe0-0000-1000-8000-00805f9b34fb', // Generic BLE serial (HM-10 and similar cheap thermal printers)
    'e7e1',
    '18f0',
    '4953',
    'ffe0',
    'ffe1'
];

/**
 * Checks if a Bluetooth printer is currently connected and cached.
 */
function isPrinterConnected() {
    return cachedBluetoothDevice && cachedBluetoothDevice.gatt.connected && cachedWriteCharacteristic;
}

/**
 * Disconnects the printer and clears caches.
 */
function disconnectPrinter() {
    if (cachedBluetoothDevice && cachedBluetoothDevice.gatt.connected) {
        cachedBluetoothDevice.gatt.disconnect();
    }
    cachedBluetoothDevice = null;
    cachedWriteCharacteristic = null;
}

/**
 * Connects to a Bluetooth thermal printer via Web Bluetooth API.
 * Auto-discovers the write characteristic.
 * Supports reconnecting to a saved device by ID.
 */
async function connectPrinter(deviceIdOrOnStatusChange, onStatusChange = () => {}) {
    let deviceId = null;
    let statusCallback = onStatusChange;
    
    if (typeof deviceIdOrOnStatusChange === 'string') {
        deviceId = deviceIdOrOnStatusChange;
    } else if (typeof deviceIdOrOnStatusChange === 'function') {
        statusCallback = deviceIdOrOnStatusChange;
    }

    if (isPrinterConnected()) {
        return cachedWriteCharacteristic;
    }

    try {
        let device = null;
        if (deviceId && navigator.bluetooth && typeof navigator.bluetooth.getDevices === 'function') {
            statusCallback('Reconnecting to saved printer...');
            const devices = await navigator.bluetooth.getDevices();
            device = devices.find(d => d.id === deviceId);
        }

        if (!device) {
            statusCallback('Scanning for Bluetooth POS printers...');
            device = await navigator.bluetooth.requestDevice({
                acceptAllDevices: true,
                optionalServices: PRINTER_SERVICE_UUIDS
            });
        }

        statusCallback(`Found: ${device.name || 'POS Printer'}. Connecting...`);
        
        device.addEventListener('gattserverdisconnected', () => {
            cachedBluetoothDevice = null;
            cachedWriteCharacteristic = null;
            statusCallback('Printer disconnected.', false);
            window.dispatchEvent(new CustomEvent('printerdisconnected'));
        });

        const server = await device.gatt.connect();
        statusCallback('Connected! Discovering services...');

        let service = null;
        for (const uuid of PRINTER_SERVICE_UUIDS) {
            try {
                service = await server.getPrimaryService(uuid);
                if (service) break;
            } catch (e) {
                // Try next UUID
            }
        }

        // If no pre-defined service is found, try to get all services
        if (!service) {
            try {
                const services = await server.getPrimaryServices();
                if (services.length > 0) {
                    service = services[0];
                }
            } catch (err) {
                // Fail-safe
            }
        }

        if (!service) {
            throw new Error('No compatible POS printing services found on this device.');
        }

        statusCallback('Service found. Discovering write channel...');

        // Find write characteristic
        const characteristics = await service.getCharacteristics();
        let writeChar = null;

        for (const char of characteristics) {
            if (char.properties.write || char.properties.writeWithoutResponse) {
                writeChar = char;
                break;
            }
        }

        if (!writeChar) {
            throw new Error('Printer does not support writing data streams.');
        }

        cachedBluetoothDevice = device;
        cachedWriteCharacteristic = writeChar;

        statusCallback('Printer connected & ready!', true);
        
        // Save selected printer ID to localStorage
        localStorage.setItem('selected_printer_id', device.id);
        
        // Fire event so UI can listen to it
        window.dispatchEvent(new CustomEvent('printerconnected', { 
            detail: { deviceName: device.name || 'POS Printer', deviceId: device.id } 
        }));

        return writeChar;

    } catch (error) {
        disconnectPrinter();
        onStatusChange(`Error: ${error.message}`, false);
        throw error;
    }
}

/**
 * Converts a Canvas containing the receipt drawing to black and white raster ESC/POS bytes.
 * Uses the GS v 0 (Print raster bit image) standard command.
 */
function canvasToEscPos(canvas) {
    const ctx = canvas.getContext('2d');
    const width = canvas.width;
    const height = canvas.height;
    
    // Width in bytes must be width / 8
    const widthBytes = Math.ceil(width / 8);
    const imgData = ctx.getImageData(0, 0, width, height).data;
    
    // ESC/POS GS v 0 m xL xH yL yH d1...dk
    // Header size: 8 bytes
    const header = new Uint8Array([0x1D, 0x76, 0x30, 0, widthBytes & 0xFF, (widthBytes >> 8) & 0xFF, height & 0xFF, (height >> 8) & 0xFF]);
    const rasterData = new Uint8Array(widthBytes * height);

    let idx = 0;
    for (let y = 0; y < height; y++) {
        for (let xByte = 0; xByte < widthBytes; xByte++) {
            let byteVal = 0;
            for (let bit = 0; bit < 8; bit++) {
                const x = xByte * 8 + bit;
                let bitVal = 0; // 0 = white, 1 = black
                
                if (x < width) {
                    const pixelIdx = (y * width + x) * 4;
                    const r = imgData[pixelIdx];
                    const g = imgData[pixelIdx + 1];
                    const b = imgData[pixelIdx + 2];
                    const a = imgData[pixelIdx + 3];

                    // Standard luminance grayscale thresholding (including transparency check)
                    if (a > 50) {
                        const gray = 0.299 * r + 0.587 * g + 0.114 * b;
                        if (gray < 160) { // Threshold for black pixel (lower means darker black)
                            bitVal = 1;
                        }
                    }
                }
                
                byteVal = (byteVal << 1) | bitVal;
            }
            rasterData[idx++] = byteVal;
        }
    }

    // Combine Header, Raster Data, Line Feed, and Paper Cut
    const feedCut = new Uint8Array([
        0x1B, 0x64, 5, // Feed 5 lines
        0x1D, 0x56, 66, 0 // Standard partial paper cut
    ]);

    const finalBuffer = new Uint8Array(header.length + rasterData.length + feedCut.length);
    finalBuffer.set(header, 0);
    finalBuffer.set(rasterData, header.length);
    finalBuffer.set(feedCut, header.length + rasterData.length);

    return finalBuffer;
}

/**
 * Transmits binary data to the Bluetooth printer characteristic in chunks.
 */
async function printBinary(writeChar, data, onProgress = () => {}) {
    const chunkSize = 512; // MTU friendly write size
    const totalBytes = data.length;

    for (let offset = 0; offset < totalBytes; offset += chunkSize) {
        const chunk = data.slice(offset, offset + chunkSize);
        
        // Write the chunk (with/without response depending on properties)
        if (writeChar.properties.writeWithoutResponse) {
            await writeChar.writeValueWithoutResponse(chunk);
        } else {
            await writeChar.writeValueWithResponse(chunk);
        }

        const percentage = Math.min(100, Math.round(((offset + chunk.length) / totalBytes) * 100));
        onProgress(`Printing... ${percentage}%`);

        // Tiny sleep to avoid Bluetooth buffer congestion
        await new Promise(resolve => setTimeout(resolve, 25));
    }
}
