<div class="app-menu">
    <!--begin::MenuContent-->
    <div class="navbar-vertical navbar nav-dashboard">
        <!--begin::Menu-->
        <div class="h-100" data-simplebar>
            <!--begin::BrandLogo-->
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
            <!--end::BrandLogo-->
            <!--begin::NavbarNav-->
            <ul class="navbar-nav flex-column" id="sideNavbar">
                <!--begin::Pages-->
                <li class="nav-item">
                    <div class="navbar-heading">Overview</div>
                </li>
                <!--end::Pages-->

                <!--begin::Dashboard-->
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i data-feather="home" class="nav-icon me-2 icon-xxs"></i>Dashboard
                    </a>
                </li>
                <!--end::Dashboard-->

                <!--begin::Pages-->
                <li class="nav-item">
                    <div class="navbar-heading">Management</div>
                </li>
                <!--end::Pages-->

                <!--begin::CategoriesLink-->
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('categories.*') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}">
                        <i data-feather="grid" class="nav-icon me-2 icon-xxs"></i>Categories </a>
                </li>
                <!--end::CategoriesLink-->
                <!--begin::Privacy Policy-->
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('privacy-policy.index*') ? 'active' : '' }}"
                        href="{{ route('privacy-policy.index') }}">
                        <i data-feather="shield" class="nav-icon me-2 icon-xxs"></i>Privacy Policy </a>
                </li>
                <!--end::Privacy Policy-->
                <!--begin::Terms and conditions-->
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('terms-and-conditions.index*') ? 'active' : '' }}"
                        href="{{ route('terms-and-conditions.index') }}">
                        <i data-feather="file-text" class="nav-icon me-2 icon-xxs"></i>Terms and Conditions </a>
                </li>
                <!--end::Terms and conditions-->

                <!--begin::SystemSettingsHeading-->
                <li class="nav-item mt-6">
                    <div class="navbar-heading">System Settings</div>
                </li>
                <!--end::SystemSettingsHeading-->

                <!--begin::Settings-->
                @php
                    $settingsOpen =
                        Route::is('v1.setting.mail.show') ||
                        Route::is('system.index') ||
                        Route::is('integration.setting') ||
                        Route::is('social-media-links.*');
                @endphp
                <!--begin::Settings-->
                <li class="nav-item">
                    <a class="nav-link {{ $settingsOpen ? 'active' : 'collapsed' }}" href="#settingsDropdown"
                        data-bs-toggle="collapse" role="button" aria-expanded="{{ $settingsOpen ? 'true' : 'false' }}"
                        aria-controls="settingsDropdown">
                        <i data-feather="sliders" class="nav-icon me-2 icon-xxs"></i> Settings
                    </a>
                    <div class="collapse {{ $settingsOpen ? 'show' : '' }}" id="settingsDropdown">
                        <!--begin::SettingsDropdown-->
                        <ul class="nav flex-column ms-3">
                            <!--begin::EmailSettings-->
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('v1.setting.mail.show') ? 'active' : '' }}"
                                    href="{{ route('v1.setting.mail.show') }}">
                                    Email Settings
                                </a>
                            </li>
                            <!--end::EmailSettings-->
                            <!--begin::System settings-->
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('system.index') ? 'active' : '' }}"
                                    href="{{ route('system.index') }}">
                                    System Settings
                                </a>
                            </li>
                            <!--end::System settings-->
                            <!--begin::Integration settings-->
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('integration.setting') ? 'active' : '' }}"
                                    href="{{ route('integration.setting') }}">
                                    Integration Settings
                                </a>
                            </li>
                            <!--end::Integration settings-->
                            <!--begin::Social Media settings-->
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('social-media-links.index') ? 'active' : '' }}"
                                    href="{{ route('social-media-links.index') }}">
                                    Social Media
                                </a>
                            </li>
                            <!--end::Social Media settings-->
                        </ul>
                        <!--end::SettingsDropdown-->
                    </div>
                    <!--end::SettingsDropdown-->
                </li>
                <!--end::Settings-->
                <!--end::NavbarNav-->
        </div>
        <!--end::Menu-->
    </div>
    <!--end::MenuContent-->
</div>
<!--end::Sidebar-->
