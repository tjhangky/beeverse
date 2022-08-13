@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="container mt-3">
        <h4 class="page-title">@lang('index.send_avatar')</h4>

        <div class="row d-flex justify-content-center">
            <div class="col-md-4 col-sm-12">
                <img src="{{ asset('storage/' . $avatar->image) }}" class="shadow avatar-img mb-3" alt="Profile Picture">
            </div>

            <div class="col-md-5 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="text-muted">@lang('index.price')</span>
                                <h5 class="card-title">{{ number_format($avatar->price, 0) }}
                                    <i class="bi bi-coin"></i>
                                </h5>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                <span class="text-muted">@lang('index.your_coins')</span>
                                <span class="card-title text-muted">{{ number_format(Auth::user()->balance, 0) }}
                                    <i class="bi bi-coin"></i>
                                </span>
                            </div>
                        </div>

                        <form action="{{ route('avatar_send', $avatar->id) }}" method="POST">
                            @csrf
                            <div class="my-3">
                                <select class="form-select @error('user_id') is-invalid @enderror" name="user_id">
                                    <option selected disabled="disabled">@lang('index.select_user_to_send')</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-warning">@lang('index.send_gift')</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
