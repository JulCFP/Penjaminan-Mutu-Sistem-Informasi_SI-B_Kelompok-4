@extends('layouts.dashboard')

@section('title', 'Pesanan Masuk')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Pesanan Masuk</h1>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">ID Pesanan</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Pembeli</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pesanan as $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-[#849C26]">#{{ $p->id_pesanan }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($p->tanggal_pesan)->format('d M Y') }}</td>
                    <td class="px-6 py-4 font-medium">{{ $p->konsumen->nama_konsumen ?? 'Guest' }}</td>
                    <td class="px-6 py-4">
                        @php
                            $color = match($p->status_pesanan) {
                                'Menunggu Pembayaran' => 'bg-red-100 text-red-800',
                                'Sudah Dibayar (Menunggu Verifikasi)' => 'bg-yellow-100 text-yellow-800',
                                'Diproses Penjual' => 'bg-blue-100 text-blue-800',
                                'Dikirim' => 'bg-purple-100 text-purple-800',
                                'Selesai' => 'bg-green-100 text-green-800',
                                default => 'bg-gray-100 text-gray-800'
                            };
                        @endphp
                        <span class="{{ $color }} text-xs px-3 py-1 rounded-full font-bold">
                            {{ $p->status_pesanan }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-bold">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('pesanan.penjual.show', $p->id_pesanan) }}" class="inline-block bg-[#EFF6C5] text-[#849C26] px-4 py-2 rounded-lg text-sm font-bold hover:bg-[#849C26] hover:text-white transition shadow-sm">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                        <i class="fas fa-box-open text-4xl mb-3 block"></i>
                        Belum ada pesanan masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection