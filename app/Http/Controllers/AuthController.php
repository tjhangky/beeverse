<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hobby;
use App\Models\UserHobby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    private function setLang() {
        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        } else {
            app()->setLocale('en');
        }
    }

    public function register()
    {
        $this->setLang();

        $hobbies = Hobby::all();
        return view('auth.register', [
            'hobbies' => $hobbies,
            'price' => rand(100000, 125000),
            'title' => 'Register', 
            'active' => 'register',
        ]);
    }

    public function process(Request $request)
    {   
        $this->setLang();

        $data = $request->validate([
            'name' => 'required',
            'age' => 'required|numeric|min:10',
            'instagram_username' => 'required|unique:users',
            'mobile_number' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'hobby' => 'required|min:3',
        ]);

        $data['price'] = $request->price;

        $request->session()->put('data', $data);

        return redirect()->route('payment')->with([
            'price' => $request->price,
            'title' => 'Payment',
            'active' => 'payment',
        ]);
    }

    public function payment(Request $request)
    {
        $this->setLang();

        $data = $request->session()->get('data');

        return view('auth.payment', [
            'price' => $data['price'],
            'title' => 'Payment', 
            'active' => 'payment',
        ]);
    }

    public function confirm(Request $request)
    {
        $this->setLang();

        $request->validate([
            'amount' => 'required',
        ]);

        $data = $request->session()->get('data');
        $data['amount'] = $request->amount;
        $request->session()->put('data', $data);
        
        if($request->amount < $data['price']) {
            $difference = $data['price'] - $request->amount;
            return redirect()->back()->with('error', 'You are still underpaid IDR ' . number_format($difference, 0));
        } else {
            $difference = $request->amount - $data['price'];
            return redirect()->back()->with('success', 'Sorry you overpaid IDR ' . number_format($difference, 0) . ', would you like to enter a
            balance? ');
        }
    }

    public function finish() {
        $this->setLang();

        $data = session()->get('data');
        $user = new User();
        $user->name = $data['name'];
        $user->age = $data['age'];
        $user->gender = $data['gender'];
        $user->instagram_username = $data['instagram_username'];
        $user->mobile_number = $data['mobile_number'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->balance = ($data['amount'] - $data['price']) + 100;
        $user->save();

        foreach ($data['hobby'] as $hobby) {
            $userHobby = new UserHobby();
            $userHobby->user_id = $user->id;
            $userHobby->hobby_id = $hobby;
            $userHobby->save();
        }
    
        return redirect()->route('login')->with('success', 'You have successfully registered!');
    }

    public function login()
    {
        $this->setLang();

        return view('auth.login', ['title' => 'Login', 'active' => 'login']);
    }

    public function authenticate(Request $request)
    {
        $this->setLang();

        $validated = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if($request->remember) {
            Cookie::queue('loginCookie', $request->input('email'), 10);
        }

        if (Auth::attempt($validated, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        };

        return back()->with('error', 'These credentials do not match our records.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
