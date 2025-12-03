@extends('layouts.dashboard')

@section('title', 'Laporan Pembayaran')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Laporan Pembayaran Masuk</h1>
        <button onclick="window.print()" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-900">
            <i class="fas fa-print mr-2"></i> Cetak Laporan
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">Tanggal Bayar</th>
                    <th class="px-6 py-4">ID Pesanan</th>
                    <th class="px-6 py-4">Konsumen</th>
                    <th class="px-6 py-4">Metode</th>
                    <th class="px-6 py-4">Jumlah</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($laporan as $row)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-gray-600">
                        {{ \Carbon\Carbon::parse($row->tanggal_pembayaran)->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 font-bold text-[#849C26]">#{{ $row->pesanan->id_pesanan }}</td>
                    <td class="px-6 py-4 font-medium">{{ $row->pesanan->konsumen->nama_konsumen ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $row->metode_pembayaran }}</td>
                    <td class="px-6 py-4 font-bold">
                        Rp {{ number_format($row->pesanan->total_harga, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($row->status_pembayaran == 'Lunas')
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-bold">Terverifikasi</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-bold">Menunggu</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada data pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection