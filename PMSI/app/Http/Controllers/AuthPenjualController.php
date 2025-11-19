<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthPenjualController extends Controller
{
    public function showLogin()
    {
        return view('auth.penjual-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('penjual')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/penjual/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('penjual')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/penjual/login');
    }
}
