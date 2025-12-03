@extends('layouts.main')

@section('title', 'Katalog Produk')

@section('content')

<div class="bg-[#EFF6C5] py-8">
    <div class="container mx-auto px-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            
            <div class="flex items-center gap-2 text-gray-500 text-sm">
                <i class="fas fa-map-marker-alt"></i> 
                <span>Palu, Sulawesi Tengah</span>
            </div>
            
            <form action="{{ route('produk.katalog') }}" method="GET" class="w-full md:w-1/2 relative">
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="w-full pl-10 pr-4 py-3 rounded-full focus:outline-none focus:ring-2 focus:ring-[#849C26] shadow-sm" 
                       placeholder="Cari sayuran, buah, atau bumbu...">
                <i class="fas fa-search absolute left-4 top-3.5 text-gray-400"></i>
            </form>
        </div>
    </div>
</div>

<div class="container mx-auto px-8 py-12">
    
    <div class="flex justify-between items-end mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Semua Produk</h2>
            <p class="text-gray-500 text-sm mt-1">
                Menampilkan {{ $produk->firstItem() ?? 0 }} - {{ $produk->lastItem() ?? 0 }} dari {{ $produk->total() }} produk segar
            </p>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($produk as $item)
        <div class="bg-white p-4 rounded-2xl border hover:shadow-xl transition group relative flex flex-col">
            
            <div class="h-48 flex items-center justify-center mb-4 overflow-hidden rounded-xl bg-gray-50 relative">
                <a href="{{ route('produk.show', $item->id_produk) }}">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="h-full w-full object-cover group-hover:scale-110 transition duration-300">
                    @else
                        <img src="https://via.placeholder.com/300x300?text=No+Image" class="h-full object-cover opacity-50">
                    @endif
                </a>
                
                <div class="absolute top-2 left-2 bg-white/90 backdrop-blur px-2 py-1 rounded text-[10px] font-bold text-gray-600 shadow-sm">
                    Stok: {{ $item->stok }}
                </div>
            </div>

            <div class="flex-1">
                <h3 class="font-bold text-gray-800 line-clamp-1 mb-1">
                    <a href="{{ route('produk.show', $item->id_produk) }}" class="hover:text-[#849C26]">{{ $item->nama_produk }}</a>
                </h3>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-[#849C26]">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="mt-4 pt-4 border-t flex gap-2">
                <a href="{{ route('produk.show', $item->id_produk) }}" class="flex-1 bg-gray-100 text-gray-600 py-2 rounded-lg font-bold hover:bg-gray-200 text-center text-xs flex items-center justify-center">
                    Detail
                </a>
                
                <button onclick="openQtyModal({{ $item->id_produk }}, '{{ $item->nama_produk }}', {{ $item->harga }}, '{{ $item->gambar }}', {{ $item->stok }})" 
                        class="flex-1 bg-[#849C26] text-white py-2 rounded-lg font-bold hover:bg-[#6d821e] text-center text-xs flex items-center justify-center gap-1 shadow-md hover:shadow-lg transition">
                    <i class="fas fa-shopping-cart"></i> Beli
                </button>
            </div>
        </div>
        @empty
        <div class="col-span-4 text-center py-20">
            <div class="bg-gray-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-leaf text-4xl text-gray-300"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-600">Produk Tidak Ditemukan</h3>
            <p class="text-gray-400">Coba cari kata kunci lain.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-12 flex justify-center">
        <div class="bg-white p-2 rounded-xl shadow-sm border">
            {{ $produk->withQueryString()->links() }}
        </div>
    </div>
</div>

<div id="qtyModal" class="fixed inset-0 z-[999] hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeQtyModal()"></div>
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-sm p-6 transform transition-all scale-100">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-lg font-bold text-gray-800">Tentukan Jumlah</h3>
                <button onclick="closeQtyModal()" class="text-gray-400 hover:text-red-500 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="flex gap-4 mb-6">
                <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0">
                    <img id="modal-img" src="" class="w-full h-full object-cover">
                </div>
                <div>
                    <h4 id="modal-name" class="font-bold text-gray-800 text-lg line-clamp-1">Nama Produk</h4>
                    <p id="modal-price" class="text-[#849C26] font-bold">Rp 0</p>
                    <p class="text-xs text-gray-400 mt-1">Stok: <span id="modal-stock">0</span></p>
                </div>
            </div>
            <form id="addToCartForm" action="" method="GET">
                <div class="flex items-center justify-between bg-gray-50 p-2 rounded-xl mb-6 border border-gray-200">
                    <button type="button" onclick="updateModalQty(-1)" class="w-10 h-10 bg-white rounded-lg shadow text-gray-600 hover:text-[#849C26] font-bold text-xl flex items-center justify-center transition">-</button>
                    <input type="number" name="quantity" id="modal-qty-input" value="1" readonly class="bg-transparent text-center font-bold text-xl text-gray-800 w-16 focus:outline-none">
                    <button type="button" onclick="updateModalQty(1)" class="w-10 h-10 bg-[#849C26] rounded-lg shadow text-white hover:bg-[#6d821e] font-bold text-xl flex items-center justify-center transition">+</button>
                </div>
                <div class="flex justify-between items-center mb-6 text-sm">
                    <span class="text-gray-500">Total Harga:</span>
                    <span id="modal-total" class="font-bold text-lg text-gray-800">Rp 0</span>
                </div>
                <button type="submit" class="w-full bg-[#849C26] text-white py-3 rounded-xl font-bold text-lg hover:bg-[#6d821e] shadow-lg transition transform hover:-translate-y-1">
                    <i class="fas fa-cart-plus mr-2"></i> Masukkan Keranjang
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    let currentPrice = 0;
    let maxStock = 0;
    function openQtyModal(id, name, price, image, stock) {
        document.getElementById('modal-name').innerText = name;
        document.getElementById('modal-price').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
        document.getElementById('modal-stock').innerText = stock;
        const imgPath = image ? `{{ asset('storage') }}/${image}` : 'https://via.placeholder.com/150';
        document.getElementById('modal-img').src = imgPath;
        const baseUrl = "{{ url('/add-to-cart') }}";
        document.getElementById('addToCartForm').action = `${baseUrl}/${id}`;
        document.getElementById('modal-qty-input').value = 1;
        currentPrice = price;
        maxStock = stock;
        calculateTotal();
        document.getElementById('qtyModal').classList.remove('hidden');
    }
    function closeQtyModal() {
        document.getElementById('qtyModal').classList.add('hidden');
    }
    function updateModalQty(change) {
        let input = document.getElementById('modal-qty-input');
        let currentQty = parseInt(input.value);
        let newQty = currentQty + change;
        if (newQty >= 1 && newQty <= maxStock) {
            input.value = newQty;
            calculateTotal();
        }
    }
    function calculateTotal() {
        let qty = parseInt(document.getElementById('modal-qty-input').value);
        let total = qty * currentPrice;
        document.getElementById('modal-total').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
    }
</script>

@endsection