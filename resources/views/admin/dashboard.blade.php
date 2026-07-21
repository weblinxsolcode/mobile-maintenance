@extends('admin.layout.main')

@section('content')
<div class="row g-4 mb-4">
    <!-- Total Shops -->
    <div class="col-lg-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#ede9fe; color:#7c3aed;">
                <i class="bi bi-shop"></i>
            </div>
            <div class="stat-number">{{ $totalShops }}</div>
            <div class="stat-label">Total Shops</div>
        </div>
    </div>

    <!-- Active Shops -->
    <div class="col-lg-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7; color:#16a34a;">
                <i class="bi bi-shop-window"></i>
            </div>
            <div class="stat-number">{{ $activeShops }}</div>
            <div class="stat-label">Active Shops</div>
        </div>
    </div>

    <!-- Pending Shops -->
    <div class="col-lg-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef9c3; color:#ca8a04;">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="stat-number">{{ $totalShops - $activeShops }}</div>
            <div class="stat-label">Pending Shops</div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="col-lg-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dbeafe; color:#2563eb;">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-number">{{ $totalUsers }}</div>
            <div class="stat-label">App Users</div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="admin-card">
    <div class="card-header-custom">
        <h5><i class="bi bi-lightning-fill me-2" style="color:#f59e0b;"></i>Quick Actions</h5>
    </div>
    <div class="card-body-custom">
        <div class="d-flex flex-wrap gap-3">
            <a href="{{ route('admin.shops.create') }}" class="btn-admin-primary">
                <i class="bi bi-plus-circle"></i> Create New Shop
            </a>
            <a href="{{ route('admin.shops.index') }}" class="btn btn-outline-secondary" style="border-radius:10px; font-weight:600;">
                <i class="bi bi-shop me-1"></i> View All Shops
            </a>
        </div>
    </div>
</div>
@endsection
