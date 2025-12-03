@extends('layouts.main')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
<div class="bg-[#EFF6C5] min-h-screen py-12">
    <div class="container mx-auto px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Konfirmasi dan Pembayaran</h1>

        <form action="{{ route('pesanan.store') }}" method="POST">
            @csrf
            
            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-2/3 bg-white p-8 rounded-3xl shadow-sm">
                    
                    <h3 class="font-bold text-xl mb-6">Informasi Pengiriman</h3>
                    
                    <div class="mb-6">
                        <label class="block text-gray-600 text-sm font-bold mb-2">Alamat Lengkap</label>
                        <textarea name="alamat_pengiriman" rows="3" class="w-full border bg-gray-50 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26]" placeholder="Jln. Mawar No. 12, Kecamatan..." required>{{ Auth::user()->alamat ?? '' }}</textarea>
                    </div>

                    <h3 class="font-bold text-xl mb-4 mt-8">Metode Pembayaran</h3>
                    
                    <div class="flex gap-4 mb-6">
                        <label class="flex items-center gap-4 border-2 border-[#849C26] bg-[#eff6c540] p-4 rounded-xl cursor-pointer w-full hover:bg-[#eff6c566] transition">
                            <input type="radio" name="metode_pembayaran" value="Transfer Bank" checked class="w-5 h-5 accent-[#849C26]">
                            <div>
                                <span class="font-bold text-gray-800 block text-lg">Transfer Bank</span>
                                <span class="text-sm text-gray-500">Pembayaran melalui transfer bank manual (BCA, BRI, Mandiri)</span>
                            </div>
                        </label>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-xl mb-6 border border-blue-100 flex gap-3">
                        <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                        <div>
                            <p class="text-sm text-blue-800 font-bold mb-1">Catatan Pengiriman:</p>
                            <p class="text-sm text-blue-700 leading-relaxed">
                                Mohon pastikan alamat yang Anda masukkan sudah benar, detail, dan ada orang yang dapat menerima paket di lokasi tersebut.
                            </p>
                        </div>
                    </div>

                    @foreach($cart as $id => $details)
                        <input type="hidden" name="items[{{ $loop->index }}][id_produk]" value="{{ $details['id_produk'] }}">
                        <input type="hidden" name="items[{{ $loop->index }}][qty]" value="{{ $details['quantity'] }}">
                    @endforeach

                    <button type="submit" class="w-full bg-[#849C26] text-white py-4 rounded-xl font-bold text-lg hover:bg-[#6d821e] shadow-lg transition transform hover:-translate-y-1">
                        Konfirmasi & Bayar
                    </button>
                </div>

                <div class="w-full md:w-1/3">
                    <div class="bg-white p-8 rounded-3xl shadow-sm sticky top-24 border border-gray-50">
                        <h3 class="font-bold text-xl mb-6 border-b pb-4">Ringkasan</h3>
                        
                        <div class="space-y-4 mb-6">
                            @foreach($cart as $details)
                            <div class="flex justify-between items-start text-sm">
                                <span class="text-gray-600 w-2/3">{{ $details['name'] }} <span class="text-xs font-bold text-[#849C26]">x{{ $details['quantity'] }}</span></span>
                                <span class="font-bold text-gray-800">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t pt-4 flex justify-between items-center">
                            <span class="font-bold text-lg text-gray-800">Total Tagihan</span>
                            <span class="font-bold text-2xl text-[#849C26]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection