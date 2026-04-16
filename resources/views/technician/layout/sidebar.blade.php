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

                {{-- <li class="{{ Route::is(['technician.dashboard']) ? 'active' : '' }}">
                    <a href="{{ route('technician.dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li> --}}
                
                <li class="{{ Route::is(['technician.assignedJobs.*']) ? 'active' : '' }}">
                    <a href="{{ route('technician.assignedJobs.index') }}"><i class="fa fa-tasks"></i> <span>Assigned Job</span></a>
                </li>
                
                <li class="{{ Route::is(['technician.profile','technician.profile.update']) ? 'active' : '' }}">
                    <a href="{{ route('technician.profile') }}"><i class="fa fa-user"></i> <span>Profile</span></a>
                </li>  
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
