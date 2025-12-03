<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Haritani</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-cream { background-color: #EFF6C5; }
        .text-olive { color: #849C26; }
        .bg-olive { background-color: #849C26; }
        .bg-olive:hover { background-color: #6d821e; }
    </style>
</head>
<body class="bg-white flex flex-col min-h-screen">

    <nav class="bg-cream px-8 py-4 flex justify-between items-center sticky top-0 z-50 shadow-sm">
        <a href="{{ route('konsumen.dashboard') }}" class="flex items-center gap-2">
            <div class="bg-olive text-white px-5 py-2 rounded-full font-bold flex items-center gap-2 shadow-md">
                <i class="fas fa-star text-xs"></i> HARITANI
            </div>
        </a>

        <div class="hidden md:flex gap-8 text-gray-600 font-medium">
            <a href="{{ route('konsumen.dashboard') }}" class="hover:text-[#849C26] transition {{ request()->routeIs('konsumen.dashboard') ? 'text-[#849C26] font-bold' : '' }}">Home</a>
            <a href="{{ route('produk.katalog') }}" class="hover:text-[#849C26] transition {{ request()->routeIs('produk.katalog') ? 'text-[#849C26] font-bold' : '' }}">Belanja (Katalog)</a>
        </div>

        <div class="flex items-center gap-6">
            
            <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-[#849C26] transition">
                <i class="fas fa-shopping-cart text-xl"></i>
                
                @php $cartCount = count((array) session('cart')); @endphp
                
                @if($cartCount > 0)
                    <span class="absolute -top-2 -right-2 bg-black text-white text-xs w-5 h-5 flex items-center justify-center rounded-full animate-bounce">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
            
            <div class="relative group">
                <button class="flex items-center gap-2 text-gray-700 hover:text-[#849C26]">
                    <div class="w-8 h-8 rounded-full bg-white border border-gray-300 flex items-center justify-center overflow-hidden">
                        <i class="far fa-user"></i>
                    </div>
                </button>
                <div class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-xl hidden group-hover:block p-2">
                    <div class="px-4 py-2 border-b mb-2">
                        <p class="text-xs text-gray-500">Halo,</p>
                        <p class="font-bold text-gray-800">{{ Auth::guard('konsumen')->user()->nama_konsumen }}</p>
                    </div>
                    <a href="{{ route('pesanan.konsumen') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">Riwayat Pesanan</a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white py-8 border-t mt-12">
        <div class="container mx-auto px-8 text-center">
            <p class="text-sm text-gray-400">
                &copy; {{ date('Y') }} Haritani. Fresh from local farmers.
            </p>
        </div>
    </footer>

</body>
</html>