@extends('backend.app')

@section('title')
    {{ config('app.name') }} || Profile Settings
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
                        <div class="mb-4">
                            <h2 class="h3 mb-0">Adminstrator Profile Settings</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Profile Settings</li>
                                </ol>
                            </nav>
                        </div>
                        <!--end::PageHeader-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row g-4">
                    {{-- Left Side: Profile Overview --}}
                    <!--begin::Col-->
                    <div class="col-xl-4 col-lg-5">
                        <!--begin::Card-->
                        <div class="card border-0 shadow-sm text-center p-4">
                            <!--begin::CardBody-->
                            <div class="card-body">
                                <div class="position-relative d-inline-block mb-3">
                                    <img id="profile-display"
                                        src="{{ $user->avatar ? asset($user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->first_name . ' ' . $user->last_name) }}"
                                        class="rounded-circle border border-4 border-white shadow-sm"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                                <h4 class="mb-0">{{ $user->first_name }} {{ $user->last_name }}</h4>
                                <p class="text-muted small">{{ ucfirst($user->role->name ?? 'Administrator') }}</p>
                                <hr>

                                <div class="mt-4">
                                    {{-- Email Item --}}
                                    <div class="p-3 mb-2 bg-light rounded-3 border-0">
                                        <div class="row align-items-center">
                                            <div class="col-4 border-end">
                                                <span class="text-muted small fw-bold text-uppercase">Email</span>
                                            </div>
                                            <div class="col-8">
                                                <span class="text-dark small fw-semibold ps-2" style="word-break: break-all;">{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Phone Item --}}
                                    <div class="p-3 mb-2 bg-light rounded-3 border-0">
                                        <div class="row align-items-center">
                                            <div class="col-4 border-end">
                                                <span class="text-muted small fw-bold text-uppercase">Phone</span>
                                            </div>
                                            <div class="col-8">
                                                <span class="text-dark small fw-semibold ps-2">{{ $user->phone ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Address Item --}}
                                    <div class="p-3 bg-light rounded-3 border-0">
                                        <div class="row align-items-center">
                                            <div class="col-4 border-end">
                                                <span class="text-muted small fw-bold text-uppercase">Address</span>
                                            </div>
                                            <div class="col-8">
                                                <span class="text-dark small fw-semibold ps-2">{{ $user->location ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::CardBody-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->

                    {{-- Right Side: Update Form --}}
                    <!--begin::Col-->
                    <div class="col-xl-8 col-lg-7">
                        <!--begin::Card-->
                        <div class="card border-0 shadow-sm">
                            <!--begin::CardHeader-->
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">Edit Personal Information</h5>
                            </div>
                            <!--end::CardHeader-->
                            <!--begin::CardBody-->
                            <div class="card-body p-4">
                                <!--begin::Form-->
                                <form action="{{ route('admin.profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row g-3">
                                        {{-- First Name --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">First Name</label>
                                            <input type="text" name="first_name"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                value="{{ old('first_name', $user->first_name) }}" placeholder="Enter your first name">
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Last Name --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Last Name</label>
                                            <input type="text" name="last_name"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                value="{{ old('last_name', $user->last_name) }}" placeholder="Enter your last name">
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Email Address</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $user->email) }}" placeholder="Enter email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Phone --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Phone Number</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number">
                                        </div>

                                        {{-- Avatar --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Profile Picture</label>
                                            <input type="file" name="avatar" id="avatar-input"
                                                class="form-control @error('avatar') is-invalid @enderror" accept="image/*">
                                            <small class="text-muted">Recommended: Square image, max 5MB</small>
                                            @error('avatar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Address --}}
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Address / Location</label>
                                            <input type="text" name="location"
                                                class="form-control @error('location') is-invalid @enderror"
                                                value="{{ old('location', $user->location) }}" placeholder="Enter address / location">

                                        </div>

                                    <div class="mt-4 text-end">
                                        <button type="submit" class="btn btn-primary px-5">Update Profile</button>
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
        document.getElementById('avatar-input').onchange = function(evt) {
            const [file] = this.files;
            if (file) {
                document.getElementById('profile-display').src = URL.createObjectURL(file);
            }
        };

        // password show
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                //icon change check 
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = "password";
                //icon change check 
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
