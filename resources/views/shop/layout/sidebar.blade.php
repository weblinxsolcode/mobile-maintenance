  <!-- Sidebar -->
  <style>
    .sidebar ul li a i {
        font-size: 18px;
        line-height: 18px;
    }
</style>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="{{ Route::is(['shop.dashboard']) ? 'active' : '' }}">
                    <a href="{{ route('shop.dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>
                <li class="{{ Route::is(['shop.technicians.*']) ? 'active' : '' }}">
                    <a href="{{ route('shop.technicians.index') }}"><i class="fe fe-users"></i> <span>Technicians</span></a>
                </li>
                <li class="{{ Route::is(['shop.appliedJobs.*']) ? 'active' : '' }}">
                    <a href="{{ route('shop.appliedJobs.index') }}"><i class="fa fa-briefcase"></i> <span>Job Listings</span></a>
                </li>
                <li class="{{ Route::is(['shop.orders.*']) ? 'active' : '' }}">
                    <a href="{{ route('shop.orders.index') }}"><i class="fa fa-box"></i> <span>Orders</span></a>
                </li>
                <li class="{{ Route::is(['shop.assignedJobs.*']) ? 'active' : '' }}">
                    <a href="{{ route('shop.assignedJobs.index') }}"><i class="fa fa-tasks"></i> <span>Assign Technicians</span></a>
                </li>
                <li class="{{ Route::is(['shop.reviews.*']) ? 'active' : '' }}">
                    <a href="{{ route('shop.reviews.index') }}"><i class="fa fa-star"></i> <span>Reviews</span></a>
                </li>
                <li class="{{ Route::is(['shop.profile','shop.profile.update']) ? 'active' : '' }}">
                    <a href="{{ route('shop.profile') }}"><i class="fa fa-user"></i> <span>Profile</span></a>
                </li>

                
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
