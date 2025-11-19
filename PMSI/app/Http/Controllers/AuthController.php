<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Penjual;
use App\Models\Konsumen;

class AuthController extends Controller
{
    // =========================
    // Tampilkan halaman LOGIN
    // =========================
    public function showLogin()
    {
        return view('auth.login');
    }

    // =========================
    // Proses LOGIN 3 ROLE
    // =========================
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;

        // ======================
        // 1) LOGIN ADMIN
        // ======================
        if (Auth::attempt(['email' => $email, 'password' => $password], $request->remember)) {
            return redirect()->route('admin.dashboard');
        }

        // ======================
        // 2) LOGIN PENJUAL
        // ======================
        $penjual = Penjual::where('email', $email)->first();
        if ($penjual && $password === $penjual->password) {
            session(['penjual_id' => $penjual->id_penjual]);
            return redirect()->route('penjual.dashboard');
        }

        // ======================
        // 3) LOGIN KONSUMEN
        // ======================
        $konsumen = Konsumen::where('email', $email)->first();
        if ($konsumen && $password === $konsumen->password) {
            session(['konsumen_id' => $konsumen->id_konsumen]);
            return redirect()->route('konsumen.dashboard');
        }

        // Jika gagal login
        return back()->withErrors([
            'login' => 'Email atau password salah!'
        ]);
    }

    // =========================
    // LOGOUT UNIVERSAL
    // =========================
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/login');
    }
}
