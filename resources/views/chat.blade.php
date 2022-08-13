@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="col-md-7 col-sm-12">
                    <div class="card shadow-sm chat-box mb-2">
                        <div class="card-header">
                            <span>{{ $user->name }}</span>
                            @if ($last_seen)
                                <span class="text-muted">last seen {{ $last_seen }}</span>
                            @endif
                        </div>
                        <div class="card-body chat-container" id="chat-container">
                            @include('message')
                        </div>

                        {{-- CHAT INPUT --}}
                        <div class="card-footer">
                            <form action="{{ route('chat_store', $user->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-10 col-sm-10">
                                        <input type="text" class="form-control" name="chat_msg"
                                            placeholder="@lang('index.enter_a_message')">
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <button type="submit" class="btn btn-warning w-100"><i
                                                class="bi bi-send"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- avatars --}}
                    <div class="card chat-avatar-container shadow-sm my-3">
                        <div class="card-body d-flex">
                            @if ($user_avatars->count() > 0)
                                @foreach ($user_avatars as $user_avatar)
                                    <form action="{{ route('chat_store', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="chat-avatar-btn" name="sticker"
                                            value="{{ $user_avatar->avatar_id }}"> <img
                                                src="{{ asset('storage/' . $user_avatar->avatar->image) }}" alt="avatar"
                                                class="img-fluid chat-avatar-img shadow">
                                        </button>
                                    </form>
                                @endforeach
                            @else
                                <span class="text-muted">@lang('index.you_dont_have_any_avatar')</span>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                setInterval(function() {
                    var page = window.location.href;
                    $.ajax({
                        url: page + '/message',
                        success: function(data) {
                            $('#chat-container').html(data);
                            $('#chat-container').scrollTop($('#chat-container')[0].scrollHeight);
                        }
                    });
                }, 1000);
            });
        </script>
    @endsection
