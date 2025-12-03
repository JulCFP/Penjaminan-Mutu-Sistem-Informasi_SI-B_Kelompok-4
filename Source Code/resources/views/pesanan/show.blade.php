@extends('layouts.dashboard')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ url()->previous() }}" class="text-gray-400 hover:text-gray-600">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan #{{ $pesanan->id_pesanan }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">Daftar Produk Dibeli</h3>
                @foreach($pesanan->detailPesanan as $detail)
                <div class="flex items-center gap-4 py-4 border-b last:border-0">
                    <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden">
                        @if($detail->produk->gambar)
                            <img src="{{ asset('storage/' . $detail->produk->gambar) }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-800">{{ $detail->produk->nama_produk }}</h4>
                        <p class="text-sm text-gray-500">{{ $detail->jumlah }} x Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                    </div>
                    <div class="font-bold text-gray-700">
                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                    </div>
                </div>
                @endforeach
                
                <div class="flex justify-between items-center mt-4 pt-4 border-t">
                    <span class="font-bold text-lg">Total Transaksi</span>
                    <span class="font-bold text-xl text-[#849C26]">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">Informasi Pengiriman</h3>
                <p class="text-sm text-gray-500 mb-1">Penerima:</p>
                <p class="font-bold text-gray-800 mb-4">{{ $pesanan->konsumen->nama_konsumen }}</p>
                
                <p class="text-sm text-gray-500 mb-1">Alamat:</p>
                <p class="text-gray-800">{{ $pesanan->alamat_pengiriman }}</p>
                
                <p class="text-sm text-gray-500 mb-1 mt-4">Status Saat Ini:</p>
                <span class="bg-[#EFF6C5] text-[#849C26] px-3 py-1 rounded-full text-xs font-bold">
                    {{ $pesanan->status_pesanan }}
                </span>
            </div>

            @if(Auth::guard('penjual')->check() || Auth::guard('web')->check())
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-gray-700 mb-4">Update Status Pesanan</h3>
                <form action="{{ route('pesanan.update', $pesanan->id_pesanan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <select name="status_pesanan" class="w-full border bg-gray-50 rounded-lg px-4 py-3 mb-4 focus:ring-2 focus:ring-[#849C26]">
                        <option value="Diproses Penjual" {{ $pesanan->status_pesanan == 'Diproses Penjual' ? 'selected' : '' }}>Diproses Penjual</option>
                        <option value="Dikirim" {{ $pesanan->status_pesanan == 'Dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                        <option value="Selesai" {{ $pesanan->status_pesanan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Dibatalkan" {{ $pesanan->status_pesanan == 'Dibatalkan' ? 'selected' : '' }}>Batalkan Pesanan</option>
                    </select>

                    <button type="submit" class="w-full bg-[#849C26] text-white py-3 rounded-lg font-bold hover:bg-[#6d821e]">
                        Update Status
                    </button>
                </form>
            </div>
            @endif

        </div>
    </div>
@endsection