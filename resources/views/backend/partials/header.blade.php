<!--begin::Header-->
<div class="header">

    <!--begin::Navbar-->
    <div class="navbar-custom navbar navbar-expand-lg">
        <div class="container-fluid px-0">

            <!--begin::BrandMobile-->
            <a class="navbar-brand d-block d-md-none" href="index-2.html">
                <img src="{{ asset('assets/backend/images/brand/logo/logo-2.svg') }}" alt="Image">
            </a>
            <!--end::BrandMobile-->

            <!--begin::NavToggle-->
            <a id="nav-toggle" href="#!" class="ms-auto ms-md-0 me-0 me-lg-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                    class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
                    <path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </a>
            <!--end::NavToggle-->

            <!--begin::SearchForm (hidden)-->
            <div class="d-none d-md-none d-lg-block">
                {{-- <form action="#">
                    <div class="input-group">
                        <input class="form-control rounded-3" type="search" value="" id="searchInput" placeholder="Search">
                        <span class="input-group-append">
                            <button class="btn ms-n10 rounded-0 rounded-end" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-dark">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </span>
                    </div>
                </form> --}}
            </div>
            <!--end::SearchForm-->

            <!--begin::NavRight-->
            <ul class="navbar-nav navbar-right-wrap ms-lg-auto d-flex nav-top-wrap align-items-center ms-4 ms-lg-0">

                <!--begin::ThemeToggle-->
                <a href="#" class="form-check form-switch theme-switch btn btn-ghost btn-icon rounded-circle mb-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                </a>
                <!--end::ThemeToggle-->

                <!--begin::NotificationsDropdown (hidden)-->
                <li class="dropdown stopevent ms-2">
                    {{-- <a class="btn btn-ghost btn-icon rounded-circle" href="#!" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-xs" data-feather="bell"></i>
                    </a> --}}
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownNotification">
                        <div>
                            <!--begin::NotificationsHeader-->
                            <div class="border-bottom px-3 pt-2 pb-3 d-flex justify-content-between align-items-center">
                                <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                                <a href="#!" class="text-muted">
                                    <span><i class="me-1 icon-xs" data-feather="settings"></i></span>
                                </a>
                            </div>
                            <!--end::NotificationsHeader-->
                            <!--begin::NotificationsList-->
                            <div data-simplebar style="height: 250px;">
                                <ul class="list-group list-group-flush notification-list-scroll">
                                    <li class="list-group-item bg-light">
                                        <a href="#!" class="text-muted">
                                            <h5 class="mb-1">Rishi Chopra</h5>
                                            <p class="mb-0">Mauris blandit erat id nunc blandit, ac eleifend dolor pretium.</p>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#!" class="text-muted">
                                            <h5 class="mb-1">Neha Kannned</h5>
                                            <p class="mb-0">Proin at elit vel est condimentum elementum id in ante. Maecenas et sapien metus.</p>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#!" class="text-muted">
                                            <h5 class="mb-1">Nirmala Chauhan</h5>
                                            <p class="mb-0">Morbi maximus urna lobortis elit sollicitudin sollicitudieget elit vel pretium.</p>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#!" class="text-muted">
                                            <h5 class="mb-1">Sina Ray</h5>
                                            <p class="mb-0">Sed aliquam augue sit amet mauris volutpat hendrerit sed nunc eu diam.</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!--end::NotificationsList-->
                            <div class="border-top px-3 py-2 text-center">
                                <a href="#!" class="text-inherit"></a>
                            </div>
                        </div>
                    </div>
                </li>
                <!--end::NotificationsDropdown-->

                <!--begin::UserDropdown-->
                <li class="dropdown ms-2">
                    <!--begin::UserDropdownToggle-->
                    <a class="rounded-circle" href="#!" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-md avatar-indicators avatar-online">
                            @if (Auth::check() && Auth::user()->avatar)
                                <img alt="avatar" src="{{ asset(Auth::user()->avatar) }}" class="rounded-circle">
                            @else
                                <!--begin::AvatarInitials-->
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold"
                                    style="width: 40px; height: 40px; font-size: 14px;">
                                    @php
                                        $firstName = Auth::user()->first_name ?? '';
                                        $lastName  = Auth::user()->last_name ?? '';
                                        $fullName  = trim($firstName . ' ' . $lastName) ?: 'Admin';
                                        $words     = explode(' ', $fullName);
                                        $initials  = '';
                                        foreach ($words as $w) {
                                            if ($w !== '') {
                                                $initials .= $w[0];
                                            }
                                        }
                                        echo strtoupper(substr($initials, 0, 2));
                                    @endphp
                                </div>
                                <!--end::AvatarInitials-->
                            @endif
                        </div>
                    </a>
                    <!--end::UserDropdownToggle-->

                    <!--begin::UserDropdownMenu-->
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                        <!--begin::UserInfo-->
                        <div class="px-4 pb-0 pt-2">
                            <div class="lh-1">
                                <h5 class="mb-1">{{ trim(optional(auth()->user())->first_name . ' ' . optional(auth()->user())->last_name) ?: 'Admin' }}</h5>
                            </div>
                            <div class="dropdown-divider mt-3 mb-2"></div>
                        </div>
                        <!--end::UserInfo-->

                        <!--begin::MenuItems-->
                        <ul class="list-unstyled">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.index') }}">
                                    <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.password') }}">
                                    <i class="me-2 icon-xxs dropdown-item-icon" data-feather="lock"></i>Change Password
                                </a>
                            </li>
                            <li>
                                <form class="dropdown-item" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button style="border: none; background: transparent; margin: 0px; padding: 0px;">
                                        <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                        <!--end::MenuItems-->

                    </div>
                    <!--end::UserDropdownMenu-->

                </li>
                <!--end::UserDropdown-->

            </ul>
            <!--end::NavRight-->

        </div>
    </div>
    <!--end::Navbar-->

</div>
<!--end::Header-->
