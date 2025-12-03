@extends('layouts.auth-split')

@section('title', 'Login Penjual')

@section('content')
    <div class="mb-6">
        <span class="text-xs font-bold tracking-widest text-[#849C26] uppercase">Mitra Haritani</span>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Welcome back, Partner!</h1>
        <p class="text-gray-500">Kelola tokomu dan pantau pesanan dengan mudah.</p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 text-red-600 px-4 py-3 rounded-lg text-sm mb-4 border border-red-200">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.penjual.process') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-600 font-medium mb-1 text-sm">Email Toko</label>
            <input type="email" name="email" 
                   class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26] transition"
                   placeholder="contoh@toko.com" required>
        </div>

        <div>
            <label class="block text-gray-600 font-medium mb-1 text-sm">Password</label>
            <input type="password" name="password" 
                   class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26] transition"
                   placeholder="Masukkan password anda" required>
            <div class="flex justify-end mt-1">
                <a href="#" class="text-xs text-gray-400 hover:text-gray-600">Lupa Password?</a>
            </div>
        </div>

        <button type="submit" class="w-full btn-haritani py-3 rounded-xl font-bold text-lg shadow-md hover:shadow-lg transform transition hover:-translate-y-0.5">
            Masuk ke Toko
        </button>
    </form>
@endsection

{{-- BAGIAN INI PENTING: Harus dibungkus section footer-link agar posisinya benar --}}
@section('footer-link')
    Ingin berjualan di Haritani? <a href="{{ route('register.penjual') }}" class="font-bold text-gray-800 hover:underline">Daftar Jadi Mitra</a>
@endsection