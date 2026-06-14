@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Dashboard
@endsection

@section('content')
    <div id="app-content">Education
        <div class="app-content-area">
            <div class="bg-primary pt-10 pb-21 mt-n6 mx-n4"></div>
            <div class="container-fluid mt-n22">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page header -->
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="mb-2 mb-lg-0">
                                <h3 class="mb-0 text-white">Welcome back, Networking Made Simple</h3>
                                <p class="text-white-50">Manage your users, visibility, and details overview here.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stat Cards -->
                <div class="row">
                    <!-- Total Users Card -->
                    <div class="col-xl-4 col-lg-6 col-md-12 col-12 mb-5">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="mb-0">Users</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-primary-soft text-primary rounded-2">
                                        <i class="bi bi-people fs-4"></i>
                                    </div>
                                </div>
                                <div class="lh-1">
                                    <h1 class="mb-1 fw-bold">{{ $stats['total_users'] ?? 0 }}</h1>
                                    <span class="text-dark me-2">Registered Users</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Suspended Users Card -->
                    <div class="col-xl-4 col-lg-6 col-md-12 col-12 mb-5">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="mb-0">Suspended Users</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-danger-soft text-danger rounded-2">
                                        <i class="bi bi-person-x fs-4"></i>
                                    </div>
                                </div>
                                <div class="lh-1">
                                    <h1 class="mb-1 fw-bold">{{ $stats['total_suspended'] ?? 0 }}</h1>
                                    <span class="text-dark me-2">Total Suspended Users</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expertise Card -->
                    <div class="col-xl-4 col-lg-6 col-md-12 col-12 mb-5">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="mb-0">Expertise</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-info-soft text-info rounded-2">
                                        <i class="bi bi-star fs-4"></i>
                                    </div>
                                </div>
                                <div class="lh-1">
                                    <h1 class="mb-1 fw-bold">{{ $stats['total_expertise'] ?? 0 }}</h1>
                                    <span class="text-dark me-2">Total Skills/Expertise listed</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Recent Users & Extras Section -->
                <div class="row mt-6">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-5">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Recent Users</h4>
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">View All</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-centered text-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Job Title</th>
                                            <th>Company</th>
                                            <th>Location</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($userInfo ?? [] as $item)
                                            <tr>
                                                <td>
                                                    <div class="me-2 position-relative">
                                                        <img src="{{ $item->avatar ? asset($item->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(trim($item->first_name . ' ' . $item->last_name) ?: 'User') }}"
                                                            alt="Avatar" class="rounded border"
                                                            style="width: 50px; height: 50px; object-fit: cover;">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="ms-3">
                                                        <h5 class="mb-0">
                                                            <a href="{{ route('users.show', $item->id) }}"
                                                                class="text-inherit">{{ trim($item->first_name . ' ' . $item->last_name) ?: 'User' }}</a>
                                                        </h5>
                                                        @if ($item->handle)
                                                            <small class="text-muted">{{ '@' . $item->handle }}</small>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone ?? 'N/A' }}</td>
                                                <td>{{ Str::limit($item->job_title, 20, '...') ?? 'N/A' }}</td>
                                                <td>{{ Str::limit($item->company_name, 20, '...') ?? 'N/A' }}</td>
                                                <td>{{ Str::limit($item->location, 20, '...') ?? 'N/A' }}</td>
                                                <td>{{ $item->created_at ? $item->created_at->format('d M, Y') : 'N/A' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('users.show', $item->id) }}"
                                                        class="btn btn-sm btn-info-soft" title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No recent users found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        {{-- // --}}
    @endpush
