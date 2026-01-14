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
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </nav>

            <h2 class="h4 mb-0">Add Language</h2>
            <small class="text-muted">Create a new programming language</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">Language Information</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.languages.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Language Key</label>
                            <input type="text" name="name" class="form-control" placeholder="python"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Display Name</label>
                            <input type="text" name="display_name" class="form-control" placeholder="Python"
                                value="{{ old('display_name') }}" required>
                            @error('display_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Slug (URL Friendly)</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <small class="text-muted">Used in URL or identifier. Change carefully.</small>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Version</label>
                            <input type="text" name="version" class="form-control" placeholder="3.10.0"
                                value="{{ old('version') }}">
                            @error('version')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Runtime</label>
                            <input type="text" name="runtime" class="form-control" placeholder="python3"
                                value="{{ old('runtime') }}">
                            @error('runtime')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Icon</label>
                            <input type="file" name="icon" id="icon" class="form-control dropify"
                                data-allow-remove="true">
                            @error('icon')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <small class="text-muted">Upload an icon image (jpg, png, webp).</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        {{-- Status --}}
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1">
                            <label class="form-check-label">
                                Active
                            </label>
                        </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Save
                            </button>

                            <a href="{{ route('admin.languages.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <!-- Dropify CSS/JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>

    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Dropify
            $('.dropify').dropify();

            // Summernote description editor
            $('#description').summernote({
                height: 200,
                placeholder: 'Describe the language...',
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
