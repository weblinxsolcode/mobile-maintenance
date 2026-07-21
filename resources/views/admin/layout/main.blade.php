<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ $title ?? 'Dashboard' }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('common/default.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/feathericon.min.css') }}">

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Datatables JS -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>

    <style>
        :root {
            --admin-primary: #26ACE8;
            --admin-primary-dark: #0389D1;
            --admin-sidebar-bg: #025BA0;
            --admin-sidebar-text: #f1f1f1;
            --admin-sidebar-active: #26ACE8;
            --admin-header-bg: #ffffff;
        }

        * { font-family: 'Inter', sans-serif; }

        body { background: #f1f5f9; margin: 0; }

        /* ── SIDEBAR ── */
        .admin-sidebar {
            position: fixed; top: 0; left: 0;
            width: 250px; height: 100vh;
            background: var(--admin-sidebar-bg);
            overflow-y: auto; z-index: 1000;
            transition: width .3s ease;
            display: flex; flex-direction: column;
        }

        .admin-sidebar .sidebar-brand {
            padding: 22px 20px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .admin-sidebar .sidebar-brand h4 {
            color: #fff; font-weight: 700; font-size: 18px; margin: 0;
        }

        .admin-sidebar .sidebar-brand span { color: var(--admin-primary); }

        .admin-sidebar .nav-section-title {
            font-size: 11px; font-weight: 600; letter-spacing: 1.5px;
            color: rgba(255, 255, 255, 0.6); text-transform: uppercase;
            padding: 16px 20px 6px;
        }

        .admin-sidebar .nav-link-item {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 20px; color: var(--admin-sidebar-text);
            text-decoration: none; font-size: 14px; font-weight: 500;
            border-left: 3px solid transparent;
            transition: all .2s ease;
        }

        .admin-sidebar .nav-link-item:hover {
            background: var(--admin-primary-dark);
            color: #fff;
            border-left-color: var(--admin-primary);
        }

        .admin-sidebar .nav-link-item.active {
            background: var(--admin-primary);
            color: #fff;
            border-left-color: #fff;
        }

        .admin-sidebar .nav-link-item i { width: 20px; text-align: center; font-size: 16px; }

        /* ── HEADER ── */
        .admin-header {
            position: fixed; top: 0; left: 250px; right: 0;
            height: 64px; background: var(--admin-header-bg);
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
            display: flex; align-items: center;
            justify-content: space-between;
            padding: 0 28px; z-index: 900;
        }

        .admin-header .page-title {
            font-size: 18px; font-weight: 600; color: #0f172a; margin: 0;
        }

        .admin-header .admin-user-menu {
            display: flex; align-items: center; gap: 16px;
        }

        .admin-header .avatar-btn {
            width: 38px; height: 38px; border-radius: 50%;
            background: var(--admin-primary); color: #fff;
            border: none; font-weight: 700; font-size: 15px;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
        }

        /* ── MAIN CONTENT ── */
        .admin-content {
            margin-left: 250px;
            margin-top: 64px;
            padding: 28px;
            min-height: calc(100vh - 64px);
        }

        /* ── STAT CARDS ── */
        .stat-card {
            background: #fff; border-radius: 16px;
            padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,.07);
            border: 1px solid #e2e8f0;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.1); }

        .stat-card .stat-icon {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; margin-bottom: 16px;
        }

        .stat-card .stat-number { font-size: 32px; font-weight: 800; color: #0f172a; line-height: 1; }
        .stat-card .stat-label  { font-size: 13px; color: #64748b; margin-top: 4px; font-weight: 500; }

        /* ── TABLES ── */
        .admin-card {
            background: #fff; border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,.07);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .admin-card .card-header-custom {
            padding: 20px 24px; border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; justify-content: space-between;
        }

        .admin-card .card-header-custom h5 {
            font-size: 16px; font-weight: 600; color: #0f172a; margin: 0;
        }

        .admin-card .card-body-custom { padding: 24px; }

        .badge-active   { background: #dcfce7; color: #16a34a; }
        .badge-pending  { background: #fef9c3; color: #ca8a04; }
        .badge-blocked  { background: #fee2e2; color: #dc2626; }

        .btn-admin-primary {
            background: var(--admin-primary); color: #fff; border: none;
            padding: 9px 20px; border-radius: 10px; font-weight: 600;
            font-size: 14px; cursor: pointer;
            transition: background .2s ease;
            text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
        }

        .btn-admin-primary:hover { background: var(--admin-primary-dark); color: #fff; }

        @media (max-width: 768px) {
            .admin-sidebar { width: 0; overflow: hidden; }
            .admin-header  { left: 0; }
            .admin-content { margin-left: 0; }
        }
    </style>

    @yield('extra-css')
</head>

<body>
    <!-- SIDEBAR -->
    <nav class="admin-sidebar">
        <div class="sidebar-brand">
            <h4><i class="bi bi-shield-fill-check me-2"></i><span>Admin</span>Panel</h4>
        </div>

        <div style="flex:1; overflow-y:auto; padding: 8px 0;">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>

            <div class="nav-section-title">Management</div>
            <a href="{{ route('admin.shops.index') }}"
               class="nav-link-item {{ Route::is('admin.shops.*') ? 'active' : '' }}">
                <i class="bi bi-shop"></i> Shops
            </a>
        </div>

        <div style="padding: 16px 20px; border-top: 1px solid rgba(255,255,255,.08);">
            <a href="{{ route('admin.logout') }}" class="nav-link-item" style="color:#f87171; border-left-color:transparent;">
                <i class="bi bi-box-arrow-left"></i> Logout
            </a>
        </div>
    </nav>

    <!-- HEADER -->
    <header class="admin-header">
        <h1 class="page-title">{{ $title ?? 'Dashboard' }}</h1>
        <div class="admin-user-menu">
            <div class="dropdown">
                <button class="avatar-btn dropdown-toggle" data-bs-toggle="dropdown">
                    A
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><span class="dropdown-item-text fw-bold">
                        {{ \App\Models\Admin::find(session('admin_id'))->name ?? 'Admin' }}
                    </span></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('admin.logout') }}">
                        <i class="bi bi-box-arrow-left me-2"></i>Logout
                    </a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="admin-content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <div><i class="bi bi-exclamation-circle me-2"></i>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        // Init DataTables
        $(document).ready(function () {
            if ($.fn.DataTable) {
                $('.datatable').DataTable({ responsive: true });
            }
        });
    </script>

    @yield('extra-js')
</body>
</html>
