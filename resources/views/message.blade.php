@foreach ($chats as $chat)
    @if ($chat->first_user_id == Auth::user()->id)
        <div class="d-flex flex-column align-items-end">
            <div class="msg-container d-flex flex-column align-items-end">
                <div class="msg-box-first shadow-sm">
                    <span>{{ nl2br("$chat->message") }}</span>
                    @if ($chat->avatar_id != null)
                        <img src="{{ asset('storage/' . $chat->avatar->image) }}" class="img-fluid msg-avatar-img">
                    @endif
                </div>
                <span class="msg-time">{{ \Carbon\Carbon::parse($chat->created_at)->format('H:i') }}</span>
            </div>
        </div>
    @else
        <div class="d-flex flex-column align-items-start">
            <div class='d-flex justify-content-start mb-2'>
                <div class="msg-photo me-1">
                    <img src="{{ asset('storage/' . $user->photo) }}" class="rounded-circle">
                </div>
                <span class="text-muted">{{ $user->name }}</span>
            </div>
            <div class="msg-container d-flex flex-column align-items-start ms-3">
                <div class="msg-box-second shadow-sm">
                    <span>{{ $chat->message }}</span>
                    @if ($chat->avatar_id != null)
                        <img src="{{ asset('storage/' . $chat->avatar->image) }}" class="img-fluid msg-avatar-img">
                    @endif
                </div>
                <span class="msg-time">{{ \Carbon\Carbon::parse($chat->created_at)->format('H:i') }}</span>
            </div>
        </div>
    @endif
@endforeach
