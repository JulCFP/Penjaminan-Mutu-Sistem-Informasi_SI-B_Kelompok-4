<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dashboard Haritani</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body { font-family: 'Inter', sans-serif; }
        .nav-active { background-color: #EFF6C5; color: #849C26; border-right: 4px solid #849C26; }
    </style>
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden">

    <aside class="w-64 bg-white border-r hidden md:flex flex-col">
        <div class="h-16 flex items-center px-8 border-b">
            <div class="bg-[#849C26] text-white px-3 py-1 rounded-full font-bold text-sm shadow-sm">
                ★ HARITANI
            </div>
            <span class="ml-2 font-bold text-gray-700">
                @if(Auth::guard('web')->check()) Admin @else Mitra @endif
            </span>
        </div>

        <nav class="flex-1 overflow-y-auto py-4">
            
            {{-- ================= MENU ADMIN ================= --}}
            @if(Auth::guard('web')->check())
                <p class="px-6 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Administrator</p>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#849C26] transition {{ request()->routeIs('admin.dashboard') ? 'nav-active' : '' }}">
                    <i class="fas fa-home w-6"></i> <span class="font-medium">Dashboard</span>
                </a>
                <a href="{{ route('penjual.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#849C26] transition {{ request()->routeIs('penjual.*') ? 'nav-active' : '' }}">
                    <i class="fas fa-store w-6"></i> <span class="font-medium">Kelola Penjual</span>
                </a>
                <a href="{{ route('konsumen.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#849C26] transition {{ request()->routeIs('konsumen.*') ? 'nav-active' : '' }}">
                    <i class="fas fa-users w-6"></i> <span class="font-medium">Kelola Konsumen</span>
                </a>
                <a href="{{ route('pembayaran.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#849C26] transition {{ request()->routeIs('pembayaran.*') ? 'nav-active' : '' }}">
                    <i class="fas fa-money-bill-wave w-6"></i> <span class="font-medium">Verifikasi Bayar</span>
                </a>
                <a href="{{ route('laporan.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#849C26] transition {{ request()->routeIs('laporan.*') ? 'nav-active' : '' }}">
                    <i class="fas fa-file-alt w-6"></i> <span class="font-medium">Laporan Pusat</span>
                </a>

            {{-- ================= MENU PENJUAL ================= --}}
            @elseif(Auth::guard('penjual')->check())
                <p class="px-6 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Menu Toko</p>
                
                <a href="{{ route('penjual.dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#849C26] transition {{ request()->routeIs('penjual.dashboard') ? 'nav-active' : '' }}">
                    <i class="fas fa-home w-6"></i> <span class="font-medium">Dashboard</span>
                </a>
                <a href="{{ route('produk.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#849C26] transition {{ request()->routeIs('produk.*') ? 'nav-active' : '' }}">
                    <i class="fas fa-box w-6"></i> <span class="font-medium">Kelola Produk</span>
                </a>
                <a href="{{ route('pesanan.penjual') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#849C26] transition {{ request()->routeIs('pesanan.penjual*') ? 'nav-active' : '' }}">
                    <i class="fas fa-shopping-bag w-6"></i> <span class="font-medium">Pesanan Masuk</span>
                </a>
                <a href="{{ route('laporan.penjualan.penjual') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-[#849C26] transition {{ request()->routeIs('laporan.*') ? 'nav-active' : '' }}">
                    <i class="fas fa-chart-line w-6"></i> <span class="font-medium">Laporan</span>
                </a>
            @endif

        </nav>

        <div class="border-t p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gray-800 text-white flex items-center justify-center">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div>
                    @if(Auth::guard('web')->check())
                        <p class="text-sm font-bold text-gray-700">{{ Auth::guard('web')->user()->name }}</p>
                        <p class="text-xs text-blue-600">● Administrator</p>
                    @elseif(Auth::guard('penjual')->check())
                        <p class="text-sm font-bold text-gray-700">{{ Auth::guard('penjual')->user()->nama_penjual }}</p>
                        <p class="text-xs text-green-600">● Mitra Penjual</p>
                    @endif
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button class="w-full text-xs text-red-500 border border-red-200 py-1 rounded hover:bg-red-50">Logout</button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <header class="h-16 bg-white border-b flex md:hidden items-center px-4 justify-between">
            <span class="font-bold text-[#849C26]">Haritani Admin</span>
            <button class="text-gray-500"><i class="fas fa-bars"></i></button>
        </header>

        <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
            @yield('content')
        </div>
    </main>

</body>
</html>