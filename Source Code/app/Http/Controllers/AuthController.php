<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ===============================================
    // HALAMAN LOGIN & PROSES
    // ===============================================
    public function showLogin() { return view('auth.login'); }
    public function showAdminLoginForm() { return view('auth.login-admin'); }
    public function showPenjualLoginForm() { return view('auth.login-penjual'); }
    public function showKonsumenLoginForm() { return view('auth.login-konsumen'); }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['email' => 'Login Admin Gagal.']);
    }

    public function penjualLogin(Request $request)
    {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::guard('penjual')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('penjual.dashboard');
        }
        return back()->withErrors(['email' => 'Login Penjual Gagal.']);
    }

    public function konsumenLogin(Request $request)
    {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::guard('konsumen')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('konsumen.dashboard');
        }
        return back()->withErrors(['email' => 'Login Konsumen Gagal.']);
    }

    // ===============================================
    // SETTINGS (PROFILE ADMIN) - BARU
    // ===============================================
    public function showAdminSettings()
    {
        return view('admin.settings');
    }

    public function updateAdminSettings(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Jika password diisi, ganti password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // ===============================================
    // LOGOUT
    // ===============================================
    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) Auth::guard('web')->logout();
        elseif (Auth::guard('penjual')->check()) Auth::guard('penjual')->logout();
        elseif (Auth::guard('konsumen')->check()) Auth::guard('konsumen')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}