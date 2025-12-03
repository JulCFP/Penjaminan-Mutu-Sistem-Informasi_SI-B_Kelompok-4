@extends('layouts.dashboard')

@section('title', 'Tambah Produk')

@section('content')
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('produk.index') }}" class="text-gray-400 hover:text-gray-600">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Produk Baru</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-3xl">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                <input type="text" name="nama_produk" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26]" placeholder="Contoh: Sayur Bayam Organik" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Harga (Rp)</label>
                    <input type="number" name="harga" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26]" placeholder="0" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Stok Awal</label>
                    <input type="number" name="stok" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26]" placeholder="0" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Deskripsi Produk</label>
                <textarea name="deskripsi" rows="4" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26]" placeholder="Jelaskan detail produk..."></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Foto Produk</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition relative">
                    <input type="file" name="gambar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                    <p class="text-sm text-gray-500">Klik atau geser file gambar ke sini</p>
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (Max 2MB)</p>
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="bg-[#849C26] text-white px-8 py-3 rounded-lg font-bold shadow-md hover:bg-[#6d821e] transition">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
@endsection