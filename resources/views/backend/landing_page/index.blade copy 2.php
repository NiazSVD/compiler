@extends('backend.master')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Landing Page Content Management</h4>
        <button type="submit" form="landingForm" class="btn btn-primary btn-lg">
            <i class="bi bi-check-circle me-1"></i> Update All Content
        </button>
    </div>

    @php
        function getLandingData($landing, $key, $lang = 'en') {
            $row = $landing->where('key', $key)->first();
            if (!$row) return '';
            return ($lang == 'en') ? $row->value : $row->getTranslation($key, $lang);
        }
    @endphp

    <form method="POST" action="{{ route('admin.landing.update') }}" id="landingForm" enctype="multipart/form-data">
        @csrf

        <div class="card shadow-sm mb-4 border-0 sticky-top" style="top: 70px; z-index: 1000;">
            <div class="card-body">
                <ul class="nav nav-pills" id="langTabs" role="tablist">
                    @foreach($multiLanguages as $lang)
                    <li class="nav-item">
                        <button class="nav-link {{ $lang->code == 'en' ? 'active' : '' }} me-2"
                            id="{{ $lang->code }}-tab" data-bs-toggle="tab"
                            data-bs-target="#lang-{{ $lang->code }}" type="button">
                            <i class="bi bi-translate me-1"></i> {{ $lang->name }}
                        </button>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="tab-content" id="langTabsContent">
            @foreach($multiLanguages as $lang)
            <div class="tab-pane fade {{ $lang->code == 'en' ? 'show active' : '' }}" id="lang-{{ $lang->code }}" role="tabpanel">

                <div class="card card-body shadow-sm mb-5 mt-5 border-0" style="background-color: #f8f9fa;">
                    <h3 class="text-center mb-4 mt-3 text-primary">Header Section ({{ strtoupper($lang->code) }})</h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Header Sub Title</label>
                            <input type="text" name="header_sub_title_{{ $lang->code }}" class="form-control"
                                value="{{ getLandingData($landing, 'header_sub_title', $lang->code) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Header Title</label>
                            <input type="text" name="header_title_{{ $lang->code }}" class="form-control"
                                value="{{ getLandingData($landing, 'header_title', $lang->code) }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Header Short Description</label>
                            <textarea name="header_short_description_{{ $lang->code }}" class="form-control" rows="2">{{ getLandingData($landing, 'header_short_description', $lang->code) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card card-body shadow-sm mb-5 border-0">
                    <h3 class="text-center mb-4 text-success">Language Section</h3>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Language Header</label>
                        <input type="text" name="lang_header_{{ $lang->code }}" class="form-control"
                            value="{{ getLandingData($landing, 'lang_header', $lang->code) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Language Description</label>
                        <textarea name="lang_description_{{ $lang->code }}" class="form-control" rows="2">{{ getLandingData($landing, 'lang_description', $lang->code) }}</textarea>
                    </div>
                </div>

                <div class="card card-body shadow-sm mb-5 border-0" style="background-color: #fff">
                    <h3 class="text-center mb-4 text-info">About Top Section</h3>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">About Header</label>
                            <input type="text" name="about_header_{{ $lang->code }}" class="form-control" value="{{ getLandingData($landing, 'about_header', $lang->code) }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">About Short Description</label>
                            <textarea name="about_short_description_{{ $lang->code }}" class="form-control" rows="2">{{ getLandingData($landing, 'about_short_description', $lang->code) }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Full About Description (Summernote)</label>
                            <textarea name="about_description_{{ $lang->code }}" class="form-control summernote">{{ getLandingData($landing, 'about_description', $lang->code) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card card-body shadow-sm mb-5 border-0" style="background-color: #e9ecef">
                    <h3 class="text-center mb-4">About Cards (Translations)</h3>
                    <div class="row">
                        @for($i = 1; $i <= 9; $i++)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-center text-secondary border-bottom pb-2">Card {{ $i }}</h5>

                                    <div class="mb-3 mt-3">
                                        <label class="form-label small fw-bold text-uppercase">Header</label>
                                        <input type="text" name="about_card_header_{{ $i }}_{{ $lang->code }}" class="form-control" value="{{ getLandingData($landing, 'about_card_header_'.$i, $lang->code) }}">
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label small fw-bold text-uppercase">Description</label>
                                        <textarea name="about_card_description_{{ $i }}_{{ $lang->code }}" class="form-control" rows="3">{{ getLandingData($landing, 'about_card_description_'.$i, $lang->code) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <div class="card card-body shadow-sm mb-5 border-0">
                    <h3 class="text-center mb-4 text-warning">About Bottom & Footer</h3>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">About Header 2</label>
                            <input type="text" name="about_header_2_{{ $lang->code }}" class="form-control" value="{{ getLandingData($landing, 'about_header_2', $lang->code) }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">About Short Description 2</label>
                            <textarea name="about_short_description_2_{{ $lang->code }}" class="form-control" rows="2">{{ getLandingData($landing, 'about_short_description_2', $lang->code) }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Footer Text</label>
                            <input type="text" name="footer_text_{{ $lang->code }}" class="form-control" value="{{ getLandingData($landing, 'footer_text', $lang->code) }}">
                        </div>
                    </div>
                </div>

                <div class="card card-body shadow-sm mb-5 border-0 bg-light">
                    <h3 class="text-center mb-4">SEO Information ({{ strtoupper($lang->code) }})</h3>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Meta Title</label>
                            <input type="text" name="meta_title_{{ $lang->code }}" class="form-control" value="{{ getLandingData($landing, 'meta_title', $lang->code) }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Meta Tags (Enter for tag)</label>
                            <input type="text" name="meta_tags_{{ $lang->code }}" class="form-control tags-input" value="{{ getLandingData($landing, 'meta_tags', $lang->code) }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Meta Description</label>
                            <textarea name="meta_description_{{ $lang->code }}" class="form-control" rows="3">{{ getLandingData($landing, 'meta_description', $lang->code) }}</textarea>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        <div class="card card-body shadow mb-5 border-0 bg-dark text-white">
            <h3 class="text-center mb-5 text-warning">Card Icons</h3>

            {{-- <div class="row mb-5 justify-content-center">
                <div class="col-md-3 text-center">
                    <label class="form-label fw-bold">Theme Color</label>
                    <input type="color" name="theme_color" class="form-control form-control-color w-100"
                           value="{{ $landing->where('key', 'theme_color')->first()?->value ?? '#ffffff' }}">
                </div>
            </div> --}}

            <div class="row">
                @for($i = 1; $i <= 9; $i++)
                <div class="col-md-4 mb-4">
                    <div class="card card-body bg-info border-0 h-100">
                        <label class="form-label fw-bold text-white">Card {{ $i }} Icon/Image</label>
                        <div class="text-center mb-2">
                            @php
                                $iconUrl = $landing->where('key', 'about_card_icon_'.$i)->first()?->value;
                            @endphp
                            <img src="{{ $iconUrl ? $iconUrl : asset('placeholder.png') }}" class="img-thumbnail mb-2" style="height: 80px;">
                        </div>
                        <input type="file" name="about_card_icon_{{ $i }}" class="form-control form-control-sm">
                        <small class="text-light mt-1">Recommended: Square SVG or PNG</small>
                    </div>
                </div>
                @endfor
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-xl px-5 py-3 fw-bold">
                    <i class="bi bi-save me-2"></i> SAVE ALL CHANGES
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
{{-- CSS --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">

<style>
    .bootstrap-tagsinput { width: 100% !important; padding: 0.5rem; border-radius: 0.375rem; }
    .bootstrap-tagsinput .tag { margin-right: 5px; color: white; background-color: #0d6efd; padding: 2px 8px; border-radius: 3px; }
    .nav-pills .nav-link.active { background-color: #35d7ff; box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3); }
    .btn-xl { font-size: 1.25rem; border-radius: 50px; }
</style>

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({ height: 200 });
        $('.tags-input').tagsinput({ confirmKeys: [13, 44] });
    });
</script>
@endsection
