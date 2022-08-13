@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="container mt-3">
        <h4 class="page-title">@lang('index.explore')</h4>

        <div class="row">
            <div class="d-flex justify-content-between">
                <div class="col-md-4">
                    <div class="btn-group" role="group">
                        <a href="{{ route('home') }}"
                            class="btn btn-outline-warning {{ $active == 'home' ? 'active' : '' }}">@lang('index.all')</a>
                        <a href="{{ route('male') }}"
                            class="btn btn-outline-warning {{ $active == 'male' ? 'active' : '' }}">@lang('index.male')</a>
                        <a href="{{ route('female') }}"
                            class="btn btn-outline-warning {{ $active == 'female' ? 'active' : '' }}">@lang('index.female')</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('home') }}">
                        <div class="input-group mb-3">
                            <input class="form-control" type="search" placeholder="@lang('index.search')" name="search">
                            <button class="btn btn-warning" type="submit" id="button-addon2">@lang('index.search')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            @if ($users->count() > 0)
                @foreach ($users as $user)
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm mb-3">
                            <a href="{{ route('collectors', $user->id) }}">
                                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('storage/photos/person.jpg') }}"
                                    class="card-img-top" alt="Profile Picture">
                            </a>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <h6 class="text-muted">{{ $user->age }} @lang('index.y/o')</h6>
                                </div>

                                <div class="mb-3">
                                    @if ($user->gender == 'male')
                                        <span class="badge bg-primary">@lang('index.male')</span>
                                    @else
                                        <span class="badge bg-danger">@lang('index.female')</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    @foreach ($user_hobbies as $user_hobby)
                                        @if ($user_hobby->user_id == $user->id)
                                            <span class="badge rounded-pill bg-secondary text-light">#
                                                {{ $user_hobby->hobby->name }}</span>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="d-flex justify-content-between align-items-end">
                                    @if ($wishlists->contains('liked_user_id', $user->id))
                                        <form action="{{ route('wishlist_update', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger w-100">
                                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                            </button>
                                        </form>

                                        @if ($cross_wishlists->contains('user_id', $user->id))
                                            <h6 class="text-muted">Mutual</h6>
                                            <a href="{{ route('chat', $user->id) }}" class="btn btn-warning">
                                                <i class="bi bi-chat-dots-fill"></i>
                                                Chat
                                            </a>
                                        @else
                                            <h6 class="text-muted">@lang('index.waiting_for_response')</h6>
                                        @endif
                                    @else
                                        <form action="{{ route('wishlist_update', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                <i class="bi bi-hand-thumbs-up"></i>
                                            </button>
                                        </form>
                                        @if ($cross_wishlists->contains('user_id', $user->id))
                                            <h6 class="text-muted">{{ $user->name }} @lang('index.liked_you')
                                            </h6>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex justify-content-center">
                    <span class="text-muted">@lang('index.no_users_found')</span>
                </div>
            @endif

        </div>
    </div>
@endsection
