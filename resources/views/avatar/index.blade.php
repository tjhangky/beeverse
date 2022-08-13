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
        <h4 class="page-title">@lang('index.explore_avatar')</h4>
        <div class="row">
            @foreach ($avatars as $avatar)
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-sm mb-3">
                        <img src="{{ asset('storage/' . $avatar->image) }}" class="card-img-top" alt="Avatar">
                        <div class="card-body">
                            <span class="text-muted">@lang('index.price')</span>
                            <h5 class="card-title">{{ number_format($avatar->price, 0) }}
                                <i class="bi bi-coin"></i>
                            </h5>

                            <div class="d-flex justify-content-between align-items-center">
                                @if ($bought_avatars->contains('avatar_id', $avatar->id))
                                    <span class="text-muted fw-bold">@lang('index.owned')</span>
                                @else
                                    <form action="{{ route('avatar_buy', $avatar->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">@lang('index.buy')</button>
                                    </form>
                                @endif

                                <a
                                    href="{{ route('avatar_gift', $avatar->id) }}"class="btn btn-warning">@lang('index.send_gift')</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
