@extends('backend.app')

@section('title')
    {{ config('app.name') }} || Users
@endsection

@section('content')
    <!--begin::App Content-->
    <div id="app-content">
        <!--begin::App Content Area-->
        <div class="app-content-area">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Main Column-->
                    <div class="col-xl-9 col-lg-12 col-md-12 col-12">
                        <!--begin::Header-->
                        <div id="validation" class="mb-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="h3 mb-1">Users</h2>
                                <p>Manage your users, visibility, and details overview here.</p>
                            </div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Card-->
                        <div class="card border-0 shadow-sm mb-4">
                            <!--begin::Card Body-->
                            <div class="card-body">
                                <!--begin::Table Responsive-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-hover table-centered mb-0 w-100" id="user-table">
                                        <!--begin::Table Head-->
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Avatar</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Job Title</th>
                                                <th>Company</th>
                                                <th>Location</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table Head-->
                                        <!--begin::Table Body-->
                                        <tbody>
                                            {{-- Data loaded via DataTables --}}
                                        </tbody>
                                        <!--end::Table Body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table Responsive-->
                            </div>
                            <!--end::Card Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Main Column-->

                    <!--begin::Sidebar Column-->
                    <div class="col-xl-2 d-none d-xl-block position-fixed end-0 mt-6">
                        <!--begin::Sidebar Nav-->
                        <div class="sidebar-nav-fixed">
                            <span class="px-4 mb-2 d-block text-uppercase ls-md h3 fs-6">Contents</span>
                            <!--begin::Sidebar List-->
                            <ul class="list-unstyled">
                                <li><a href="#validation">Users List</a></li>
                            </ul>
                            <!--end::Sidebar List-->
                        </div>
                        <!--end::Sidebar Nav-->
                    </div>
                    <!--end::Sidebar Column-->

                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Area-->
    </div>
    <!--end::App Content-->
@endsection

@push('scripts')
    <!-- jQuery & DataTables -->
    <script src="{{ asset('assets/custom/js/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
            };
            var table = $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'avatar',
                        name: 'avatar',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'job_title',
                        name: 'job_title'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ],

            });
        });

        /**
         * Change User Status
         */
        function changeStatus(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Update Status?',
                text: 'Are you sure you want to change this user status?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#4e73df',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/users/status/${id}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            toastr.success(res.message || 'Status updated successfully');
                            $('#user-table').DataTable().ajax.reload(null, false);
                        },
                        error: function() {
                            toastr.error('Failed to update status. Please try again.');
                        }
                    });
                }
            });
        }

        /**
         * Delete Record
         */
        function deleteRecord(event, id) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'All associated data will be lost forever!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/users/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(res) {
                            toastr.success(res.message || 'User deleted successfully');
                            $('#user-table').DataTable().ajax.reload(null, false);
                        },
                        error: function(xhr) {
                            toastr.error('Deletion failed. The record might be in use.');
                        }
                    });
                }
            });
        }
    </script>
@endpush
