@extends('layouts.dashboard')

@section('title', 'Pengaturan Akun')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan Akun Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-lg text-gray-700 mb-4 border-b pb-2">Edit Profil</h3>
            
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-gray-600 text-sm font-bold mb-2">Nama Admin</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26]" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26]" required>
                </div>

                <hr class="my-6 border-gray-200">
                <h3 class="font-bold text-lg text-gray-700 mb-4">Ganti Password <span class="text-xs font-normal text-gray-400">(Biarkan kosong jika tidak ingin mengganti)</span></h3>

                <div class="mb-4">
                    <label class="block text-gray-600 text-sm font-bold mb-2">Password Baru</label>
                    <input type="password" name="password" class="w-full border bg-gray-50 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26]">
                </div>

                <button type="submit" class="bg-[#849C26] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#6d821e] transition">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <div class="bg-[#EFF6C5] p-8 rounded-xl h-fit">
            <h3 class="font-bold text-[#849C26] mb-2">Keamanan Akun</h3>
            <p class="text-gray-600 text-sm mb-4">
                Pastikan Anda menggunakan password yang kuat. Jangan berikan akses akun administrator kepada sembarang orang.
            </p>
            <div class="flex items-center gap-3 text-sm text-gray-500">
                <i class="fas fa-shield-alt text-2xl"></i>
                <span>Akun Anda dilindungi enkripsi standar Laravel.</span>
            </div>
        </div>
    </div>
@endsection