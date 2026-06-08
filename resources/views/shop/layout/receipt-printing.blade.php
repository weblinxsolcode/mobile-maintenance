@php
    $activeShop = \App\Models\shop::find(session()->get('shop_id'));
@endphp
{{-- Reusable High-Fidelity ESC/POS Thermal Receipt Printing Modal and Script --}}

<!-- Signature Pad & Processing Libraries -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="{{ asset('assets/js/printing-engine.js') }}"></script>

<!-- Custom Styling for Premium Modal & Signatures -->
<style>
    .print-modal-header {
        background: linear-gradient(135deg, #1e293b, #0f172a);
        color: #fff;
        border-top-left-radius: 14px;
        border-top-right-radius: 14px;
    }

    .print-modal-body {
        max-height: 80vh;
        overflow-y: auto;
        background-color: #f8fafc;
    }

    .sig-canvas-container {
        border: 2px dashed #cbd5e1;
        background-color: #fff;
        border-radius: 10px;
        position: relative;
        overflow: hidden;
        margin-bottom: 8px;
    }

    .sig-canvas {
        width: 100%;
        height: 140px;
        display: block;
        cursor: crosshair;
    }

    .sig-btn-clear {
        position: absolute;
        bottom: 8px;
        right: 8px;
        font-size: 11px;
        padding: 2px 8px;
        z-index: 10;
    }

    .sig-saved-img {
        width: 100%;
        height: 140px;
        object-fit: contain;
        background-color: #fff;
        display: none;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
    }

    .printer-status-bar {
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }

    .printer-status-bar.disconnected {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
    }

    .printer-status-bar.connected {
        background-color: #dcfce7;
        color: #166534;
        border: 1px solid #86efac;
    }

    .printer-status-bar.working {
        background-color: #e0f2fe;
        color: #075985;
        border: 1px solid #7dd3fc;
    }

    /* Offscreen Thermal 58mm (384px) Receipt Styling */
    #thermal-receipt-container {
        position: absolute;
        left: -9999px;
        top: -9999px;
        z-index: -999;
    }

    .thermal-receipt {
        background: #fff;
        color: #000;
        font-family: 'Inter', 'Amiri', 'Courier New', monospace;
        line-height: 1.4;
        padding: 20px 12px;
        box-sizing: border-box;
    }

    .thermal-receipt.paper-58mm {
        width: 384px;
        font-size: 13px;
    }

    .thermal-receipt.paper-80mm {
        width: 576px;
        font-size: 15px;
    }

    .tr-center {
        text-align: center;
    }

    .tr-right {
        text-align: right;
    }

    .tr-left {
        text-align: left;
    }

    .tr-bold {
        font-weight: bold;
    }

    .tr-shop-name {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 4px;
        text-transform: uppercase;
    }

    .tr-title {
        font-size: 17px;
        font-weight: bold;
        border: 2px solid #000;
        padding: 6px 10px;
        margin: 15px auto;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .tr-divider {
        border-top: 1px dashed #000;
        margin: 12px 0;
        height: 0;
    }

    .tr-double-divider {
        border-top: 3px double #000;
        margin: 12px 0;
        height: 0;
    }

    .tr-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 4px;
    }

    .tr-col-label {
        font-weight: bold;
        flex: 1;
    }

    .tr-col-val {
        flex: 1;
        text-align: right;
    }

    .tr-arabic-text {
        font-family: 'Amiri', 'Georgia', serif;
        direction: rtl;
        text-align: right;
    }

    .tr-table {
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0;
    }

    .tr-table th {
        border-bottom: 1px solid #000;
        font-weight: bold;
        text-align: left;
        padding: 4px 0;
    }

    .tr-table td {
        padding: 6px 0;
        vertical-align: top;
    }

    .tr-total-box {
        border: 1px solid #000;
        padding: 8px;
        margin-top: 10px;
        background-color: #f9f9f9;
    }

    .tr-barcode-container,
    .tr-qrcode-container {
        display: flex;
        justify-content: center;
        margin: 14px 0;
    }

    .tr-signature-section {
        display: flex;
        justify-content: space-between;
        margin-top: 25px;
        padding-top: 10px;
    }

    .tr-sig-box {
        width: 45%;
        text-align: center;
    }

    .tr-sig-line {
        border-top: 1px solid #000;
        margin-top: 40px;
        font-size: 11px;
        font-weight: bold;
    }

    .tr-sig-img {
        max-height: 45px;
        max-width: 100%;
        object-fit: contain;
        display: block;
        margin: 0 auto;
    }
</style>

