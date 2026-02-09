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
            function getLandingData($landing, $key, $lang = 'en')
            {
                $row = $landing->where('key', $key)->first();
                if (!$row) {
                    return '';
                }
                return $lang == 'en' ? $row->value : $row->getTranslation($key, $lang);
            }
        @endphp

        <form method="POST" action="{{ route('admin.landing.update') }}" id="landingForm" enctype="multipart/form-data">
            @csrf

            <div class="card shadow-sm mb-4 border-0 sticky-top" style="top: 70px; z-index: 1000;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <span class="fw-bold text-muted text-uppercase">Select Translation Language:</span>
                    <ul class="nav nav-pills" id="langTabs" role="tablist">
                        @foreach ($multiLanguages as $lang)
                            <li class="nav-item">
                                <button
                                    class="nav-link {{ $lang->code == 'en' ? 'active' : '' }} me-2 fw-bold d-flex align-items-center shadow"
                                    id="{{ $lang->code }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#lang-{{ $lang->code }}" type="button">

                                    @if ($lang->flag)
                                        <img src="{{ asset('uploads/flag/' . $lang->flag) }}" alt="{{ $lang->name }}"
                                            class="me-2"
                                            style="width: 20px; height: 14px; object-fit: cover; border-radius: 2px;">
                                    @else
                                        <i class="bi bi-translate me-2"></i>
                                    @endif

                                    {{ $lang->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="langTabsContent">
                @foreach ($multiLanguages as $lang)
                    <div class="tab-pane fade {{ $lang->code == 'en' ? 'show active' : '' }}" id="lang-{{ $lang->code }}"
                        role="tabpanel">

                        <div class="row mb-5">
                            <div class="col-12">
                                <h3 class="text-center text-primary mb-3 border-bottom pb-2">Header Section</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-body shadow-sm border-0 bg-light">
                                    <h6 class="text-muted small fw-bold mb-3">REFERENCE (ENGLISH)</h6>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Sub Title</label>
                                        <input type="text" class="form-control"
                                            value="{{ getLandingData($landing, 'header_sub_title', 'en') }}" readonly
                                            disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Header Title</label>
                                        <input type="text" class="form-control"
                                            value="{{ getLandingData($landing, 'header_title', 'en') }}" readonly disabled>
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label small fw-bold">Short Description</label>
                                        <textarea class="form-control" rows="2" readonly disabled>{{ getLandingData($landing, 'header_short_description', 'en') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-body shadow-sm border-0 h-100" style="background-color: #f0f7ff;">
                                    <h6 class="text-primary small fw-bold mb-3">EDIT ({{ strtoupper($lang->name) }})</h6>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Sub Title</label>
                                        <input type="text" name="header_sub_title_{{ $lang->code }}"
                                            class="form-control"
                                            value="{{ getLandingData($landing, 'header_sub_title', $lang->code) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Header Title</label>
                                        <input type="text" name="header_title_{{ $lang->code }}" class="form-control"
                                            value="{{ getLandingData($landing, 'header_title', $lang->code) }}">
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label small fw-bold">Short Description</label>
                                        <textarea name="header_short_description_{{ $lang->code }}" class="form-control" rows="2">{{ getLandingData($landing, 'header_short_description', $lang->code) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-12">
                                <h3 class="text-center text-success mb-3 border-bottom pb-2">Language Section</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-body shadow-sm border-0 bg-light">
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Lang Header</label>
                                        <input type="text" class="form-control"
                                            value="{{ getLandingData($landing, 'lang_header', 'en') }}" readonly disabled>
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label small fw-bold">Lang Description</label>
                                        <textarea class="form-control" rows="2" readonly disabled>{{ getLandingData($landing, 'lang_description', 'en') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-body shadow-sm border-0 h-100" style="background-color: #f0fff4;">
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Lang Header</label>
                                        <input type="text" name="lang_header_{{ $lang->code }}" class="form-control"
                                            value="{{ getLandingData($landing, 'lang_header', $lang->code) }}">
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label small fw-bold">Lang Description</label>
                                        <textarea name="lang_description_{{ $lang->code }}" class="form-control" rows="2">{{ getLandingData($landing, 'lang_description', $lang->code) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-12">
                                <h3 class="text-center text-info mb-3 border-bottom pb-2">About Section (Main)</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-body shadow-sm border-0 bg-light">
                                    <div class="mb-3"><label class="small fw-bold">Header</label><input type="text"
                                            class="form-control"
                                            value="{{ getLandingData($landing, 'about_header', 'en') }}" readonly
                                            disabled></div>
                                    <div class="mb-3"><label class="small fw-bold">Short Desc</label>
                                        <textarea class="form-control" rows="2" readonly disabled>{{ getLandingData($landing, 'about_short_description', 'en') }}</textarea>
                                    </div>
                                    <div class="mb-0"><label class="small fw-bold">Full Desc</label>
                                        <div class="bg-white p-2 border rounded"
                                            style="max-height:150px; overflow-y:auto;">{!! getLandingData($landing, 'about_description', 'en') !!}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-body shadow-sm border-0 h-100" style="background-color: #f0fbff;">
                                    <div class="mb-3"><label class="small fw-bold">Header</label><input type="text"
                                            name="about_header_{{ $lang->code }}" class="form-control"
                                            value="{{ getLandingData($landing, 'about_header', $lang->code) }}"></div>
                                    <div class="mb-3"><label class="small fw-bold">Short Desc</label>
                                        <textarea name="about_short_description_{{ $lang->code }}" class="form-control" rows="2">{{ getLandingData($landing, 'about_short_description', $lang->code) }}</textarea>
                                    </div>
                                    <div class="mb-0"><label class="small fw-bold">Full Desc</label>
                                        <textarea name="about_description_{{ $lang->code }}" class="form-control my-editor">{{ getLandingData($landing, 'about_description', $lang->code) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h3 class="text-center mb-4 border-bottom pb-2">About Cards (1-9)</h3>
                        </div>
                        @for ($i = 1; $i <= 9; $i++)
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="card card-body border-0 bg-light">
                                        <span class="badge bg-secondary mb-2 w-25">Card {{ $i }} English</span>
                                        <input type="text" class="form-control mb-2 fw-bold"
                                            value="{{ getLandingData($landing, 'about_card_header_' . $i, 'en') }}" readonly
                                            disabled>
                                        <textarea class="form-control small" rows="2" readonly disabled>{{ getLandingData($landing, 'about_card_description_' . $i, 'en') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-body border-0 h-100" style="background-color: #fff9f0;">
                                        <span class="badge bg-warning text-dark mb-2 w-25">Card {{ $i }}
                                            {{ strtoupper($lang->code) }}</span>
                                        <input type="text"
                                            name="about_card_header_{{ $i }}_{{ $lang->code }}"
                                            class="form-control mb-2 fw-bold"
                                            value="{{ getLandingData($landing, 'about_card_header_' . $i, $lang->code) }}">
                                        <textarea name="about_card_description_{{ $i }}_{{ $lang->code }}" class="form-control small"
                                            rows="2">{{ getLandingData($landing, 'about_card_description_' . $i, $lang->code) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endfor

                        <div class="row mb-5 mt-5">
                            <div class="col-12">
                                <h3 class="text-center text-secondary mb-3 border-bottom pb-2">About Bottom Section</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-body bg-light border-0">
                                    <div class="mb-3"><label class="small fw-bold">Header 2</label><input
                                            type="text" class="form-control"
                                            value="{{ getLandingData($landing, 'about_header_2', 'en') }}" readonly
                                            disabled></div>
                                    <div class="mb-0"><label class="small fw-bold">Short Desc 2</label>
                                        <textarea class="form-control" rows="2" readonly disabled>{{ getLandingData($landing, 'about_short_description_2', 'en') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-body border-0 h-100" style="background-color: #f8f9fa;">
                                    <div class="mb-3"><label class="small fw-bold">Header 2</label><input
                                            type="text" name="about_header_2_{{ $lang->code }}"
                                            class="form-control"
                                            value="{{ getLandingData($landing, 'about_header_2', $lang->code) }}"></div>
                                    <div class="mb-0"><label class="small fw-bold">Short Desc 2</label>
                                        <textarea name="about_short_description_2_{{ $lang->code }}" class="form-control" rows="2">{{ getLandingData($landing, 'about_short_description_2', $lang->code) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-12">
                                <h3 class="text-center text-dark mb-3 border-bottom pb-2">Footer & SEO Section</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-body bg-light border-0">
                                    <div class="mb-3"><label class="small fw-bold">Footer Text</label><input
                                            type="text" class="form-control"
                                            value="{{ getLandingData($landing, 'footer_text', 'en') }}" readonly disabled>
                                    </div>
                                    <div class="mb-3"><label class="small fw-bold">Meta Title</label><input
                                            type="text" class="form-control"
                                            value="{{ getLandingData($landing, 'meta_title', 'en') }}" readonly disabled>
                                    </div>
                                    <div class="mb-3"><label class="small fw-bold">Meta Tags</label><input
                                            type="text" class="form-control"
                                            value="{{ getLandingData($landing, 'meta_tags', 'en') }}" readonly disabled>
                                    </div>
                                    <div class="mb-0"><label class="small fw-bold">Meta Desc</label>
                                        <textarea class="form-control" rows="2" readonly disabled>{{ getLandingData($landing, 'meta_description', 'en') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-body border-0 h-100" style="background-color: #fcfcfc;">
                                    <div class="mb-3"><label class="small fw-bold">Footer Text</label><input
                                            type="text" name="footer_text_{{ $lang->code }}" class="form-control"
                                            value="{{ getLandingData($landing, 'footer_text', $lang->code) }}"></div>
                                    <div class="mb-3"><label class="small fw-bold">Meta Title</label><input
                                            type="text" name="meta_title_{{ $lang->code }}" class="form-control"
                                            value="{{ getLandingData($landing, 'meta_title', $lang->code) }}"></div>
                                    <div class="mb-3">
                                        <label class="small fw-bold">Meta Tags (Press Enter)</label>
                                        <input type="text" name="meta_tags_{{ $lang->code }}"
                                            class="form-control tags-input"
                                            value="{{ getLandingData($landing, 'meta_tags', $lang->code) }}"
                                            data-role="tagsinput">

                                        {{-- <input type="text" name="meta_tags_{{ $lang->code }}" id="meta_tags" class="tag-input" value="{{ getLandingData($landing, 'meta_tags', $lang->code) }}" > --}}
                                    </div>
                                    <div class="mb-0">
                                        <label class="small fw-bold">Meta Desc</label>
                                        <textarea name="meta_description_{{ $lang->code }}" class="form-control" rows="2">{{ getLandingData($landing, 'meta_description', $lang->code) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="card card-body shadow-lg mt-5 border-0 bg-dark text-white">
                <h3 class="text-center mb-5 text-warning fw-bold border-bottom pb-3">Card Icons</h3>

                {{-- <div class="row mb-5 justify-content-center">
                <div class="col-md-4">
                    <div class="card card-body bg-light border-0 text-center">
                        <label class="form-label fw-bold text-dark">Website Theme Color</label>
                        <input type="color" name="theme_color" class="form-control form-control-color w-100 mb-2"
                               value="{{ $landing->where('key', 'theme_color')->first()?->value ?? '#ffffff' }}">
                        <small class="text-muted">This color applies to all language versions.</small>
                    </div>
                </div>
            </div> --}}

                <div class="row">
                    @for ($i = 1; $i <= 9; $i++)
                        <div class="col-md-4 mb-4">
                            <div class="card card-body bg-secondary border-0 h-100">
                                <label class="form-label fw-bold text-white small">CARD {{ $i }} ICON</label>
                                <div class="text-center mb-3">
                                    @php $iconUrl = $landing->where('key', 'about_card_icon_'.$i)->first()?->value; @endphp
                                    <img src="{{ $iconUrl ? $iconUrl : asset('placeholder.png') }}"
                                        class="img-thumbnail bg-white"
                                        style="height: 60px; width: 60px; object-fit: contain;">
                                </div>
                                <input type="file" name="about_card_icon_{{ $i }}"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-warning btn-xl px-5 py-3 fw-bold shadow">
                        <i class="bi bi-save2-fill me-2"></i> UPDATE ALL CONTENT
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">

    <style>
        .sticky-top {
            transition: all 0.3s ease;
            border-bottom: 2px solid #35fd0d;
        }

        .nav-pills .nav-link.active {
            background-color: #0dfdad;
            font-weight: bold;
        }

        .bg-light {
            background-color: #f8f9fa !important;
            border: 1px solid #dee2e6 !important;
        }

        .btn-xl {
            font-size: 1.3rem;
            border-radius: 50px;
            transition: transform 0.2s;
        }

        .btn-xl:hover {
            transform: scale(1.05);
        }

        .bootstrap-tagsinput {
            width: 100% !important;
            padding: 0.5rem;
            border-radius: 5px;
        }

        .bootstrap-tagsinput .tag {
            margin-right: 5px;
            color: white;
            background-color: #0d6efd;
            padding: 2px 8px;
            border-radius: 3px;
        }
    </style>


    
@endsection
