@extends('backend.app')

@section('title')
    {{ config('app.name') }} || User Details
@endsection

@section('content')
    <!--begin::App Content-->
    <div id="app-content">
        <!--begin::App Content Area-->
        <div class="app-content-area">
            <!--begin::Container-->
            <div class="container-fluid">
                <!-- Breadcrumbs -->
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="d-flex flex-column">
                            <a href="{{ route('users.index') }}" class="text-primary fw-bold text-decoration-none mb-1"><i
                                    class="bi bi-arrow-left me-1"></i> Back to Users</a>
                            <span class="text-primary fw-bold">Users</span>
                            <h2 class="h4 mb-1">User Details</h2>
                            <p class="text-muted">View user profile and associated data.</p>
                        </div>
                    </div>
                </div>

                <!-- User Information Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-person-circle text-primary fs-4 me-2"></i>
                            <h4 class="mb-0 h5">User Information</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Full Name</div>
                                <div class="fw-bold text-dark">
                                    {{ trim($user->first_name . ' ' . $user->last_name) ?: 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Email</div>
                                <div class="fw-bold text-dark">{{ $user->email ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Phone</div>
                                <div class="fw-bold text-dark">{{ $user->phone ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Handle</div>
                                <div class="fw-bold text-dark">{{ $user->handle ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Job Title</div>
                                <div class="fw-bold text-dark">{{ $user->job_title ?? 'N/A' }}</div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Location</div>
                                <div class="fw-bold text-dark">{{ $user->location ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Bio</div>
                                <div class="fw-bold text-dark">{{ $user->bio ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Status</div>
                                <div class="fw-bold text-dark">
                                    <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Company Name</div>
                                <div class="fw-bold text-dark">{{ $user->company_name ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-telephone text-primary fs-4 me-2"></i>
                            <h4 class="mb-0 h5">Contact Information</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Website</div>
                                <div class="fw-bold text-dark">{{ $user->contact->website ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Instagram</div>
                                <div class="fw-bold text-dark">{{ $user->contact->instagram ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">TikTok</div>
                                <div class="fw-bold text-dark">{{ $user->contact->tiktok ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">LinkedIn</div>
                                <div class="fw-bold text-dark">{{ $user->contact->linkedin ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Other</div>
                                <div class="fw-bold text-dark">{{ $user->contact->other ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-card-heading text-primary fs-4 me-2"></i>
                            <h4 class="mb-0 h5">Business Card</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Front Image</div>
                                <div class="fw-bold text-dark">
                                    @if (isset($user->businessCard) && $user->businessCard->front_image)
                                        <a href="{{ asset($user->businessCard->front_image) }}" target="_blank">View
                                            Image</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Back Image</div>
                                <div class="fw-bold text-dark">
                                    @if (isset($user->businessCard) && $user->businessCard->back_image)
                                        <a href="{{ asset($user->businessCard->back_image) }}" target="_blank">View
                                            Image</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Link -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-link-45deg text-primary fs-4 me-2"></i>
                            <h4 class="mb-0 h5">Payment Link</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Type</div>
                                <div class="fw-bold text-dark">
                                    {{ isset($user->paymentLink) ? ucfirst($user->paymentLink->type) : 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Status</div>
                                <div class="fw-bold text-dark">
                                    @if (isset($user->paymentLink))
                                        <span class="badge {{ $user->paymentLink->enabled ? 'bg-success' : 'bg-danger' }}">
                                            {{ $user->paymentLink->enabled ? 'Enabled' : 'Disabled' }}
                                        </span>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Button Label</div>
                                <div class="fw-bold text-dark">{{ $user->paymentLink->button_label ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">External URL</div>
                                <div class="fw-bold text-dark">
                                    @if (isset($user->paymentLink) && $user->paymentLink->external_url)
                                        <a href="{{ $user->paymentLink->external_url }}"
                                            target="_blank">{{ $user->paymentLink->external_url }}</a>
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Theme -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-palette text-primary fs-4 me-2"></i>
                            <h4 class="mb-0 h5">Theme</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Name</div>
                                <div class="fw-bold text-dark">{{ $user->theme->name ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Primary Color</div>
                                <div class="fw-bold text-dark">
                                    @if (isset($user->theme) && $user->theme->primary_color)
                                        <span
                                            style="display:inline-block; width:15px; height:15px; background-color:{{ $user->theme->primary_color }}; border-radius:3px; margin-right:5px;"></span>
                                        {{ $user->theme->primary_color }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Accent Color</div>
                                <div class="fw-bold text-dark">
                                    @if (isset($user->theme) && $user->theme->accent_color)
                                        <span
                                            style="display:inline-block; width:15px; height:15px; background-color:{{ $user->theme->accent_color }}; border-radius:3px; margin-right:5px;"></span>
                                        {{ $user->theme->accent_color }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="text-uppercase text-muted small fw-bold mb-1">Description</div>
                                <div class="fw-bold text-dark">{{ $user->theme->description ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expertises -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-star text-primary fs-4 me-2"></i>
                            <h4 class="mb-0 h5">Expertises</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @if (isset($user->expertises) && $user->expertises->count() > 0)
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($user->expertises as $expertise)
                                            <span class="badge bg-secondary fs-6">{{ $expertise->name }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="fw-bold text-dark">N/A</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Education -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-book text-primary fs-4 me-2"></i>
                            <h4 class="mb-0 h5">Education</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @if (isset($user->educations) && $user->educations->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-uppercase text-muted small fw-bold">Degree</th>
                                                    <th class="text-uppercase text-muted small fw-bold">Institution</th>
                                                    <th class="text-uppercase text-muted small fw-bold">Year</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user->educations as $education)
                                                    <tr>
                                                        <td class="fw-bold text-dark">{{ $education->degree ?? 'N/A' }}
                                                        </td>
                                                        <td class="fw-bold text-dark">
                                                            {{ $education->institution ?? 'N/A' }}</td>
                                                        <td class="fw-bold text-dark">{{ $education->year ?? 'N/A' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="fw-bold text-dark">N/A</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recognitions -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-award text-primary fs-4 me-2"></i>
                            <h4 class="mb-0 h5">Recognitions</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @if (isset($user->recognitions) && $user->recognitions->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-uppercase text-muted small fw-bold">Title</th>
                                                    <th class="text-uppercase text-muted small fw-bold">Description</th>
                                                    <th class="text-uppercase text-muted small fw-bold">Year</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user->recognitions as $recognition)
                                                    <tr>
                                                        <td class="fw-bold text-dark">{{ $recognition->title ?? 'N/A' }}
                                                        </td>
                                                        <td class="fw-bold text-dark">
                                                            {{ $recognition->description ?? 'N/A' }}</td>
                                                        <td class="fw-bold text-dark">{{ $recognition->year ?? 'N/A' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="fw-bold text-dark">N/A</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            <!--end::Container-->
            </div>
        <!--end::App Content Area-->
        </div>
    <!--end::App Content-->
    </div>
@endsection
