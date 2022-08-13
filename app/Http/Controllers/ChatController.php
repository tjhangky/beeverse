<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\UserAvatar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    private function setLang() {
        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        } else {
            app()->setLocale('en');
        }
    }

    public function chat($id) {
        $this->setLang();
        $chats = Chat::where('first_user_id', Auth::user()->id)
                        ->where('second_user_id', $id)
                        ->orWhere('second_user_id', Auth::user()->id)
                        ->where('first_user_id', $id)->get();

        $chatx = Chat::where('second_user_id', Auth::user()->id)
                        ->where('first_user_id', $id)->get();

        $last_seen = null;
        if(!$chatx->isEmpty()) {
            $last_chat = $chatx->last()->created_at;
            $now = Carbon::now();
            $last_seen = Carbon::parse($last_chat)->diffForHumans($now, true). ' ago';
        }

        // avatars
        $user_avatars = UserAvatar::where('user_id', Auth::user()->id)->get();

        $data = [
            'title' => 'Chat',
            'active' => 'chat',
            'user' => User::find($id),
            'last_seen' => $last_seen,
            'chats' => $chats,
            'user_avatars' => $user_avatars,
        ];
        return view('chat', $data);  
    }

    public function message($id) {
        $this->setLang();
        $chats = Chat::where('first_user_id', Auth::user()->id)
                    ->where('second_user_id', $id)
                    ->orWhere('second_user_id', Auth::user()->id)
                    ->where('first_user_id', $id)->get();
        
        $chatx = Chat::where('second_user_id', Auth::user()->id)
        ->where('first_user_id', $id)->get();

        $last_seen = null;
        if(!$chatx->isEmpty()) {
            $last_chat = $chatx->last()->created_at;
            $now = Carbon::now();
            $last_seen = Carbon::parse($last_chat)->diffForHumans($now, true). ' ago';
        }

        $data = [
            'title' => 'Chat',
            'active' => 'chat',
            'user' => User::find($id),
            'last_seen' => $last_seen,
            'chats' => $chats,
        ];

        return view('message', $data)->render();
    }

    public function store($id) {
        if(!request('chat_msg') && !request('sticker')) {
            return redirect()->back();
        } 

        $chat = new Chat();
        $chat->first_user_id = auth()->user()->id;
        $chat->second_user_id = $id;
        $chat->message = request('chat_msg');

        if(request('sticker')) {
            $chat->avatar_id = request('sticker');
        }

        $chat->save();
        return redirect()->back();
    }
}
