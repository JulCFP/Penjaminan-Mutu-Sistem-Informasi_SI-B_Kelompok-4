@extends('layouts.dashboard')

@section('title', 'Kelola Konsumen')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Konsumen Terdaftar</h1>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">Nama Konsumen</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">No. Telepon</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($konsumen as $k)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-gray-700">{{ $k->nama_konsumen }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $k->email }}</td>
                    <td class="px-6 py-4">{{ $k->no_telepon ?? '-' }}</td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('konsumen.destroy', $k->id_konsumen) }}" method="POST" onsubmit="return confirm('Hapus akun konsumen ini?');">
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
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada konsumen terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection