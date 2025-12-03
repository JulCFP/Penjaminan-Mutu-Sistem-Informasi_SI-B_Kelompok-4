@extends('layouts.dashboard')

@section('title', 'Dashboard Penjual')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Overview Toko</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Penjualan</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">
                        Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                    </h3>
                </div>
                <div class="bg-green-100 p-2 rounded-lg text-[#849C26]">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Pesanan Baru</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">
                        {{ $pesananBaru }}
                    </h3>
                </div>
                <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                    <i class="fas fa-shopping-bag"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Produk</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">
                        {{ $totalProduk }}
                    </h3>
                </div>
                <div class="bg-orange-100 p-2 rounded-lg text-orange-600">
                    <i class="fas fa-box"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-[#EFF6C5] rounded-xl p-8 flex items-center justify-between relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-xl font-bold text-[#849C26] mb-2">Halo, Mitra Haritani!</h2>
            <p class="text-gray-600 mb-4">
                Siap melayani pelanggan hari ini? <br> 
                Pastikan stok produkmu selalu update.
            </p>
            <a href="{{ route('produk.create') }}" class="inline-block bg-[#849C26] text-white px-6 py-2 rounded-lg font-bold shadow-md hover:bg-[#6d821e] transition">
                + Tambah Produk Baru
            </a>
        </div>
        
        <i class="fas fa-store text-9xl text-[#849C26] opacity-10 absolute -right-4 -bottom-4"></i>
    </div>
@endsection