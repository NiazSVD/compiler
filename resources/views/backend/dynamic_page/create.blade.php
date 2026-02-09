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
                    <li class="breadcrumb-item active">Add New Page</li>
                </ol>
            </nav>
            <h2 class="h4 mb-0">Create Dynamic Page</h2>
            <small class="text-muted">Fill in the details to create a multi-language page.</small>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.dynamic_page.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-8">
                <div class="card border-0 shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0"><i class="bi bi-pencil-square me-2"></i>Page Content</h5>
                    </div>
                    <div class="card-body">

                        <ul class="nav nav-tabs mb-3" id="langTabs" role="tablist">
                            @foreach ($multiLanguages as $lang)
                                <li class="nav-item">
                                    <button class="nav-link {{ $lang->code == 'en' ? 'active' : '' }}"
                                        id="{{ $lang->code }}-tab" data-bs-toggle="tab"
                                        data-bs-target="#lang-{{ $lang->code }}" type="button" role="tab">

                                        @if ($lang->flag)
                                            <img src="{{ asset('uploads/flag/' . $lang->flag) }}" alt="{{ $lang->name }}"
                                                class="me-1"
                                                style="width: 20px; height: 14px; object-fit: cover; border-radius: 2px; vertical-align: middle;">
                                        @else
                                            <i class="bi bi-translate me-1"></i>
                                        @endif

                                        {{ $lang->name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>


                        <div class="tab-content p-2 border-start border-end border-bottom rounded-bottom"
                            id="langTabsContent">
                            @foreach ($multiLanguages as $lang)
                                <div class="tab-pane fade {{ $lang->code == 'en' ? 'show active' : '' }}"
                                    id="lang-{{ $lang->code }}" role="tabpanel">

                                    <div class="mb-3 mt-3">
                                        <label class="form-label fw-bold">Page Title
                                            ({{ strtoupper($lang->code) }})</label>
                                        <input type="text" name="page_title_{{ $lang->code }}"
                                            class="form-control @error('page_title_' . $lang->code) is-invalid @enderror"
                                            placeholder="Enter page title in {{ $lang->name }}"
                                            value="{{ old('page_title_' . $lang->code) }}"
                                            {{ $lang->code == 'en' ? 'required' : '' }}>
                                        @error('page_title_' . $lang->code)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Page Content
                                            ({{ strtoupper($lang->code) }})</label>
                                        <textarea name="page_content_{{ $lang->code }}" class="form-control summernote" rows="10">{{ old('page_content_' . $lang->code) }}</textarea>
                                        @error('page_content_' . $lang->code)
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="bi bi-search me-2"></i>SEO Information (Meta Details)</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control"
                                value="{{ old('meta_title') }}" maxlength="60">

                            @error('meta_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Meta Tags</label>
                            <div>
                                <input type="text" name="meta_tags" id="meta_tags" value="{{ old('meta_tags') }}"
                                    class="tag-input">
                            </div>

                            @error('meta_tags')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3" maxlength="160">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card border-0 shadow mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="bi bi-gear me-2"></i>Publishing Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Slug (URL Friendly)</label>
                            <input type="text" name="page_slug" class="form-control" placeholder="page-url-slug"
                                value="{{ old('page_slug') }}">
                            <small class="text-muted">By default, it will be generated from the English title.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                        </div>

                        <hr>

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="status" id="statusSwitch"
                                value="active" checked>
                            <label class="form-check-label" for="statusSwitch">Page Active Status</label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="set_home" id="setHomeSwitch"
                                value="1">
                            <label class="form-check-label fw-bold text-primary" for="setHomeSwitch">Set as Home
                                Page</label>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-cloud-arrow-up me-1"></i> Save & Publish
                            </button>
                            <a href="{{ route('admin.dynamic_page.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>
    <!-- Summernote CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote for all instances with class .summernote
            $('.summernote').summernote({
                height: 300,
                placeholder: 'Write your page content here...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Home switch logic
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
            syncHomeStatus();
        });
    </script>
@endsection
