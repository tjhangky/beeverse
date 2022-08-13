@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h4 class="page-title">My Avatars</h4>
        <div class="row">
            @if ($avatars->count() > 0)
                @foreach ($avatars as $avatar)
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm mb-3">
                            <img src="{{ asset('storage/' . $avatar->image) }}" class="card-img-top" alt="Avatar">
                            <div class="card-body">
                                <span class="text-muted">Price</span>
                                <h5 class="card-title">{{ number_format($avatar->price, 0) }}
                                    <i class="bi bi-coin"></i>
                                </h5>

                                <div class="d-flex justify-content-between align-items-center">

                                    <a href="{{ route('avatar_gift', $avatar->id) }}"class="btn btn-warning">Send Gift</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="alert alert-warning text-center">
                            <strong>@lang('index.you_dont_have_any_avatar') <a href="{{ route('avatar') }}"> @lang('index.go_to_avatar_store')</a></strong>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
