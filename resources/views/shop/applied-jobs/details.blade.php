@extends('shop.layout.main')

@section('section')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap');

        .jd-wrap * {
            box-sizing: border-box;
        }

        .jd-wrap {
            font-family: 'DM Sans', sans-serif;
            background: #f0f4f9;
            min-height: 100vh;
            padding: 2rem 1.5rem 4rem;
        }

        /* Back */
        .jd-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            margin-bottom: 1.75rem;
            padding: 7px 14px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .jd-back:hover {
            background: #f8fafc;
            color: #1e293b;
            border-color: #cbd5e1;
        }

        /* Hero */
        .jd-hero {
            border-radius: 20px;
            background: linear-gradient(135deg, #26ACE8 0%, #0389D1 50%, #025BA0 100%);
            padding: 2rem 2rem 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            color: #fff;
        }

        .jd-hero::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
        }

        .jd-hero::after {
            content: '';
            position: absolute;
            bottom: -40px;
            left: 40%;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .jd-hero-code {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.65);
            margin-bottom: 8px;
        }

        .jd-hero-title {
            font-size: 22px;
            font-weight: 600;
            color: #fff;
            margin: 0 0 6px;
            line-height: 1.3;
        }

        .jd-hero-service {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.80);
            margin: 0 0 1.5rem;
        }

        .jd-hero-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            padding-top: 1.25rem;
            border-top: 1px solid rgba(255, 255, 255, 0.18);
        }

        .jd-hero-date {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.60);
        }

        .jd-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.04em;
        }

        .jd-status-pill.pending {
            background: rgba(251, 191, 36, 0.22);
            color: #fef3c7;
            border: 1px solid rgba(251, 191, 36, 0.35);
        }

        .jd-status-pill.accepted {
            background: rgba(52, 211, 153, 0.22);
            color: #d1fae5;
            border: 1px solid rgba(52, 211, 153, 0.35);
        }

        .jd-status-pill.rejected {
            background: rgba(248, 113, 113, 0.22);
            color: #fee2e2;
            border: 1px solid rgba(248, 113, 113, 0.35);
        }

        .jd-status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        /* Stats */
        .jd-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .jd-stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            border: 1px solid #e8edf4;
            position: relative;
            overflow: hidden;
        }

        .jd-stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            border-radius: 16px 0 0 16px;
        }

        .jd-stat-card.price::before {
            background: linear-gradient(180deg, #26ACE8, #025BA0);
        }

        .jd-stat-card.time::before {
            background: linear-gradient(180deg, #34d399, #059669);
        }

        .jd-stat-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 6px;
        }

        .jd-stat-value {
            font-size: 24px;
            font-weight: 600;
            color: #0f172a;
            line-height: 1;
        }

        /* Warranty */
        .jd-warranty {
            margin-bottom: 1.5rem;
        }

        .jd-warranty-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
        }

        .jd-warranty-badge.yes {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .jd-warranty-badge.no {
            background: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .jd-warranty-icon {
            font-size: 16px;
        }

        /* Cards */
        .jd-card {
            background: #fff;
            border-radius: 18px;
            border: 1px solid #e8edf4;
            margin-bottom: 1.25rem;
            overflow: hidden;
        }

        .jd-card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            background: #fafbfd;
        }

        .jd-card-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .jd-card-icon.blue {
            background: #dbeafe;
        }

        .jd-card-icon.green {
            background: #dcfce7;
        }

        .jd-card-icon.purple {
            background: #ede9fe;
        }

        .jd-card-icon.amber {
            background: #fef3c7;
        }

        .jd-card-title {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #64748b;
        }

        .jd-card-body {
            padding: 1.25rem 1.5rem;
        }

        /* Cover image style */
        .jd-cover-img {
            width: 100%;
            max-height: 280px;
            object-fit: cover;
            border-radius: 14px;
            margin-bottom: 1.25rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #eef2f6;
        }

        /* Person row */
        .jd-person {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .jd-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            border: 2px solid #e8edf4;
        }

        .jd-avatar-initials {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            font-weight: 700;
            flex-shrink: 0;
            border: 2px solid transparent;
        }

        .jd-avatar-initials.blue {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .jd-avatar-initials.green {
            background: #dcfce7;
            color: #15803d;
        }

        .jd-person-name {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            margin: 0 0 3px;
        }

        .jd-person-sub {
            font-size: 13px;
            color: #64748b;
            margin: 0;
        }

        /* Info table */
        .jd-info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .jd-info-table tr {
            border-bottom: 1px solid #f1f5f9;
        }

        .jd-info-table tr:last-child {
            border-bottom: none;
        }

        .jd-info-table td {
            padding: 10px 0;
            vertical-align: middle;
            font-size: 14px;
        }

        .jd-info-table .jd-key {
            color: #94a3b8;
            font-weight: 500;
            width: 40%;
        }

        .jd-info-table .jd-val {
            color: #0f172a;
            font-weight: 600;
            text-align: right;
        }

        /* Status badges (dark bg) */
        .jd-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.04em;
        }

        .jd-badge.pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .jd-badge.success {
            background: #dcfce7;
            color: #14532d;
        }

        .jd-badge.danger {
            background: #fee2e2;
            color: #7f1d1d;
        }

        /* Description block */
        .jd-desc {
            background: #f8fafc;
            border: 1px solid #e8edf4;
            border-left: 4px solid #26ACE8;
            border-radius: 0 10px 10px 0;
            padding: 1rem 1.25rem;
            font-size: 14px;
            line-height: 1.75;
            color: #475569;
            font-style: italic;
            margin-top: 1rem;
        }

        /* Timeline dots in status section */
        .jd-timeline {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .jd-tl-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        .jd-tl-item:last-child {
            border-bottom: none;
        }

        .jd-tl-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .jd-tl-dot.blue {
            background: #26ACE8;
        }

        .jd-tl-dot.gray {
            background: #cbd5e1;
        }

        .jd-tl-label {
            color: #94a3b8;
            font-weight: 500;
            flex: 1;
        }

        .jd-tl-value {
            color: #0f172a;
            font-weight: 600;
            font-size: 13px;
            font-family: 'DM Mono', monospace;
        }

        @media (max-width: 540px) {
            .jd-stats {
                grid-template-columns: 1fr;
            }

            .jd-hero-title {
                font-size: 18px;
            }

            .jd-stat-value {
                font-size: 20px;
            }
        }
    </style>

    <div class="page-wrapper">
        <div class="content container-fluid">

            {{-- Back --}}
            <a href="{{ route('shop.appliedJobs.index') }}" class="jd-back">
                <i class="fe fe-arrow-left"></i> Back to Jobs Listing
            </a>

            {{-- Hero --}}
            <div class="jd-hero d-flex align-items-center justify-content-between">
                <div>
                    <div class="jd-hero-code">Job Code &nbsp;/&nbsp; {{ strtoupper($appliedJobs->code ?? 'N/A') }}</div>
                    <h1 class="jd-hero-title">
                        {{ $appliedJobs->brand ?? 'N/A' }} &mdash; {{ $appliedJobs->model ?? 'N/A' }}
                    </h1>
                    <p class="jd-hero-service">{{ $appliedJobs->service_type ?? 'N/A' }}</p>
                </div>
                @php
                $existingOffer = $appliedJobs->jobApplications
                    ->where('shop_id', session()->get('shop_id'))
                    ->first();
                @endphp
                <div style="z-index: 999999999999999999999999">
                    @if ($existingOffer)
                        <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editOfferModal{{ $appliedJobs->id }}">
                            <i class="fe fe-edit"></i> Edit Offer
                        </button>
                    @else
                        <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#submitOfferModal{{ $appliedJobs->id }}">
                            <i class="fe fe-edit"></i> Submit Offer
                        </button>
                    @endif
                </div>
            </div>



            {{-- Customer Info --}}
            <div class="jd-card">
                <div class="jd-card-header">
                    <div class="jd-card-icon blue">&#128100;</div>
                    <span class="jd-card-title">Customer Info</span>
                </div>
                <div class="jd-card-body">
                    <div class="jd-person">
                        <img class="jd-avatar"
                            src="{{ asset('userImages/' . ($appliedJobs->profile_picture ?? 'common/blackicon.png')) }}"
                            onerror="this.onerror=null;this.src='{{ asset('common/blackicon.png') }}';" alt="Customer">
                        <div>
                            <p class="jd-person-name">{{ ucfirst($appliedJobs->full_name ?? 'N/A') }}</p>
                            @if (!empty($appliedJobs->phone_number))
                                <p class="jd-person-sub">{{ $appliedJobs->phone_number }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Job Listing Details (with cover image) --}}
            <div class="jd-card">
                <div class="jd-card-header">
                    <div class="jd-card-icon purple">&#128295;</div>
                    <span class="jd-card-title">Job Listing Details</span>
                </div>
                <div class="jd-card-body">
                    {{-- Cover image --}}
                    @php
                        $coverImage = $appliedJobs->cover_image ?? null;
                    @endphp
                    @if ($coverImage && file_exists(public_path('jobs/' . $coverImage)))
                        <img class="jd-cover-img" src="{{ asset('jobs/' . $coverImage) }}" alt="Job cover image">
                    @endif

                    <table class="jd-info-table">
                        <tr>
                            <td class="jd-key">Brand</td>
                            <td class="jd-val">{{ $appliedJobs->brand ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="jd-key">Model</td>
                            <td class="jd-val">{{ $appliedJobs->model ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="jd-key">Code</td>
                            <td class="jd-val" style="font-family:'DM Mono',monospace;font-size:13px;">
                                {{ $appliedJobs->code ?? 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="jd-key">Service Type</td>
                            <td class="jd-val">{{ $appliedJobs->service_type ?? 'N/A' }}</td>
                        </tr>
                    </table>

                    <div class="jd-desc">
                        {{ $appliedJobs->description ?? 'No description provided.' }}
                    </div>
                </div>
            </div>
            {{-- Existing Offer Details --}}
            @if ($existingOffer)
                <div class="jd-card ">
                    <div class="jd-card-header">
                        <div class="jd-card-icon green">💰</div>
                        <span class="jd-card-title">Your Offer Details</span>
                    </div>
                    <div class="jd-card-body">
                        <table class="jd-info-table">
                            <tr>
                                <td class="jd-key">Price</td>
                                <td class="jd-val">${{ number_format($existingOffer->price, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="jd-key">Time</td>
                                <td class="jd-val">{{ $existingOffer->time }} hour(s)</td>
                            </tr>
                            <tr>
                                <td class="jd-key">Warranty</td>
                                <td class="jd-val">
                                    @if ($existingOffer->warranty == 1)
                                        Yes ({{ $existingOffer->warranty_months ?? 0 }} months)
                                    @else
                                        No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="jd-key">Description</td>
                                <td class="jd-val">{{ $existingOffer->description ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endif



        </div>
    </div>

    {{-- Submit Offer Modal --}}
    @include('shop.applied-jobs.submitOfferModal')
@endsection
