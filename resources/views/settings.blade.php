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
        <h4 class="page-title">@lang('index.settings')</h4>
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="col-md-3">
                    @if ($user->is_visible == 1)
                        {{-- PROFILE VISIBLE --}}
                        <h6 class="text-muted text-center">@lang('index.you_are_visible')</h6>

                        <div class="card shadow-sm mb-3">
                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('storage/photos/person.jpg') }}"
                                class="card-img-top" alt="Profile Picture">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <h6 class="text-muted">{{ $user->age }} @lang('index.y/o')</h6>
                                </div>

                                <div class="mb-3">
                                    @if ($user->gender == 'male')
                                        <span class="badge bg-primary">{{ Str::ucfirst($user->gender) }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ Str::ucfirst($user->gender) }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    @foreach ($user_hobbies as $user_hobby)
                                        <span class="badge rounded-pill bg-secondary text-light">#
                                            {{ $user_hobby->hobby->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <form action="{{ route('settings_update') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-warning">
                                    50 <i class="nav-icon bi bi-coin fs-5"></i> @lang('index.hide_my_profile')
                                </button>
                            </form>
                        </div>
                    @else
                        {{-- PROFILE NOT VISIBLE --}}
                        <h6 class="text-danger text-center">@lang('index.you_are_not_visible')</h6>

                        <div class="card shadow-sm mb-3">
                            <img src="{{ asset('storage/' . $user->photo_hidden) }}" class="card-img-top"
                                alt="Profile Picture">
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>

                                <div class="mb-3">
                                    @if ($user->gender == 'male')
                                        <span class="badge bg-primary">{{ Str::ucfirst($user->gender) }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ Str::ucfirst($user->gender) }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    @foreach ($user_hobbies as $user_hobby)
                                        <span class="badge rounded-pill bg-secondary text-light">#
                                            {{ $user_hobby->hobby->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <form action="{{ route('settings_update') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-warning">
                                    5 <i class="nav-icon bi bi-coin fs-5"></i> @lang('index.unhide_my_profile')
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
