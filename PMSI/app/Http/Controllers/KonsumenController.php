<?php

namespace App\Http\Controllers;

use App\Models\Produk;   // Model Produk (Untuk Dashboard Belanja)
use App\Models\Konsumen; // Model Konsumen (Untuk Admin Kelola User)
use Illuminate\Http\Request;

class KonsumenController extends Controller
{
    // =================================================================
    // 1. BAGIAN KONSUMEN (Dashboard Belanja)
    // =================================================================
    
    public function dashboard()
    {
        // 1. Ambil 3 Produk Terbaru untuk Banner/Hero
        $latestProducts = Produk::latest()->take(3)->get();

        // 2. Ambil 6 Produk Acak untuk bagian "Populer"
        $popularProducts = Produk::inRandomOrder()->with('penjual')->take(6)->get();

        return view('dashboard.konsumen', compact('latestProducts', 'popularProducts'));
    }


    // =================================================================
    // 2. BAGIAN ADMIN (Kelola Data Konsumen)
    // =================================================================
    
    // Menampilkan daftar semua konsumen untuk Admin
    public function index()
    {
        $konsumen = Konsumen::all();
        return view('admin.konsumen.index', compact('konsumen'));
    }

    // Menghapus akun konsumen (oleh Admin)
    public function destroy($id)
    {
        $konsumen = Konsumen::findOrFail($id);
        $konsumen->delete();

        return redirect()->route('konsumen.index')->with('success', 'Akun konsumen berhasil dihapus.');
    }
}