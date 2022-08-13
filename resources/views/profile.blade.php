@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="container mt-3">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h4 class="page-title">@lang('index.profile')</h4>
        @if ($user->is_visible == 0)
            <h6 class="text-muted text-center mb-3">@lang('index.you_are_not_visible')</h6>
        @endif

        <form action="{{ route('profile_update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row d-flex justify-content-center">
                <div class="col-md-4 col-sm-12">
                    @if ($user->is_visible == 1)
                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('storage/photos/person.jpg') }}"
                            class="rounded-circle shadow profile-photo mb-3" alt="Profile Picture">
                        <div class="form-group mb-3">
                            <label for="file" class="form-label">@lang('index.upload_photo')</label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <img src="{{ asset('storage/' . $user->photo_hidden) }}"
                            class="rounded-circle shadow profile-photo mb-3" alt="Profile Picture">
                    @endif
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="name" value="{{ old('name', $user->name) }}">
                        <label for="name">@lang('index.name')</label>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('age') is-invalid @enderror" name="age"
                            placeholder="age" value="{{ old('age', $user->age) }}">
                        <label for="age">@lang('index.age')</label>
                        @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('instagram_username') is-invalid @enderror"
                            id="instagram_username" name="instagram_username" placeholder="Instagram Username"
                            value="{{ old('instagram_username', $user->instagram_username) }}">
                        <label for="instagram_username">@lang('index.instagram_username')</label>
                        @error('instagram_username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control @error('mobile_number') is-invalid @enderror"
                            id="mobile_number" name="mobile_number" placeholder="mobile_number"
                            value="{{ old('mobile_number', $user->mobile_number) }}">
                        <label for="mobile_number">@lang('index.mobile_number')</label>
                        @error('mobile_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">@lang('index.gender')</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male"
                                {{ $user->gender == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_male">@lang('index.male')</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female"
                                {{ $user->gender == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_female">@lang('index.female')</label>
                        </div>
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="email" value="{{ old('email', $user->email) }}">
                        <label for="email">@lang('index.email_address')</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column align-items-center">
                <button type="submit" class="btn btn-warning">@lang('index.save_profile')</button>
            </div>
        </form>
    </div>
@endsection
