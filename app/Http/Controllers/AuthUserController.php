<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthUserController extends Controller
{
    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function handleLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
            ],
            'password' => [
                'required',
            ],
        ]);

        if (Auth::attempt(
            $request->only(['email', 'password'])
        )) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()
            ->route('user.login');
    }
}
