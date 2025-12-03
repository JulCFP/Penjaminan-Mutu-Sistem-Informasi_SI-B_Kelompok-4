<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class CartController extends Controller
{
    // Menampilkan Halaman Keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        
        // Hitung total belanja
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('pesanan.cart', compact('cart', 'total'));
    }

    // Menambah Barang ke Keranjang
// Update method ini
    public function addToCart(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $cart = session()->get('cart', []);
        
        // Ambil quantity dari input, default 1 jika tidak ada
        $qty = $request->query('quantity', 1); 

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty; // Tambahkan sesuai jumlah yang diinput
        } else {
            $cart[$id] = [
                "id_produk" => $produk->id_produk,
                "name" => $produk->nama_produk,
                "quantity" => $qty, // Pakai qty yang diinput
                "price" => $produk->harga,
                "image" => $produk->gambar
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Update Jumlah (Qty) di Keranjang
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Keranjang diperbarui');
        }
    }

    // Hapus Barang dari Keranjang
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Produk dihapus dari keranjang');
        }
    }
}