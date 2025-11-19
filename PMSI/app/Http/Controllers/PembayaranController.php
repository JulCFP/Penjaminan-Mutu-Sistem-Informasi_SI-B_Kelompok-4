<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        return response()->json(Pembayaran::with('pesanan')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'tanggal_pembayaran' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode_pembayaran' => 'nullable|string|max:100',
        ]);

        $pembayaran = Pembayaran::create($validated);
        return response()->json($pembayaran, 201);
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with('pesanan')->findOrFail($id);
        return response()->json($pembayaran);
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($request->all());
        return response()->json($pembayaran);
    }

    public function destroy($id)
    {
        Pembayaran::findOrFail($id)->delete();
        return response()->json(['message' => 'Pembayaran berhasil dihapus']);
    }
}
