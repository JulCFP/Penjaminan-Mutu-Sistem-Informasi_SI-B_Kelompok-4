@extends('layouts.dashboard')

@section('title', 'Tambah Mitra')

@section('content')
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('penjual.index') }}" class="text-gray-400 hover:text-gray-600">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Mitra Baru</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-2xl">
        <form action="{{ route('penjual.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-bold mb-2">Nama Toko / Penjual</label>
                <input type="text" name="nama_penjual" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#849C26]" required>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#849C26]" required>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Password Default</label>
                <input type="password" name="password" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#849C26]" required>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">No Telepon</label>
                <input type="text" name="no_telepon" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#849C26]">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Alamat</label>
                <textarea name="alamat" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#849C26]"></textarea>
            </div>
            <button class="w-full bg-[#849C26] text-white py-3 rounded-lg font-bold mt-4 hover:bg-[#6d821e]">Simpan Mitra</button>
        </form>
    </div>
@endsection