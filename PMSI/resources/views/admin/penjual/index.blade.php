@extends('layouts.dashboard')

@section('title', 'Kelola Penjual')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Mitra Penjual</h1>
        <a href="{{ route('penjual.create') }}" class="bg-[#849C26] text-white px-4 py-2 rounded-lg font-bold shadow-sm hover:bg-[#6d821e] transition">
            <i class="fas fa-plus mr-2"></i> Tambah Mitra Baru
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">Nama Toko</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">No. Telepon</th>
                    <th class="px-6 py-4">Total Produk</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($penjual as $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-gray-700">{{ $p->nama_penjual }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $p->email }}</td>
                    <td class="px-6 py-4">{{ $p->no_telepon ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-bold">
                            {{ $p->produk->count() }} Produk
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('penjual.destroy', $p->id_penjual) }}" method="POST" onsubmit="return confirm('Hapus mitra ini beserta seluruh produknya?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:text-red-700 bg-red-50 p-2 rounded">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada mitra penjual.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection