@extends('backend.app')

<!--begin::Title-->
@section('title', 'System Settings')
<!--end::Title-->

@section('content')
    <!--begin::SystemSettingsContent-->
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-9 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-12">
                                <!--begin::PageHeader-->
                                <div id="system-settings" class="mb-4">
                                    <h2 class="h3 mb-1">System Settings</h2>
                                    <p>Configure platform identity, contact information, and public system details.</p>
                                </div>
                                <!--end::PageHeader-->

                                <!--begin::FormCard-->
                                <div class="card mb-10">
                                    <div class="tab-content p-4">
                                        <form method="POST" action="{{ route('system.update') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')

                                            <div class="row">

                                                <!--begin::TitleField-->
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label for="title" class="form-label fw-medium">Title</label>
                                                        <input type="text"
                                                            class="form-control @error('title') is-invalid @enderror"
                                                            name="title" id="title" placeholder="Enter System Title"
                                                            value="{{ old('title', $setting->title ?? '') }}">
                                                        @error('title')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::TitleField-->

                                                <!--begin::SystemNameField-->
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label for="system_name" class="form-label fw-medium">System
                                                            Name</label>
                                                        <input type="text"
                                                            class="form-control @error('system_name') is-invalid @enderror"
                                                            name="system_name" id="system_name"
                                                            placeholder="Enter System Name"
                                                            value="{{ old('system_name', $setting->system_name ?? '') }}">
                                                        @error('system_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::SystemNameField-->

                                                <!--begin::EmailField-->
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label for="email" class="form-label fw-medium">Email
                                                            Address</label>
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" id="email" placeholder="Enter Email"
                                                            value="{{ old('email', $setting->email ?? '') }}">
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::EmailField-->

                                                <!--begin::PhoneField-->
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label for="phone" class="form-label fw-medium">Phone
                                                            Number</label>
                                                        <input type="text"
                                                            class="form-control @error('phone') is-invalid @enderror"
                                                            name="phone" id="phone" placeholder="Enter Phone Number"
                                                            value="{{ old('phone', $setting->phone ?? '') }}">
                                                        @error('phone')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::PhoneField-->

                                                <!--begin::AddressField-->
                                                <div class="col-12 mb-4">
                                                    <div class="form-group">
                                                        <label for="address" class="form-label fw-medium">Address</label>
                                                        <input type="text"
                                                            class="form-control @error('address') is-invalid @enderror"
                                                            name="address" id="address" placeholder="Enter Address"
                                                            value="{{ old('address', $setting->address ?? '') }}">
                                                        @error('address')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::AddressField-->

                                                <!--begin::CopyrightField-->
                                                <div class="col-12 mb-4">
                                                    <div class="form-group">
                                                        <label for="copyright_text" class="form-label fw-medium">Copyright
                                                            Text</label>
                                                        <input type="text"
                                                            class="form-control @error('copyright_text') is-invalid @enderror"
                                                            name="copyright_text" id="copyright_text"
                                                            placeholder="Enter Copyright Text"
                                                            value="{{ old('copyright_text', $setting->copyright_text ?? '') }}">
                                                        @error('copyright_text')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::CopyrightField-->

                                                <!--begin::DescriptionField-->
                                                <div class="col-12 mb-4">
                                                    <div class="form-group">
                                                        <label for="description" class="form-label fw-medium">About
                                                            System</label>
                                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                            rows="4" placeholder="Write about the system...">{{ old('description', $setting->description ?? '') }}</textarea>
                                                        @error('description')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::DescriptionField-->

                                                <!--begin::LogoUpload-->
                                                <div class="col-md-4 mb-4">
                                                    <div class="form-group">
                                                        <label for="logo" class="form-label fw-medium">Logo</label>
                                                        <input type="file"
                                                            class="form-control @error('logo') is-invalid @enderror"
                                                            name="logo" id="logo" accept="image/*">
                                                        @error('logo')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::LogoUpload-->

                                                <!--begin::FaviconUpload-->
                                                <div class="col-md-4 mb-4">
                                                    <div class="form-group">
                                                        <label for="favicon" class="form-label fw-medium">Favicon</label>
                                                        <input type="file"
                                                            class="form-control @error('favicon') is-invalid @enderror"
                                                            name="favicon" id="favicon" accept="image/*">
                                                        @error('favicon')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::FaviconUpload-->

                                                <!--begin::SidebarUpload-->
                                                <div class="col-md-4 mb-4">
                                                    <div class="form-group">
                                                        <label for="sidebar" class="form-label fw-medium">Sidebar
                                                            Image</label>
                                                        <input type="file"
                                                            class="form-control @error('sidebar') is-invalid @enderror"
                                                            name="sidebar" id="sidebar" accept="image/*">
                                                        @error('sidebar')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::SidebarUpload-->
                                                <!--end::ImageUploads-->

                                            </div>

                                            <!--begin::FormActions-->
                                            <div class="d-flex flex-wrap gap-3 mt-4">
                                                <button type="submit" class="btn btn-primary py-2 px-4">
                                                    <i class="bi bi-check-lg me-1"></i> Save Changes
                                                </button>
                                            </div>
                                            <!--end::FormActions-->
                                        </form>
                                    </div>
                                </div>
                                <!--end::FormCard-->

                            </div>
                        </div>
                    </div>

                    <!--begin::SidebarNav-->
                    <div class="col-xl-2 d-none d-xl-block position-fixed end-0">
                        <div class="sidebar-nav-fixed">
                            <span class="px-4 mb-2 d-block text-uppercase ls-md h3 fs-6">Contents</span>
                            <ul class="list-unstyled">
                                <li><a href="#system-settings">General Settings</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--end::SidebarNav-->

                </div>
            </div>
        </div>
    </div>
    <!--end::SystemSettingsContent-->

    <!--begin::Scripts-->
    @push('scripts')
        <script>
            // Classic Editor
            document.addEventListener("DOMContentLoaded", function() {
                if (document.querySelector('#description')) {
                    ClassicEditor
                        .create(document.querySelector('#description'))
                        .catch(error => {
                            console.error(error);
                        });
                }
            });
        </script>
    @endpush
    <!--end::Scripts-->
@endsection
