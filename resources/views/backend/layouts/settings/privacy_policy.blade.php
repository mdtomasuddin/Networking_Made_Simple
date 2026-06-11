@extends('backend.app')

<!--begin::Title-->
@section('title')
    {{ env('APP_NAME') }} || Privacy Policy
@endsection
<!--end::Title-->

@section('content')
    <!--begin::PrivacyPolicyContent-->
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-9 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-12">
                                <!--begin::PageHeader-->
                                <div id="edit-category" class="mb-4">
                                    <h2 class="h3 mb-1">Privacy Policy</h2>
                                    <p>Update the Privacy Policy details below and submit.</p>
                                </div>
                                <!--end::PageHeader-->

                                <!--begin::FormCard-->
                                <div class="card mb-10">
                                    <div class="tab-content p-4">
                                        <form method="POST" action="{{ route('privacy-policy.store') }}">
                                            @csrf
                                            <div class="row">
                                                <!--begin::TitleField-->
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label for="title" class="label text-secondary">Title</label>
                                                        <input type="text"
                                                            class="form-control text-dark ps-3 h-55 @error('title') is-invalid @enderror"
                                                            name="title" id="title" placeholder="Please Enter Title"
                                                            value="{{ old('title', $privacy_policy->title ?? '') }}">
                                                        @error('title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::TitleField-->

                                                <!--begin::SlugField-->
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label for="disabledInput" class="label text-secondary">Slug</label>
                                                        <input type="text" class="form-control text-dark ps-3 h-55"
                                                            id="disabledInput" value="{{ $privacy_policy->slug ?? '' }}"
                                                            disabled="">
                                                    </div>
                                                </div>
                                                <!--end::SlugField-->
                                            </div>

                                            <!--begin::ContentField-->
                                            <div class="form-group mb-4">
                                                <label for="content" class="label text-secondary">Content</label>
                                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                                                    placeholder="Privacy Policy">{{ old('content', $privacy_policy->content ?? '') }}</textarea>
                                                @error('content')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!--end::ContentField-->

                                            <!--begin::FormActions-->
                                            <div class="d-flex flex-wrap gap-3 mt-4">
                                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                                    <i class="ri-check-line text-white fw-medium"></i> Update
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
                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12 d-none d-xl-block position-fixed end-0">
                        <div class="sidebar-nav-fixed">
                            <span class="px-4 mb-2 d-block text-uppercase ls-md h3 fs-6">Contents</span>
                            <ul class="list-unstyled">
                                <li><a href="#edit-category">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--end::SidebarNav-->
                </div>
            </div>
        </div>
    </div>
    <!--end::PrivacyPolicyContent-->

    <!--begin::Scripts-->
    @push('scripts')
        <script>
            // Start Ckeditor5
            ClassicEditor
                .create(document.querySelector('#content'))
                .catch(error => {
                    console.error(error);
                });
            // End Ckeditor5
        </script>
    @endpush
    <!--end::Scripts-->
@endsection
