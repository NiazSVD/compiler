@extends('backend.master')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door fs-6"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.languages.index') }}">Languages</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>

            <h2 class="h4 mb-0">Edit Language</h2>
            <small class="text-muted">Update language configuration</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">Language Information</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.languages.update', $language) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- Language Key --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Language Key</label>
                                <input type="text" class="form-control" value="{{ $language->name }}" disabled>
                            </div>

                            {{-- Display Name --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Display Name</label>
                                <input type="text" name="display_name" value="{{ $language->display_name }}"
                                    class="form-control" required>
                            </div>

                            {{-- Slug --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Slug (URL Friendly)</label>
                                <input type="text" name="slug" value="{{ $language->slug }}" class="form-control">
                                <small class="text-muted">
                                    Used in URL or identifier. Change carefully.
                                </small>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Version --}}
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Version</label>
                                <input type="text" class="form-control" value="{{ $language->version }}" disabled>
                            </div>

                            {{-- Runtime --}}
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Runtime</label>
                                <input type="text" class="form-control" value="{{ $language->runtime }}" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="icon" class="form-label">Icon</label>
                                <input type="text" name="icon" id="icon" class="form-control"
                                    value="{{ old('icon', $language->icon) }}">
                                <small class="text-muted">FontAwesome icon class, example: fa-brands fa-python</small>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="icon_color" class="form-label">Icon Color</label>
                                <input type="color" name="icon_color" id="icon_color"
                                    class="form-control form-control-color"
                                    value="{{ old('icon_color', $language->icon_color ?? '#000000') }}">
                            </div>

                        </div>

                        {{-- Status --}}
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                {{ $language->is_active ? 'checked' : '' }}>
                            <label class="form-check-label">
                                Active
                            </label>
                        </div>

                        {{-- Default --}}
                        {{-- <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" name="is_default" value="1"
                                {{ $language->is_default ? 'checked' : '' }}>
                            <label class="form-check-label">
                                Default Language
                            </label>
                        </div> --}}

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $language->description) }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Update
                            </button>

                            <a href="{{ route('admin.languages.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#description').summernote({
                height: 200,               // editor height
                placeholder: 'Enter language description...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color', 'strikethrough']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection
