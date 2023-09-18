<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:80',
            'password' => 'required|min:4|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')->withSuccess('You have made an account and logged into dashboard');

    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request) 
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard')->withSuccess('You logged in!');
        }

        return back()->withErrors([
            'email' => 'your provided credentials are wrong',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        if(Auth::check()) 
        {
            return view('auth.dashboard');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Please login the dashboard to gain access',
        ])->onlyInput('email');
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess('you logged out succesfully');
    }
}

