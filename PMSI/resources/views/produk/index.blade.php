@extends('layouts.dashboard')

@section('title', 'Kelola Produk')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Produk</h1>
        <a href="{{ route('produk.create') }}" class="bg-[#849C26] text-white px-4 py-2 rounded-lg font-bold shadow-sm hover:bg-[#6d821e] transition">
            <i class="fas fa-plus mr-2"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">Gambar</th>
                    <th class="px-6 py-4">Nama Produk</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4">Stok</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($produk as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="w-12 h-12 object-cover rounded-lg border">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded-lg"></div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-bold text-gray-700">{{ $item->nama_produk }}</td>
                    <td class="px-6 py-4 text-gray-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-bold">
                            {{ $item->stok }} Pcs
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('produk.edit', $item->id_produk) }}" class="text-blue-500 hover:text-blue-700 bg-blue-50 p-2 rounded">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <form action="{{ route('produk.destroy', $item->id_produk) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:text-red-700 bg-red-50 p-2 rounded">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                        <i class="fas fa-box-open text-4xl mb-3"></i>
                        <p>Belum ada produk. Silakan tambah produk baru.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection