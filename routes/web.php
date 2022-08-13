<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// lang
Route::get('/lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::controller(AuthController::class)
    ->middleware('guest')
    ->group(function() {
        Route::get('/register', 'register')->name('register');
        Route::post('/register/process', 'process')->name('process');
        Route::get('/register/payment/', 'payment')->name('payment');
        Route::post('/register/payment/confirm', 'confirm')->name('confirm');
        Route::post('/register/payment/finish', 'finish')->name('finish');
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate')->name('login_post');  
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::controller(HomeController::class)
    ->group(function() {
        Route::get('/', 'index')->name('home');
        Route::get('/male', 'male')->name('male');
        Route::get('/female', 'female')->name('female');
});

Route::controller(WishlistController::class)
    ->middleware('auth')
    ->group(function() {
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
        Route::post('/wishlist/{id}', [WishlistController::class, 'update'])->name('wishlist_update');
});

Route::controller(UserController::class)
    ->middleware('auth')
    ->group(function() {
        Route::get('/profile', [UserController::class, 'show'])->name('profile');
        Route::put('/profile', [UserController::class, 'update'])->name('profile_update');
        Route::get('/wallet', [UserController::class, 'wallet'])->name('wallet');
        Route::post('/wallet/add', [UserController::class, 'add'])->name('wallet_add');
        Route::get('/settings', [UserController::class, 'settings'])->name('settings');
        Route::post('/settings', [UserController::class, 'settings_update'])->name('settings_update');
        Route::get('/users/{user}', 'collectors')->name('collectors');
});

Route::get('/avatars', [AvatarController::class, 'index'])->name('avatar');
Route::controller(AvatarController::class)
    ->middleware('auth')
    ->group(function() {
        Route::post('/avatars/{avatar}/buy', 'buy')->name('avatar_buy');
        Route::get('/avatars/{avatar}/gift', 'gift')->name('avatar_gift');
        Route::post('/avatars/{avatar}/gift', 'send')->name('avatar_send');
        Route::get('/avatars/my', 'my')->name('avatar_my');
});

Route::controller(ChatController::class)
    ->middleware('auth')
    ->group(function() {
        Route::get('/chat/{id}', 'chat')->name('chat');
        Route::post('/chat/{id}', 'store')->name('chat_store');
        Route::get('/chat/{id}/message', 'message')->name('message');
});