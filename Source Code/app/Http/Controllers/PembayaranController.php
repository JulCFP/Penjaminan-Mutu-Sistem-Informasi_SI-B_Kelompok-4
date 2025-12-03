<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Penting untuk urusan file/gambar

class PembayaranController extends Controller
{
    // =================================================================
    // 1. BAGIAN KONSUMEN (Upload Bukti)
    // =================================================================

    // Menampilkan Halaman Form Upload
    public function create($id_pesanan)
    {
        // Pastikan pesanan ini milik konsumen yang sedang login
        $pesanan = Pesanan::where('id_pesanan', $id_pesanan)
            ->where('id_konsumen', Auth::guard('konsumen')->id())
            ->firstOrFail();

        return view('pembayaran.create', compact('pesanan'));
    }

    // PROSES UTAMA: Menyimpan Bukti Transfer ke Database & Folder
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'metode_pembayaran' => 'required|string',
            'tanggal_pembayaran' => 'required|date',
            'bukti_pembayaran' => 'required|image|max:2048', // Wajib Gambar, Max 2MB
        ]);

        // Cek keamanan kepemilikan pesanan
        $pesanan = Pesanan::where('id_pesanan', $request->id_pesanan)
            ->where('id_konsumen', Auth::guard('konsumen')->id())
            ->firstOrFail();

        // 1. PROSES UPLOAD FILE GAMBAR
        if ($request->hasFile('bukti_pembayaran')) {
            // Simpan file ke folder 'public/bukti-bayar'
            // Hasilnya akan berupa path string, misal: "bukti-bayar/foto123.jpg"
            $path = $request->file('bukti_pembayaran')->store('bukti-bayar', 'public');
            $validated['bukti_pembayaran'] = $path;
        }

        // Set status default
        $validated['status_pembayaran'] = 'Menunggu Verifikasi';

        // 2. SIMPAN KE TABEL PEMBAYARAN
        Pembayaran::create($validated);

        // 3. UPDATE STATUS DI TABEL PESANAN (Agar Admin tahu ini sudah dibayar)
        $pesanan->update(['status_pesanan' => 'Sudah Dibayar (Menunggu Verifikasi)']);

        return redirect()->route('pesanan.konsumen')->with('success', 'Pembayaran berhasil dikirim! Mohon tunggu verifikasi admin.');
    }


    // =================================================================
    // 2. BAGIAN ADMIN (Verifikasi Pembayaran)
    // =================================================================
    
    // Menampilkan Daftar Pembayaran Masuk (Untuk Menu "Verifikasi Bayar")
    public function index()
    {
        // Ambil pembayaran terbaru dulu
        $pembayaran = Pembayaran::with('pesanan.konsumen')
                        ->orderBy('created_at', 'desc')
                        ->get();
                        
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    // PROSES VERIFIKASI (Admin menekan tombol "Verifikasi")
    public function verify(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        // 1. Ubah Status di Tabel Pembayaran
        $pembayaran->update([
            'status_pembayaran' => 'Lunas'
        ]);

        // 2. Ubah Status di Tabel Pesanan menjadi 'Diproses'
        // Agar Pesanan ini muncul di Dashboard Penjual
        $pembayaran->pesanan->update([
            'status_pesanan' => 'Diproses Penjual'
        ]);

        return redirect()->back()->with('success', 'Pembayaran telah diverifikasi. Pesanan diteruskan ke Penjual.');
    }
}