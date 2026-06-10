@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Dashboard
@endsection

@section('content')
    <div id="app-content">
        <div class="app-content-area">
            <div class="bg-primary pt-10 pb-21 mt-n6 mx-n4"></div>
            <div class="container-fluid mt-n22">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page header -->
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="mb-2 mb-lg-0">
                                <h3 class="mb-0 text-white">Welcome back, Admin</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stat Cards -->
                <div class="row">

                </div>

                <!-- Graphs Section -->
                <div class="row mt-6"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- // --}}
@endpush
