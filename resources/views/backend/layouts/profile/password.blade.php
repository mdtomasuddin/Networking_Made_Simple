@extends('backend.app')

@section('title')
    {{ config('app.name') }} || Change Password
@endsection

@section('content')
    <!--begin::AppContent-->
    <div id="app-content">
        <!--begin::AppContentArea-->
        <div class="app-content-area">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->
                    <div class="col-12">
                        <!--begin::PageHeader-->
                            <h2 class="h3 mb-0">Change Password</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li><a href="{{ route('admin.profile.index') }}">Profile</a></li>
                                    <li> / Change Password</li>
                                </ol>
                            </nav>
                        </div>
                        <!--end::PageHeader-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row g-4 d-flex justify-content-center">
                    {{-- Right Side: Update Form --}}
                    <!--begin::Col-->
                    <div class="col-xl-6 col-lg-8">
                        <!--begin::Card-->
                        <div class="card border-0 shadow-sm">
                            <!--begin::CardHeader-->
                                <h5 class="mb-0">Security Settings</h5>
                            </div>
                            <!--end::CardHeader-->
                            <!--begin::CardBody-->
                            <div class="card-body p-4">
                                <!--begin::Form-->
                                <form action="{{ route('admin.profile.password.update') }}" method="POST">
                                    @csrf

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <p class="text-muted small">Choose a strong password and don't reuse it for
                                                other accounts.</p>
                                        </div>

                                        {{-- Password --}}
                                        <div class="col-12">
                                            <label class="form-label fw-bold">New Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="••••••••" required>
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('password', 'password-icon')">
                                                    <i class="fa-regular fa-eye" id="password-icon"></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Confirm Password --}}
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">Confirm New Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" class="form-control" placeholder="••••••••"
                                                    required>
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('password_confirmation', 'confirm-icon')">
                                                    <i class="fa-regular fa-eye" id="confirm-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 text-end">
                                        <button type="submit" class="btn btn-primary px-5">Change Password</button>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::CardBody-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::AppContentArea-->
    </div>
    <!--end::AppContent-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- JavaScript for Image Preview --}}
    <script>
        // password show
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
