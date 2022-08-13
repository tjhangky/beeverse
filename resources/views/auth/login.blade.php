@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="d-flex flex-column align-items-center mt-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-center">@lang('index.login')</h4>
                    <form action="{{ route('login_post') }}" method="POST">
                        @csrf
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="email"
                                value="{{ Cookie::get('loginCookie') !== null ? Cookie::get('loginCookie') : old('name') }}">
                            <label for="email">@lang('index.email_address')</label>
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

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember" checked>
                            <label class="form-check-label" for="remember">
                                @lang('index.remember_me')
                            </label>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-warning">@lang('index.login')</button>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            @lang('index.dont_have_an_account') <a href="{{ route('register') }}" class="ms-1">@lang('index.register_now')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