<!-- ================= THERMAL PRINT MODAL ================= -->
<div class="modal fade" id="receiptPrintModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0" style="border-radius: 14px;">
            <div class="modal-header print-modal-header py-3">
                <h5 class="modal-title d-flex align-items-center" id="printModalTitle">
                    <i class="fa fa-print me-2"></i>
                    <span>Receipt Printing Panel</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body print-modal-body">
                <!-- Printer Connection & Settings Card -->
                <div class="card border-0 shadow-sm mb-3" style="border-radius: 10px; background-color: #f1f5f9;">
                    <div class="card-body p-3">
                        <div id="printerStatusBar" class="printer-status-bar disconnected mb-2"
                            style="margin-bottom: 8px;">
                            <i class="fa fa-circle-notch fa-spin status-spinner" style="display: none;"></i>
                            <i class="fab fa-bluetooth status-icon"></i>
                            <span id="printerStatusText" class="fw-bold">Bluetooth Printer Disconnected</span>
                            <button class="btn btn-sm btn-outline-dark ms-auto" id="btnReconnectPrinter"
                                onclick="triggerConnect()">Connect</button>
                        </div>

                        <div class="row g-2 align-items-center">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted mb-1" for="paperSizeSelect">Paper
                                    Size</label>
                                <select id="paperSizeSelect" class="form-select form-select-sm"
                                    onchange="handlePaperSizeChange()">
                                    <option value="58mm">58mm (Receipt)</option>
                                    <option value="80mm">80mm (Invoice)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted mb-1">&nbsp;</label>
                                <div class="form-check form-switch mt-1">
                                    <input class="form-check-input" type="checkbox" id="autoPrintSwitch"
                                        onchange="handleAutoPrintChange()">
                                    <label class="form-check-label small fw-bold"
                                        for="autoPrintSwitch">Auto-Open</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Receipt Customization Form -->
                <form id="receiptConfigForm" onsubmit="event.preventDefault();">
                    <input type="hidden" id="pmJobAppId" value="{{ $jobApp->id }}">
                    <input type="hidden" id="pmReceiptType" value="check_in">

                    <div class="row g-3">
                        <!-- Shop Info Snapshot -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Shop Phone Number</label>
                            <input type="text" class="form-control" id="pmShopPhone"
                                placeholder="Enter shop phone number"
                                value="{{ $activeShop->phone_number ?? '0599-123456' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Shop Address</label>
                            <input type="text" class="form-control" id="pmShopAddress"
                                placeholder="Enter shop address"
                                value="{{ $activeShop->address ?? '123 Main Street, City Centre' }}">
                        </div>

                        <!-- Technician Name -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Technician Name (المهندس المسؤول) *</label>
                            <input type="text" class="form-control" id="pmTechnicianName" required
                                placeholder="Enter technician name"
                                value="{{ $jobApp->technicianInfo->full_name ?? '' }}">
                        </div>

                        <!-- ================= CHECK-IN RECEIPT CONFIG FIELDS ================= -->
                        <div class="col-12" id="checkInFieldsOnly">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Device Condition (حالة الجهاز) *</label>
                                    <select class="form-select" id="pmDeviceCondition">
                                        <option value="Working Status / Good Condition">Working (شغال / ممتاز)</option>
                                        <option value="Broken Screen / Scratches">Scratches / Broken Screen (خدوش / شاشة
                                            مكسورة)</option>
                                        <option value="Not Working / Dead Board">Dead / Not Powering (طافي / لا يعمل)
                                        </option>
                                        <option value="Liquid Damage / Wet">Water Damage (دخول سوائل / رطوبة)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Estimated Cost (التكلفة التقديرية) -
                                        Optional</label>
                                    <input type="number" class="form-control" id="pmEstimatedCost"
                                        placeholder="e.g. 150" value="{{ $jobApp->price ?? '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">Notes / Customer Requests (ملاحظات
                                        المستلم)</label>
                                    <textarea class="form-control" id="pmCheckInNotes" rows="2"
                                        placeholder="Write any scratches, issues, or specific customer requests here...">No specific notes.</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- ================= FINAL RECEIPT CONFIG FIELDS ================= -->
                        <div class="col-12" id="finalFieldsOnly" style="display: none;">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-bold">Repair Details (تفاصيل الإصلاح وعملية الصيانة)
                                        *</label>
                                    <textarea class="form-control" id="pmRepairDetails" rows="2"
                                        placeholder="e.g. Replaced original screen assembly and cleaned charging port.">Screen Replacement & Cleaning</textarea>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="form-label fw-bold mb-0">Parts Used & Prices (قطع الغيار
                                            المستخدمة
                                            وأسعارها)</label>
                                        <button type="button" class="btn btn-xs btn-outline-primary"
                                            onclick="addPartRow()">
                                            <i class="fa fa-plus me-1"></i> Add Part
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm align-middle" id="partsTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Part / Service Name (القطعة)</th>
                                                    <th style="width: 150px;">Price (السعر)</th>
                                                    <th style="width: 50px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="partsTableBody">
                                                <tr>
                                                    <td><input type="text"
                                                            class="form-control form-control-sm part-name"
                                                            value="Original Screen Assembly"
                                                            placeholder="Screen, Battery, etc."></td>
                                                    <td><input type="number"
                                                            class="form-control form-control-sm part-price"
                                                            value="{{ intval($jobApp->price) * 0.7 }}"
                                                            oninput="calculateTotalAmount()" placeholder="Price"></td>
                                                    <td class="text-center"><button type="button"
                                                            class="btn btn-link text-danger p-0"
                                                            onclick="removePartRow(this)"><i
                                                                class="fa fa-trash"></i></button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Labor Cost (أجور اليد / الصيانة) *</label>
                                    <input type="number" class="form-control" id="pmLaborCost"
                                        value="{{ intval($jobApp->price) * 0.3 }}" oninput="calculateTotalAmount()"
                                        placeholder="e.g. 50">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Total Amount Due (المجموع النهائي)</label>
                                    <input type="text" class="form-control fw-bold text-success"
                                        id="pmTotalAmount" readonly value="{{ $jobApp->price }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Warranty Period (فترة الضمان)</label>
                                    <input type="text" class="form-control" id="pmWarrantyNote"
                                        value="{{ $jobApp->warranty ? $jobApp->warranty_months . ' Months Warranty' : '3 Days Checking Warranty' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Job Status</label>
                                    <input type="text" class="form-control fw-bold text-primary" readonly
                                        value="Completed">
                                </div>
                            </div>
                        </div>

                        <!-- ================= SIGNATURE PADS ================= -->
                        <div class="col-12 mt-4">
                            <div class="row g-3">
                                <!-- Customer Signature -->
                                <div class="col-md-6">
                                    <label
                                        class="form-label fw-bold d-flex justify-content-between align-items-center">
                                        <span>Customer Signature (توقيع العميل) *</span>
                                        <span class="text-muted small" style="font-size: 10px;">Draw sign inside
                                            box</span>
                                    </label>
                                    <div class="sig-canvas-container" id="customerSigContainer">
                                        <canvas id="customerSigCanvas" class="sig-canvas"></canvas>
                                        <button type="button" class="btn btn-outline-secondary btn-xs sig-btn-clear"
                                            onclick="clearSignature('customer')">Clear</button>
                                    </div>
                                    <img id="customerSigSavedImg" class="sig-saved-img"
                                        alt="Saved Customer Signature">
                                </div>

                                <!-- Technician Signature (Only for Check-in) -->
                                <div class="col-md-6" id="technicianSigWrapper">
                                    <label
                                        class="form-label fw-bold d-flex justify-content-between align-items-center">
                                        <span>Technician Signature (توقيع المستلم) *</span>
                                        <span class="text-muted small" style="font-size: 10px;">Draw sign inside
                                            box</span>
                                    </label>
                                    <div class="sig-canvas-container" id="technicianSigContainer">
                                        <canvas id="technicianSigCanvas" class="sig-canvas"></canvas>
                                        <button type="button" class="btn btn-outline-secondary btn-xs sig-btn-clear"
                                            onclick="clearSignature('technician')">Clear</button>
                                    </div>
                                    <img id="technicianSigSavedImg" class="sig-saved-img"
                                        alt="Saved Technician Signature">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer bg-light py-3 border-0">
                <button type="button" class="btn btn-outline-secondary btn-rounded"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger btn-rounded" id="btnEditSignature"
                    style="display: none;" onclick="enableSignatureDrawing()">Edit Signatures</button>
                <button type="button" class="btn btn-success btn-rounded" id="btnDownloadPDF"
                    onclick="downloadReceiptPDF()">
                    <i class="fa fa-file-pdf me-1"></i> Save PDF
                </button>
                <button type="button" class="btn btn-primary btn-rounded" id="btnPrintReceiptSubmit"
                    onclick="saveAndPrintReceipt()">
                    <i class="fa fa-print me-1"></i> Save & Direct Print
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ================= OFFSCREEN THERMAL RECEIPT PREVIEW (384px) ================= -->
<div id="thermal-receipt-container">
    <div class="thermal-receipt" id="receiptTemplate">
        <!-- Shop Details -->
        <div class="tr-center">
            @if ($activeShop && $activeShop->profile && file_exists(public_path($activeShop->profile)))
                <img src="{{ asset($activeShop->profile) }}"
                    style="max-height: 50px; width: auto; object-fit: contain; margin-bottom: 8px; filter: grayscale(100%) contrast(200%);">
            @endif
            <div class="tr-shop-name" id="trShopName">{{ $activeShop->title ?? 'MOBILE MAINTENANCE' }}</div>
            <div id="trShopPhone">Phone: {{ $activeShop->phone_number ?? '0599-123456' }}</div>
            <div id="trShopAddress">Address: {{ $activeShop->address ?? '123 Main Street' }}</div>
            <div class="tr-title" id="trReceiptTitle">Check-in Receipt</div>
        </div>

        <div class="tr-divider"></div>

        <!-- Meta Grid -->
        <div class="tr-row">
            <div class="tr-col-label">Job ID (رقم الطلب):</div>
            <div class="tr-col-val tr-bold" id="trJobId">#{{ $jobApp->id }}</div>
        </div>
        <div class="tr-row">
            <div class="tr-col-label">Date & Time:</div>
            <div class="tr-col-val" id="trDateTime">30/05/2026 12:00 PM</div>
        </div>

        <div class="tr-divider"></div>

        <!-- Customer Section -->
        <div class="tr-bold" style="text-decoration: underline; margin-bottom: 6px;">Customer Details (العميل):</div>
        <div class="tr-row">
            <div>Name: <span class="tr-bold" id="trCustomerName">{{ $jobApp->userInfo->full_name ?? 'N/A' }}</span>
            </div>
            <div>Phone: <span class="tr-bold"
                    id="trCustomerPhone">{{ $jobApp->userInfo->phone ?? ($jobApp->jobInfo->phone_number ?? 'N/A') }}</span>
            </div>
        </div>

        <div class="tr-divider"></div>

        <!-- Device Section -->
        <div class="tr-row">
            <div class="tr-col-label">Device Type:</div>
            <div class="tr-col-val tr-bold" id="trDeviceType">{{ $jobApp->jobInfo->brand ?? 'N/A' }}
                {{ $jobApp->jobInfo->model ?? 'N/A' }}
            </div>
        </div>
        <div class="tr-bold" style="margin-top: 6px;">Issue Description:</div>
        <div style="margin-bottom: 4px; font-style: italic;" id="trIssueDescription">
            {{ $jobApp->jobInfo->description ?? 'No issue description.' }}
        </div>

        <div class="tr-divider"></div>

        <!-- Dynamic Check-in Receipt Info -->
        <div id="trCheckInOnly">
            <div class="tr-row">
                <div class="tr-col-label">Device Condition:</div>
                <div class="tr-col-val tr-bold" id="trDeviceCondition">Working Condition</div>
            </div>
            <div class="tr-row">
                <div class="tr-col-label">Estimated Cost:</div>
                <div class="tr-col-val tr-bold" id="trEstimatedCost">{{ env('APP_CURRENCY', 'IQD') }}
                    {{ $jobApp->price ?? '0.00' }}</div>
            </div>
            <div class="tr-bold" style="margin-top: 6px;">Check-in Notes:</div>
            <div style="font-style: italic;" id="trCheckInNotesText">None</div>
        </div>

        <!-- Dynamic Final Receipt Info -->
        <div id="trFinalOnly" style="display: none;">
            <div class="tr-bold" style="margin-top: 6px;">Repair Details:</div>
            <div style="margin-bottom: 8px; font-style: italic;" id="trRepairDetailsText">Screen replaced.</div>

            <!-- Parts Table -->
            <table class="tr-table">
                <thead>
                    <tr>
                        <th>Part / Service Details</th>
                        <th style="text-align: right;">Price</th>
                    </tr>
                </thead>
                <tbody id="trPartsTableBody">
                    <tr>
                        <td>Original Screen replacement</td>
                        <td style="text-align: right;">$140.00</td>
                    </tr>
                </tbody>
            </table>

            <div class="tr-row">
                <div class="tr-col-label">Labor Cost (الصيانة):</div>
                <div class="tr-col-val" id="trLaborCost">$50.00</div>
            </div>

            <!-- Double divider before total -->
            <div class="tr-double-divider"></div>

            <div class="tr-row tr-bold" style="font-size: 16px;">
                <div>TOTAL DUE (المطلوب):</div>
                <div id="trTotalAmount">$190.00</div>
            </div>

            <div class="tr-row tr-bold" style="margin-top: 8px; font-size: 14px;">
                <div>Job Status:</div>
                <div class="tr-arabic-text" style="color: green;">COMPLETED (تمت الصيانة)</div>
            </div>

            <div class="tr-divider"></div>

            <div class="tr-center tr-bold" style="font-size: 12px; margin-top: 4px;" id="trWarrantyNote">
                3 Days Checking Warranty
            </div>

            <!-- Barcode for Job ID -->
            <div class="tr-barcode-container">
                <svg id="trBarcode"></svg>
            </div>
        </div>

        <div class="tr-divider"></div>

        <div class="tr-row">
            <div class="tr-col-label">Technician (المستلم):</div>
            <div class="tr-col-val tr-bold" id="trTechnicianName">Engineer</div>
        </div>

        <!-- QR Code Tracking Link -->
        <div class="tr-center" style="font-size: 10px; margin-top: 8px; font-weight: bold;">
            Scan to track maintenance status:
        </div>
        <div class="tr-qrcode-container">
            <canvas id="trQrcode"></canvas>
        </div>

        <!-- Dual Signature Area -->
        <div class="tr-signature-section">
            <div class="tr-sig-box">
                <div style="height: 45px; display: flex; align-items: center; justify-content: center;">
                    <img id="trCustomerSigImg" class="tr-sig-img" src="" style="display: none;"
                        alt="Customer Signature">
                </div>
                <div class="tr-sig-line">Customer Signature</div>
            </div>
            <div class="tr-sig-box" id="trTechnicianSigBox">
                <div style="height: 45px; display: flex; align-items: center; justify-content: center;">
                    <img id="trTechnicianSigImg" class="tr-sig-img" src="" style="display: none;"
                        alt="Technician Signature">
                </div>
                <div class="tr-sig-line">Technician Signature</div>
            </div>
        </div>

        <!-- Footer terms -->
        <div class="tr-divider"></div>
        <div class="tr-center" style="font-size: 9px; font-weight: bold;">
            شكراً لثقتكم بنا - Thank you for choosing us!
        </div>
    </div>
