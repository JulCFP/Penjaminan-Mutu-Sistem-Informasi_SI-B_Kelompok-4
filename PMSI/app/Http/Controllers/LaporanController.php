<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    // Menu Utama Laporan (Pilih mau laporan apa)
    public function index()
    {
        return view('laporan.index');
    }

    // Laporan Penjualan (Omset)
    public function laporanPenjualan(Request $request)
    {
        // 1. Cek Siapa yang Login?
        if (Auth::guard('web')->check()) {
            // === ADMIN (Bisa lihat semua) ===
            // Ambil semua pesanan yang statusnya selesai/diproses
            $laporan = Pesanan::with(['konsumen', 'detailPesanan.produk'])
                ->orderBy('tanggal_pesan', 'desc')
                ->get();
                
            return view('laporan.penjualan_admin', compact('laporan'));

        } elseif (Auth::guard('penjual')->check()) {
            // === PENJUAL (Hanya lihat produknya sendiri) ===
            $idPenjual = Auth::guard('penjual')->id();

            // Query agar Penjual hanya melihat pesanan yang berisi produk dia
            $laporan = Pesanan::whereHas('detailPesanan.produk', function($q) use ($idPenjual) {
                $q->where('id_penjual', $idPenjual);
            })->with(['detailPesanan' => function($q) use ($idPenjual) {
                // Filter detail pesanan agar yang tampil cuma barang milik dia
                $q->whereHas('produk', function($sq) use ($idPenjual) {
                    $sq->where('id_penjual', $idPenjual);
                })->with('produk');
            }, 'konsumen'])->get();

            return view('laporan.penjualan_penjual', compact('laporan'));
        }

        abort(403, 'Anda tidak memiliki akses laporan ini.');
    }

    // Laporan Pembayaran (Biasanya Khusus Admin Keuangan)
    public function laporanPembayaran()
    {
        // Hanya Admin yang boleh lihat rekap pembayaran
        if (!Auth::guard('web')->check()) {
            abort(403);
        }

        $laporan = Pembayaran::with('pesanan.konsumen')
            ->orderBy('tanggal_pembayaran', 'desc')
            ->get();

        return view('laporan.pembayaran', compact('laporan'));
    }
}