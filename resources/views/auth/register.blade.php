@extends('layouts.app')

@section('title', 'Register - DompetKu')

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
            <p class="text-neutral-text-secondary text-sm mt-1">Buat Akun Baru</p>
        </div>

        <!-- Form Card -->
        <div class="card mb-6">
            <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Name Input -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-neutral-text mb-2">Nama Lengkap</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="input-field @error('name') ring-2 ring-red-500 @enderror"
                        placeholder="Nama Anda"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

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

                <!-- Confirm Password Input -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-neutral-text mb-2">Konfirmasi Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="input-field"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <!-- Register Button -->
                <button type="submit" class="btn-primary-lg mt-6">
                    Daftar
                </button>
            </form>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <p class="text-neutral-text-secondary text-sm">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="text-primary font-semibold hover:text-primary-dark transition">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
