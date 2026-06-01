<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <!-- Premium Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome & Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- html2pdf Client Generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-light: #eff6ff;
            --success: #16a34a;
            --success-light: #f0fdf4;
            --warning: #ca8a04;
            --warning-light: #fefce8;
            --info: #0891b2;
            --info-light: #ecfeff;
            --dark: #0f172a;
            --slate-300: #cbd5e1;
            --slate-600: #475569;
            --bg-body: #f8fafc;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-body);
            color: var(--dark);
            line-height: 1.5;
            padding-bottom: 40px;
        }

        /* Container Layout */
        .container {
            max-width: 550px;
            margin: 0 auto;
            padding: 16px;
        }

        /* Glassmorphic Brand Header */
        .brand-header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            padding: 24px 20px;
            border-radius: 16px;
            color: white;
            text-align: center;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .brand-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, transparent 60%);
            pointer-events: none;
        }

        .shop-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .job-id {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .job-date {
            font-size: 13px;
            opacity: 0.75;
        }

        /* Status Progress Timeline Cards */
        .card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            border: 1px solid #f1f5f9;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 8px;
        }

        .card-title-ar {
            font-family: 'Amiri', serif;
            font-size: 18px;
            color: var(--slate-600);
        }

        /* Stepper Engine */
        .stepper {
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: relative;
            padding-left: 32px;
        }

        .stepper::before {
            content: '';
            position: absolute;
            left: 11px;
            top: 10px;
            bottom: 10px;
            width: 3px;
            background-color: var(--slate-300);
            z-index: 1;
        }

        .step-item {
            position: relative;
            z-index: 2;
        }

        .step-badge {
            position: absolute;
            left: -32px;
            top: 2px;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: white;
            border: 3px solid var(--slate-300);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .step-badge i {
            font-size: 10px;
            color: white;
            display: none;
        }

        .step-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .step-label {
            font-weight: 600;
            font-size: 15px;
            color: var(--slate-600);
        }

        .step-label-ar {
            font-family: 'Amiri', serif;
            font-size: 15px;
            display: block;
            color: #64748b;
            margin-top: -2px;
        }

        .step-time {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
        }

        /* Active/Completed Step Styles */
        .step-item.completed .step-badge {
            background-color: var(--success);
            border-color: var(--success);
        }
        .step-item.completed .step-badge i {
            display: block;
        }
        .step-item.completed .step-label {
            color: var(--dark);
        }

        .step-item.active .step-badge {
            background-color: var(--primary);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37,99,235,0.2);
            animation: pulse-ring 1.5s infinite;
        }
        .step-item.active .step-label {
            color: var(--primary);
            font-weight: 700;
        }

        /* Progress Bar Timeline Connections */
        .stepper-connect {
            position: absolute;
            left: 11px;
            top: 10px;
            width: 3px;
            background-color: var(--success);
            z-index: 1;
            transition: height 0.5s ease;
        }

        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(37,99,235,0.4); }
            70% { box-shadow: 0 0 0 6px rgba(37,99,235,0); }
            100% { box-shadow: 0 0 0 0 rgba(37,99,235,0); }
        }

        /* Details List Card */
        .details-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #f1f5f9;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-size: 14px;
            color: var(--slate-600);
            font-weight: 500;
        }

        .detail-label-ar {
            font-family: 'Amiri', serif;
            font-size: 14px;
            color: #94a3b8;
            display: block;
        }

        .detail-val {
            font-size: 14px;
            font-weight: 600;
            text-align: right;
        }

        /* Receipts Section */
        .receipt-btn-container {
            display: flex;
            gap: 10px;
            margin-top: 14px;
        }

        .btn-receipt {
            flex: 1;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid var(--slate-300);
            background: white;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-receipt:hover {
            border-color: var(--primary);
            color: var(--primary);
            background-color: var(--primary-light);
        }

        .btn-receipt.active {
            border-color: var(--primary);
            background-color: var(--primary);
            color: white;
        }

        /* Snapshots Modal */
        .receipt-snapshot-box {
            display: none;
            background: #fafafb;
            border-radius: 12px;
            padding: 16px;
            margin-top: 15px;
            border: 1px solid #e2e8f0;
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
        }

        /* Shop Information Footer */
        .shop-footer {
            background-color: var(--dark);
            color: white;
            border-radius: 16px;
            padding: 24px 20px;
            text-align: center;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        }

        .shop-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .shop-info-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            color: #94a3b8;
            margin-top: 8px;
        }

        .shop-info-row a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 600;
        }

        /* Real Receipt Design in Tracking Page */
        .receipt-visual {
            width: 100%;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
            border: 1px solid #cbd5e1;
            padding: 20px 14px;
            font-family: 'Outfit', sans-serif;
            color: black;
            box-sizing: border-box;
            border-radius: 12px;
            margin-top: 15px;
        }

        .tr-arabic {
            font-family: 'Amiri', serif;
            direction: rtl;
            text-align: right;
        }

        .tr-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 13px;
        }

        .tr-divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        .tr-bold {
            font-weight: bold;
        }

        .tr-signature-box {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .tr-sig-col {
            width: 45%;
            text-align: center;
            font-size: 12px;
        }

        .tr-sig-img {
            max-height: 45px;
            max-width: 100%;
            object-fit: contain;
            display: block;
            margin: 0 auto 4px auto;
            border-bottom: 1px solid #000;
        }

        .tr-logo {
            text-align: center;
            font-size: 18px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .parts-item {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            padding: 3px 0;
        }
    </style>
</head>
<body>

    <div class="container">
        
        <!-- Brand Header Section -->
        <div class="brand-header">
            <span class="shop-badge">{{ $job->shopInfo->title ?? 'SHOP REPAIR' }}</span>
            <div class="job-id">Job Application #{{ $job->id }}</div>
            <div class="job-date">
                Received: {{ $job->created_at ? $job->created_at->format('M d, Y h:i A') : 'N/A' }}
            </div>
        </div>

        <!-- 1. PROGRESS TIMELINE -->
        <div class="card">
            <div class="card-title">
                <span>Repair Timeline</span>
                <span class="card-title-ar">حالة الطلب</span>
            </div>
            
            <div class="stepper">
                @php
                    $status = $job->status;
                    $step1 = in_array($status, ['accepted', 'under_review', 'under_repair', 'ready_for_pickup', 'delivered']);
                    $step2 = in_array($status, ['under_review', 'under_repair', 'ready_for_pickup', 'delivered']);
                    $step3 = in_array($status, ['ready_for_pickup', 'delivered']);
                    $step4 = $status === 'delivered';
                @endphp
                
                <!-- Dynamic connection bar height -->
                <div class="stepper-connect" style="height: {{ $step4 ? '100%' : ($step3 ? '66%' : ($step2 ? '33%' : '0%')) }}"></div>

                <!-- Step 1: Checked in -->
                <div class="step-item completed">
                    <span class="step-badge"><i class="fa fa-check"></i></span>
                    <div class="step-content">
                        <div>
                            <span class="step-label">Device Checked-in</span>
                            <span class="step-label-ar">تم استلام الجهاز في المحل</span>
                        </div>
                        <span class="step-time">{{ $job->created_at ? $job->created_at->format('d/m H:i') : '' }}</span>
                    </div>
                </div>

                <!-- Step 2: Under Repair -->
                <div class="step-item {{ $step2 ? ($status === 'under_review' || $status === 'under_repair' ? 'active' : 'completed') : '' }}">
                    <span class="step-badge"><i class="fa fa-check"></i></span>
                    <div class="step-content">
                        <div>
                            <span class="step-label">Under Repair</span>
                            <span class="step-label-ar">قيد الصيانة والعمل</span>
                        </div>
                        <span class="step-time"></span>
                    </div>
                </div>

                <!-- Step 3: Ready for Pickup -->
                <div class="step-item {{ $step3 ? ($status === 'ready_for_pickup' ? 'active' : 'completed') : '' }}">
                    <span class="step-badge"><i class="fa fa-check"></i></span>
                    <div class="step-content">
                        <div>
                            <span class="step-label">Ready for Pickup</span>
                            <span class="step-label-ar">جاهز للاستلام</span>
                        </div>
                        <span class="step-time"></span>
                    </div>
                </div>

                <!-- Step 4: Delivered -->
                <div class="step-item {{ $step4 ? 'completed active' : '' }}">
                    <span class="step-badge"><i class="fa fa-check"></i></span>
                    <div class="step-content">
                        <div>
                            <span class="step-label">Delivered</span>
                            <span class="step-label-ar">تم تسليم الجهاز والانتهاء</span>
                        </div>
                        <span class="step-time"></span>
                    </div>
                </div>

            </div>
        </div>

        <!-- 2. DEVICE DETAILS -->
        <div class="card">
            <div class="card-title">
                <span>Device Information</span>
                <span class="card-title-ar">بيانات الجهاز</span>
            </div>
            
            <div class="details-grid">
                <div class="detail-row">
                    <div>
                        <span class="detail-label">Brand & Model</span>
                        <span class="detail-label-ar">الموديل والماركة</span>
                    </div>
                    <span class="detail-val">{{ $job->jobInfo->brand ?? 'N/A' }} {{ $job->jobInfo->model ?? 'N/A' }}</span>
                </div>
                
                <div class="detail-row">
                    <div>
                        <span class="detail-label">Reported Issue</span>
                        <span class="detail-label-ar">المشكلة المذكورة</span>
                    </div>
                    <span class="detail-val" style="max-width: 60%; word-break: break-word;">
                        {{ $job->jobInfo->description ?? 'No description.' }}
                    </span>
                </div>

                @if($checkInReceipt && isset($checkInReceipt->receipt_data['device_condition']))
                <div class="detail-row">
                    <div>
                        <span class="detail-label">Physical Condition</span>
                        <span class="detail-label-ar">الحالة الخارجية</span>
                    </div>
                    <span class="detail-val text-warning">{{ $checkInReceipt->receipt_data['device_condition'] }}</span>
                </div>
                @endif

                @if($job->technicianInfo)
                <div class="detail-row">
                    <div>
                        <span class="detail-label">Assigned Technician</span>
                        <span class="detail-label-ar">المهندس المسؤول</span>
                    </div>
                    <span class="detail-val"><i class="fa fa-user-gear me-1"></i> {{ $job->technicianInfo->full_name }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- 3. ESTIMATED COST / PAYMENT SUMMARY -->
        <div class="card">
            <div class="card-title">
                <span>Cost & Billing Summary</span>
                <span class="card-title-ar">التكلفة والرسوم</span>
            </div>

            <div class="details-grid">
                @if($finalReceipt)
                    @php $fData = $finalReceipt->receipt_data; @endphp
                    @if(isset($fData['parts']) && count($fData['parts']) > 0)
                        <div class="detail-row" style="border-bottom: none; padding-bottom: 0;">
                            <span class="detail-label fw-bold">Spare Parts Used (القطع المستخدمة):</span>
                        </div>
                        @foreach($fData['parts'] as $part)
                            <div class="detail-row" style="padding-left: 15px; background: #fafafb; border-bottom: none; margin-bottom: 2px;">
                                <span class="detail-label">- {{ $part['name'] }}</span>
                                <span class="detail-val">{{ env('APP_CURRENCY', 'IQD') }} {{ number_format($part['price'], 2) }}</span>
                            </div>
                        @endforeach
                    @endif
                    
                    <div class="detail-row">
                        <div>
                            <span class="detail-label">Labor Cost</span>
                            <span class="detail-label-ar">أجور اليد</span>
                        </div>
                        <span class="detail-val">{{ env('APP_CURRENCY', 'IQD') }} {{ number_format($fData['labor_cost'] ?? 0, 2) }}</span>
                    </div>
                    
                    <div class="detail-row" style="background-color: var(--success-light); padding: 10px; border-radius: 8px;">
                        <div>
                            <span class="detail-label fw-bold text-success">TOTAL AMOUNT DUE</span>
                            <span class="detail-label-ar">المجموع النهائي</span>
                        </div>
                        <span class="detail-val text-success fw-bold" style="font-size: 16px;">
                            {{ env('APP_CURRENCY', 'IQD') }} {{ number_format($fData['total_amount'] ?? $job->price, 2) }}
                        </span>
                    </div>

                    @if(isset($fData['warranty_period']))
                    <div class="detail-row">
                        <div>
                            <span class="detail-label text-info">Warranty Scope</span>
                            <span class="detail-label-ar">مدة الضمان المعتمدة</span>
                        </div>
                        <span class="detail-val text-info"><i class="fa fa-shield-halved me-1"></i> {{ $fData['warranty_period'] }}</span>
                    </div>
                    @endif

                @else
                    <div class="detail-row">
                        <div>
                            <span class="detail-label">Estimated Cost</span>
                            <span class="detail-label-ar">التكلفة التقديرية</span>
                        </div>
                        <span class="detail-val" style="font-size: 15px; color: var(--primary);">
                            @if($checkInReceipt && isset($checkInReceipt->receipt_data['estimated_cost']) && $checkInReceipt->receipt_data['estimated_cost'])
                                {{ env('APP_CURRENCY', 'IQD') }} {{ number_format($checkInReceipt->receipt_data['estimated_cost'], 2) }}
                            @else
                                {{ env('APP_CURRENCY', 'IQD') }} {{ number_format($job->price ?? 0, 2) }}
                            @endif
                        </span>
                    </div>
                    <div class="detail-row" style="border-bottom: none; background: var(--warning-light); padding: 8px; border-radius: 8px;">
                        <span class="detail-label text-warning" style="font-size: 12px; display: flex; align-items: center; gap: 6px;">
                            <i class="fa fa-info-circle"></i>
                            <span>Final cost is calculated after troubleshooting has been fully completed.</span>
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <!-- 4. DIGITAL RECEIPT ARCHIVES -->
        @if($checkInReceipt || $finalReceipt)
        <div class="card">
            <div class="card-title">
                <span>Archived Digital Receipts</span>
                <span class="card-title-ar">إيصالات الصيانة الرقمية</span>
            </div>
            
            <p style="font-size: 13px; color: var(--slate-600); margin-bottom: 8px;">
                Below are your high-fidelity official receipt copies saved in our system:
            </p>

            <div class="receipt-btn-container">
                @if($checkInReceipt)
                    <button class="btn-receipt active" id="btnShowCheckIn" onclick="toggleReceipt('check_in')">
                        <i class="fa fa-file-invoice"></i> Check-in Receipt
                    </button>
                @endif
                @if($finalReceipt)
                    <button class="btn-receipt {{ !$checkInReceipt ? 'active' : '' }}" id="btnShowFinal" onclick="toggleReceipt('final')">
                        <i class="fa fa-receipt"></i> Final Receipt
                    </button>
                @endif
            </div>

            <!-- check-in receipt visual snapshot -->
            @if($checkInReceipt)
            <div class="receipt-visual" id="vCheckInReceipt" style="display: block;">
                <div class="tr-logo">{{ $job->shopInfo->title ?? 'SHOP REPAIR' }}</div>
                <div class="tr-row tr-arabic" style="font-size: 11px; text-align: center; color: var(--slate-600);">
                    {{ $checkInReceipt->shop_address }} | Tel: {{ $checkInReceipt->shop_phone }}
                </div>
                <div class="tr-divider"></div>
                
                <div class="tr-bold" style="text-align: center; font-size: 14px; margin-bottom: 10px;">CHECK-IN RECEIPT (استلام جهاز)</div>
                
                <div class="tr-row">
                    <div>Job ID: <span class="tr-bold">#{{ $job->id }}</span></div>
                    <div>Date: {{ $checkInReceipt->created_at ? $checkInReceipt->created_at->format('d/m/Y H:i') : '' }}</div>
                </div>
                <div class="tr-row">
                    <div>Customer: {{ $job->userInfo->full_name ?? 'N/A' }}</div>
                    <div>Phone: {{ $job->userInfo->phone ?? $job->jobInfo->phone_number ?? 'N/A' }}</div>
                </div>
                
                <div class="tr-divider"></div>
                <div class="tr-row">
                    <div class="tr-bold">Device:</div>
                    <div>{{ $job->jobInfo->brand }} {{ $job->jobInfo->model }}</div>
                </div>
                <div class="tr-row" style="flex-direction: column;">
                    <div class="tr-bold">Issue Description:</div>
                    <div style="font-style: italic;">{{ $job->jobInfo->description }}</div>
                </div>
                <div class="tr-row">
                    <div class="tr-bold">Condition:</div>
                    <div class="tr-bold" style="color: var(--warning);">{{ $checkInReceipt->receipt_data['device_condition'] ?? 'N/A' }}</div>
                </div>
                
                <div class="tr-divider"></div>
                <div class="tr-row">
                    <div class="tr-bold">Technician Name:</div>
                    <div>{{ $checkInReceipt->receipt_data['technician_name'] ?? 'N/A' }}</div>
                </div>
                <div class="tr-row">
                    <div class="tr-bold">Estimated Cost:</div>
                    <div class="tr-bold">${{ number_format($checkInReceipt->receipt_data['estimated_cost'] ?? 0, 2) }}</div>
                </div>
                <div class="tr-row" style="flex-direction: column;">
                    <div class="tr-bold">Check-in Notes:</div>
                    <div>{{ $checkInReceipt->receipt_data['notes'] ?? 'None' }}</div>
                </div>
                
                <div class="tr-divider"></div>
                <div class="tr-signature-box">
                    <div class="tr-sig-col">
                        @if($checkInReceipt->customer_signature)
                            <img class="tr-sig-img" src="{{ $checkInReceipt->customer_signature }}" alt="Customer Sign">
                        @endif
                        <div class="tr-bold">Customer Sign</div>
                    </div>
                    <div class="tr-sig-col">
                        @if($checkInReceipt->technician_signature)
                            <img class="tr-sig-img" src="{{ $checkInReceipt->technician_signature }}" alt="Tech Sign">
                        @endif
                        <div class="tr-bold">Technician Sign</div>
                    </div>
                </div>
                
                <button type="button" onclick="downloadPDF('vCheckInReceipt', 'check_in_receipt_{{ $job->id }}')" class="btn-pdf-download" style="margin-top: 20px; width: 100%; padding: 12px; border-radius: 8px; border: none; background-color: var(--primary); color: white; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 13.5px; transition: all 0.2s;">
                    <i class="fa fa-file-pdf"></i> Download PDF Receipt
                </button>
            </div>
            @endif

            <!-- final receipt visual snapshot -->
            @if($finalReceipt)
            <div class="receipt-visual" id="vFinalReceipt" style="display: {{ !$checkInReceipt ? 'block' : 'none' }};">
                <div class="tr-logo">{{ $job->shopInfo->title ?? 'SHOP REPAIR' }}</div>
                <div class="tr-row tr-arabic" style="font-size: 11px; text-align: center; color: var(--slate-600);">
                    {{ $finalReceipt->shop_address }} | Tel: {{ $finalReceipt->shop_phone }}
                </div>
                <div class="tr-divider"></div>
                
                <div class="tr-bold" style="text-align: center; font-size: 14px; margin-bottom: 10px;">FINAL REPAIR RECEIPT (فاتورة صيانة)</div>
                
                <div class="tr-row">
                    <div>Job ID: <span class="tr-bold">#{{ $job->id }}</span></div>
                    <div>Date: {{ $finalReceipt->created_at ? $finalReceipt->created_at->format('d/m/Y H:i') : '' }}</div>
                </div>
                <div class="tr-row">
                    <div>Customer: {{ $job->userInfo->full_name ?? 'N/A' }}</div>
                    <div>Phone: {{ $job->userInfo->phone ?? $job->jobInfo->phone_number ?? 'N/A' }}</div>
                </div>
                
                <div class="tr-divider"></div>
                <div class="tr-row">
                    <div class="tr-bold">Device:</div>
                    <div>{{ $job->jobInfo->brand }} {{ $job->jobInfo->model }}</div>
                </div>
                <div class="tr-row" style="flex-direction: column;">
                    <div class="tr-bold">Repair Details:</div>
                    <div style="font-style: italic;">{{ $finalReceipt->receipt_data['repair_details'] ?? 'N/A' }}</div>
                </div>
                
                @if(isset($finalReceipt->receipt_data['parts']) && count($finalReceipt->receipt_data['parts']) > 0)
                    <div class="tr-divider"></div>
                    <div class="tr-bold" style="margin-bottom: 4px;">Hardware Parts Used:</div>
                    @foreach($finalReceipt->receipt_data['parts'] as $part)
                        <div class="parts-item">
                            <span>- {{ $part['name'] }}</span>
                            <span class="tr-bold">${{ number_format($part['price'], 2) }}</span>
                        </div>
                    @endforeach
                @endif
                
                <div class="tr-divider"></div>
                <div class="tr-row">
                    <div>Labor Cost (أجور الصيانة):</div>
                    <div class="tr-bold">${{ number_format($finalReceipt->receipt_data['labor_cost'] ?? 0, 2) }}</div>
                </div>
                <div class="tr-row" style="font-size: 14px;">
                    <div class="tr-bold">TOTAL DUE (المجموع):</div>
                    <div class="tr-bold text-success">${{ number_format($finalReceipt->receipt_data['total_amount'] ?? 0, 2) }}</div>
                </div>
                <div class="tr-row">
                    <div class="tr-bold">Warranty Period:</div>
                    <div class="tr-bold text-info"><i class="fa fa-shield-halved"></i> {{ $finalReceipt->receipt_data['warranty_period'] ?? 'No Warranty' }}</div>
                </div>
                
                <div class="tr-divider"></div>
                <div class="tr-signature-box">
                    <div class="tr-sig-col" style="margin: 0 auto; width: 60%;">
                        @if($finalReceipt->customer_signature)
                            <img class="tr-sig-img" src="{{ $finalReceipt->customer_signature }}" alt="Customer Sign">
                        @endif
                        <div class="tr-bold">Customer Signature</div>
                    </div>
                </div>
                
                <button type="button" onclick="downloadPDF('vFinalReceipt', 'final_receipt_{{ $job->id }}')" class="btn-pdf-download" style="margin-top: 20px; width: 100%; padding: 12px; border-radius: 8px; border: none; background-color: var(--success); color: white; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 13.5px; transition: all 0.2s;">
                    <i class="fa fa-file-pdf"></i> Download PDF Invoice
                </button>
            </div>
            @endif

        </div>
        @endif

        <!-- 5. SHOP CONTACT INFORMATION FOOTER -->
        <div class="shop-footer">
            <div class="shop-title">{{ $job->shopInfo->title ?? 'Repair Shop' }}</div>
            <div style="font-size: 13px; color: #94a3b8;">
                {{ $job->shopInfo->address ?? 'Shop Location Center' }}
            </div>
            
            <div class="tr-divider" style="border-color: #334155; margin: 16px 0;"></div>
            
            <div class="shop-info-row">
                <i class="fa fa-phone text-primary"></i>
                <span>Customer Support:</span>
                <a href="tel:{{ $job->shopInfo->phone ?? '0599-123456' }}">{{ $job->shopInfo->phone ?? '0599-123456' }}</a>
            </div>
            
            <div class="shop-info-row" style="margin-top: 10px; font-size: 12px; color: #64748b;">
                Powered by {{ config('app.name', 'Mobile Maintenance') }}
            </div>
        </div>

    </div>

    <!-- Toggle scripts for dynamic receipt visual switching -->
    <script>
        function toggleReceipt(type) {
            const vCheckIn = document.getElementById('vCheckInReceipt');
            const vFinal = document.getElementById('vFinalReceipt');
            
            const btnCheckIn = document.getElementById('btnShowCheckIn');
            const btnFinal = document.getElementById('btnShowFinal');

            if (type === 'check_in') {
                if (vCheckIn) vCheckIn.style.display = 'block';
                if (vFinal) vFinal.style.display = 'none';
                
                if (btnCheckIn) btnCheckIn.classList.add('active');
                if (btnFinal) btnFinal.classList.remove('active');
            } else {
                if (vCheckIn) vCheckIn.style.display = 'none';
                if (vFinal) vFinal.style.display = 'block';
                
                if (btnCheckIn) btnCheckIn.classList.remove('active');
                if (btnFinal) btnFinal.classList.add('active');
            }
        }

        function downloadPDF(elementId, filename) {
            const element = document.getElementById(elementId);
            const downloadBtn = element.querySelector('.btn-pdf-download');
            
            if (downloadBtn) {
                downloadBtn.style.display = 'none';
            }

            const opt = {
                margin:       0.15,
                filename:     filename + '.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true, logging: false },
                jsPDF:        { unit: 'in', format: [4.2, 7.8], orientation: 'portrait' }
            };

            html2pdf().from(element).set(opt).save().then(() => {
                if (downloadBtn) {
                    downloadBtn.style.display = 'flex';
                }
            });
        }
    </script>
</body>
</html>
