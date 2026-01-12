@extends('backend.master')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item"><a href="#"><i class="bi bi-house-door fs-6"></i></a></li>
                    <li class="breadcrumb-item active">{{ __('profile.edit_profile') }}</li>
                </ol>
            </nav>
            <h2 class="h4">{{ __('profile.edit_profile') }}</h2>
            <small class="text-muted">{{ __('profile.update_details') }}</small>
        </div>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-7">
                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">{{ __('profile.general_information') }}</h2>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">{{ __('profile.name') }}</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                type="text" placeholder="{{ __('profile.name') }}" value="{{ old('name', $user->name) }}"
                                required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone">{{ __('profile.phone') }}</label>
                            <input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                type="text" placeholder="{{ __('profile.phone') }}"
                                value="{{ old('phone', $user->phone) }}" required>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone">{{ __('Email') }}</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                type="text" placeholder="{{ __('Email') }}"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <h2 class="h5 my-4">{{ __('profile.password') }}</h2>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="password">{{ __('profile.password') }}</label>
                            <input class="form-control @error('password') is-invalid @enderror" id="password"
                                name="password" type="password" placeholder="{{ __('profile.password') }}">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="password_confirmation">{{ __('profile.confirm_password') }}</label>
                            <input class="form-control" id="password_confirmation" name="password_confirmation"
                                type="password" placeholder="{{ __('profile.confirm_password') }}">
                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">
                            <i class="bi bi-save me-1"></i> {{ __('profile.save_all') }}
                        </button>
                    </div>

                </div>
            </div>


            <div class="col-md-5">
                <div class="card card-body border-0 shadow mb-4 text-center">
                    <h2 class="h5 mb-4">{{ __('profile.profile_photo') }}</h2>

                    {{-- Image Preview --}}
                    <div class="mb-3">
                        <img id="profilePreview"
                            src="{{ $user->avater ?? asset('images/default-avatar.png') }}"
                            alt="Profile Image"
                            class="img-fluid rounded-circle border shadow-sm"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    {{-- File Input --}}
                    <input type="file" name="profile_image" id="profileImageInput"
                        accept="image/png, image/jpeg, image/webp"
                        class="form-control">

                    <small class="text-muted d-block mt-2">
                        Allowed: jpg, png, jpeg, webp | Max size: 2MB
                    </small>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('script')
<script>
    document.getElementById('profileImageInput').addEventListener('change', function(event){
        const file = event.target.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(e){
                document.getElementById('profilePreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
