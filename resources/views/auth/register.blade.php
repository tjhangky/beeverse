@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="d-flex flex-column align-items-center mt-3">
        <div class="col-md-5">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h4 class="text-center">@lang('index.register')</h4>
                    <form action="{{ route('process') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="name" value="{{ old('name') }}">
                            <label for="name">@lang('index.name') <i class="bi bi-person"></i></label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('age') is-invalid @enderror" id="age"
                                name="age" placeholder="age" value="{{ old('age') }}">
                            <label for="age">@lang('index.age')</label>
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="gender" class="form-label">@lang('index.gender')</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_male"
                                        value="male" checked>
                                    <label class="form-check-label" for="gender_male"><i class="bi bi-gender-male"></i>
                                        @lang('index.male')</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_female"
                                        value="female">
                                    <label class="form-check-label" for="gender_female"><i class="bi bi-gender-female"></i>
                                        @lang('index.female')</label>
                                </div>
                            </div>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- HOBBY --}}
                        <div class="card">
                            <div class="card-body">
                                <label for="hobby" class="form-label">@lang('index.hobbies') <span
                                        class="text-muted">(@lang('index.choose_min_3'))</span>
                                </label><br>
                                @foreach ($hobbies as $hobby)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="hobby[]" id="hobby"
                                            value="{{ $hobby->id }}">
                                        <label class="form-check-label" for="hobby">{{ $hobby->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" class="form-control @error('hobby') is-invalid @enderror">
                            @error('hobby')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('instagram_username') is-invalid @enderror"
                                id="instagram_username" name="instagram_username" placeholder="Instagram Username"
                                value="{{ old('instagram_username') }}">
                            <label for="instagram_username">@lang('index.instagram_username') <i class="bi bi-instagram"></i></label>
                            @error('instagram_username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control @error('mobile_number') is-invalid @enderror"
                                id="mobile_number" name="mobile_number" placeholder="mobile_number"
                                value="{{ old('mobile_number') }}">
                            <label for="mobile_number">@lang('index.mobile_number') <i class="bi bi-phone"></i></label>
                            @error('mobile_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="email" value="{{ old('email') }}">
                            <label for="email">@lang('index.email_address') <i class="bi bi-envelope"></i></label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Password">
                            <label for="password">@lang('index.password')</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password_confirm') is-invalid @enderror"
                                id="password_confirm" name="password_confirm" placeholder="Confirm Password">
                            <label for="password_confirm">@lang('index.confirm_password')</label>
                            @error('password_confirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="hidden" name="price" value={{ $price }}>

                        <div class="mb-3 text-center">
                            <label for="mobile" class="form-label">@lang('index.registration_price')</label>
                            <p class="fw-bold">IDR {{ number_format($price, 0) }}</p>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-warning fw-bold">@lang('index.register')</button>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            @lang('index.already_have_an_account') <a href="{{ route('login') }}" class="ms-1">@lang('index.login')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
