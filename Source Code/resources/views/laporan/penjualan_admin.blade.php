@extends('layouts.dashboard')

@section('title', 'Laporan Penjualan Admin')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Laporan Penjualan (Semua Mitra)</h1>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Konsumen</th>
                    <th class="px-6 py-4">Total Belanja</th>
                    <th class="px-6 py-4">Detail Item</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $row)
                <tr class="border-b last:border-0 hover:bg-gray-50">
                    <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($row->tanggal_pesan)->format('d M Y') }}</td>
                    <td class="px-6 py-4 font-bold">{{ $row->konsumen->nama_konsumen }}</td>
                    <td class="px-6 py-4 font-bold text-[#849C26]">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <ul class="list-disc pl-4">
                            @foreach($row->detailPesanan as $detail)
                                <li>{{ $detail->produk->nama_produk }} ({{ $detail->jumlah }}x)</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-6 text-gray-400">Data kosong</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection