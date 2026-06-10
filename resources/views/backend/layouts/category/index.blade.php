@extends('backend.app')

@section('title')
    {{ config('app.name') }} || Category
@endsection

@section('content')
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-9 col-lg-12 col-md-12 col-12">
                        <div id="validation" class="mb-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="h3 mb-1">Categories</h2>
                                <p>Manage your categories, visibility, and details.</p>
                            </div>

                        </div>

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered mb-0 w-100" id="category-table">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Data loaded via DataTables --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Sidebar --}}
                    <div class="col-xl-2 d-none d-xl-block position-fixed end-0 mt-6">
                        <div class="sidebar-nav-fixed">
                            <a href="{{ route('categories.create') }}">
                                <button type="button" class="btn btn-secondary-soft mb-2">Add New Category</button>
                            </a>
                            <span class="px-4 mb-2 d-block text-uppercase ls-md h3 fs-6">Contents</span>
                            <ul class="list-unstyled">
                                <li><a href="#validation">Categories List</a></li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery & DataTables -->
    <script src="{{ asset('assets/custom/js/jquery-3.6.0.min.js') }}"></script>
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
            var table = $('#category-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('categories.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
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
         * Change Category Status
         */
        function changeStatus(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Update Status?',
                text: 'Are you sure you want to change this category status?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#4e73df',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/category/status/${id}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            toastr.success(res.message || 'Status updated successfully');
                            $('#category-table').DataTable().ajax.reload(null, false);
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
                        url: `/category/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            toastr.success(res.message || 'Category deleted successfully');
                            $('#category-table').DataTable().ajax.reload(null, false);
                        },
                        error: function() {
                            toastr.error('Deletion failed. The record might be in use.');
                        }
                    });
                }
            });
        }
    </script>
@endpush
