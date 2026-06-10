@extends('backend.app')

@section('title')
    {{ config('app.name') }} || Change Password
@endsection

@section('content')
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-4">
                            <h2 class="h3 mb-0">Change Password</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li><a href="{{ route('profile.index') }}">Profile</a></li>
                                    <li> / Change Password</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row g-4 d-flex justify-content-center">
                    {{-- Right Side: Update Form --}}
                    <div class="col-xl-6 col-lg-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">Security Settings</h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{ route('profile.password.update') }}" method="POST">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
