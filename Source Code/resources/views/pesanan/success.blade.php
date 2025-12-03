@extends('layouts.main')

@section('title', 'Pesanan Berhasil')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-white">
    <div class="text-center max-w-lg">
        <div class="mb-8 flex justify-center">
            <img src="https://cdn-icons-png.flaticon.com/512/411/411712.png" alt="Success" class="w-40 h-40 opacity-80">
        </div>

        <h4 class="text-gray-500 font-bold tracking-widest text-sm uppercase mb-2">ORDER SUCCESSFUL</h4>
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Thank you for your order!</h1>
        
        <p class="text-xl text-gray-600 mb-8">
            Order number is: <span class="font-bold text-[#849C26]">#{{ $id_pesanan }}</span>
        </p>
        
        <p class="text-gray-500 mb-8">
            Pesanan Anda telah kami terima dan sedang diproses. <br>
            Silakan tunggu konfirmasi selanjutnya.
        </p>

        <div class="flex justify-center">
            <a href="{{ route('produk.katalog') }}" class="bg-[#849C26] text-white px-8 py-3 rounded-full font-bold hover:bg-[#6d821e] shadow-md transition transform hover:-translate-y-1">
                Continue shopping
            </a>
        </div>
    </div>
</div>
@endsection