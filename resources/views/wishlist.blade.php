@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="container mt-3">
        <h4 class="page-title">@lang('index.wishlist')</h4>
        <div class="row">
            @if ($wishlists->count() > 0)
                @foreach ($wishlists as $wishlist)
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm mb-3">
                            <a href="{{ route('collectors', $wishlist->liked_user->id) }}">
                                <img src="{{ $wishlist->liked_user->photo ? asset('storage/' . $wishlist->liked_user->photo) : asset('storage/photos/person.jpg') }}"
                                    class="card-img-top" alt="Profile Picture">
                            </a>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="card-title">{{ $wishlist->liked_user->name }}</h5>
                                    <h6 class="text-muted">{{ $wishlist->liked_user->age }} @lang('index.y/o')</h6>
                                </div>

                                <div class="mb-3">
                                    @if ($wishlist->liked_user->gender == 'male')
                                        <span
                                            class="badge bg-primary">{{ Str::ucfirst($wishlist->liked_user->gender) }}</span>
                                    @else
                                        <span
                                            class="badge bg-danger">{{ Str::ucfirst($wishlist->liked_user->gender) }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    @foreach ($user_hobbies as $user_hobby)
                                        @if ($user_hobby->user_id == $wishlist->liked_user->id)
                                            <span class="badge rounded-pill bg-secondary text-light">#
                                                {{ $user_hobby->hobby->name }}</span>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="d-flex justify-content-between align-items-end">
                                    @if ($wishlists->contains('liked_user_id', $wishlist->liked_user->id))
                                        <form action="{{ route('wishlist_update', $wishlist->liked_user->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger w-100">
                                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                            </button>
                                        </form>

                                        @if ($cross_wishlists->contains('user_id', $wishlist->liked_user->id))
                                            <h6 class="text-muted">Mutual</h6>
                                            <a href="{{ route('chat', $wishlist->liked_user->id) }}"
                                                class="btn btn-warning">
                                                <i class="bi bi-chat-dots-fill"></i>
                                                Chat
                                            </a>
                                        @else
                                            <h6 class="text-muted">@lang('index.waiting_for_response')</h6>
                                        @endif
                                    @else
                                        <form action="{{ route('wishlist_update', $wishlist->liked_user->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                <i class="bi bi-hand-thumbs-up"></i>
                                            </button>
                                        </form>
                                        @if ($cross_wishlists->contains('user_id', $wishlist->liked_user->id))
                                            <h6 class="text-muted">{{ $wishlist->liked_user->name }} @lang('index.liked_you')
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
                    <div class="col-md-6">
                        <div class="alert alert-warning text-center">
                            <strong>@lang('index.you_dont_have_any_wishlist')<a href="{{ route('home') }}"> @lang('index.explore')?</a></strong>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
