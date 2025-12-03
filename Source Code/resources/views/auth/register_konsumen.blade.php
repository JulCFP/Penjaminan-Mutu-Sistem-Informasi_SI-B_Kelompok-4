@extends('layouts.auth-split')

@section('title', 'Daftar Akun')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun Baru</h1>
    <p class="text-gray-500 mb-8">Gratis dan mudah, mari mulai belanja.</p>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg mb-6 text-sm">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.konsumen.process') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-600 font-medium mb-1 text-sm">Nama Lengkap</label>
            <input type="text" name="nama_konsumen" value="{{ old('nama_konsumen') }}"
                   class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26] transition"
                   placeholder="Masukkan nama anda" required>
        </div>

        <div>
            <label class="block text-gray-600 font-medium mb-1 text-sm">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26] transition"
                   placeholder="nama@email.com" required>
        </div>

        <div>
            <label class="block text-gray-600 font-medium mb-1 text-sm">Password</label>
            <input type="password" name="password" 
                   class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26] transition"
                   placeholder="Minimal 8 karakter" required>
        </div>

        <button type="submit" class="w-full btn-haritani py-3 rounded-xl font-bold text-lg shadow-md mt-4 transform transition hover:-translate-y-0.5">
            Daftar Sekarang
        </button>
    </form>
@endsection

@section('footer-link')
    Sudah punya akun? <a href="{{ route('login.konsumen') }}" class="font-bold text-gray-800 hover:underline">Masuk Disini</a>
@endsection