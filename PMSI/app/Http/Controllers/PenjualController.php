<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use Illuminate\Http\Request;

class PenjualController extends Controller
{
    public function index()
    {
        return response()->json(Penjual::with('produks')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_penjual' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
        ]);

        $penjual = Penjual::create($validated);
        return response()->json($penjual, 201);
    }

    public function show($id)
    {
        $penjual = Penjual::with('produks')->findOrFail($id);
        return response()->json($penjual);
    }

    public function update(Request $request, $id)
    {
        $penjual = Penjual::findOrFail($id);
        $penjual->update($request->all());
        return response()->json($penjual);
    }

    public function destroy($id)
    {
        Penjual::findOrFail($id)->delete();
        return response()->json(['message' => 'Penjual berhasil dihapus']);
    }
}
