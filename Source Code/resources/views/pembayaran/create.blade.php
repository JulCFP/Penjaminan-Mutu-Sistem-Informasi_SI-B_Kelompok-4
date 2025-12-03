@extends('layouts.main')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
<div class="container mx-auto px-8 py-12">
    <div class="max-w-md mx-auto bg-white p-8 rounded-3xl shadow-lg border border-gray-100">
        
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Upload Bukti Transfer</h2>
            <p class="text-gray-500 text-sm">Pesanan #{{ $pesanan->id_pesanan }}</p>
        </div>
        
        <div class="bg-blue-50 p-4 rounded-xl mb-6 text-sm text-blue-800 flex items-start gap-3">
            <i class="fas fa-info-circle mt-1"></i>
            <div>
                <p>Total Tagihan: <span class="font-bold text-lg block">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span></p>
                <p class="mt-2 text-xs uppercase tracking-wide opacity-70">Transfer ke Rekening:</p>
                <p class="font-bold">BCA: 123-456-7890 (Haritani)</p>
            </div>
        </div>

        <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_pesanan" value="{{ $pesanan->id_pesanan }}">
            <input type="hidden" name="tanggal_pembayaran" value="{{ date('Y-m-d') }}">

            <div class="mb-4">
                <label class="block text-gray-600 text-sm font-bold mb-2">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26]">
                    <option value="Transfer Bank">Transfer Bank (BCA/Mandiri/BRI)</option>
                    <option value="E-Wallet">E-Wallet (OVO/GoPay/Dana)</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-600 text-sm font-bold mb-2">Bukti Foto / Screenshot</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition relative">
                    <input type="file" name="bukti_pembayaran" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required accept="image/*">
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                    <p class="text-sm text-gray-500">Klik untuk upload bukti</p>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#849C26] text-white py-3 rounded-xl font-bold hover:bg-[#6d821e] shadow-md transition transform hover:-translate-y-1">
                Kirim Bukti Pembayaran
            </button>
        </form>
        
        <div class="text-center mt-4">
            <a href="{{ route('konsumen.dashboard') }}" class="text-gray-400 text-sm hover:text-[#849C26]">Kembali ke Dashboard</a>
        </div>
    </div>
</div>
@endsection