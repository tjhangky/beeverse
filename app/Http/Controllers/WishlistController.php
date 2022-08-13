<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\UserHobby;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{   
    private function setLang() {
        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        } else {
            app()->setLocale('en');
        }
    }

    public function update($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
                            ->where('liked_user_id', $id)
                            ->first();
        if ($wishlist) {
            $wishlist->delete();
        } else {
            $wishlist = new Wishlist();
            $wishlist->user_id = Auth::id();
            $wishlist->liked_user_id = $id;
            $wishlist->save();
        }
        return redirect()->back();
    }

    public function index()
    {   
        $this->setLang();
        $cross_wishlists = Wishlist::where('liked_user_id', Auth::id())->get();
        $wishlists = Wishlist::where('user_id', Auth::id())->get();
        $user_hobbies = UserHobby::all();
        return view ('wishlist', [
            'title' => 'Wishlist',
            'active' => 'wishlist',
            'wishlists' => $wishlists,
            'user_hobbies' => $user_hobbies,
            'cross_wishlists' => $cross_wishlists,
        ]);
    }

    public function show(Wishlist $wishlist)
    {
        //
    }

}
