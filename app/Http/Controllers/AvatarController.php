<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Avatar;
use App\Models\UserAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAvatarRequest;

class AvatarController extends Controller
{
    private function setLang() {
        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        } else {
            app()->setLocale('en');
        }
    }

    public function index()
    {
        $this->setLang();

        return view ('avatar.index', [
            'title' => 'Avatars',
            'active' => 'avatar',
            'avatars' => Avatar::all(),
            'bought_avatars' => UserAvatar::where('user_id', Auth::id())->get(),
        ]);
    }

    public function my() {
        $this->setLang();

        $userAvatars = UserAvatar::where('user_id', Auth::id())->get();

        $avatars = new Collection();

        foreach($userAvatars as $userAvatar) {
            $avatar = Avatar::find($userAvatar->avatar_id);
            $avatars->push($avatar);
        }

        return view('avatar.my', [
            'title' => 'My Avatars',
            'active' => 'myavatar',
            'user_avatars' => $userAvatars,
            'avatars' => $avatars
        ]);
    }

    public function buy(Avatar $avatar)
    {
        $this->setLang();

        $user = User::find(Auth::id());

        $hasAvatar = UserAvatar::where('user_id', $user->id)
                                ->where('avatar_id', $avatar->id)->first();

        if($hasAvatar) {
            return redirect()->back()->with('error', 'You already own this avatar!');
        }

        if ($user->balance < $avatar->price) {
            return redirect()->back()->with('error', 'You do not have enough money to buy this avatar!');
        }

        $user->balance -= $avatar->price;
        $user->save();

        $userAvatar = new UserAvatar();
        $userAvatar->user_id = $user->id;
        $userAvatar->avatar_id = $avatar->id;
        $userAvatar->save();

        return redirect()->back()->with('success', 'Avatar bought!');
    }

    public function gift(Avatar $avatar)
    {   
        $this->setLang();

        $users = User::where('id', '!=', Auth::id())->get();

        return view('avatar.gift', [
            'title' => 'Avatar',
            'active' => 'avatar',
            'avatar' => $avatar,
            'users' => $users,
        ]);
    }

    public function send(Avatar $avatar, Request $request)
    {   
        $this->setLang();
        
        $user = User::find(Auth::id());

        if ($user->balance < $avatar->price) {
            return redirect()->back()->with('error', 'You do not have enough money to buy this avatar!');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $hasAvatar = UserAvatar::where('user_id', $request->user_id)
                                ->where('avatar_id', $avatar->id)->first();

        if($hasAvatar) {
            return redirect()->back()->with('error', 'This user already own this avatar!');
        }

        $user->balance -= $avatar->price;
        $user->save();

        $userAvatar = new UserAvatar();
        $userAvatar->user_id = $request->user_id;
        $userAvatar->avatar_id = $avatar->id;
        $userAvatar->save();
        
        return redirect()->back()->with('success', 'Avatar gifted!');
    }

}
