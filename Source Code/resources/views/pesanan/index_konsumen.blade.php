@extends('layouts.main')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Riwayat Pesanan Saya</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            @forelse($pesanan as $p)
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between gap-6">
                
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="font-bold text-[#849C26] text-lg">Order #{{ $p->id_pesanan }}</span>
                        <span class="text-gray-400 text-sm">| {{ \Carbon\Carbon::parse($p->tanggal_pesan)->format('d M Y') }}</span>
                    </div>
                    
                    <div class="mb-4">
                        @php
                            $statusClass = match($p->status_pesanan) {
                                'Menunggu Pembayaran' => 'bg-red-100 text-red-700',
                                'Sudah Dibayar (Menunggu Verifikasi)' => 'bg-yellow-100 text-yellow-800',
                                'Diproses Penjual' => 'bg-blue-100 text-blue-800',
                                'Dikirim' => 'bg-purple-100 text-purple-800',
                                'Selesai' => 'bg-green-100 text-green-800',
                                default => 'bg-gray-100 text-gray-800'
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                            {{ $p->status_pesanan }}
                        </span>
                    </div>

                    <p class="text-gray-600 text-sm">
                        Total Belanja: <span class="font-bold">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</span>
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('pesanan.konsumen.show', $p->id_pesanan) }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 text-sm font-bold">
                        Detail
                    </a>

                    @if($p->status_pesanan == 'Menunggu Pembayaran')
                        <a href="{{ route('pembayaran.create', $p->id_pesanan) }}" class="px-6 py-2 bg-[#849C26] text-white rounded-lg hover:bg-[#6d821e] text-sm font-bold shadow-md transition transform hover:-translate-y-1">
                            Bayar Sekarang
                        </a>
                    @endif
                </div>

            </div>
            @empty
            <div class="text-center py-16">
                <i class="fas fa-history text-6xl text-gray-200 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-500">Belum ada riwayat pesanan.</h3>
                <a href="{{ route('produk.katalog') }}" class="text-[#849C26] font-bold underline mt-2 inline-block">Mulai Belanja</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection