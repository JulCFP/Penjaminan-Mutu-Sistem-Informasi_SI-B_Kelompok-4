<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthKonsumenController extends Controller
{
    public function showLogin()
    {
        return view('auth.konsumen-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('konsumen')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/konsumen/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('konsumen')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/konsumen/login');
    }
}
