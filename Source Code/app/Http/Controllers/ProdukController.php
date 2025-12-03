<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Menampilkan daftar produk milik penjual yang sedang login
    public function index()
    {
        $id_penjual = Auth::guard('penjual')->id();
        $produk = Produk::where('id_penjual', $id_penjual)->get();
        return view('produk.index', compact('produk'));
    }

    // Halaman tambah produk
    public function create()
    {
        return view('produk.create');
    }

    // Proses simpan produk
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|max:2048', // Max 2MB
        ]);

        // Upload Gambar
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produk-images', 'public');
        }

        $validated['id_penjual'] = Auth::guard('penjual')->id(); // Otomatis set ID Penjual

        Produk::create($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Halaman edit
    public function edit($id)
    {
        // Pastikan hanya pemilik yang bisa edit
        $produk = Produk::where('id_produk', $id)->where('id_penjual', Auth::guard('penjual')->id())->firstOrFail();
        return view('produk.edit', compact('produk'));
    }

    // Proses update
    public function update(Request $request, $id)
    {
        $produk = Produk::where('id_produk', $id)->where('id_penjual', Auth::guard('penjual')->id())->firstOrFail();

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('produk-images', 'public');
        }

        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // Hapus produk
    public function destroy($id)
    {
        $produk = Produk::where('id_produk', $id)->where('id_penjual', Auth::guard('penjual')->id())->firstOrFail();
        
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }
        
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk dihapus.');
    }
    
    // Untuk dilihat detail oleh Konsumen (Public/Protected)
// GANTI METHOD SHOW YANG LAMA DENGAN INI:
    public function show($id)
    {
        // Ambil data produk beserta data penjualnya
        $produk = Produk::with('penjual')->findOrFail($id);
        
        // Return ke view detail produk yang baru kita buat
        return view('produk.show', compact('produk'));
    }
    // === TAMBAHAN UNTUK KATALOG PUBLIC ===
    public function katalog(Request $request)
    {
        // Ambil semua produk (bisa ditambah fitur search nanti)
        $query = Produk::query();

        if ($request->has('search')) {
            $query->where('nama_produk', 'LIKE', '%' . $request->search . '%');
        }

        // Filter kategori jika ada (opsional)
        
        $produk = $query->paginate(12); // Tampilkan 12 produk per halaman

        return view('produk.katalog', compact('produk'));
    }
}