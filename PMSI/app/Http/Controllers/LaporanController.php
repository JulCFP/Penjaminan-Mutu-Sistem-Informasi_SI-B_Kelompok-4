<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pembayaran;

class LaporanController extends Controller
{
    // Laporan pesanan dan pembayaran sederhana
    public function laporanPenjualan()
    {
        $laporan = Pesanan::with(['konsumen', 'detailPesanan.produk'])
            ->get()
            ->map(function ($pesanan) {
                return [
                    'id_pesanan' => $pesanan->id_pesanan,
                    'konsumen' => $pesanan->konsumen->nama_konsumen,
                    'tanggal' => $pesanan->tanggal_pesanan,
                    'total_harga' => $pesanan->total_harga,
                    'produk_dipesan' => $pesanan->detailPesanan->map(function ($d) {
                        return $d->produk->nama_produk . ' (' . $d->jumlah . ')';
                    }),
                ];
            });

        return response()->json($laporan);
    }

    public function laporanPembayaran()
    {
        $laporan = Pembayaran::with('pesanan.konsumen')->get();
        return response()->json($laporan);
    }
}
