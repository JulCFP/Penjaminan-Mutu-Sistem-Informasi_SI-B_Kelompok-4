@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Dashboard Administrator</h1>
    <p class="text-gray-500 mb-8">Selamat datang kembali, Admin. Berikut ringkasan sistem hari ini.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-gray-500 text-sm font-medium">Perlu Verifikasi</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $pendingBayar }}</h3>
                <p class="text-xs text-gray-400 mt-1">Pembayaran Menunggu</p>
            </div>
            <div class="absolute right-4 top-6 bg-red-100 p-3 rounded-lg text-red-500">
                <i class="fas fa-exclamation-circle text-xl"></i>
            </div>
            @if($pendingBayar > 0)
                <a href="{{ route('pembayaran.index') }}" class="absolute bottom-0 left-0 w-full bg-red-50 text-red-600 text-center py-2 text-xs font-bold hover:bg-red-100 transition">
                    Proses Sekarang &rarr;
                </a>
            @endif
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Mitra Penjual</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalPenjual }}</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-lg text-[#849C26]">
                    <i class="fas fa-store text-xl"></i>
                </div>
            </div>
            <a href="{{ route('penjual.index') }}" class="text-[#849C26] text-xs font-bold mt-4 inline-block hover:underline">Kelola Mitra &rarr;</a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Konsumen</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalKonsumen }}</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg text-blue-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
            <a href="{{ route('konsumen.index') }}" class="text-blue-600 text-xs font-bold mt-4 inline-block hover:underline">Lihat Konsumen &rarr;</a>
        </div>
    </div>

    <h3 class="font-bold text-gray-800 mb-4">Akses Cepat</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('penjual.create') }}" class="bg-white p-4 rounded-xl shadow-sm border hover:border-[#849C26] hover:shadow-md transition text-center group">
            <div class="w-12 h-12 bg-green-50 text-[#849C26] rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-[#849C26] group-hover:text-white transition">
                <i class="fas fa-user-plus"></i>
            </div>
            <span class="font-bold text-gray-700 text-sm">Tambah Mitra</span>
        </a>

        <a href="{{ route('laporan.penjualan') }}" class="bg-white p-4 rounded-xl shadow-sm border hover:border-[#849C26] hover:shadow-md transition text-center group">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-600 group-hover:text-white transition">
                <i class="fas fa-chart-bar"></i>
            </div>
            <span class="font-bold text-gray-700 text-sm">Laporan Omset</span>
        </a>

        <a href="{{ route('admin.settings') }}" class="bg-white p-4 rounded-xl shadow-sm border hover:border-[#849C26] hover:shadow-md transition text-center group">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-purple-600 group-hover:text-white transition">
                <i class="fas fa-cogs"></i>
            </div>
            <span class="font-bold text-gray-700 text-sm">Pengaturan</span>
        </a>
    </div>

@endsection