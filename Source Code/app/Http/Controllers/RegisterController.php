<?php

namespace App\Http\Controllers;

use App\Models\Konsumen;
use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // ============================================================
    // REGISTRASI KONSUMEN
    // ============================================================
    public function showKonsumenRegisterForm()
    {
        return view('auth.register_konsumen');
    }

    public function registerKonsumen(Request $request)
    {
        $validated = $request->validate([
            'nama_konsumen' => 'required|string|max:100',
            'email' => 'required|email|unique:konsumen,email',
            'password' => 'required|min:8',
        ]);

        $konsumen = Konsumen::create([
            'nama_konsumen' => $validated['nama_konsumen'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Auto login setelah daftar
        Auth::guard('konsumen')->login($konsumen);

        return redirect()->route('konsumen.dashboard');
    }

    // ============================================================
    // REGISTRASI PENJUAL (MITRA)
    // ============================================================
    public function showPenjualRegisterForm()
    {
        return view('auth.register_penjual');
    }

    public function registerPenjual(Request $request)
    {
        $validated = $request->validate([
            'nama_penjual' => 'required|string|max:100',
            'email' => 'required|email|unique:penjual,email',
            'password' => 'required|min:8',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        $penjual = Penjual::create([
            'nama_penjual' => $validated['nama_penjual'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'no_telepon' => $validated['no_telepon'],
            'alamat' => $validated['alamat'],
        ]);

        // Auto login setelah daftar
        Auth::guard('penjual')->login($penjual);

        return redirect()->route('penjual.dashboard');
    }
}