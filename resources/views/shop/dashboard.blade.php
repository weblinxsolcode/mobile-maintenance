@extends('shop.layout.main')

@section('section')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Mono:wght@400;500&display=swap');

        /* ── Base ── */
        .db-wrapper {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .db-wrapper * {
            box-sizing: border-box;
        }

        /* ── Page ── */
        .db-page {
            padding: 28px 28px 40px;
            background: #eef0f8;
            min-height: 100vh;
        }

        /* ── Hero Header (already using your gradient) ── */
        .db-hero {
            background: linear-gradient(135deg, #26ACE8 0%, #0389D1 50%, #025BA0 100%);
            border-radius: 22px;
            padding: 34px 36px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 16px 48px rgba(20, 24, 60, 0.22);
        }

        .db-hero::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.28) 0%, transparent 68%);
            pointer-events: none;
        }

        .db-hero::after {
            content: '';
            position: absolute;
            bottom: -40px;
            left: 30%;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.13) 0%, transparent 70%);
            pointer-events: none;
        }

        .db-hero-dots {
            position: absolute;
            right: 200px;
            top: 20px;
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 7px;
            opacity: 0.12;
            pointer-events: none;
        }

        .db-hero-dots span {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #fff;
            display: block;
        }

        .db-hero-content {
            position: relative;
            z-index: 1;
        }

        .db-hero-eyebrow {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            color: #a5f3fc;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .db-hero-eyebrow::before {
            content: '';
            width: 20px;
            height: 2px;
            background: #a5f3fc;
            border-radius: 2px;
        }

        .db-hero h1 {
            font-size: 28px;
            font-weight: 900;
            color: #f1f3ff;
            margin: 0 0 6px;
            letter-spacing: -0.5px;
            line-height: 1.15;
        }

        .db-hero h1 span {
            color: #bae6fd;
        }

        .db-hero p {
            font-size: 13.5px;
            color: rgba(255, 255, 255, 0.42);
            margin: 0;
            font-weight: 500;
        }

        .db-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(38, 172, 232, 0.18);
            border: 1px solid rgba(38, 172, 232, 0.4);
            color: #bae6fd;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            padding: 5px 13px;
            letter-spacing: 0.3px;
            margin-top: 16px;
        }

        .db-hero-badge .pulse {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #34d399;
            animation: db-pulse 1.8s ease-in-out infinite;
        }

        @keyframes db-pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(52, 211, 153, 0.5);
            }

            50% {
                box-shadow: 0 0 0 5px rgba(52, 211, 153, 0);
            }
        }

        /* ── Section Label ── */
        .db-section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: #1e40af;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .db-section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #cbd5e1;
        }

        /* ── Stat Cards (updated to theme blues) ── */
        .db-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .db-stat-card {
            border-radius: 20px;
            padding: 24px 22px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.10);
            transition: transform 0.22s ease, box-shadow 0.22s ease;
            animation: db-fadeup 0.5s ease both;
        }

        .db-stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 36px rgba(0, 0, 0, 0.15);
        }

        .db-stat-card:nth-child(1) {
            animation-delay: 0.05s;
        }

        .db-stat-card:nth-child(2) {
            animation-delay: 0.12s;
        }

        .db-stat-card:nth-child(3) {
            animation-delay: 0.19s;
        }

        .db-stat-card:nth-child(4) {
            animation-delay: 0.26s;
        }

        @keyframes db-fadeup {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .db-stat-watermark {
            position: absolute;
            right: -8px;
            bottom: -14px;
            font-size: 80px;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.08);
            line-height: 1;
            pointer-events: none;
            font-family: 'DM Mono', monospace;
            letter-spacing: -4px;
        }

        .db-stat-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .db-stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.20);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .db-stat-icon i {
            font-size: 19px;
            color: #fff;
        }

        .db-stat-chip {
            background: rgba(255, 255, 255, 0.18);
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 10.5px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.3px;
            opacity: 0.85;
        }

        .db-stat-number {
            font-size: 38px;
            font-weight: 900;
            color: #fff;
            line-height: 1;
            margin: 0 0 5px;
            font-family: 'DM Mono', monospace;
            letter-spacing: -1px;
        }

        .db-stat-label {
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.65);
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .db-stat-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 0 0 20px 20px;
        }

        .db-stat-bar-fill {
            height: 100%;
            border-radius: 0 0 20px 20px;
            background: rgba(255, 255, 255, 0.55);
            transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Updated card gradients (blue family) */
        .db-card-primary {
            background: linear-gradient(140deg, #26ACE8 0%, #0389D1 100%);
        }

        .db-card-secondary {
            background: linear-gradient(140deg, #0ea5e9 0%, #0284c7 100%);
        }
        
        .db-card-tertiary {
            /* Keep as original dark navy */
            background: linear-gradient(140deg, #0389D1 0%, #025BA0 100%);
        }

        .db-card-accent {
            /* Use a brighter sky blue */
            background: linear-gradient(140deg, #1e3a8a 0%, #0f2b6d 100%);
        }

        /* ── Quick Info Row (updated) ── */
        .db-info-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            animation: db-fadeup 0.5s 0.35s ease both;
        }

        .db-info-card {
            background: #fff;
            border-radius: 18px;
            padding: 22px 22px 20px;
            box-shadow: 0 4px 20px rgba(30, 34, 80, 0.07);
            border: 1px solid rgba(38, 172, 232, 0.1);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .db-info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(30, 34, 80, 0.11);
        }

        .db-info-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .db-info-icon i {
            font-size: 20px;
        }

        /* Info icon backgrounds matching theme */
        .db-info-icon.primary-light {
            background: #e0f2fe;
            color: #0389D1;
        }

        .db-info-icon.primary-dark {
            background: #e6f0fa;
            color: #025BA0;
        }

        .db-info-icon.accent {
            background: #eef2ff;
            color: #1e3a8a;
        }

        .db-info-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: #475569;
            margin-bottom: 3px;
        }

        .db-info-value {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            font-family: 'DM Mono', monospace;
            letter-spacing: -0.5px;
            line-height: 1;
        }

        .db-info-sub {
            font-size: 11.5px;
            color: #6b7280;
            font-weight: 500;
            margin-top: 3px;
        }

        /* responsive */
        @media (max-width: 1199px) {
            .db-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 767px) {
            .db-page {
                padding: 16px;
            }

            .db-stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .db-info-row {
                grid-template-columns: 1fr;
            }

            .db-hero {
                padding: 24px 22px;
            }

            .db-hero h1 {
                font-size: 22px;
            }

            .db-stat-number {
                font-size: 30px;
            }
        }

        @media (max-width: 480px) {
            .db-stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="db-wrapper">
        <div class="main-wrapper">
            <div class="page-wrapper">
                <div class="content container-fluid db-page">

                    {{-- Hero Header (gradient already matches) --}}
                    <div class="db-hero">
                        <div class="db-hero-dots">
                            @for ($i = 0; $i < 24; $i++)
                                <span></span>
                            @endfor
                        </div>
                        <div class="db-hero-content">
                            <div class="db-hero-eyebrow">Shop Panel</div>
                            <h1>Welcome back, <span>Shop!</span></h1>
                            <p>Here's what's happening across your platform today.</p>
                            <div class="db-hero-badge">
                                <span class="pulse"></span>
                                All systems operational
                            </div>
                        </div>
                    </div>

                    {{-- Stat Cards (updated classes to blue theme) --}}
                    <div class="db-section-label">Overview</div>
                    <div class="db-stats-grid">
                        <!-- Technicians -->
                        <div class="db-stat-card db-card-primary">
                            <div class="db-stat-top">
                                <div class="db-stat-icon"><i class="fe fe-users"></i></div>
                                <span class="db-stat-chip">Total</span>
                            </div>
                            <div class="db-stat-number">{{ $totalTechnicians }}</div>
                            <div class="db-stat-label">Technicians</div>
                            <div class="db-stat-watermark">{{ $totalTechnicians }}</div>
                            <div class="db-stat-bar">
                                <div class="db-stat-bar-fill" style="width:72%"></div>
                            </div>
                        </div>

                        <!-- Pending Offers -->
                        <div class="db-stat-card db-card-secondary">
                            <div class="db-stat-top">
                                <div class="db-stat-icon"><i class="fa fa-briefcase"></i></div>
                                <span class="db-stat-chip">Total</span>
                            </div>
                            <div class="db-stat-number">{{ $totalJob }}</div>
                            <div class="db-stat-label">Jobs</div>
                            <div class="db-stat-watermark">{{ $totalJob }}</div>
                            <div class="db-stat-bar">
                                <div class="db-stat-bar-fill" style="width:58%"></div>
                            </div>
                        </div>

                        <!-- Accepted Offers -->
                        <div class="db-stat-card db-card-tertiary">
                            <div class="db-stat-top">
                                <div class="db-stat-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                                <span class="db-stat-chip">Total</span>
                            </div>
                            <div class="db-stat-number">{{ $totalOrder }}</div>
                            <div class="db-stat-label">Orders</div>
                            <div class="db-stat-watermark">{{ $totalOrder }}</div>
                            <div class="db-stat-bar">
                                <div class="db-stat-bar-fill" style="width:44%"></div>
                            </div>
                        </div>

                        <!-- Reviews -->
                        <div class="db-stat-card db-card-accent">
                            <div class="db-stat-top">
                                <div class="db-stat-icon"><i class="fa-solid fa-star"></i></div>
                                <span class="db-stat-chip">Total</span>
                            </div>
                            <div class="db-stat-number">{{ $totalReviews }}</div>
                            <div class="db-stat-label">Reviews</div>
                            <div class="db-stat-watermark">{{ $totalReviews }}</div>
                            <div class="db-stat-bar">
                                <div class="db-stat-bar-fill" style="width:63%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Optional Quick Info Row (if you uncomment later) --}}
                    {{-- 
                    <div class="db-section-label">Quick Insights</div>
                    <div class="db-info-row">
                        <div class="db-info-card">
                            <div class="db-info-icon primary-light"><i class="fe fe-calendar"></i></div>
                            <div>
                                <div class="db-info-label">Active Jobs</div>
                                <div class="db-info-value">24</div>
                                <div class="db-info-sub">+3 this week</div>
                            </div>
                        </div>
                        <div class="db-info-card">
                            <div class="db-info-icon primary-dark"><i class="fe fe-dollar-sign"></i></div>
                            <div>
                                <div class="db-info-label">Revenue</div>
                                <div class="db-info-value">$12,430</div>
                                <div class="db-info-sub">+18% vs last month</div>
                            </div>
                        </div>
                        <div class="db-info-card">
                            <div class="db-info-icon accent"><i class="fe fe-star"></i></div>
                            <div>
                                <div class="db-info-label">Rating</div>
                                <div class="db-info-value">4.8</div>
                                <div class="db-info-sub">from {{ $totalReviews }} reviews</div>
                            </div>
                        </div>
                    </div>
                    --}}

                </div>
            </div>
        </div>
    </div>
@endsection
