@extends('backend.app')

@section('title', 'Social Media Settings')

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
                                    <h2 class="h3 mb-1">Social Media Settings</h2>
                                    <p>Please provide your social media links to update your profile. Without this,
                                        the social media integration will not work.</p>
                                    <p><span class="text-danger">Note: </span> You can add multiple social media links in
                                        this section.</p>
                                </div>
                                <!--end::PageHeader-->

                                <!--begin::Content-->
                                <div class="card mb-10 shadow-sm border-0">
                                    <!--begin::Card header-->
                                    <div
                                        class="card-header border-bottom-0 pt-6 pb-2 d-flex justify-content-between align-items-center">
                                        <h4 class="card-title fw-bold m-0 text-dark">Social Media Links</h4>
                                        <button class="btn btn-sm btn-light-info fw-semibold" type="button"
                                            onclick="addSocialField()"
                                            style="background-color: #f1faff; color: #024d7c; border: none;">
                                            <i class="bi bi-plus-lg"></i> Add
                                        </button>
                                    </div>
                                    <!--end::Card header-->

                                    <div class="card-body p-6">
                                        <!--begin::Form-->
                                        <form action="{{ route('social-media-links.store') }}" method="POST" class="form"
                                            novalidate="novalidate">
                                            @csrf
                                            <div id="social_media_container">
                                                <!--start::Existing social media links-->
                                                @forelse ($social_link as $link)
                                                    <div class="social_media row mb-4 align-items-center">
                                                        <input type="hidden" name="social_media_id[]"
                                                            value="{{ $link->id }}">
                                                        <div class="col-md-3 mb-2 mb-md-0">
                                                            <select class="form-select bg-light border-0 shadow-none"
                                                                name="social_media[]"
                                                                title="Select a social media platform">
                                                                <option value="">Select Social</option>
                                                                <option value="facebook"
                                                                    {{ $link->social_media == 'facebook' ? 'selected' : '' }}>
                                                                    Facebook</option>
                                                                <option value="instagram"
                                                                    {{ $link->social_media == 'instagram' ? 'selected' : '' }}>
                                                                    Instagram</option>
                                                                <option value="twitter"
                                                                    {{ $link->social_media == 'twitter' ? 'selected' : '' }}>
                                                                    Twitter</option>
                                                                <option value="tiktok"
                                                                    {{ $link->social_media == 'tiktok' ? 'selected' : '' }}>
                                                                    Tiktok</option>
                                                                <option value="youtube"
                                                                    {{ $link->social_media == 'youtube' ? 'selected' : '' }}>
                                                                    YouTube</option>
                                                                <option value="linkedin"
                                                                    {{ $link->social_media == 'linkedin' ? 'selected' : '' }}>
                                                                    Linkedin</option>
                                                                <option value="snapchat"
                                                                    {{ $link->social_media == 'snapchat' ? 'selected' : '' }}>
                                                                    Snapchat</option>
                                                                <option value="pinterest"
                                                                    {{ $link->social_media == 'pinterest' ? 'selected' : '' }}>
                                                                    Pinterest</option>
                                                                <option value="whatsapp"
                                                                    {{ $link->social_media == 'whatsapp' ? 'selected' : '' }}>
                                                                    WhatsApp</option>
                                                                <option value="telegram"
                                                                    {{ $link->social_media == 'telegram' ? 'selected' : '' }}>
                                                                    Telegram</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-8 mb-2 mb-md-0">
                                                            <input type="url"
                                                                class="form-control bg-light border-0 shadow-none"
                                                                name="profile_link[]" value="{{ $link->profile_link }}"
                                                                placeholder="Enter the profile link here"
                                                                title="Enter the profile link here">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button class="btn btn-icon btn-sm btn-danger w-100 w-md-auto"
                                                                type="button"
                                                                style="background-color: #f1416c; border: none; padding: 8px 12px; border-radius: 6px;"
                                                                onclick="removeSocialField(this)"
                                                                data-id="{{ $link->id }}"
                                                                data-url="{{ route('social-media-links.destroy', $link->id) }}"
                                                                title="Remove this social media field">
                                                                <i class="bi bi-trash text-white"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="text-center text-muted py-5" id="empty-message">
                                                        <i class="bi bi-share fs-1 d-block mb-3"></i>
                                                        <p>No social media links added yet. Click "Add" to get started.</p>
                                                    </div>
                                                @endforelse
                                            </div>

                                            <!--begin::Actions-->
                                            <div class="d-flex flex-wrap justify-content-end gap-3 mt-5 border-top pt-5">
                                                <button type="submit" class="btn btn-primary fw-semibold"
                                                    style="background-color: #009ef7; border: none;">
                                                    <i class="bi bi-save me-1"></i> Save Changes
                                                </button>
                                                <a href="{{ route('social-media-links.index') }}" class="btn fw-semibold"
                                                    style="background-color: #e4e6ef; color: #7e8299;">
                                                    <i class="bi bi-x-lg me-1"></i> Cancel
                                                </a>
                                            </div>
                                            <!--end::Actions-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>
                    </div>

                    <!--begin::SidebarNav-->
                    <div class="col-xl-2 d-none d-xl-block position-fixed end-0">
                        <div class="sidebar-nav-fixed">
                            <span class="px-4 mb-2 d-block text-uppercase ls-md h3 fs-6">Contents</span>
                            <ul class="list-unstyled">
                                <li><a href="#social_media_container" class="ps-2">Social Links</a></li>
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

