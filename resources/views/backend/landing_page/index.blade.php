@extends('backend.master')

@section('content')
    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Landing Page Content</h4>
        </div>


        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.landing.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        {{-- Header Color --}}
                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-semibold">Theme Color</label>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="color" id="header_color_picker" class="form-control form-control-color"
                                    value="{{ old('theme_color', $landing->theme_color ?? '#ffffff') }}">
                                <input type="text" name="theme_color" id="header_color_text" class="form-control"
                                    value="{{ old('theme_color', $landing->theme_color ?? '#ffffff') }}">
                            </div>
                        </div>
                    </div>


                    <div class="card card-body shadow" style="background-color: rgb(248, 247, 247)">
                        <h3 class="text-center">Header Section</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">No setup required (Header Sub Title)</label>
                                <input type="text" name="header_sub_title" class="form-control"
                                    value="{{ old('header_sub_title', $landing->header_sub_title ?? '') }}"
                                    placeholder="Enter header sub title" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Header Title</label>
                                <input type="text" name="header_title" class="form-control"
                                    value="{{ old('header_title', $landing->header_title ?? '') }}"
                                    placeholder="Enter header title" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Header Short Description</label>
                                <textarea name="header_short_description" class="form-control" rows="3" placeholder="Short header description">{{ old('header_short_description', $landing->header_short_description ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>



                    <div class="card card-body shadow mt-5" style="background-color: rgb(233, 232, 232)">
                        <h3 class="text-center">Language Section</h3>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Language Header</label>
                            <input type="text" name="lang_header" class="form-control"
                                value="{{ old('lang_header', $landing->lang_header ?? '') }}"
                                placeholder="Enter main heading" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Language Description</label>
                            <textarea name="lang_description" class="form-control" rows="3" placeholder="Short header description">{{ old('lang_description', $landing->lang_description ?? '') }}</textarea>
                        </div>
                    </div>



                    <div class="card card-body shadow mt-5" style="background-color: rgb(255, 255, 255)">
                        <h3 class="text-center">About Section</h3>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">About Header</label>
                            <input type="text" name="about_header" class="form-control"
                                value="{{ old('about_header', $landing->about_header ?? '') }}"
                                placeholder="Enter about header" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">About short description</label>
                            <textarea name="about_short_description" class="form-control" rows="3" placeholder="Short header description">{{ old('about_short_description', $landing->about_short_description ?? '') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">About Description</label>
                            <textarea name="about_description" id="summernote" class="form-control">
                                {{ old('about_description', $landing->about_description ?? '') }}
                            </textarea>
                        </div>

                        <div class="card card-body shadow mt-3" style="background-color: rgb(217, 235, 234)">
                            <h3 class="text-center">About card Section</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-body shadow" style="background-color: rgb(245, 235, 235)">

                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <input type="file" name="about_card_icon_1" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <img src="{{ $landing->about_card_icon_1 ? asset($landing->about_card_icon_1) : '#' }}"
                                                    class="form-control" height="100">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Header</label>
                                            <input type="text" name="about_card_header_1" class="form-control"
                                                value="{{ old('about_card_header_1', $landing->about_card_header_1 ?? '') }}"
                                                placeholder="Enter card heading" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Description</label>
                                            <textarea name="about_card_description_1" class="form-control" rows="3"
                                                placeholder="Card description">{{ old('about_card_description_1', $landing->about_card_description_1 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-body shadow" style="background-color: rgb(245, 235, 235)">

                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <input type="file" name="about_card_icon_2" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                 <img src="{{ $landing->about_card_icon_2 ? asset($landing->about_card_icon_2) : '#' }}"
                                                    class="form-control" height="100">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Header</label>
                                            <input type="text" name="about_card_header_2" class="form-control"
                                                value="{{ old('about_card_header_2', $landing->about_card_header_2 ?? '') }}"
                                                placeholder="Enter card heading" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Description</label>
                                            <textarea name="about_card_description_2" class="form-control" rows="3"
                                                placeholder="Card description">{{ old('about_card_description_2', $landing->about_card_description_2 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-body shadow" style="background-color: rgb(245, 235, 235)">

                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <input type="file" name="about_card_icon_3" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                 <img src="{{ $landing->about_card_icon_3 ? asset($landing->about_card_icon_3) : '#' }}"
                                                    class="form-control" height="100">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Header</label>
                                            <input type="text" name="about_card_header_3" class="form-control"
                                                value="{{ old('about_card_header_3', $landing->about_card_header_3 ?? '') }}"
                                                placeholder="Enter card heading" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Description</label>
                                            <textarea name="about_card_description_3" class="form-control" rows="3"
                                                placeholder="Card description">{{ old('about_card_description_3', $landing->about_card_description_3 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>




                    <div class="card card-body shadow mt-5" style="background-color: rgb(248, 247, 247)">
                        <h3 class="text-center">About Section</h3>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">About Header</label>
                            <input type="text" name="about_header_2" class="form-control"
                                value="{{ old('about_header_2', $landing->about_header_2 ?? '') }}"
                                placeholder="Enter main heading" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">About short description</label>
                            <textarea name="about_short_description_2" class="form-control" rows="3"
                                placeholder="Short header description">{{ old('about_short_description_2', $landing->about_short_description_2 ?? '') }}</textarea>
                        </div>


                        <div class="card card-body shadow mt-3" style="background-color: rgb(217, 235, 234)">
                            <h3 class="text-center">About card Section</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-body shadow" style="background-color: rgb(245, 235, 235)">

                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <input type="file" name="about_card_icon_4" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                 <img src="{{ $landing->about_card_icon_4 ? asset($landing->about_card_icon_4) : '#' }}"
                                                    class="form-control" height="100">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Header</label>
                                            <input type="text" name="about_card_header_4" class="form-control"
                                                value="{{ old('about_card_header_4', $landing->about_card_header_4 ?? '') }}"
                                                placeholder="Enter card heading" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Description</label>
                                            <textarea name="about_card_description_4" class="form-control" rows="3"
                                                placeholder="Card description">{{ old('about_card_description_4', $landing->about_card_description_4 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-body shadow" style="background-color: rgb(245, 235, 235)">

                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <input type="file" name="about_card_icon_5" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                 <img src="{{ $landing->about_card_icon_5 ? asset($landing->about_card_icon_5) : '#' }}"
                                                    class="form-control" height="100">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Header</label>
                                            <input type="text" name="about_card_header_5" class="form-control"
                                                value="{{ old('about_card_header_5', $landing->about_card_header_5 ?? '') }}"
                                                placeholder="Enter card heading" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Description</label>
                                            <textarea name="about_card_description_5" class="form-control" rows="3"
                                                placeholder="Card description">{{ old('about_card_description_5', $landing->about_card_description_5 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-body shadow" style="background-color: rgb(245, 235, 235)">

                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <input type="file" name="about_card_icon_6" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                 <img src="{{ $landing->about_card_icon_6 ? asset($landing->about_card_icon_6) : '#' }}"
                                                    class="form-control" height="100">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Header</label>
                                            <input type="text" name="about_card_header_6" class="form-control"
                                                value="{{ old('about_card_header_6', $landing->about_card_header_6 ?? '') }}"
                                                placeholder="Enter card heading" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Description</label>
                                            <textarea name="about_card_description_6" class="form-control" rows="3"
                                                placeholder="Card description">{{ old('about_card_description_6', $landing->about_card_description_6 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-body mt-3 shadow" style="background-color: rgb(245, 235, 235)">

                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <input type="file" name="about_card_icon_7" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                 <img src="{{ $landing->about_card_icon_7 ? asset($landing->about_card_icon_7) : '#' }}"
                                                    class="form-control" height="100">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Header</label>
                                            <input type="text" name="about_card_header_7" class="form-control"
                                                value="{{ old('about_card_header_7', $landing->about_card_header_7 ?? '') }}"
                                                placeholder="Enter card heading" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Description</label>
                                            <textarea name="about_card_description_7" class="form-control" rows="3"
                                                placeholder="Card description">{{ old('about_card_description_7', $landing->about_card_description_7 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-body mt-3 shadow" style="background-color: rgb(245, 235, 235)">

                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <input type="file" name="about_card_icon_8" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <img src="{{ $landing->about_card_icon_8 ? asset($landing->about_card_icon_8) : '#' }}"
                                                    class="form-control" height="100">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Header</label>
                                            <input type="text" name="about_card_header_8" class="form-control"
                                                value="{{ old('about_card_header_8', $landing->about_card_header_8 ?? '') }}"
                                                placeholder="Enter card heading" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Description</label>
                                            <textarea name="about_card_description_8" class="form-control" rows="3"
                                                placeholder="Card description">{{ old('about_card_description_8', $landing->about_card_description_8 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-body mt-3 shadow" style="background-color: rgb(245, 235, 235)">

                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <input type="file" name="about_card_icon_9" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Icon</label>
                                                <img src="{{ $landing->about_card_icon_9 ? asset($landing->about_card_icon_9) : '#' }}"
                                                    class="form-control" height="100">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Header</label>
                                            <input type="text" name="about_card_header_9" class="form-control"
                                                value="{{ old('about_card_header_9', $landing->about_card_header_9 ?? '') }}"
                                                placeholder="Enter card heading" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Description</label>
                                            <textarea name="about_card_description_9" class="form-control" rows="3"
                                                placeholder="Card description">{{ old('about_card_description_9', $landing->about_card_description_9 ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="col-md-12 mt-3">
                            <label class="form-label fw-semibold">Footer text</label>
                            <input type="text" name="footer_text" class="form-control" placeholder="Enter footer text"
                                value="{{ $landing->footer_text ?? '' }}">
                        </div>

                    </div>


                    <div class="d-flex gap-2 mt-5">
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
