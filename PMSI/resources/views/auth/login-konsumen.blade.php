@extends('layouts.auth-split')

@section('title', 'Login Konsumen')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome back!</h1>
    <p class="text-gray-500 mb-8">Meet the good taste today</p>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ $errors->first() }}</span>
        </div>
    @endif

    <form action="{{ route('login.konsumen.process') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-600 font-medium mb-1 text-sm">E-mail or phone number</label>
            <input type="email" name="email" 
                   class="w-full bg-gray-100 text-gray-800 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26] transition"
                   placeholder="Type your e-mail or phone number" required>
        </div>

        <div>
            <label class="block text-gray-600 font-medium mb-1 text-sm">Password</label>
            <input type="password" name="password" 
                   class="w-full bg-gray-100 text-gray-800 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#849C26] transition"
                   placeholder="Type your password" required>
            <div class="flex justify-end mt-1">
                <a href="#" class="text-xs text-gray-400 hover:text-gray-600">Forgot Password?</a>
            </div>
        </div>

        <button type="submit" class="w-full btn-haritani py-3 rounded-xl font-bold text-lg shadow-md mt-4">
            Sign In
        </button>
    </form>
@endsection

@section('footer-link')
    Don’t have an account? <a href="{{ route('register.konsumen') }}" class="font-bold text-gray-800 hover:underline">Sign Up</a>
@endsection