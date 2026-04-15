  <!-- Header -->
  <div class="header">

      <!-- Logo -->
      <div class="header-left">
          <a href="" class="logo">
              <img src="{{ asset('common/blackicon.png') }}" alt="Logo">
          </a>
          <a href="" class="logo logo-small">
              <img src="{{ asset('common/blackicon.png') }}" class="img-fluid" alt="Logo" width="10"
                  height="10">
          </a>
      </div>
      <!-- /Logo -->

      <a href="javascript:void(0);" id="toggle_btn">
          <i class="fe fe-text-align-left"></i>
      </a>


      <!-- Mobile Menu Toggle -->
      <a class="mobile_btn" id="mobile_btn">
          <i class="fa fa-bars"></i>
      </a>
      <!-- /Mobile Menu Toggle -->

      <!-- Header Right Menu -->
      <ul class="nav user-menu">



          <!-- User Menu -->
          <li class="nav-item dropdown has-arrow">
              @php
                  $shopId = session()->get('shop_id');
                  $info = \App\Models\shop::find($shopId);
              @endphp

              <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                  <span class="user-img">
                      <img class="rounded-circle"
                          src="{{ $info && $info->profile ? asset($info->profile) : asset('common/blackicon.png') }}"
                          width="31" height="31" alt="User">
                  </span>
              </a>

              <div class="dropdown-menu">
                  <div class="user-header">
                      <div class="avatar avatar-sm">
                          <img src="{{ $info && $info->profile ? asset($info->profile) : asset('common/blackicon.png') }}"
                              class="avatar-img rounded-circle" alt="User Image" style="height: 34px;">
                      </div>

                      <div class="user-text">
                          <h6>{{ ucfirst($info->username ?? 'N/A') }}</h6>
                          <p class="text-muted mb-0">Shop Owner</p>
                      </div>
                  </div>

                  <a class="dropdown-item" href="{{ route('shop.profile') }}">My Profile</a>
                  <a class="dropdown-item" href="{{ route('shop.logout') }}">Logout</a>
              </div>
          </li>
          <!-- /User Menu -->

      </ul>
      <!-- /Header Right Menu -->

  </div>
  <!-- /Header -->
