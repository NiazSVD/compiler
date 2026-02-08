@extends('backend.master')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="bi bi-house-door fs-6"></i></a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dynamic_page.index') }}">Dynamic Pages</a>
                </li>
                <li class="breadcrumb-item active">Edit Page</li>
            </ol>
        </nav>
        <h2 class="h4 mb-0">Edit Dynamic Page</h2>
        <small class="text-muted">Update multi-language content and settings.</small>
    </div>
</div>

<form method="POST" action="{{ route('admin.dynamic_page.update', $page->id) }}" enctype="multipart/form-data">
    @csrf
    {{-- Update এর জন্য @method('POST') আপনার কন্ট্রোলার লজিক অনুযায়ী (যদি route post হয়) --}}

    <div class="row">
        {{-- বাম পাশ: কন্টেন্ট এবং SEO --}}
        <div class="col-md-8">
            <div class="card border-0 shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="bi bi-pencil-square me-2"></i>Page Content</h5>
                </div>
                <div class="card-body">
                    {{-- ল্যাঙ্গুয়েজ ট্যাব নেভিগেশন --}}
                    <ul class="nav nav-tabs mb-3" id="langTabs" role="tablist">
                        @foreach($multiLanguages as $lang)
                        <li class="nav-item">
                            <button class="nav-link {{ $lang->code == 'en' ? 'active' : '' }}"
                                id="{{ $lang->code }}-tab" data-bs-toggle="tab"
                                data-bs-target="#lang-{{ $lang->code }}"
                                type="button" role="tab">
                                <i class="bi bi-translate me-1"></i> {{ $lang->name }}
                            </button>
                        </li>
                        @endforeach
                    </ul>

                    {{-- ট্যাব কন্টেন্ট --}}
                    <div class="tab-content p-2 border-start border-end border-bottom rounded-bottom" id="langTabsContent">
                        @foreach($multiLanguages as $lang)
                        <div class="tab-pane fade {{ $lang->code == 'en' ? 'show active' : '' }}"
                             id="lang-{{ $lang->code }}" role="tabpanel">

                            <div class="mb-3 mt-3">
                                <label class="form-label fw-bold">Page Title ({{ strtoupper($lang->code) }})</label>
                                <input type="text" name="page_title_{{ $lang->code }}"
                                    class="form-control @error('page_title_'.$lang->code) is-invalid @enderror"
                                    placeholder="Enter title in {{ $lang->name }}"
                                    {{-- Trait এর মাধ্যমে ডাটাবেস থেকে সঠিক ল্যাঙ্গুয়েজ অনুযায়ী ডাটা নিয়ে আসা --}}
                                    value="{{ old('page_title_'.$lang->code, $page->getTranslation('page_title', $lang->code)) }}"
                                    {{ $lang->code == 'en' ? 'required' : '' }}>
                                @error('page_title_'.$lang->code)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Page Content ({{ strtoupper($lang->code) }})</label>
                                <textarea name="page_content_{{ $lang->code }}"
                                    class="form-control summernote">{{ old('page_content_'.$lang->code, $page->getTranslation('page_content', $lang->code)) }}</textarea>
                                @error('page_content_'.$lang->code)
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- SEO সেটিংস --}}
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="bi bi-search me-2"></i>SEO Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control"
                                value="{{ old('meta_title', $page->meta_title) }}" maxlength="60">

                            @error('meta_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Tags</label>
                            <div>
                                <input type="text" name="meta_tags" id="meta_tags" class="tag-input"
                                    value="{{ old('meta_tags', $page->meta_tags) }}">
                            </div>


                            @error('meta_tags')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" rows="4" maxlength="160">{{ old('meta_description', $page->meta_description) }}</textarea>

                            @error('meta_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                </div>
            </div>
        </div>

        {{-- ডান পাশ: পাবলিশিং সেটিংস --}}
        <div class="col-md-4">
            <div class="card border-0 shadow mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="bi bi-gear me-2"></i>Publishing Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Slug (URL Friendly)</label>
                        <input type="text" name="page_slug" class="form-control" placeholder="page-url-slug"
                            value="{{ old('page_slug', $page->page_slug) }}">
                        <small class="text-muted">By default, it will be generated from the English title.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Display Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $page->order) }}">
                    </div>

                    <hr>

                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="active"
                            {{ old('status', $page->status) === 'active' ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusSwitch">Status: Active</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="set_home" id="setHomeSwitch" value="1"
                            {{ (isset($page->is_home) && $page->is_home) || (isset($homeSettings) && $homeSettings->slug == $page->page_slug) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold text-primary" for="setHomeSwitch">Set as Home Page</label>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-arrow-repeat me-1"></i> Update Page
                        </button>
                        <a href="{{ route('admin.dynamic_page.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    {{-- CSS Libraries --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">


    {{-- JS Libraries --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <script>
        $(document).ready(function() {
            // Summernote Initialize
            $('.summernote').summernote({
                height: 300,
                placeholder: 'Update page content...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });


            // Status & Home Sync Logic
            const setHome = document.getElementById('setHomeSwitch');
            const status = document.getElementById('statusSwitch');

            function syncHomeStatus() {
                if (setHome.checked) {
                    status.checked = true;
                    status.disabled = true;
                } else {
                    status.disabled = false;
                }
            }

            setHome.addEventListener('change', syncHomeStatus);
            syncHomeStatus(); // Initial check
        });
    </script>
@endsection
