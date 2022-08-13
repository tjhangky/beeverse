<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hobby;
use App\Models\Wishlist;
use App\Models\UserHobby;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private function setLang() {
        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        } else {
            app()->setLocale('en');
        }
    }

    public function index() {
        $this->setLang();

        if(!request('search')) {
            $users = User::where('id', '!=', Auth::id())
                        ->where('is_visible', 1)->get();
            $user_hobbies = UserHobby::all();
            $wishlists = Wishlist::where('user_id', Auth::id())->get();
            $cross_wishlists = Wishlist::where('liked_user_id', Auth::id())->get();

            return view('home', [
                'title' => 'Home',
                'active' => 'home',
                'users' => $users,
                'user_hobbies' => $user_hobbies,
                'wishlists' => $wishlists,
                'cross_wishlists' => $cross_wishlists,
            ]);
        } else {
            $hobbies = Hobby::query()->where('name', 'like', '%' . request('search') . '%')->get();

            $user_hobbies = new Collection();
            $users = new Collection();
            $all_users = User::all();

            foreach($hobbies as $hobby) {
                $user_hobbies_select = UserHobby::query()->where('hobby_id', $hobby->id)->get();
                if(count($user_hobbies_select) > 0) {
                    foreach($user_hobbies_select as $user_hobby_select) {
                        $user_hobbies->push($user_hobby_select);
                        foreach($all_users as $all_user) {
                            if($all_user->id == $user_hobby_select->user_id) {
                                $users->push($all_user);
                            }
                        }
                    }
                }
            }
            $users = $users->unique('id');

            
            $user_hobbies_all = UserHobby::all();
            $wishlists = Wishlist::where('user_id', Auth::id())->get();
            $cross_wishlists = Wishlist::where('liked_user_id', Auth::id())->get();

            return view('home', [
                'title' => 'Home',
                'active' => 'home',
                'users' => $users,
                'user_hobbies' => $user_hobbies_all,
                'wishlists' => $wishlists,
                'cross_wishlists' => $cross_wishlists,
            ]);
        }
        
    }

    public function male() {
        $this->setLang();

        $users = User::where('id', '!=', Auth::id())
                        ->where('gender', 'male')
                        ->where('is_visible', 1)->get();
        $user_hobbies = UserHobby::all();
        $wishlists = Wishlist::where('user_id', Auth::id())->get();
        $cross_wishlists = Wishlist::where('liked_user_id', Auth::id())->get();

        return view('male', [
            'title' => 'Home',
            'active' => 'male',
            'users' => $users,
            'user_hobbies' => $user_hobbies,
            'wishlists' => $wishlists,
            'cross_wishlists' => $cross_wishlists,
        ]);
    }

    public function female() {
        $this->setLang();

        $users = User::where('id', '!=', Auth::id())
                        ->where('gender', 'female')
                        ->where('is_visible', 1)->get();
        $user_hobbies = UserHobby::all();
        $wishlists = Wishlist::where('user_id', Auth::id())->get();
        $cross_wishlists = Wishlist::where('liked_user_id', Auth::id())->get();

        return view('female', [
            'title' => 'Home',
            'active' => 'female',
            'users' => $users,
            'user_hobbies' => $user_hobbies,
            'wishlists' => $wishlists,
            'cross_wishlists' => $cross_wishlists,
        ]);
    }



}