</div>

<!-- ================= CORE MODAL INTERACTIVE JAVASCRIPT ================= -->
<script>
    /**
     * =====================================================================
     *  FIXED: receipt-modal-fixed.js
     *  Drop this inside your <script> tag in the Blade partial.
     *  Fixes:
     *    1. isPrinterConnected() now reads a single reliable flag.
     *    2. connectPrinter() is called ONCE and the characteristic is cached.
     *    3. renderAndSendToPrinter() reuses the cached characteristic — no
     *       second connectPrinter() call that clears the connected state.
     *    4. Status bar stays green after a successful connection.
     * =====================================================================
     */

    let customerSignaturePad = null;
    let technicianSignaturePad = null;
    let loadedReceiptRecord = null;

    /* ── Single source-of-truth for the BT connection ─────────────────── */
    let _cachedWriteChar = null; // the GATT characteristic we write to
    let _printerConnected = false; // mirrors the status bar colour

    /** Returns true only when we have a live, usable characteristic. */
    function isPrinterConnected() {
        return _printerConnected && _cachedWriteChar !== null;
    }

    /** Update every visual indicator in one place. */
    function _setStatus(state, message) {
        // state: 'connected' | 'disconnected' | 'working'
        const bar = document.getElementById('printerStatusBar');
        const text = document.getElementById('printerStatusText');
        const btn = document.getElementById('btnReconnectPrinter');
        const spinner = bar.querySelector('.status-spinner');
        const icon = bar.querySelector('.status-icon');

        if (!bar) return;

        bar.className = `printer-status-bar ${state}`;

        if (text) text.innerText = message;
        if (spinner) spinner.style.display = state === 'working' ? 'inline-block' : 'none';
        if (icon) icon.style.display = state !== 'working' ? 'inline-block' : 'none';

        if (btn) {
            if (state === 'connected') {
                btn.innerText = 'Connected';
                btn.disabled = true;
            } else {
                btn.innerText = state === 'working' ? 'Connecting…' : 'Connect';
                btn.disabled = state === 'working';
            }
        }

        if (state === 'connected') {
            _printerConnected = true;
        } else if (state === 'disconnected') {
            _printerConnected = false;
            _cachedWriteChar = null;
        }
    }

    /* ── Listen for events fired by printing-engine.js ────────────────── */
    window.addEventListener('printerconnected', (e) => {
        _setStatus('connected', `Connected: ${e.detail?.deviceName ?? 'Bluetooth Printer'}`);
    });

    window.addEventListener('printerdisconnected', () => {
        _setStatus('disconnected', 'Bluetooth Printer Disconnected');
    });

    /* ── Connect button handler ────────────────────────────────────────── */
    async function triggerConnect() {
        _setStatus('working', 'Connecting to Bluetooth…');

        try {
            /*
             * connectPrinter() from printing-engine.js must return the writable
             * GATT characteristic (or throw on failure).
             * Pass a status-callback so it can give intermediate messages.
             */
            const char = await connectPrinter((msg, ok) => {
                if (ok === true) {
                    _cachedWriteChar = char; // set below if resolve; redundant but safe
                    _setStatus('connected', msg);
                } else if (ok === false) {
                    _setStatus('disconnected', msg);
                } else {
                    // intermediate / undefined – keep spinner
                    const bar = document.getElementById('printerStatusBar');
                    if (bar) bar.className = 'printer-status-bar working';
                    const text = document.getElementById('printerStatusText');
                    if (text) text.innerText = msg;
                }
            });

            /* connectPrinter resolved → we have the characteristic */
            if (char) {
                _cachedWriteChar = char;
                _printerConnected = true;
                _setStatus('connected', 'Printer Connected & Ready!');
                localStorage.setItem('printer_was_connected', '1');
            }

        } catch (err) {
            console.error('Web Bluetooth connection failed', err);
            _setStatus('disconnected', 'Connection failed – try again');
        }
    }

    /* ── Auto-reconnect on modal open ──────────────────────────────────── */
    async function _tryAutoReconnect() {
        const wasConnected = localStorage.getItem('printer_was_connected') === '1';
        if (!wasConnected) return;

        _setStatus('working', 'Auto-reconnecting…');
        try {
            const char = await connectPrinter(null); // silent reconnect
            if (char) {
                _cachedWriteChar = char;
                _printerConnected = true;
                _setStatus('connected', 'Printer reconnected!');
            }
        } catch {
            _setStatus('disconnected', 'Bluetooth Printer Disconnected');
        }
    }

    /* ================================================================== */
    /*  DOM READY                                                           */
    /* ================================================================== */
    document.addEventListener('DOMContentLoaded', function() {
        initSignaturePads();
    });

    function initSignaturePads() {
        const cCanvas = document.getElementById('customerSigCanvas');
        const tCanvas = document.getElementById('technicianSigCanvas');

        if (cCanvas) {
            customerSignaturePad = new SignaturePad(cCanvas, {
                backgroundColor: 'rgb(255, 255, 255)',
                penColor: 'rgb(0, 0, 0)'
            });
            resizeCanvas(cCanvas);
        }
        if (tCanvas) {
            technicianSignaturePad = new SignaturePad(tCanvas, {
                backgroundColor: 'rgb(255, 255, 255)',
                penColor: 'rgb(0, 0, 0)'
            });
            resizeCanvas(tCanvas);
        }
    }

    function resizeCanvas(canvas) {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext('2d').scale(ratio, ratio);
    }

    function clearSignature(type) {
        if (type === 'customer' && customerSignaturePad) customerSignaturePad.clear();
        if (type === 'technician' && technicianSignaturePad) technicianSignaturePad.clear();
    }

    /* ================================================================== */
    /*  PAPER SIZE / AUTO-PRINT SETTINGS                                   */
    /* ================================================================== */
    function handlePaperSizeChange() {
        const size = document.getElementById('paperSizeSelect')?.value;
        if (!size) return;
        localStorage.setItem('printer_paper_size', size);
        const template = document.getElementById('receiptTemplate');
        if (template) {
            template.className = `thermal-receipt paper-${size}`;
            template.style.width = size === '80mm' ? '576px' : '384px';
        }
    }

    function handleAutoPrintChange() {
        const checked = document.getElementById('autoPrintSwitch')?.checked;
        localStorage.setItem('auto_print_on_completion', checked);
    }

    /* ================================================================== */
    /*  OPEN MODAL                                                          */
    /* ================================================================== */
    function openPrintModal(type) {
        const modalEl = document.getElementById('receiptPrintModal');
        const titleText = document.getElementById('printModalTitle').querySelector('span');
        const typeInput = document.getElementById('pmReceiptType');

        typeInput.value = type;
        loadedReceiptRecord = null;

        if (type === 'check_in') {
            titleText.innerText = 'Print Check-in Receipt (استلام الجهاز)';
            document.getElementById('checkInFieldsOnly').style.display = 'block';
            document.getElementById('finalFieldsOnly').style.display = 'none';
            document.getElementById('technicianSigWrapper').style.display = 'block';
        } else {
            titleText.innerText = 'Print Final Receipt (بعد الصيانة)';
            document.getElementById('checkInFieldsOnly').style.display = 'none';
            document.getElementById('finalFieldsOnly').style.display = 'block';
            document.getElementById('technicianSigWrapper').style.display = 'none';
        }
        document.getElementById('btnPrintReceiptSubmit').innerText = 'Save & Direct Print';

        document.getElementById('receiptConfigForm').reset();
        enableSignatureDrawing();
        clearSignature('customer');
        clearSignature('technician');

        /* Restore paper-size & auto-print preferences */
        const savedSize = localStorage.getItem('printer_paper_size') || '58mm';
        const sizeSelect = document.getElementById('paperSizeSelect');
        if (sizeSelect) sizeSelect.value = savedSize;

        const template = document.getElementById('receiptTemplate');
        if (template) {
            template.className = `thermal-receipt paper-${savedSize}`;
            template.style.width = savedSize === '80mm' ? '576px' : '384px';
        }

        const autoSwitch = document.getElementById('autoPrintSwitch');
        if (autoSwitch) autoSwitch.checked = localStorage.getItem('auto_print_on_completion') === 'true';

        /* ── Reflect current connection state immediately ──────────────── */
        if (isPrinterConnected()) {
            _setStatus('connected', 'Printer Connected & Ready!');
        } else {
            _setStatus('disconnected', 'Bluetooth Printer Disconnected');
            /* Attempt silent auto-reconnect in background */
            _tryAutoReconnect();
        }

        /* ── Load saved receipt from server if it exists ───────────────── */
        const jobId = document.getElementById('pmJobAppId').value;
        const fetchUrl = "{{ route('shop.receipts.get', [':jobId', ':type']) }}"
            .replace(':jobId', jobId)
            .replace(':type', type);

        fetch(fetchUrl)
            .then(res => res.ok ? res.json() : null)
            .then(data => {
                if (data?.success) {
                    loadedReceiptRecord = data.receipt;
                    prefillSavedReceipt(data.receipt);
                }
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
                setTimeout(() => {
                    if (customerSignaturePad) resizeCanvas(document.getElementById('customerSigCanvas'));
                    if (technicianSignaturePad) resizeCanvas(document.getElementById(
                    'technicianSigCanvas'));
                }, 400);
            })
            .catch(err => {
                console.error(err);
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            });
    }

    /* ================================================================== */
    /*  PREFILL / SIGNATURE HELPERS                                         */
    /* ================================================================== */
    function prefillSavedReceipt(receipt) {
        document.getElementById('pmShopPhone').value = receipt.shop_phone;
        document.getElementById('pmShopAddress').value = receipt.shop_address;

        const data = receipt.receipt_data;
        document.getElementById('pmTechnicianName').value = data.technician_name || '';

        if (receipt.receipt_type === 'check_in') {
            document.getElementById('pmDeviceCondition').value = data.device_condition || '';
            document.getElementById('pmEstimatedCost').value = data.estimated_cost || '';
            document.getElementById('pmCheckInNotes').value = data.notes || '';
        } else {
            document.getElementById('pmRepairDetails').value = data.repair_details || '';
            document.getElementById('pmLaborCost').value = data.labor_cost || '';
            document.getElementById('pmTotalAmount').value = data.total_amount || '';
            document.getElementById('pmWarrantyNote').value = data.warranty_period || '';

            const partsBody = document.getElementById('partsTableBody');
            partsBody.innerHTML = '';
            if (data.parts?.length) {
                data.parts.forEach(part => {
                    const row = document.createElement('tr');
                    row.innerHTML =
                        `
                    <td><input type="text"   class="form-control form-control-sm part-name"  value="${part.name}"></td>
                    <td><input type="number" class="form-control form-control-sm part-price" value="${part.price}" oninput="calculateTotalAmount()"></td>
                    <td class="text-center"><button type="button" class="btn btn-link text-danger p-0" onclick="removePartRow(this)"><i class="fa fa-trash"></i></button></td>`;
                    partsBody.appendChild(row);
                });
            } else {
                addPartRow();
            }
        }

        disableSignatureDrawing(receipt.customer_signature, receipt.technician_signature);
        document.getElementById('btnPrintReceiptSubmit').innerText = 'Direct Reprint';
    }

    function disableSignatureDrawing(cSigUrl = null, tSigUrl = null) {
        const customerImg = document.getElementById('customerSigSavedImg');
        const customerCont = document.getElementById('customerSigContainer');
        const techImg = document.getElementById('technicianSigSavedImg');
        const techCont = document.getElementById('technicianSigContainer');
        const btnEdit = document.getElementById('btnEditSignature');

        if (cSigUrl) {
            customerImg.src = cSigUrl;
            customerImg.style.display = 'block';
            customerCont.style.display = 'none';
        }

        const type = document.getElementById('pmReceiptType').value;
        if (tSigUrl && type === 'check_in') {
            techImg.src = tSigUrl;
            techImg.style.display = 'block';
            techCont.style.display = 'none';
        } else {
            techCont.style.display = 'none';
            techImg.style.display = 'none';
        }

        btnEdit.style.display = 'inline-block';
    }

    function enableSignatureDrawing() {
        document.getElementById('customerSigSavedImg').style.display = 'none';
        document.getElementById('customerSigContainer').style.display = 'block';

        const type = document.getElementById('pmReceiptType').value;
        if (type === 'check_in') {
            document.getElementById('technicianSigSavedImg').style.display = 'none';
            document.getElementById('technicianSigContainer').style.display = 'block';
        } else {
            document.getElementById('technicianSigContainer').style.display = 'none';
        }

        document.getElementById('btnEditSignature').style.display = 'none';
        document.getElementById('btnPrintReceiptSubmit').innerText = 'Save & Direct Print';

        setTimeout(() => {
            if (customerSignaturePad) {
                customerSignaturePad.clear();
                resizeCanvas(document.getElementById('customerSigCanvas'));
            }
            if (technicianSignaturePad && type === 'check_in') {
                technicianSignaturePad.clear();
                resizeCanvas(document.getElementById('technicianSigCanvas'));
            }
        }, 100);
    }

    /* ================================================================== */
    /*  PARTS TABLE HELPERS                                                 */
    /* ================================================================== */
    function addPartRow() {
        const tbody = document.getElementById('partsTableBody');
        const tr = document.createElement('tr');
        tr.innerHTML =
            `
        <td><input type="text"   class="form-control form-control-sm part-name"  placeholder="Part Name"></td>
        <td><input type="number" class="form-control form-control-sm part-price" value="0" oninput="calculateTotalAmount()" placeholder="Price"></td>
        <td class="text-center"><button type="button" class="btn btn-link text-danger p-0" onclick="removePartRow(this)"><i class="fa fa-trash"></i></button></td>`;
        tbody.appendChild(tr);
    }

    function removePartRow(button) {
        button.closest('tr').remove();
        calculateTotalAmount();
    }

    function calculateTotalAmount() {
        let total = 0;
        document.querySelectorAll('.part-price').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        total += parseFloat(document.getElementById('pmLaborCost').value) || 0;
        document.getElementById('pmTotalAmount').value = total.toFixed(2);
    }

    /* ================================================================== */
    /*  SAVE & PRINT                                                        */
    /* ================================================================== */
    async function saveAndPrintReceipt() {
        const jobId = document.getElementById('pmJobAppId').value;
        const type = document.getElementById('pmReceiptType').value;
        const shopPhone = document.getElementById('pmShopPhone').value;
        const shopAddr = document.getElementById('pmShopAddress').value;
        const techName = document.getElementById('pmTechnicianName').value;

        if (!techName) {
            alert('Please enter the technician name.');
            return;
        }

        /* ── Collect signatures ──────────────────────────────────────── */
        let customerSigUrl = '';
        let technicianSigUrl = '';

        const customerImg = document.getElementById('customerSigSavedImg');
        const technicianImg = document.getElementById('technicianSigSavedImg');

        if (customerImg.style.display === 'block') {
            customerSigUrl = customerImg.src;
        } else {
            if (customerSignaturePad.isEmpty()) {
                alert('Please request the customer signature.');
                return;
            }
            customerSigUrl = customerSignaturePad.toDataURL('image/png');
        }

        if (type === 'check_in') {
            if (technicianImg.style.display === 'block') {
                technicianSigUrl = technicianImg.src;
            } else {
                if (technicianSignaturePad.isEmpty()) {
                    alert('Please request the technician signature.');
                    return;
                }
                technicianSigUrl = technicianSignaturePad.toDataURL('image/png');
            }
        }

        /* ── Build receipt payload ───────────────────────────────────── */
        let receiptData = {
            technician_name: techName
        };

        if (type === 'check_in') {
            receiptData.device_condition = document.getElementById('pmDeviceCondition').value;
            receiptData.estimated_cost = document.getElementById('pmEstimatedCost').value;
            receiptData.notes = document.getElementById('pmCheckInNotes').value;
        } else {
            receiptData.repair_details = document.getElementById('pmRepairDetails').value;
            receiptData.labor_cost = document.getElementById('pmLaborCost').value;
            receiptData.total_amount = document.getElementById('pmTotalAmount').value;
            receiptData.warranty_period = document.getElementById('pmWarrantyNote').value;

            const parts = [];
            document.querySelectorAll('#partsTableBody tr').forEach(row => {
                const name = row.querySelector('.part-name').value;
                const price = parseFloat(row.querySelector('.part-price').value) || 0;
                if (name) parts.push({
                    name,
                    price
                });
            });
            receiptData.parts = parts;
        }

        /* ── Offer to connect printer if not already connected ──────── */
        if (!isPrinterConnected()) {
            const connectNow = confirm('Bluetooth printer is not connected. Connect and print now?');
            if (connectNow) {
                _setStatus('working', 'Connecting…');
                try {
                    const char = await connectPrinter((msg, ok) => {
                        if (ok === true) _setStatus('connected', msg);
                        else if (ok === false) _setStatus('disconnected', msg);
                    });
                    if (char) {
                        _cachedWriteChar = char;
                        _printerConnected = true;
                        _setStatus('connected', 'Printer Connected & Ready!');
                        localStorage.setItem('printer_was_connected', '1');
                    }
                } catch (e) {
                    _setStatus('disconnected', 'Connection cancelled / failed');
                    alert('Printer connection failed. The receipt will still be saved, but not printed.');
                }
            }
        }

        /* ── Save to server ──────────────────────────────────────────── */
        const saveBtn = document.getElementById('btnPrintReceiptSubmit');
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="fa fa-circle-notch fa-spin me-1"></i> Saving receipt…';

        fetch("{{ route('shop.receipts.save') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    job_application_id: jobId,
                    receipt_type: type,
                    shop_phone: shopPhone,
                    shop_address: shopAddr,
                    customer_signature: customerSigUrl,
                    technician_signature: technicianSigUrl,
                    receipt_data: receiptData
                })
            })
            .then(res => res.json())
            .then(async response => {
                if (response.success) {
                    loadedReceiptRecord = response.receipt;
                    disableSignatureDrawing(customerSigUrl, technicianSigUrl);
                    saveBtn.innerText = 'Direct Reprint';

                    if (isPrinterConnected()) {
                        await renderAndSendToPrinter(response.receipt);
                    } else {
                        alert('Receipt saved! Connect the printer to print.');
                    }
                } else {
                    alert('Save failed: ' + response.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert('Something went wrong while saving the receipt.');
            })
            .finally(() => {
                saveBtn.disabled = false;
            });
    }

    /* ================================================================== */
    /*  RENDER & SEND TO PRINTER                                            */
    /*  KEY FIX: reuses _cachedWriteChar — NO second connectPrinter() call */
    /* ================================================================== */
    async function renderAndSendToPrinter(receipt) {
        const printBtn = document.getElementById('btnPrintReceiptSubmit');
        printBtn.disabled = true;
        printBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i> Rasterizing…';

        try {
            /* 1. Populate offscreen receipt DOM */
            _populateReceiptTemplate(receipt);

            /* 2. Give images time to load */
            await new Promise(r => setTimeout(r, 300));

            /* 3. html2canvas → canvas */
            const paperSize = localStorage.getItem('printer_paper_size') || '58mm';
            const paperWidth = paperSize === '80mm' ? 576 : 384;
            const receiptNode = document.getElementById('receiptTemplate');

            receiptNode.style.display = 'block';
            receiptNode.className = `thermal-receipt paper-${paperSize}`;
            receiptNode.style.width = paperWidth + 'px';

            const canvas = await html2canvas(receiptNode, {
                width: paperWidth,
                scale: 1,
                logging: false,
                backgroundColor: '#ffffff'
            });
            receiptNode.style.display = 'none';

            /* 4. ESC/POS binary */
            _setStatus('working', 'Compiling ESC/POS commands…');
            const escPosBinary = canvasToEscPos(canvas);

            /* 5. Send via the CACHED characteristic — NOT a new connectPrinter() call */
            if (!_cachedWriteChar) throw new Error('Printer is not connected.');

            _setStatus('working', 'Sending to printer…');
            await printBinary(_cachedWriteChar, escPosBinary, (msg) => {
                const text = document.getElementById('printerStatusText');
                if (text) text.innerText = msg;
            });

            _setStatus('connected', 'Printing completed!');

        } catch (error) {
            console.error(error);
            _setStatus('disconnected', 'Printing failed: ' + error.message);
            alert('Thermal Printing Error: ' + error.message);
        } finally {
            printBtn.disabled = false;
            printBtn.innerText = loadedReceiptRecord ? 'Direct Reprint' : 'Save & Direct Print';
        }
    }

    /* ================================================================== */
    /*  DOWNLOAD PDF                                                        */
    /* ================================================================== */
    async function downloadReceiptPDF() {
        const btnPdf = document.getElementById('btnDownloadPDF');

        if (!loadedReceiptRecord) {
            const go = confirm('Save the receipt first. Proceed to save now?');
            if (go) await saveAndPrintReceipt();
            return;
        }

        btnPdf.disabled = true;
        btnPdf.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i> Generating PDF…';

        try {
            const receipt = loadedReceiptRecord;
            const paperSize = localStorage.getItem('printer_paper_size') || '58mm';
            const paperWidth = paperSize === '80mm' ? 576 : 384;

            _populateReceiptTemplate(receipt);
            await new Promise(r => setTimeout(r, 300));

            const receiptNode = document.getElementById('receiptTemplate');
            receiptNode.style.display = 'block';
            receiptNode.className = `thermal-receipt paper-${paperSize}`;
            receiptNode.style.width = paperWidth + 'px';

            const opt = {
                margin: 0.15,
                filename: `receipt_${receipt.receipt_type}_job_${receipt.job_application_id}.pdf`,
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    logging: false
                },
                jsPDF: {
                    unit: 'in',
                    format: paperSize === '80mm' ? [6.2, 8.8] : [4.2, 7.8],
                    orientation: 'portrait'
                }
            };

            await html2pdf().from(receiptNode).set(opt).save();
            receiptNode.style.display = 'none';

        } catch (err) {
            console.error(err);
            alert('PDF Generation failed: ' + err.message);
        } finally {
            btnPdf.disabled = false;
            btnPdf.innerHTML = '<i class="fa fa-file-pdf me-1"></i> Save PDF';
        }
    }

    /* ================================================================== */
    /*  SHARED HELPER: populates the offscreen receipt template             */
    /* ================================================================== */
    function _populateReceiptTemplate(receipt) {
        const data = receipt.receipt_data;
        const paperSize = localStorage.getItem('printer_paper_size') || '58mm';

        document.getElementById('trShopPhone').innerText = 'Phone: ' + receipt.shop_phone;
        document.getElementById('trShopAddress').innerText = 'Address: ' + receipt.shop_address;
        document.getElementById('trReceiptTitle').innerText = receipt.receipt_type === 'check_in' ? 'Check-in Receipt' :
            'Final Receipt';

        const date = new Date(receipt.created_at || new Date());
        document.getElementById('trDateTime').innerText = date.toLocaleString('en-US', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });

        document.getElementById('trTechnicianName').innerText = data.technician_name;

        const cSigImg = document.getElementById('trCustomerSigImg');
        cSigImg.src = receipt.customer_signature;
        cSigImg.style.display = 'block';

        const tSigImg = document.getElementById('trTechnicianSigImg');
        const tSigBox = document.getElementById('trTechnicianSigBox');

        if (receipt.receipt_type === 'check_in') {
            document.getElementById('trCheckInOnly').style.display = 'block';
            document.getElementById('trFinalOnly').style.display = 'none';

            document.getElementById('trDeviceCondition').innerText = data.device_condition;
            document.getElementById('trEstimatedCost').innerText = data.estimated_cost ?
                ('$' + parseFloat(data.estimated_cost).toFixed(2)) : '—';
            document.getElementById('trCheckInNotesText').innerText = data.notes || 'None';

            tSigImg.src = receipt.technician_signature;
            tSigImg.style.display = 'block';
            tSigBox.style.display = 'block';

        } else {
            document.getElementById('trCheckInOnly').style.display = 'none';
            document.getElementById('trFinalOnly').style.display = 'block';

            document.getElementById('trRepairDetailsText').innerText = data.repair_details;
            document.getElementById('trLaborCost').innerText = '$' + parseFloat(data.labor_cost).toFixed(2);
            document.getElementById('trTotalAmount').innerText = '$' + parseFloat(data.total_amount).toFixed(2);
            document.getElementById('trWarrantyNote').innerText = data.warranty_period || 'No Warranty';
            tSigBox.style.display = 'none';

            const trPartsBody = document.getElementById('trPartsTableBody');
            trPartsBody.innerHTML = '';
            if (data.parts?.length) {
                data.parts.forEach(part => {
                    const tr = document.createElement('tr');
                    tr.innerHTML =
                        `<td>${part.name}</td><td style="text-align:right;">$${parseFloat(part.price).toFixed(2)}</td>`;
                    trPartsBody.appendChild(tr);
                });
            } else {
                trPartsBody.innerHTML = '<tr><td colspan="2">No hardware parts used.</td></tr>';
            }

            const barWidth = paperSize === '80mm' ? 3 : 2;
            const barHeight = paperSize === '80mm' ? 50 : 40;
            const barFont = paperSize === '80mm' ? 12 : 10;
            JsBarcode('#trBarcode', receipt.job_application_id.toString(), {
                format: 'CODE128',
                width: barWidth,
                height: barHeight,
                displayValue: true,
                fontSize: barFont,
                margin: 0
            });
        }

        const trackingUrl = `${window.location.origin}/track/${receipt.job_application_id}`;
        const qrSize = paperSize === '80mm' ? 120 : 90;
        new QRious({
            element: document.getElementById('trQrcode'),
            value: trackingUrl,
            size: qrSize
        });
    }
</script>
