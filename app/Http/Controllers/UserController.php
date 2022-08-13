<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Avatar;
use App\Models\Wishlist;
use App\Models\UserHobby;
use App\Models\UserAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   
    private function setLang() {
        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        } else {
            app()->setLocale('en');
        }
    }

    public function collectors(User $user) {
        $this->setLang();
        if($user->is_visible == 0) {
            abort(404, 'Not Found');
        }

        $userAvatars = UserAvatar::where('user_id', $user->id)->get();
        $userHobbies = UserHobby::where('user_id', $user->id)->get();

        $wishlist = Wishlist::where('user_id', Auth::user()->id)
                            ->where('liked_user_id', $user->id)->first();

        $wishlistx = Wishlist::where('user_id', $user->id)
                            ->where('liked_user_id', Auth::user()->id)->first();

        return view ('collectors', [
            'title' => 'Collectors',
            'active' => 'collectors',
            'user' => $user,
            'userAvatars' => $userAvatars,
            'userHobbies' => $userHobbies,
            'wishlist' => $wishlist,
            'wishlistx' => $wishlistx,
        ]);
    }

    public function show() {
        $this->setLang();
        return view('profile', [
            'title' => 'Profile',
            'active' => 'profile',
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request) {
        $this->setLang();
        $request->validate([
            'name' => 'required',
            'instagram_username' => 'required|unique:users,instagram_username,' . Auth::user()->id,
            'age' => 'required|numeric|min:10',
            'mobile_number' => 'required|digits:12',
            'gender' => 'required',
            'email' => 'required|email:dns|unique:users,email,' . Auth::user()->id,
            'file' => 'image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->age = $request->age;
        $user->instagram_username = $request->instagram_username;
        $user->mobile_number = $request->mobile_number;
        $user->gender = $request->gender;
        $user->email = $request->email;

        if($request->file('file')) {
            $user->photo = $request->file('file')->store('photos');
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }

    public function wallet() {
        $this->setLang();
        return view('wallet', [
            'title' => 'Wallet',
            'active' => 'wallet',
            'user' => Auth::user(),
        ]);
    }

    public function add() {
        $user = User::where('id', Auth::user()->id)->first();
        $user->balance += 100;
        $user->save();

        return redirect()->back()->with('success', 'Top up successful');
    }

    public function settings() {
        $this->setLang();
        return view('settings', [
            'title' => 'Settings',
            'active' => 'settings',
            'user' => Auth::user(),
            'user_hobbies' => UserHobby::where('user_id', Auth::user()->id)->get(),
        ]);
    }

    public function settings_update() {
        $user = User::where('id', Auth::user()->id)->first();

        if($user->is_visible == 1) {
            if($user->balance < 50) {
                return redirect()->back()->with('error', 'You need at least 50 coins to hide your profile');
            } else {
                $user->is_visible = 0;
                $user->balance -= 50;

                $bear = array('bear_1.jpg', 'bear_2.jpg', 'bear_3.jpg');
                $user->photo_hidden = 'photos/' . $bear[rand(0, 2)];
                $user->save();
            }
        } else {
            if($user->balance < 5) {
                return redirect()->back()->with('error', 'You need at least 5 coins to bring back your profile');
            } else {
                $user->is_visible = 1;
                $user->balance -= 5;
                $user->photo_hidden = null;
                $user->save();
            }
        }
        return redirect()->back()->with('success', 'Profile visibility updated successfully');
    }
}
