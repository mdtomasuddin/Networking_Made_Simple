@extends('backend.app')

<!--begin::Title-->
@section('title', 'Integration Settings')
<!--end::Title-->

@section('content')
    <!--begin::IntegrationContent-->
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-9 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-12">
                                <!--begin::PageHeader-->
                                <div id="validation" class="mb-4">
                                    <h2 class="h3 mb-1">Integration Settings</h2>
                                    <p>Manage your third-party service integrations and API credentials here. Configure
                                        Google, Stripe, and other payment/authentication services.</p>
                                </div>
                                <!--end::PageHeader-->

                                <!--begin::Tabs-->
                                <ul class="nav nav-tabs mb-4" id="integrationTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="stripe-tab" data-bs-toggle="tab"
                                            data-bs-target="#stripe" type="button" role="tab" aria-controls="stripe"
                                            aria-selected="true">
                                            <i class="bi bi-credit-card me-2"></i>Stripe
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="google-tab" data-bs-toggle="tab"
                                            data-bs-target="#google" type="button" role="tab" aria-controls="google"
                                            aria-selected="false">
                                            <i class="bi bi-google me-2"></i>Google
                                        </button>
                                    </li>
                                </ul>
                                <!--end::Tabs-->

                                <!--begin::TabContent-->
                                <div class="tab-content" id="integrationTabContent">

                                    <!--begin::StripeTab-->
                                    <div class="tab-pane fade show active" id="stripe" role="tabpanel"
                                        aria-labelledby="stripe-tab">
                                        <div class="card mb-10">
                                            <div class="tab-content p-4">
                                                <form method="POST" action="{{ route('stripe.update') }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="row">
                                                        <!--begin::StripePublicKey-->
                                                        <div class="col-md-6 mb-4">
                                                            <div class="form-group">
                                                                <label for="STRIPE_KEY" class="form-label fw-medium">Stripe
                                                                    Public Key</label>
                                                                <input type="text"
                                                                    class="form-control @error('STRIPE_KEY') is-invalid @enderror"
                                                                    name="STRIPE_KEY" id="STRIPE_KEY"
                                                                    placeholder="pk_live_..."
                                                                    value="{{ old('STRIPE_KEY', env('STRIPE_KEY')) }}">
                                                                @error('STRIPE_KEY')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!--end::StripePublicKey-->
                                                        <!--begin::StripeSecretKey-->
                                                        <div class="col-md-6 mb-4">
                                                            <div class="form-group">
                                                                <label for="STRIPE_SECRET"
                                                                    class="form-label fw-medium">Stripe Secret Key</label>
                                                                <input type="text"
                                                                    class="form-control @error('STRIPE_SECRET') is-invalid @enderror"
                                                                    name="STRIPE_SECRET" id="STRIPE_SECRET"
                                                                    placeholder="sk_live_..."
                                                                    value="{{ old('STRIPE_SECRET', env('STRIPE_SECRET')) }}">
                                                                @error('STRIPE_SECRET')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!--end::StripeSecretKey-->
                                                        <!--begin::StripeWebhook-->
                                                        <div class="col-md-6 mb-4">
                                                            <div class="form-group">
                                                                <label for="STRIPE_WEBHOOK_SECRET"
                                                                    class="form-label fw-medium">
                                                                    Stripe Webhook Secret
                                                                    <span class="text-muted fw-normal">(Optional)</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control @error('STRIPE_WEBHOOK_SECRET') is-invalid @enderror"
                                                                    name="STRIPE_WEBHOOK_SECRET" id="STRIPE_WEBHOOK_SECRET"
                                                                    placeholder="whsec_..."
                                                                    value="{{ old('STRIPE_WEBHOOK_SECRET', env('STRIPE_WEBHOOK_SECRET')) }}">
                                                                <small class="text-muted d-block mt-1">Used for verifying
                                                                    Stripe webhook events.</small>
                                                                @error('STRIPE_WEBHOOK_SECRET')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!--end::StripeWebhook-->
                                                    </div>
                                                    <!--begin::Actions-->
                                                    <div class="d-flex flex-wrap gap-3 mt-2">
                                                        <button class="btn btn-primary py-2 px-4" type="submit">
                                                            <i class="bi bi-check-lg me-1"></i>Save Stripe Settings
                                                        </button>
                                                    </div>
                                                    <!--end::Actions-->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::StripeTab-->

                                    <!--begin::GoogleTab-->
                                    <div class="tab-pane fade" id="google" role="tabpanel" aria-labelledby="google-tab">
                                        <div class="card mb-10">
                                            <div class="tab-content p-4">
                                                <form method="POST" action="{{ route('google.update') }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="row">
                                                        <!--begin::GoogleClientId-->
                                                        <div class="col-md-6 mb-4">
                                                            <div class="form-group">
                                                                <label for="GOOGLE_CLIENT_ID"
                                                                    class="form-label fw-medium">Google Client ID</label>
                                                                <input type="text"
                                                                    class="form-control @error('GOOGLE_CLIENT_ID') is-invalid @enderror"
                                                                    name="GOOGLE_CLIENT_ID" id="GOOGLE_CLIENT_ID"
                                                                    placeholder="Your Google Client ID"
                                                                    value="{{ old('GOOGLE_CLIENT_ID', env('GOOGLE_CLIENT_ID')) }}">
                                                                @error('GOOGLE_CLIENT_ID')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!--end::GoogleClientId-->
                                                        <!--begin::GoogleClientSecret-->
                                                        <div class="col-md-6 mb-4">
                                                            <div class="form-group">
                                                                <label for="GOOGLE_CLIENT_SECRET"
                                                                    class="form-label fw-medium">Google Client
                                                                    Secret</label>
                                                                <input type="text"
                                                                    class="form-control @error('GOOGLE_CLIENT_SECRET') is-invalid @enderror"
                                                                    name="GOOGLE_CLIENT_SECRET" id="GOOGLE_CLIENT_SECRET"
                                                                    placeholder="Your Google Client Secret"
                                                                    value="{{ old('GOOGLE_CLIENT_SECRET', env('GOOGLE_CLIENT_SECRET')) }}">
                                                                @error('GOOGLE_CLIENT_SECRET')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!--end::GoogleClientSecret-->
                                                    </div>
                                                    <!--begin::Actions-->
                                                    <div class="d-flex flex-wrap gap-3 mt-2">
                                                        <button class="btn btn-primary py-2 px-4" type="submit">
                                                            <i class="bi bi-check-lg me-1"></i>Save Google Settings
                                                        </button>
                                                    </div>
                                                    <!--end::Actions-->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::GoogleTab-->

                                </div>
                                <!--end::TabContent-->

                            </div>
                        </div>
                    </div>

                    <!--begin::SidebarNav-->
                    <div class="col-xl-2 d-none d-xl-block position-fixed end-0">
                        <div class="sidebar-nav-fixed">
                            <span class="px-4 mb-2 d-block text-uppercase ls-md h3 fs-6">Contents</span>
                            <ul class="list-unstyled">
                                <li><a href="#validation">Integration Settings</a></li>
                                <li><a href="#stripe-tab" class="ps-2">Stripe</a></li>
                                <li><a href="#google-tab" class="ps-2">Google</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--end::SidebarNav-->

                </div>
            </div>
        </div>
    </div>
    <!--end::IntegrationContent-->
@endsection
