@extends('layouts.main')

@section('title', $produk->nama_produk)

@section('content')

<div class="bg-gray-50 py-4">
    <div class="container mx-auto px-8 text-sm text-gray-500">
        <a href="{{ route('konsumen.dashboard') }}" class="hover:text-[#849C26]">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('produk.katalog') }}" class="hover:text-[#849C26]">Katalog</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800 font-bold">{{ $produk->nama_produk }}</span>
    </div>
</div>

<div class="container mx-auto px-8 py-12">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            {{ session('success') }} <a href="{{ route('cart.index') }}" class="font-bold underline ml-2">Lihat Keranjang</a>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        
        <div class="bg-white rounded-3xl p-8 border shadow-sm flex items-center justify-center relative">
            @if($produk->gambar)
                <img src="{{ asset('storage/' . $produk->gambar) }}" class="w-full max-h-[400px] object-contain">
            @else
                <img src="https://via.placeholder.com/500?text=No+Image" class="w-full object-contain opacity-50">
            @endif
        </div>

        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="bg-[#EFF6C5] text-[#849C26] px-3 py-1 rounded-full text-xs font-bold uppercase">
                    Stok: {{ $produk->stok }}
                </span>
                <span class="text-gray-500 text-sm font-medium">
                    <i class="fas fa-store mr-1"></i> {{ $produk->penjual->nama_penjual ?? 'Mitra Haritani' }}
                </span>
            </div>

            <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $produk->nama_produk }}</h1>
            <div class="flex text-yellow-400 text-sm mb-6"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> <span class="text-gray-400 ml-2">(4.8 Reviews)</span></div>

            <div class="text-3xl font-bold text-[#849C26] mb-6">
                Rp {{ number_format($produk->harga, 0, ',', '.') }}
            </div>

            <p class="text-gray-600 leading-relaxed mb-8">{{ $produk->deskripsi }}</p>

            <div class="flex gap-4 items-center">
                <div class="flex items-center border border-gray-300 rounded-full px-4 py-3 gap-4">
                    <button onclick="decreaseQty()" class="text-gray-500 hover:text-[#849C26] font-bold text-xl">-</button>
                    <span id="qty-display" class="font-bold text-gray-800 w-4 text-center">1</span>
                    <button onclick="increaseQty()" class="text-gray-500 hover:text-[#849C26] font-bold text-xl">+</button>
                </div>

                <a href="#" id="add-to-cart-btn" onclick="addToCart(event)" class="flex-1 bg-[#849C26] text-white py-3 rounded-full font-bold hover:bg-[#6d821e] text-center shadow-lg transition transform hover:-translate-y-1">
                    Tambah ke Keranjang
                </a>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-8 pt-8 border-t">
                <div class="flex items-center gap-3"><i class="fas fa-leaf text-2xl text-[#849C26]"></i><div><h5 class="font-bold text-sm">100% Organik</h5><p class="text-xs text-gray-400">Jaminan kualitas</p></div></div>
                <div class="flex items-center gap-3"><i class="fas fa-truck text-2xl text-[#849C26]"></i><div><h5 class="font-bold text-sm">Pengiriman Cepat</h5><p class="text-xs text-gray-400">Langsung dari kebun</p></div></div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentQty = 1;
    const maxStock = {{ $produk->stok }};
    const productId = {{ $produk->id_produk }};
    const baseUrl = "{{ url('/add-to-cart') }}";

    function increaseQty() {
        if(currentQty < maxStock) {
            currentQty++;
            updateDisplay();
        } else {
            alert('Stok maksimal tercapai!');
        }
    }

    function decreaseQty() {
        if (currentQty > 1) {
            currentQty--;
            updateDisplay();
        }
    }

    function updateDisplay() {
        document.getElementById('qty-display').innerText = currentQty;
    }

    function addToCart(e) {
        e.preventDefault();
        // Redirect ke URL dengan parameter quantity
        window.location.href = `${baseUrl}/${productId}?quantity=${currentQty}`;
    }
</script>
@endsection