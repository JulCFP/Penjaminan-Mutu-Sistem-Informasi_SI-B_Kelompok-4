<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PenjualController extends Controller
{
    // ==========================================
    // BAGIAN DASHBOARD PENJUAL (LOGIKA BARU)
    // ==========================================
    public function dashboard()
    {
        $idPenjual = Auth::guard('penjual')->id();

        // 1. Hitung Total Produk
        $totalProduk = Produk::where('id_penjual', $idPenjual)->count();

        // 2. Hitung Pesanan Baru (Yang statusnya perlu diproses)
        // Kita cari pesanan yang punya produk dari penjual ini
        $pesananBaru = Pesanan::whereHas('detailPesanan.produk', function($q) use ($idPenjual) {
            $q->where('id_penjual', $idPenjual);
        })->whereIn('status_pesanan', ['Sudah Dibayar (Menunggu Verifikasi)', 'Diproses Penjual'])->count();

        // 3. Hitung Total Penjualan (Omset)
        // Jumlahkan subtotal dari detail_pesanan milik penjual ini
        $totalPenjualan = DetailPesanan::whereHas('produk', function($q) use ($idPenjual) {
            $q->where('id_penjual', $idPenjual);
        })->whereHas('pesanan', function($q) {
            // Hanya hitung yang tidak dibatalkan / belum bayar
            $q->whereNotIn('status_pesanan', ['Menunggu Pembayaran', 'Dibatalkan']);
        })->sum('subtotal');

        return view('dashboard.penjual', compact('totalProduk', 'pesananBaru', 'totalPenjualan'));
    }

    // ==========================================
    // BAGIAN ADMIN (CRUD PENJUAL)
    // ==========================================
    public function index()
    {
        $penjual = Penjual::all();
        return view('admin.penjual.index', compact('penjual'));
    }

    public function create()
    {
        return view('admin.penjual.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_penjual' => 'required|string|max:100',
            'email' => 'required|email|unique:penjual,email',
            'password' => 'required|min:6',
            'no_telepon' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($request->password);

        Penjual::create($validated);

        return redirect()->route('penjual.index')->with('success', 'Akun Penjual berhasil dibuat.');
    }

    public function show($id)
    {
        // Admin melihat detail penjual
        $penjual = Penjual::with('produk')->findOrFail($id);
        return view('admin.penjual.show', compact('penjual'));
    }

    public function edit($id)
    {
        $penjual = Penjual::findOrFail($id);
        return view('admin.penjual.edit', compact('penjual'));
    }

    public function update(Request $request, $id)
    {
        $penjual = Penjual::findOrFail($id);
        
        $validated = $request->validate([
            'nama_penjual' => 'required|string|max:100',
            'email' => 'required|email|unique:penjual,email,'.$id.',id_penjual',
            'no_telepon' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        if($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $penjual->update($validated);
        return redirect()->route('penjual.index')->with('success', 'Data Penjual diperbarui.');
    }

    public function destroy($id)
    {
        Penjual::findOrFail($id)->delete();
        return redirect()->route('penjual.index')->with('success', 'Penjual berhasil dihapus.');
    }
}