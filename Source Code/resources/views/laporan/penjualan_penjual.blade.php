@extends('layouts.dashboard')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="flex justify-between items-center mb-6 print:hidden">
        <h1 class="text-2xl font-bold text-gray-800">Laporan Penjualan</h1>
        <button onclick="window.print()" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-900 transition flex items-center gap-2 shadow-sm">
            <i class="fas fa-print"></i> Cetak Laporan
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-green-600 text-white p-6 rounded-xl shadow-lg print:border print:border-black print:text-black">
            <p class="text-green-100 text-sm print:text-black">Total Omset</p>
            @php $totalOmset = $laporan->sum('total_harga'); @endphp
            <h3 class="text-3xl font-bold mt-1">Rp {{ number_format($totalOmset, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <p class="text-gray-500 text-sm">Total Transaksi</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $laporan->count() }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Produk Terjual</th>
                    <th class="px-6 py-4 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($laporan as $row)
                <tr>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($row->tanggal_pesan)->format('d M Y') }}</td>
                    <td class="px-6 py-4 font-medium">{{ $row->konsumen->nama_konsumen ?? 'Guest' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <ul class="list-disc pl-4">
                            @foreach($row->detailPesanan as $detail)
                                <li>{{ $detail->produk->nama_produk }} ({{ $detail->jumlah }}x)</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-6 py-4 text-right font-bold">
                        Rp {{ number_format($row->total_harga, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400">Data kosong.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <style>
        @media print {
            .print\:hidden { display: none !important; }
            aside { display: none !important; }
            main { margin: 0; padding: 0; width: 100%; }
            body { background: white; }
        }
    </style>
@endsection