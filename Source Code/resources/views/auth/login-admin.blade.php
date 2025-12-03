@extends('layouts.auth-split')

@section('title', 'Login Administrator')

@section('content')
    <div class="mb-8">
        <span class="text-xs font-bold tracking-widest text-gray-500 uppercase">System Access</span>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Administrator</h1>
        <p class="text-gray-500">Masuk untuk mengelola sistem Haritani.</p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 text-red-600 px-4 py-3 rounded-lg text-sm mb-4 border border-red-200">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.admin.process') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-600 font-medium mb-1 text-sm">Email Admin</label>
            <input type="email" name="email" 
                   class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26] transition"
                   placeholder="admin@haritani.com" required>
        </div>

        <div>
            <label class="block text-gray-600 font-medium mb-1 text-sm">Password</label>
            <input type="password" name="password" 
                   class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26] transition"
                   placeholder="••••••••" required>
        </div>

        <button type="submit" class="w-full bg-gray-800 text-white py-3 rounded-xl font-bold text-lg shadow-md hover:bg-gray-900 transition mt-2">
            Login Sistem
        </button>
    </form>
@endsection

@section('footer-link')
    <span class="text-gray-400 text-xs">© 2024 Haritani System</span>
@endsection