<div class="app-menu">
    <!-- Sidebar -->

    <div class="navbar-vertical navbar nav-dashboard">
        <div class="h-100" data-simplebar>
            <!-- Brand logo -->
            <a class="navbar-brand p-0 m-0 d-block" href="{{ route('dashboard') }}"
                style="width: 100%; background-color: #140a0a;">
                {{-- @if (!empty($setting->sidebar))
                    <img src="{{ asset($setting->sidebar) }}" alt="Logo"
                        style="width: 100%; height: 90px; object-fit: contain; display: block; padding: 12px 20px;">
                @else
                    <img src="{{ asset('assets/backend/images/sidebar.png') }}" alt="Logo"
                        style="width: 100%; height: 90px; object-fit: contain; display: block; padding: 12px 20px;">
                @endif --}}
            </a>
            <!-- Navbar nav -->
            <ul class="navbar-nav flex-column" id="sideNavbar">


                <li class="nav-item">
                    <div class="navbar-heading">Overview</div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i data-feather="home" class="nav-icon me-2 icon-xxs"></i>Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <div class="navbar-heading">Management</div>
                </li>

                {{--  categories --}}
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('categories.*') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}">
                        <i data-feather="grid" class="nav-icon me-2 icon-xxs"></i>Categories </a>
                </li>


                
                

                {{--
                <hr>
                <li class="nav-item">
                    <div class="navbar-heading">Settings</div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('v1.setting.mail.show') ? 'active' : '' }}"
                        href="{{ route('v1.setting.mail.show') }}">
                        <i data-feather="mail" class="nav-icon me-2 icon-xxs"></i> Email Setting
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('system.index') ? 'active' : '' }}"
                        href="{{ route('system.index') }}">
                        <i data-feather="settings" class="nav-icon me-2 icon-xxs"></i> System Settings
                    </a>
                </li> --}}

            </ul>
        </div>
    </div>

</div>
