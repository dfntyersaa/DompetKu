@extends('layouts.app')

@section('title', 'Login - DompetKu')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary/10 to-accent-blue/10 flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md">
        <!-- Logo/Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-3xl bg-gradient-to-br from-primary to-primary-dark shadow-lg mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-neutral-text">DompetKu</h1>
            <p class="text-neutral-text-secondary text-sm mt-1">Smart Finance Tracker</p>
        </div>

        <!-- Form Card -->
        <div class="card mb-6">
            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-neutral-text mb-2">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="input-field @error('email') ring-2 ring-red-500 @enderror"
                        placeholder="example@mail.com"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-neutral-text mb-2">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="input-field @error('password') ring-2 ring-red-500 @enderror"
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn-primary-lg mt-6">
                    Masuk
                </button>
            </form>
        </div>

        <!-- Register Link -->
        <div class="text-center">
            <p class="text-neutral-text-secondary text-sm">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="text-primary font-semibold hover:text-primary-dark transition">
                    Daftar di sini
                </a>
            </p>
        </div>

        <!-- Demo Info -->
        <div class="mt-8 p-4 bg-white rounded-2xl shadow-md border border-gray-100">
            <p class="text-xs text-neutral-text-secondary text-center">
                <span class="font-semibold">Demo Akun:</span><br>
                Email: demo@example.com<br>
                Password: demo123
            </p>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }
</style>
@endsection
