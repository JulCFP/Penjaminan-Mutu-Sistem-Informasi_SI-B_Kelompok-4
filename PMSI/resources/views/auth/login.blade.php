<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Akses Login - Haritani</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#EFF6C5] h-screen flex items-center justify-center">

    <div class="bg-white p-10 rounded-3xl shadow-xl max-w-lg w-full text-center">
        <div class="mb-8">
            <div class="bg-[#849C26] text-white px-6 py-2 rounded-full font-bold inline-block shadow-md mb-4">
                ★ HARITANI
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Selamat Datang</h1>
            <p class="text-gray-500 mt-2">Silakan pilih akses login Anda</p>
        </div>

        <div class="space-y-4">
            <a href="{{ route('login.konsumen') }}" class="block group relative w-full">
                <div class="absolute inset-0 bg-[#849C26] rounded-xl transform translate-y-1 translate-x-1 transition group-hover:translate-y-0 group-hover:translate-x-0"></div>
                <div class="relative bg-white border-2 border-[#849C26] p-4 rounded-xl flex items-center justify-between group-hover:bg-[#849C26] group-hover:text-white transition cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-100 p-2 rounded-full group-hover:bg-white/20">
                            <svg class="w-6 h-6 text-[#849C26] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div class="text-left">
                            <h3 class="font-bold text-lg">Konsumen</h3>
                            <p class="text-xs text-gray-500 group-hover:text-green-100">Belanja sayur segar</p>
                        </div>
                    </div>
                    <span class="text-2xl">&rarr;</span>
                </div>
            </a>

            <a href="{{ route('login.penjual') }}" class="block group relative w-full">
                <div class="absolute inset-0 bg-[#849C26] rounded-xl transform translate-y-1 translate-x-1 transition group-hover:translate-y-0 group-hover:translate-x-0"></div>
                <div class="relative bg-white border-2 border-[#849C26] p-4 rounded-xl flex items-center justify-between group-hover:bg-[#849C26] group-hover:text-white transition cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-100 p-2 rounded-full group-hover:bg-white/20">
                            <svg class="w-6 h-6 text-[#849C26] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div class="text-left">
                            <h3 class="font-bold text-lg">Penjual</h3>
                            <p class="text-xs text-gray-500 group-hover:text-green-100">Kelola toko & produk</p>
                        </div>
                    </div>
                    <span class="text-2xl">&rarr;</span>
                </div>
            </a>

            <div class="pt-4">
                <a href="{{ route('login.admin') }}" class="text-sm text-gray-400 hover:text-[#849C26] hover:underline transition">
                    Masuk sebagai Administrator
                </a>
            </div>
        </div>
    </div>

</body>
</html>