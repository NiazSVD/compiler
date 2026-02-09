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
                        <a href="{{ route('admin.languages.index') }}">Programming Languages</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
            <h2 class="h4 mb-0">Edit Programming Language</h2>
            <small class="text-muted">Update configuration and translations for <b>{{ $language->name }}</b></small>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.languages.update', $language) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-md-8">
                <div class="card border-0 shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0"><i class="bi bi-translate me-2"></i>Content Translations</h5>
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

                        <div class="tab-content p-2 border rounded" id="langTabsContent">
                            @foreach ($multiLanguages as $lang)
                                <div class="tab-pane fade {{ $lang->code == 'en' ? 'show active' : '' }}"
                                    id="lang-{{ $lang->code }}" role="tabpanel">

                                    <div class="mb-3 mt-3">
                                        <label class="form-label fw-bold">Display Name
                                            ({{ strtoupper($lang->code) }})</label>
                                        <input type="text" name="display_name_{{ $lang->code }}" class="form-control"
                                            value="{{ old('display_name_' . $lang->code, $language->getTranslation('display_name', $lang->code)) }}"
                                            {{ $lang->code == 'en' ? 'required' : '' }}>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Description
                                            ({{ strtoupper($lang->code) }})</label>
                                        <textarea name="description_{{ $lang->code }}" class="form-control my-editor" rows="5">{{ old('description_' . $lang->code, $language->getTranslation('description', $lang->code)) }}</textarea>
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
                                value="{{ old('meta_title', $language->meta_title) }}" maxlength="60">

                            @error('meta_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Tags</label>
                            <div>
                                <input type="text" name="meta_tags" id="meta_tags" class="tag-input"
                                    value="{{ old('meta_tags', $language->meta_tags) }}">
                            </div>


                            @error('meta_tags')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" rows="4" maxlength="160">{{ old('meta_description', $language->meta_description) }}</textarea>

                            @error('meta_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card border-0 shadow mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">System Configuration</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label text-muted small">Language Key</label>
                            <input type="text" class="form-control bg-light" value="{{ $language->name }}" readonly
                                disabled>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label small">Version</label>
                                <input type="text" class="form-control bg-light" value="{{ $language->version }}"
                                    disabled>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label small">Runtime</label>
                                <input type="text" class="form-control bg-light" value="{{ $language->runtime }}"
                                    disabled>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Slug (URL Friendly)</label>
                            <input type="text" name="slug" value="{{ old('slug', $language->slug) }}"
                                class="form-control">
                            <small class="text-muted">Used for the editor URL.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon</label>
                            <input type="file" name="icon" class="dropify"
                                data-default-file="{{ $language->icon ? asset($language->icon) : '' }}">
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                {{ $language->is_active ? 'checked' : '' }}>
                            <label class="form-check-label">Active for Users</label>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Update Configuration</button>
                            <a href="{{ route('admin.languages.index') }}" class="btn btn-outline-secondary">Back to
                                List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

{{-- @section('script')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">


    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250
            });
            $('.dropify').dropify();
        });
    </script>
@endsection --}}
