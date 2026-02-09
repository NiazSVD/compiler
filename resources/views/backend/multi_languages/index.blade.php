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
                    <li class="breadcrumb-item active">Multi Languages</li>
                </ol>
            </nav>

            <h2 class="h4">Multi Languages</h2>
            <small class="mb-0">Manage Multi languages and flags</small>
        </div>

        <div class="mt-3 mt-md-0">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createLanguageModal">
                <i class="bi bi-plus-circle me-1"></i> Add Language
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">Language List</h5>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Flag</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($langs as $key => $lang)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if ($lang->flag)
                                            <img src="{{ asset('uploads/flag/' . $lang->flag) }}" alt="flag"
                                                style="width: 35px; height: 25px; object-fit: cover; border-radius: 3px; border: 1px solid #ddd;">
                                        @else
                                            <span class="text-muted" style="font-size: 12px;">No Flag</span>
                                        @endif
                                    </td>
                                    <td>{{ $lang->name }}</td>
                                    <td><span class="badge bg-success text-dark border">{{ strtoupper($lang->code) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $lang->active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $lang->active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-secondary me-2 text-white" data-bs-toggle="modal"
                                            data-bs-target="#editLanguageModal-{{ $lang->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <form id="delete-form-{{ $lang->id }}"
                                            action="{{ route('admin.multi_languages.destroy', $lang->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete({{ $lang->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editLanguageModal-{{ $lang->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="editLanguageForm" data-id="{{ $lang->id }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Language</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Language Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $lang->name }}" required>
                                                        <span class="text-danger error-text name_error"></span>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Code</label>
                                                        <input type="text" name="code" class="form-control"
                                                            value="{{ $lang->code }}" required>
                                                        <span class="text-danger error-text code_error"></span>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Flag Image</label>
                                                        <input type="file" name="flag" class="form-control"
                                                            accept="image/*">
                                                        <div class="mt-2">
                                                            @if ($lang->flag)
                                                                <small class="d-block mb-1 text-muted">Current Flag:</small>
                                                                <img src="{{ asset('uploads/flag/' . $lang->flag) }}"
                                                                    width="50">
                                                            @endif
                                                        </div>
                                                        <span class="text-danger error-text flag_error"></span>
                                                    </div>
                                                    <div class="form-check form-switch mb-3">
                                                        <input class="form-check-input" type="checkbox" name="active"
                                                            value="1" {{ $lang->active ? 'checked' : '' }}>
                                                        <label class="form-check-label">Active</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Edit Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createLanguageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createLanguageForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Language</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Language Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. English"
                                required>
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Code</label>
                            <input type="text" name="code" class="form-control" placeholder="e.g. en" required>
                            <span class="text-danger error-text code_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Flag Image</label>
                            <input type="file" name="flag" class="form-control" accept="image/*">
                            <span class="text-danger error-text flag_error"></span>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input type="checkbox" name="active" class="form-check-input" value="1" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Create Modal -->
@endsection

@section('script')
    <script>
        // Create Language AJAX
        $('#createLanguageForm').on('submit', function(e) {
            e.preventDefault();
            $('.error-text').text(''); // Clear errors

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('admin.multi_languages.store') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.errors, function(prefix, val) {
                            $('#createLanguageForm .' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#createLanguageModal').modal('hide');
                        location.reload();
                    }
                },
                error: function() {
                    alert('Something went wrong. Please try again.');
                }
            });
        });

        // Update Language AJAX
        $('.editLanguageForm').on('submit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $('.error-text').text(''); // Clear errors

            let formData = new FormData(this);
            // আপনার রাউট অনুযায়ী ইউআরএল (multi-languages/{id}/update)
            let updateUrl = "{{ url('admin/multi-languages') }}/" + id + "/update";

            $.ajax({
                url: updateUrl,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.errors, function(prefix, val) {
                            $('#editLanguageModal-' + id + ' .' + prefix + '_error').text(val[
                                0]);
                        });
                        if (data.message) {
                            alert(data.message);
                        }
                    } else {
                        $('#editLanguageModal-' + id).modal('hide');
                        location.reload();
                    }
                },
                error: function() {
                    alert('Update failed. Please try again.');
                }
            });
        });

        // Delete Confirmation
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "This will delete the language and all its translations!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, delete it"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