@push('scripts')
    <script>
        const MAX_SOCIAL_FIELDS = 10;
        let socialFieldsCount = $('#social_media_container .social_media').length;

        function addSocialField() {
            const container = document.getElementById("social_media_container");
            const emptyMsg = document.getElementById('empty-message');
            if (emptyMsg) emptyMsg.remove();

            if (socialFieldsCount < MAX_SOCIAL_FIELDS) {
                const row = document.createElement("div");
                row.className = "social_media row mb-4 align-items-center";
                row.innerHTML = `
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select class="form-select bg-light border-0 shadow-none" name="social_media[]" title="Select a social media platform">
                            <option value="">Select Social</option>
                            <option value="facebook">Facebook</option>
                            <option value="instagram">Instagram</option>
                            <option value="twitter">Twitter</option>
                            <option value="tiktok">Tiktok</option>
                            <option value="youtube">YouTube</option>
                            <option value="linkedin">Linkedin</option>
                            <option value="snapchat">Snapchat</option>
                            <option value="pinterest">Pinterest</option>
                            <option value="whatsapp">WhatsApp</option>
                            <option value="telegram">Telegram</option>
                        </select>
                    </div>
                    <div class="col-md-8 mb-2 mb-md-0">
                        <input type="url" class="form-control bg-light border-0 shadow-none" name="profile_link[]" placeholder="Enter the profile link here" title="Enter the profile link here">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-icon btn-sm btn-danger w-100 w-md-auto" type="button" style="background-color: #f1416c; border: none; padding: 8px 12px; border-radius: 6px;" onclick="removeSocialField(this)" title="Remove this social media field">
                            <i class="bi bi-trash text-white"></i>
                        </button>
                    </div>`;
                container.appendChild(row);
                socialFieldsCount++;
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: `Maximum ${MAX_SOCIAL_FIELDS} social links fields allowed!`,
                });
            }
        }

        function removeSocialField(button) {
            const socialLinkId = $(button).data('id');

            if (!socialLinkId) {
                $(button).closest('.social_media').remove();
                socialFieldsCount--;
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                url: $(button).data('url'),
                success: function(response) {
                    $(button).closest('.social_media').remove();
                    socialFieldsCount--;
                    if (response.success === true) {
                        toastr.success(response.message);
                    } else if (response.errors) {
                        toastr.error(response.errors[0]);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong. Please try again.",
                    });
                }
            });
        }
    </script>
@endpush
