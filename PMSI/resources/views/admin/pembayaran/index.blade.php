@extends('layouts.dashboard')

@section('title', 'Verifikasi Pembayaran')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Verifikasi Pembayaran Masuk</h1>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">ID Pesanan</th>
                    <th class="px-6 py-4">Konsumen</th>
                    <th class="px-6 py-4">Bukti Bayar</th>
                    <th class="px-6 py-4">Total Tagihan</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pembayaran as $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold">#{{ $p->pesanan->id_pesanan }}</td>
                    <td class="px-6 py-4">{{ $p->pesanan->konsumen->nama_konsumen }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ asset('storage/' . $p->bukti_pembayaran) }}" target="_blank" class="text-blue-500 underline text-sm">Lihat Bukti</a>
                    </td>
                    <td class="px-6 py-4 font-bold text-[#849C26]">Rp {{ number_format($p->pesanan->total_harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        @if($p->status_pembayaran == 'Menunggu Verifikasi')
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-bold">Menunggu</span>
                        @else
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-bold">Lunas</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($p->status_pembayaran == 'Menunggu Verifikasi')
                        <form action="{{ route('pembayaran.verify', $p->id_pembayaran) }}" method="POST">
                            @csrf
                            <button class="bg-[#849C26] text-white px-3 py-1 rounded text-sm font-bold hover:bg-[#6d821e]">
                                <i class="fas fa-check mr-1"></i> Verifikasi
                            </button>
                        </form>
                        @else
                            <span class="text-gray-400 text-sm"><i class="fas fa-check-circle"></i> Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada pembayaran baru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection