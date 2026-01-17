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
                        <a href="{{ route('admin.dynamic_page.index') }}">Dynamic Pages</a>
                    </li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </nav>

            <h2 class="h4 mb-0">Add Page</h2>
            <small class="text-muted">Create a new Dynamic Page</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">Page information</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.dynamic_page.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Page Title</label>
                                <input type="text" name="page_title" class="form-control" placeholder="page title"
                                    value="{{ old('page_title') }}" required>
                                @error('page_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Slug (URL Friendly)</label>
                                <input type="text" name="page_slug" class="form-control" value="{{ old('page_slug') }}">
                                @error('page_slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <small class="text-muted">Used in URL or identifier. Change carefully.</small>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Order</label>
                                <input type="number" name="order" class="form-control" placeholder="Page order (integer)"
                                    value="{{ old('order') }}">
                                @error('order')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>




                            <div class="mb-3">
                                <label class="form-label">Page Content</label>
                                <textarea name="page_content" id="description" class="form-control" rows="4">{{ old('page_content') }}</textarea>
                                @error('page_content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            {{-- Status --}}
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="status" id="statusSwitch"
                                    value="active">
                                <label class="form-check-label">Active</label>
                            </div>

                            {{-- Set as Home Page --}}
                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" name="set_home" id="setHomeSwitch"
                                    value="1">
                                <label class="form-check-label">
                                    Set as Home Page
                                </label>
                            </div>

                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Save
                            </button>

                            <a href="{{ route('admin.dynamic_page.index') }}" class="btn btn-outline-secondary">
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

    <script>
    const setHome = document.getElementById('setHomeSwitch');
    const status  = document.getElementById('statusSwitch');

    function syncHomeStatus() {
        if (setHome.checked) {
            status.checked = true;
            status.disabled = true;
        } else {
            status.disabled = false;
        }
    }

    setHome.addEventListener('change', syncHomeStatus);
    document.addEventListener('DOMContentLoaded', syncHomeStatus);
</script>

@endsection
