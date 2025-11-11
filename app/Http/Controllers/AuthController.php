<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->validated('email'),
            'password' => $request->validated('password')
        ])) {
            session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerSubmit(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        Auth::login($user);
        session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function logout()
    {
        Auth::logout();
    }
}
