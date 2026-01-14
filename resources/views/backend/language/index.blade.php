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
                    <li class="breadcrumb-item active">Languages</li>
                </ol>
            </nav>

            <h2 class="h4">Languages</h2>
            <small class="mb-0">Manage programming languages</small>
        </div>

        <div class="mt-3 mt-md-0">
            <a href="{{ route('admin.languages.create') }}" class="btn btn-primary me-2">
                <i class="bi bi-plus-circle me-1"></i> Add Language
            </a>

            <form action="{{ route('admin.languages.sync') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-secondary">
                    <i class="bi bi-arrow-repeat me-1"></i> Sync from Piston
                </button>
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">Languages</h5>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Icon</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Version</th>
                                <th>Runtime</th>
                                <th>Status</th>
                                {{-- <th>Default</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($languages as $key => $lang)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ $lang->icon_show }}" style="height: 50px; witdh: 50px"></td>
                                    <td>{{ $lang->display_name }}</td>
                                    <td>{{ $lang->slug }}</td>
                                    <td>{{ $lang->version }}</td>
                                    <td>{{ $lang->runtime }}</td>

                                    <td>
                                        <span class="badge {{ $lang->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $lang->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    {{-- <td>
                                        <span class="badge {{ $lang->is_default ? 'bg-primary' : 'bg-secondary' }}">
                                            {{ $lang->is_default ? 'Yes' : 'No' }}
                                        </span>
                                    </td> --}}

                                    <td>
                                        <a href="{{ route('admin.languages.edit', $lang) }}"
                                            class="btn btn-sm btn-secondary me-2 text-white">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form id="delete-form-{{ $lang->id }}"
                                            action="{{ route('admin.languages.destroy', $lang) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete({{ $lang->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this action!",
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
