@extends('layouts.main')

@section('title', 'Home')

@section('content')

    <section class="bg-cream py-16 relative overflow-hidden">
        <div class="container mx-auto px-8 flex flex-col-reverse md:flex-row items-center relative z-10">
            <div class="md:w-1/2 space-y-6">
                <span class="bg-[#849C26] text-white px-3 py-1 rounded-full text-xs font-bold tracking-wider">FRESH & ORGANIC</span>
                <h1 class="text-5xl md:text-6xl font-bold text-[#6B705C] leading-tight">
                    Hidup Lebih Hijau <br>
                    <span class="text-olive">Di Mulai Dari piringmu.</span>
                </h1>
                <p class="text-[#A5A58D] text-lg font-medium">
                    Temukan hasil panen terbaik dari petani lokal di sekitarmu.
                </p>
                <a href="{{ route('produk.katalog') }}" class="inline-block bg-olive text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    Belanja Sekarang
                </a>
            </div>

            <div class="md:w-1/2 flex justify-center relative">
                @if($latestProducts->count() > 0 && $latestProducts->first()->gambar)
                    <img src="{{ asset('storage/' . $latestProducts->first()->gambar) }}" 
                         alt="Hero Image" 
                         class="w-3/4 object-contain drop-shadow-2xl hover:scale-105 transition duration-500">
                @else
                    <img src="https://png.pngtree.com/png-clipart/20230113/ourmid/pngtree-vegetables-bucket-png-image_6561494.png" 
                         class="w-3/4 drop-shadow-2xl">
                @endif
            </div>
        </div>
        <div class="absolute top-0 right-0 w-1/3 h-full bg-[#E4EFC3] rounded-l-full opacity-50 -z-0"></div>
    </section>

    <section class="container mx-auto px-8 my-16">
        <div class="bg-[#EFF6C5] rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center gap-8 shadow-sm hover:shadow-md transition">
            <div class="md:w-1/3 text-center">
                <i class="fas fa-shipping-fast text-6xl text-[#849C26] mb-4"></i>
            </div>
            <div class="md:w-2/3">
                <h2 class="text-3xl font-bold text-olive mb-2">Pengiriman Cepat & Segar</h2>
                <p class="text-gray-500 text-lg">Kami menjamin produk tetap segar saat sampai di tangan Anda.</p>
            </div>
        </div>
    </section>

    <section id="produk" class="container mx-auto px-8 my-16">
        <div class="flex justify-between items-end mb-12">
            <div>
                <p class="text-gray-400 font-medium">Pilihan Terbaik</p>
                <h2 class="text-3xl font-bold text-gray-800">Produk Populer</h2>
            </div>
            <a href="{{ route('produk.katalog') }}" class="text-[#849C26] font-bold hover:underline">Lihat Semua &rarr;</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($popularProducts as $item)
            <div class="bg-white p-6 rounded-2xl border hover:shadow-xl transition group relative flex flex-col">
                
                <div class="absolute top-4 left-4 bg-gray-100 text-gray-500 text-[10px] px-2 py-1 rounded-full font-bold uppercase tracking-wider">
                    {{ $item->penjual->nama_penjual ?? 'Mitra Haritani' }}
                </div>

                <div class="h-48 flex items-center justify-center mb-6 overflow-hidden rounded-xl bg-gray-50">
                    <a href="{{ route('produk.show', $item->id_produk) }}">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="h-full w-full object-cover group-hover:scale-110 transition duration-300">
                        @else
                            <img src="https://via.placeholder.com/300x300?text=No+Image" class="h-full object-cover opacity-50">
                        @endif
                    </a>
                </div>

                <div class="flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="font-bold text-xl text-gray-800 group-hover:text-[#849C26] transition">
                                <a href="{{ route('produk.show', $item->id_produk) }}">{{ $item->nama_produk }}</a>
                            </h3>
                            <p class="text-xs text-gray-400">Stok: {{ $item->stok }} Tersedia</p>
                        </div>
                        <span class="bg-[#EFF6C5] text-[#849C26] px-3 py-1 rounded-lg text-sm font-bold">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>
                    </div>
                    <p class="text-gray-500 text-sm line-clamp-2 mb-4">{{ $item->deskripsi }}</p>
                </div>

                <div class="mt-auto pt-4 border-t flex gap-2">
                     <a href="{{ route('produk.show', $item->id_produk) }}" class="flex-1 bg-gray-100 text-gray-600 py-2 rounded-lg font-bold hover:bg-gray-200 text-center text-sm flex items-center justify-center">
                        Detail
                    </a>

                    <a href="{{ route('cart.add', $item->id_produk) }}" class="flex-1 bg-[#849C26] text-white py-2 rounded-lg font-bold hover:bg-[#6d821e] text-center text-sm flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition">
                        <i class="fas fa-cart-plus"></i> Beli
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                <i class="fas fa-leaf text-4xl text-gray-300 mb-3"></i>
                <p class="text-gray-500">Belum ada produk yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </section>

    @endsection