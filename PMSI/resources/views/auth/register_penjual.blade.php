@extends('layouts.auth-split')

@section('title', 'Daftar Mitra Penjual')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Gabung Mitra Haritani</h1>
    <p class="text-gray-500 mb-6">Jual hasil panenmu langsung ke konsumen.</p>

    <form action="{{ route('register.penjual.process') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-600 font-medium mb-1 text-sm">Nama Toko / Petani</label>
            <input type="text" name="nama_penjual" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#849C26]" placeholder="Contoh: Sayur Organik Pak Budi" required>
        </div>

        <div>
            <label class="block text-gray-600 font-medium mb-1 text-sm">Email Aktif</label>
            <input type="email" name="email" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#849C26]" placeholder="email@toko.com" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-600 font-medium mb-1 text-sm">No. WhatsApp</label>
                <input type="text" name="no_telepon" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#849C26]" placeholder="0812..." required>
            </div>
            <div>
                <label class="block text-gray-600 font-medium mb-1 text-sm">Password</label>
                <input type="password" name="password" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#849C26]" placeholder="Min 8 karakter" required>
            </div>
        </div>

        <div>
            <label class="block text-gray-600 font-medium mb-1 text-sm">Alamat Lokasi Kebun/Toko</label>
            <textarea name="alamat" rows="2" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#849C26]" placeholder="Alamat lengkap..." required></textarea>
        </div>

        <button type="submit" class="w-full btn-haritani py-3 rounded-xl font-bold text-lg shadow-md mt-2">
            Daftar Sekarang
        </button>
    </form>
@endsection

@section('footer-link')
    Sudah punya akun mitra? <a href="{{ route('login.penjual') }}" class="font-bold text-gray-800 hover:underline">Masuk Disini</a>
@endsection