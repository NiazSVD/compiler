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
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>

        <h2 class="h4 mb-0">Edit Page</h2>
        <small class="text-muted">Update Dynamic Page</small>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow">
            <div class="card-header">
                <h5 class="card-title mb-0">Page Information</h5>
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ route('admin.dynamic_page.update', $page->id) }}">
                    @csrf

                    <div class="row">
                        {{-- Page Title --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Page Title</label>
                            <input type="text"
                                   name="page_title"
                                   class="form-control"
                                   value="{{ old('page_title', $page->page_title) }}"
                                   required>
                            @error('page_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text"
                                   name="page_slug"
                                   class="form-control"
                                   value="{{ old('page_slug', $page->page_slug) }}">
                        </div>

                        {{-- Order --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Order</label>
                            <input type="number"
                                   name="order"
                                   class="form-control"
                                   value="{{ old('order', $page->order) }}">
                        </div>
                    </div>

                    {{-- Page Content --}}
                    <div class="mb-3">
                        <label class="form-label">Page Content</label>
                        <textarea name="page_content"
                                  id="description"
                                  class="form-control"
                                  rows="5">{{ old('page_content', $page->page_content) }}</textarea>
                        @error('page_content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- ================= STATUS ================= --}}
                    <input type="hidden" name="status" value="inactive">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input"
                               type="checkbox"
                               name="status"
                               id="statusSwitch"
                               value="active"
                               {{ old('status', $page->status) === 'active' ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>

                    {{-- ================= SET HOME ================= --}}
                    <input type="hidden" name="set_home" value="0">
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input"
                               type="checkbox"
                               name="set_home"
                               id="setHomeSwitch"
                               value="1"
                               {{ old('set_home', $page->is_home ?? 0) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label">Set as Home Page</label>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i> Update
                        </button>

                        <a href="{{ route('admin.dynamic_page.index') }}"
                           class="btn btn-outline-secondary">
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

<script>
    $(document).ready(function () {
        $('#description').summernote({
            height: 200
        });
    });
</script>
@endsection
