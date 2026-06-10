@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || title
@endsection

@section('content')
    <div id="app-content">
        <div class="app-content-area">
            <!-- Container fluid -->
            <div class="container-fluid">
                <div class="row">
                    <div class=" col-xl-9 col-md-12 col-sm-12 col-12 ">
                        <!-- Content -->
                        <div class="">
                            <!-- validation -->
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div id="validation" class="mb-4">
                                        <h2 class="h3 mb-1">'title' Section Content</h2>
                                        <p>
                                            This form will allow you to change the section content
                                        </p>
                                    </div>
                                    <!-- Card -->
                                    <div class="mb-10 card">
                                        {{-- ------------------------PUT YOUR CONTENT HEAR------------------------ --}}
                                    </div>

                                </div>
                            </div>
                            <!-- validation -->
                        </div>

                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12  d-none d-xl-block position-fixed end-0">
                        <!-- Sidebar nav fixed -->
                        <div class="sidebar-nav-fixed">
                            <span class="px-4 mb-2 d-block text-uppercase ls-md h3 fs-6">Contents</span>
                            <ul class="list-unstyled">
                                <li><a href="#validation">title</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
