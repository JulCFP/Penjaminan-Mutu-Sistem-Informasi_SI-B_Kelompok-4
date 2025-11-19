<?php

namespace App\Http\Controllers;

use App\Models\Konsumen;
use Illuminate\Http\Request;

class KonsumenController extends Controller
{
    public function index()
    {
        return response()->json(Konsumen::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:20',
        ]);

        $konsumen = Konsumen::create($validated);
        return response()->json($konsumen, 201);
    }

    public function show($id)
    {
        return response()->json(Konsumen::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $konsumen = Konsumen::findOrFail($id);
        $konsumen->update($request->all());
        return response()->json($konsumen);
    }

    public function destroy($id)
    {
        Konsumen::findOrFail($id)->delete();
        return response()->json(['message' => 'Konsumen berhasil dihapus']);
    }
}
