<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return response()->json(Produk::with('penjual')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_penjual' => 'required|exists:penjual,id_penjual',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|string',
        ]);

        $produk = Produk::create($validated);
        return response()->json($produk, 201);
    }

    public function show($id)
    {
        $produk = Produk::with('penjual')->findOrFail($id);
        return response()->json($produk);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());
        return response()->json($produk);
    }

    public function destroy($id)
    {
        Produk::findOrFail($id)->delete();
        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}
