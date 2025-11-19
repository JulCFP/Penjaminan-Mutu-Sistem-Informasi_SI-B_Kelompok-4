<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        return response()->json(Pesanan::with(['konsumen', 'detailPesanan'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_konsumen' => 'required|exists:konsumen,id_konsumen',
            'tanggal_pesanan' => 'required|date',
            'total_harga' => 'required|numeric',
        ]);

        $pesanan = Pesanan::create($validated);
        return response()->json($pesanan, 201);
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['konsumen', 'detailPesanan'])->findOrFail($id);
        return response()->json($pesanan);
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($request->all());
        return response()->json($pesanan);
    }

    public function destroy($id)
    {
        Pesanan::findOrFail($id)->delete();
        return response()->json(['message' => 'Pesanan berhasil dihapus']);
    }
}
