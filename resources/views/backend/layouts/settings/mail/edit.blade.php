@extends('backend.app')
<!--begin::Title-->
@section('title')
    {{ env('APP_NAME') }} || SMTP Mail Settings
@endsection
<!--end::Title-->
@section('content')
    <!--begin::SmtpContent-->
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-9 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-12">
                                <!--begin::PageHeader-->
                                <div id="validation" class="mb-4">
                                    <h2 class="h3 mb-1">Email SMTP Settings</h2>
                                    <p>Please provide your email SMTP to activate your email functionality. Without this,
                                        the email sending feature will not work.</p>
                                </div>
                                <!--end::PageHeader-->

                                <!--begin::FormCard-->
                                <div class="card mb-10">
                                    <div class="tab-content p-4">
                                        <form action="{{ route('mail-setting.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <!--begin::FormRow-->
                                            <div class="row">
                                                <div class="col-md-4 mb-4">
                                                    <div class="form-group">
                                                        <label for="mail_mailer" class="form-label fw-medium">Mail
                                                            Mailer</label>
                                                        <input type="text"
                                                            class="form-control @error('mail_mailer') is-invalid @enderror"
                                                            id="mail_mailer" name="mail_mailer"
                                                            value="{{ old('mail_mailer', env('MAIL_MAILER')) }}"
                                                            placeholder="smtp">
                                                        @error('mail_mailer')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::FormRow-->

                                                <!--begin::FormRow-->
                                                <div class="col-md-4 mb-4">
                                                    <div class="form-group">
                                                        <label for="mail_host" class="form-label fw-medium">Mail
                                                            Host</label>
                                                        <input type="text"
                                                            class="form-control @error('mail_host') is-invalid @enderror"
                                                            id="mail_host" name="mail_host"
                                                            value="{{ old('mail_host', env('MAIL_HOST')) }}"
                                                            placeholder="mail.domain.com">
                                                        @error('mail_host')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::FormRow-->

                                                <!--begin::FormRow-->
                                                <div class="col-md-4 mb-4">
                                                    <div class="form-group">
                                                        <label for="mail_port" class="form-label fw-medium">Mail
                                                            Port</label>
                                                        <input type="text"
                                                            class="form-control @error('mail_port') is-invalid @enderror"
                                                            id="mail_port" name="mail_port"
                                                            value="{{ old('mail_port', env('MAIL_PORT')) }}"
                                                            placeholder="587">
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end::FormRow-->

                                            <!--begin::FormRow-->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label for="mail_username"
                                                        class="form-label fw-medium">Username</label>
                                                    <input type="text"
                                                        class="form-control @error('mail_username') is-invalid @enderror"
                                                        id="mail_username" name="mail_username"
                                                        value="{{ old('mail_username', env('MAIL_USERNAME')) }}"
                                                        placeholder="mail_username">
                                                    @error('mail_username')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end::FormRow-->

                                            <!--begin::FormRow-->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label for="mail_password"
                                                        class="form-label fw-medium">Password</label>
                                                    <input type="text"
                                                        class="form-control @error('mail_password') is-invalid @enderror"
                                                        id="mail_password" name="mail_password"
                                                        value="{{ old('mail_password', env('MAIL_PASSWORD')) }}"
                                                        placeholder="**********">
                                                    @error('mail_password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end::FormRow-->

                                            <!--begin::FormRow-->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label for="mail_encryption"
                                                        class="form-label fw-medium">Encryption</label>
                                                    <input type="text"
                                                        class="form-control @error('mail_encryption') is-invalid @enderror"
                                                        id="mail_encryption" name="mail_encryption"
                                                        value="{{ old('mail_encryption', env('MAIL_ENCRYPTION')) }}"
                                                        placeholder="tls">
                                                    @error('mail_encryption')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end::FormRow-->

                                            <!--begin::FormRow-->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label for="mail_address" class="form-label fw-medium">Mail
                                                        Address</label>
                                                    <input type="text"
                                                        class="form-control @error('mail_address') is-invalid @enderror"
                                                        id="mail_address" name="mail_address"
                                                        value="{{ old('mail_address', env('MAIL_FROM_ADDRESS')) }}"
                                                        placeholder="yourmail@mail.com">
                                                    @error('mail_address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end::FormRow-->

                                            <!--begin::FormRow-->
                                            <div class="col-12 mb-4">
                                                <div class="form-check mt-1">
                                                    <input
                                                        class="form-check-input @error('condition') is-invalid @enderror"
                                                        type="checkbox" id="condition" name="condition" value="1"
                                                        {{ old('condition') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="condition">
                                                        This SMTP is mine and saved to use.
                                                    </label>
                                                    @error('condition')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::FormRow-->

                                        <!--begin::FormRow-->
                                        <div class="d-flex flex-wrap gap-3 mt-2">
                                            <button class="btn btn-primary py-2 px-4" type="submit">
                                                <i class="bi bi-check-lg me-1"></i> Save SMTP Settings
                                            </button>
                                        </div>
                                        <!--end::FormRow-->
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
                            <li><a href="#validation">SMTP Settings</a></li>
                        </ul>
                    </div>
                </div>
                <!--end::SidebarNav-->
            </div>
        </div>
    </div>
</div>
<!--end::SmtpContent-->
@endsection
