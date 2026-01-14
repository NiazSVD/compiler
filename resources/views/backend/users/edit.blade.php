@extends('backend.master')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </nav>
            <h2 class="h4">Edit User</h2>
            <small>Update user information.</small>
        </div>

        <a href="{{ route('users') }}" class="btn btn-gray-800 animate-up-2">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>

    <div class="card shadow border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <div class="col-md-6">
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="number" name="phone" value="{{ old('phone', $user->phone) }}"
                                    class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Role</label>
                                <select name="role" id="role"
                                    class="form-select @error('role') is-invalid @enderror">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ old('role', isset($user) ? $user->getRoleNames()->first() : '') == $role->name ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-12 mb-3">
                                <label class="form-label">New Password (optional)</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Leave empty to keep old password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                        </div>
                    </div>


                </div>

                <button class="btn btn-primary mt-3 animate-up-2">
                    <i class="bi bi-save me-1"></i> Update User
                </button>

            </form>
        </div>
    </div>
@endsection

