@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="container mt-3">
        <h4 class="page-title">@lang('index.profile')</h4>

        <div class="row d-flex justify-content-center">
            <div class="col-md-4 col-sm-12">
                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('storage/photos/person.jpg') }}"
                    class="rounded-circle shadow profile-photo-user mb-3" alt="Profile Picture">
            </div>

            <div class="col-md-4 col-sm-12">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">@lang('index.name')</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">@lang('index.gender')</th>
                            <td>
                                @if ($user->gender == 'male')
                                    @lang('index.male')
                                @else
                                    @lang('index.female')
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">@lang('index.instagram')</th>
                            <td>{{ $user->instagram_username }}</td>
                        </tr>
                        <tr>
                            <th scope="row">@lang('index.mobile')</th>
                            <td>{{ $user->mobile_number }}</td>
                        </tr>
                        <tr>
                            <th scope="row">@lang('index.hobbies')</th>
                            <td>
                                @foreach ($userHobbies as $userHobby)
                                    <span class="badge rounded-pill bg-secondary text-light">#
                                        {{ $userHobby->hobby->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-end">
                    @if ($wishlist)
                        <form action="{{ route('wishlist_update', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                            </button>
                        </form>
                        @if ($wishlistx)
                            <h6 class="text-muted">@lang('index.mutual')</h6>
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
                        @if ($wishlistx)
                            <h6 class="text-muted">{{ $user->name }} @lang('index.liked_you')
                            </h6>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="collectors mt-3">
            <h4 class="page-title mb-0">Collectors Angels</h4>
            <p class="text-muted text-center">{{ $userAvatars->count() }} @lang('index.avatars_owned')</p>
            <div class="row">
                @foreach ($userAvatars as $userAvatar)
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm mb-3">
                            <img src="{{ asset('storage/' . $userAvatar->avatar->image) }}" class="card-img-top"
                                alt="Avatar">
                            <div class="card-body">
                                <span class="text-muted">Price</span>
                                <h5 class="card-title">{{ number_format($userAvatar->avatar->price, 0) }}
                                    <i class="bi bi-coin"></i>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
