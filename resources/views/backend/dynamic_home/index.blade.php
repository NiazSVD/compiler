@extends('backend.master')

@section('content')
    <div class="container">
        <div class="card card-body shadow-sm">
            <h4 class="mb-4">Dynamic Home Page Settings</h4>

            <form action="{{ route('admin.dynamic_home.update') }}" method="POST">
                @csrf

                {{-- Home Type --}}
                <div class="mb-3">
                    <label class="form-label">Home Type</label>
                    <select name="type" id="homeType" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="">-- Select Type --</option>
                        <option value="page" {{ old('type', optional($home)->type) == 'page' ? 'selected' : '' }}>
                            Page
                        </option>
                        <option value="language" {{ old('type', optional($home)->type) == 'language' ? 'selected' : '' }}>
                            Language
                        </option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Page Dropdown --}}
                <div class="mb-3 d-none" id="pageBox">
                    <label class="form-label">Select Page</label>

                    <select name="slug" id="pageSelect" class="form-select @error('slug') is-invalid @enderror" disabled>
                        <option value="">-- Select Page --</option>

                        {{-- Static Landing Page --}}
                        <option value="landing" {{ old('slug', optional($home)->slug) == 'landing' ? 'selected' : '' }}>
                            Landing Page (Default)
                        </option>

                        {{-- Dynamic Pages --}}
                        @foreach ($pages as $page)
                            <option value="{{ $page->page_slug }}"
                                {{ old('slug', optional($home)->slug) == $page->page_slug ? 'selected' : '' }}>
                                {{ $page->page_title }}
                            </option>
                        @endforeach
                    </select>

                    @error('slug')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Language Dropdown --}}
                <div class="mb-3 d-none" id="languageBox">
                    <label class="form-label">Select Language</label>

                    <select name="slug" id="languageSelect" class="form-select @error('slug') is-invalid @enderror"
                        disabled>
                        <option value="">-- Select Language --</option>
                        @foreach ($languages as $lang)
                            <option value="{{ $lang->slug }}"
                                {{ old('slug', optional($home)->slug) == $lang->slug ? 'selected' : '' }}>
                                {{ $lang->display_name }}
                            </option>
                        @endforeach
                    </select>

                    @error('slug')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary">Save Home Page</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const homeType = document.getElementById('homeType');
        const pageBox = document.getElementById('pageBox');
        const languageBox = document.getElementById('languageBox');
        const pageSelect = document.getElementById('pageSelect');
        const languageSelect = document.getElementById('languageSelect');

        function toggleHomeFields() {
            // hide all
            pageBox.classList.add('d-none');
            languageBox.classList.add('d-none');

            // disable all
            pageSelect.disabled = true;
            languageSelect.disabled = true;

            if (homeType.value === 'page') {
                pageBox.classList.remove('d-none');
                pageSelect.disabled = false;
            }

            if (homeType.value === 'language') {
                languageBox.classList.remove('d-none');
                languageSelect.disabled = false;
            }
        }

        homeType.addEventListener('change', toggleHomeFields);
        document.addEventListener('DOMContentLoaded', toggleHomeFields);
    </script>
@endsection
