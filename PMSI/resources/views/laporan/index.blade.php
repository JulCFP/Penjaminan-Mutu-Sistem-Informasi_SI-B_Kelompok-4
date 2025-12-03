@extends('layouts.dashboard')

@section('title', 'Laporan Pusat')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Pusat Laporan</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('laporan.penjualan') }}" class="bg-white p-8 rounded-xl shadow-sm border hover:border-[#849C26] hover:shadow-md transition group">
            <div class="w-16 h-16 bg-green-100 text-[#849C26] rounded-full flex items-center justify-center mb-4 group-hover:bg-[#849C26] group-hover:text-white transition">
                <i class="fas fa-chart-line text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800">Laporan Penjualan (Omset)</h3>
            <p class="text-gray-500 mt-2">Lihat total transaksi sukses dan pendapatan dari seluruh mitra.</p>
        </a>

        <a href="{{ route('laporan.pembayaran') }}" class="bg-white p-8 rounded-xl shadow-sm border hover:border-[#849C26] hover:shadow-md transition group">
            <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition">
                <i class="fas fa-file-invoice-dollar text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800">Laporan Pembayaran Masuk</h3>
            <p class="text-gray-500 mt-2">Rekap history verifikasi pembayaran dari konsumen.</p>
        </a>
    </div>
@endsection