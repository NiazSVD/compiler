@extends('backend.master')

@section('content')
    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Landing Page Content</h4>
        </div>


        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.landing.update') }}">
                    @csrf

                    <div class="row">
                        {{-- Header Color --}}
                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-semibold">Header Color</label>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="color" id="header_color_picker" class="form-control form-control-color"
                                    value="{{ old('header_color', $landing->header_color ?? '#ffffff') }}">
                                <input type="text" name="header_color" id="header_color_text" class="form-control"
                                    value="{{ old('header_color', $landing->header_color ?? '#ffffff') }}">
                            </div>
                        </div>

                        {{-- Hero Section Color --}}
                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-semibold">Hero Section Color</label>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="color" id="hero_color_picker" class="form-control form-control-color"
                                    value="{{ old('hero_color', $landing->hero_color ?? '#ffffff') }}">
                                <input type="text" name="hero_color" id="hero_color_text" class="form-control"
                                    value="{{ old('hero_color', $landing->hero_color ?? '#ffffff') }}">
                            </div>
                        </div>

                        {{-- Language Card Color --}}
                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-semibold">Language Card Color</label>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="color" id="language_color_picker" class="form-control form-control-color"
                                    value="{{ old('language_color', $landing->language_color ?? '#ffffff') }}">
                                <input type="text" name="language_color" id="language_color_text" class="form-control"
                                    value="{{ old('language_color', $landing->language_color ?? '#ffffff') }}">
                            </div>
                        </div>

                        {{-- Body Color --}}
                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-semibold">Body Color</label>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="color" id="body_color_picker" class="form-control form-control-color"
                                    value="{{ old('body_color', $landing->body_color ?? '#ffffff') }}">
                                <input type="text" name="body_color" id="body_color_text" class="form-control"
                                    value="{{ old('body_color', $landing->body_color ?? '#ffffff') }}">
                            </div>
                        </div>

                        {{-- Footer Color --}}
                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-semibold">Footer Color</label>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="color" id="footer_color_picker" class="form-control form-control-color"
                                    value="{{ old('footer_color', $landing->footer_color ?? '#ffffff') }}">
                                <input type="text" name="footer_color" id="footer_color_text" class="form-control"
                                    value="{{ old('footer_color', $landing->footer_color ?? '#ffffff') }}">
                            </div>
                        </div>
                    </div>

                    {{-- Header Text --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Header Text</label>
                        <input type="text" name="header_text" class="form-control"
                            value="{{ old('header_text', $landing->header_text ?? '') }}" placeholder="Enter main heading"
                            required>
                    </div>

                    {{-- Header Description --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Header Description</label>
                        <textarea name="header_description" class="form-control" rows="3" placeholder="Short header description">{{ old('header_description', $landing->header_description ?? '') }}</textarea>
                    </div>

                    {{-- Main Description --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Main Description</label>
                        <textarea name="description" id="summernote" class="form-control">
                        {{ old('description', $landing->description ?? '') }}
                    </textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i> Update Content
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Summernote CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300, // editor height
                placeholder: 'Enter main landing page description...',
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
        const syncColor = (pickerId, textId) => {
            const picker = document.getElementById(pickerId);
            const text = document.getElementById(textId);

            // Picker changes text
            picker.addEventListener('input', () => {
                text.value = picker.value;
            });

            // Text changes picker
            text.addEventListener('input', () => {
                if (/^#([0-9A-F]{3}){1,2}$/i.test(text.value)) {
                    picker.value = text.value;
                }
            });
        }

        syncColor('header_color_picker', 'header_color_text');
        syncColor('hero_color_picker', 'hero_color_text');
        syncColor('language_color_picker', 'language_color_text');
        syncColor('body_color_picker', 'body_color_text');
        syncColor('footer_color_picker', 'footer_color_text');
    </script>
@endsection
