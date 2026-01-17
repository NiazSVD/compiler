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
                    <li class="breadcrumb-item active">Dynamic Pages</li>
                </ol>
            </nav>

            <h2 class="h4">Pages</h2>
            <small class="mb-0">Manage Dynamic Pages</small>
        </div>

        <div class="mt-3 mt-md-0">
            <a href="{{ route('admin.dynamic_page.create') }}" class="btn btn-primary me-2">
                <i class="bi bi-plus-circle me-1"></i> Add New Page
            </a>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pages</h5>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Page Order</th>
                                <th>Page Title</th>
                                <th>Slug</th>
                                <th>Page Content</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pages as $key => $page)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $page->order }}</td>
                                    <td>{{ $page->page_title }}</td>
                                    <td>{{ $page->page_slug }}</td>
                                    <td>{!! \Illuminate\Support\Str::limit(strip_tags($page->page_content), 20, '...') !!}</td>
                                    <td>
                                        <span class="badge {{ $page->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($page->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.dynamic_page.edit', $page) }}"
                                            class="btn btn-sm btn-secondary me-2 text-white">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form id="delete-form-{{ $page->id }}"
                                            action="{{ route('admin.dynamic_page.delete', $page) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete({{ $page->id }})">
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
