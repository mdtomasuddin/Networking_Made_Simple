@extends('backend.layouts.auth.app')
<!--begin::Title-->
@section('title')
    {{ env('APP_NAME') }} || Lign In
@endsection
<!--end::Title-->

<!--begin::Main-->
@section('main')
    <!--begin::Main-->
    <main class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0 min-vh-100">
            <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">

                <!--begin::ThemeToggle-->
                <a href="#" class="form-check form-switch theme-switch btn btn-light btn-icon rounded-circle d-none">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                </a>
                <!--end::ThemeToggle-->

                <!--begin::Card-->
                <div class="card smooth-shadow-md">
                    <!--begin::CardBody-->
                    <div class="card-body p-6">

                        <!--begin::Header-->
                        <div class="mb-4 text-center">
                            {{-- Logo Circle (commented out) --}}
                            {{-- <div
                                style="width: 90px; height: 90px;border-radius: 50%;overflow: hidden;  border: 3px solid #1a2b5e;                                background: #1a2b5e;
                                display: flex;align-items: center; justify-content: center;margin: 0 auto 16px auto;">
                                @if (!empty($setting->logo))
                                    <img src="{{ asset($setting->logo) }}" alt="Logo"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/backend/images/brand/logo/logo-2.svg') }}" alt="Logo"
                                        style="width: 65%; height: 65%; object-fit: contain;">
                                @endif
                            </div> --}}

                            <!--begin::WelcomeText-->
                            <h4 class="fw-bold mb-1">Welcome Back</h4>
                            <p class="text-muted mb-0 small">
                                Sign in to continue to {{ $setting->system_name ?? config('app.name') }}.
                            </p>
                            <!--end::WelcomeText-->
                        </div>
                        <!--end::Header-->

                        <!--begin::Form-->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!--begin::EmailField-->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" name="email"
                                    value="{{ old('email') }}" placeholder="Email address here">
                                @error('email')
                                    <div class="validation-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!--end::EmailField-->

                            <!--begin::PasswordField-->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="position-relative">
                                    <input type="password" id="password" class="form-control pe-5" name="password"
                                        placeholder="**************">
                                    <!--begin::TogglePassword-->
                                    <button type="button" id="togglePassword"
                                        class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted border-0"
                                        style="padding: 0.375rem 0.75rem;" aria-label="Show password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <!--end::TogglePassword-->
                                </div>
                                @error('password')
                                    <div class="validation-error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!--end::PasswordField-->

                            <!--begin::RememberMe-->
                            <div class="d-lg-flex justify-content-between align-items-center mb-4">
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" class="form-check-input" id="rememberme" name="remember">
                                    <label class="form-check-label" for="rememberme">Remember me</label>
                                </div>
                            </div>
                            <!--end::RememberMe-->

                            <!--begin::Actions-->
                            <div>
                                <!--begin::SubmitButton-->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                </div>
                                <!--end::SubmitButton-->

                                {{-- Register & Forgot password links (commented out) --}}
                                {{-- <div class="d-md-flex justify-content-between mt-4">
                                    <div class="mb-2 mb-md-0">
                                        <a href="{{ route('register') }}" class="fs-5">Create An Account</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('password.request') }}" class="text-inherit fs-5">Forgot your password?</a>
                                    </div>
                                </div> --}}
                            </div>
                            <!--end::Actions-->

                        </form>
                        <!--end::Form-->

                    </div>
                    <!--end::CardBody-->
                </div>
                <!--end::Card-->

            </div>
        </div>
    </main>
    <!--end::Main-->

    <!--begin::Scripts-->
    @push('scripts')
        <script>
            // Password visibility toggle
            document.addEventListener('DOMContentLoaded', function() {
                const togglePassword = document.getElementById('togglePassword');
                const passwordInput = document.getElementById('password');
                const icon = togglePassword.querySelector('i');

                // Toggle password visibility on button click
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    icon.classList.toggle('bi-eye');
                    icon.classList.toggle('bi-eye-slash');
                    togglePassword.setAttribute('aria-label', type === 'password' ? 'Show password' :
                        'Hide password');
                    passwordInput.focus();
                });
            });
        </script>
    @endpush
    <!--end::Scripts-->
@endsection
<!--end::Main-->
