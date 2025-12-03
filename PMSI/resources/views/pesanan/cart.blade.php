@extends('layouts.main')

@section('title', 'Keranjang Belanja')

@section('content')

<div class="bg-[#EFF6C5] min-h-screen py-12">
    <div class="container mx-auto px-8">
        
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Keranjang Belanja <span class="text-gray-500 text-xl font-normal ml-2">({{ count((array) session('cart')) }} item)</span></h1>

        <div class="flex flex-col lg:flex-row gap-12 mt-8">
            
            <div class="w-full lg:w-[65%]">
                <div class="bg-[#F9FBE7] rounded-3xl shadow-sm p-8 border border-[#e4eeb3]">
                    
                    @if(session('cart') && count(session('cart')) > 0)
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-gray-500 border-b border-gray-200 text-sm uppercase tracking-wider">
                                <th class="pb-4 font-medium w-1/2">Produk</th>
                                <th class="pb-4 font-medium text-center">Harga</th>
                                <th class="pb-4 font-medium text-center">Qty</th>
                                <th class="pb-4 font-medium text-right">Total</th>
                                <th class="pb-4 font-medium"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach(session('cart') as $id => $details)
                            <tr class="group" data-id="{{ $id }}">
                                <td class="py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-20 h-20 bg-white rounded-xl p-1 shadow-sm flex-shrink-0 border border-gray-100">
                                            @if(isset($details['image']))
                                                <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-cover rounded-lg">
                                            @else
                                                <div class="w-full h-full bg-gray-200 rounded-lg"></div>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-lg">{{ $details['name'] }}</h4>
                                            <p class="text-xs text-gray-500">Segar & Berkualitas</p>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="py-6 text-center text-gray-600 font-medium">
                                    Rp {{ number_format($details['price'], 0, ',', '.') }}
                                </td>
                                
                                <td class="py-6">
                                    <div class="flex items-center justify-center">
                                        <div class="flex items-center border border-[#849C26] rounded-full px-3 py-1 bg-white shadow-sm">
                                            <span class="text-[#849C26] font-bold text-sm">{{ $details['quantity'] }}</span>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="py-6 text-right font-bold text-gray-800 text-lg">
                                    Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                </td>
                                
                                <td class="py-6 text-right pl-4">
                                    <button class="text-gray-400 hover:text-red-500 transition remove-from-cart p-2 hover:bg-red-50 rounded-full" data-id="{{ $id }}" title="Hapus Item">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="text-center py-16">
                            <div class="bg-white w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                                <i class="fas fa-shopping-basket text-4xl text-gray-300"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-600 mb-2">Keranjang belanjaanmu kosong</h3>
                            <p class="text-gray-500 mb-8">Yuk isi dengan sayuran segar!</p>
                            <a href="{{ route('produk.katalog') }}" class="bg-[#849C26] text-white px-8 py-3 rounded-full font-bold shadow-md hover:bg-[#6d821e] transition transform hover:-translate-y-1 inline-block">
                                Mulai Belanja
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-full lg:w-[35%]">
                <div class="bg-white p-8 rounded-3xl shadow-lg sticky top-28 border border-gray-50">
                    <h3 class="font-bold text-xl text-gray-800 mb-6 border-b pb-4">Ringkasan Pesanan</h3>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Item</span>
                            <span class="font-medium">{{ count((array) session('cart')) }} Pcs</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Total Harga Barang</span>
                            <span class="font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-green-600 bg-green-50 p-2 rounded-lg">
                            <span>Diskon</span>
                            <span class="font-bold">- Rp 0</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-dashed border-gray-300 pt-6 mb-8">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-800 text-lg">Total Tagihan</span>
                            <span class="font-bold text-3xl text-[#849C26]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-2 text-right">*Belum termasuk ongkir (dihitung saat checkout)</p>
                    </div>

                    @if(session('cart') && count(session('cart')) > 0)
                        <a href="{{ route('checkout.page') }}" class="block w-full bg-[#849C26] text-white text-center py-4 rounded-xl font-bold text-lg hover:bg-[#6d821e] shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
                            Lanjut ke Pembayaran <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    @else
                        <button disabled class="block w-full bg-gray-200 text-gray-400 text-center py-4 rounded-xl font-bold text-lg cursor-not-allowed">
                            Keranjang Kosong
                        </button>
                    @endif

                    <a href="{{ route('produk.katalog') }}" class="block text-center mt-6 text-sm text-gray-500 hover:text-[#849C26] font-medium transition">
                        &larr; Kembali Belanja
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        // Tampilan konfirmasi yang lebih standar
        if(confirm("Yakin ingin menghapus produk ini dari keranjang?")) {
            $.ajax({
                url: '{{ route('cart.remove') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>

@endsection