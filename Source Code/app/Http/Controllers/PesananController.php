<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // History Pesanan untuk Konsumen
    public function indexKonsumen()
    {
        $userId = Auth::guard('konsumen')->id();
        $pesanan = Pesanan::where('id_konsumen', $userId)->orderBy('created_at', 'desc')->get();
        return view('pesanan.index_konsumen', compact('pesanan'));
    }

    // Daftar Pesanan Masuk untuk Penjual
    public function indexPenjual()
    {
        $penjualId = Auth::guard('penjual')->id();
        
        // Ambil pesanan yang mengandung produk milik penjual ini
        // (Menggunakan whereHas untuk cek relasi detailPesanan -> produk -> penjual)
        $pesanan = Pesanan::whereHas('detailPesanan.produk', function($query) use ($penjualId) {
            $query->where('id_penjual', $penjualId);
        })->with(['detailPesanan.produk' => function($query) use ($penjualId) {
            $query->where('id_penjual', $penjualId); // Filter detail hanya produk dia
        }])->orderBy('created_at', 'desc')->get();

        return view('pesanan.index_penjual', compact('pesanan'));
    }

    // Method Baru: Menampilkan Halaman Konfirmasi Checkout
    public function checkoutPage()
    {
        $cart = session()->get('cart');
        if(!$cart) {
            return redirect()->route('produk.katalog');
        }
        
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('pesanan.checkout', compact('cart', 'total'));
    }

    // Method Baru: Halaman Sukses
    public function successPage($id)
    {
        return view('pesanan.success', ['id_pesanan' => $id]);
    }

    // PROSES CHECKOUT (PENTING!)
    public function store(Request $request)
    {
        // Validasi data keranjang (dikirim sebagai array dari frontend)
        $request->validate([
            'items' => 'required|array', // Array produk yg dibeli
            'items.*.id_produk' => 'required|exists:produk,id_produk',
            'items.*.qty' => 'required|integer|min:1',
            'alamat_pengiriman' => 'required|string',
        ]);

        DB::beginTransaction(); // Pakai transaction agar aman

        try {
            // 1. Buat Header Pesanan
            $pesanan = Pesanan::create([
                'id_konsumen' => Auth::guard('konsumen')->id(),
                'tanggal_pesan' => now(),
                'status_pesanan' => 'Menunggu Pembayaran',
                'alamat_pengiriman' => $request->alamat_pengiriman,
                'total_harga' => 0, // Nanti diupdate
            ]);

            $totalHarga = 0;

            // 2. Loop Items dan Masukkan ke DetailPesanan
            foreach ($request->items as $item) {
                $produk = Produk::find($item['id_produk']);
                
                // Cek Stok
                if ($produk->stok < $item['qty']) {
                    throw new \Exception("Stok produk {$produk->nama_produk} tidak mencukupi.");
                }

                $subtotal = $produk->harga * $item['qty'];
                $totalHarga += $subtotal;

                // Simpan Detail
                DetailPesanan::create([
                    'id_pesanan' => $pesanan->id_pesanan,
                    'id_produk' => $produk->id_produk,
                    'jumlah' => $item['qty'],
                    'harga_satuan' => $produk->harga,
                    'subtotal' => $subtotal
                ]);

                // Kurangi Stok Produk
                $produk->decrement('stok', $item['qty']);
            }

            // 3. Update Total Harga di Header
            $pesanan->update(['total_harga' => $totalHarga]);

            DB::commit();
            session()->forget('cart');
            return redirect()->route('pesanan.success', $pesanan->id_pesanan);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    // Menampilkan Detail Pesanan
    public function show($id)
    {
        $pesanan = Pesanan::with('detailPesanan.produk')->findOrFail($id);
        return view('pesanan.show', compact('pesanan'));
    }
}