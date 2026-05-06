@extends('layouts.admin')

@section('title', 'Admin Dashboard - DompetKu')

@section('content')
<!-- Header -->
<div class="mb-8">
    <h1 class="text-3xl md:text-4xl font-bold text-neutral-text mb-2">Admin Dashboard 📊</h1>
    <p class="text-neutral-text-secondary">Pantau aktivitas dan status user secara real-time</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
    <!-- Total Users -->
    <div class="card bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium opacity-90">Total Users</p>
                <h2 class="text-4xl md:text-5xl font-bold mt-2">{{ $totalUsers }}</h2>
            </div>
            <div class="w-12 h-12 md:w-16 md:h-16 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 md:w-8 md:h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Online Users -->
    <div class="card bg-gradient-to-br from-green-500 to-green-600 text-white shadow-lg hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium opacity-90">Online Users</p>
                <h2 class="text-4xl md:text-5xl font-bold mt-2">{{ $onlineUsers }}</h2>
            </div>
            <div class="w-12 h-12 md:w-16 md:h-16 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 md:w-8 md:h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Offline Users -->
    <div class="card bg-gradient-to-br from-red-500 to-red-600 text-white shadow-lg hover:shadow-xl transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium opacity-90">Offline Users</p>
                <h2 class="text-4xl md:text-5xl font-bold mt-2">{{ $offlineUsers }}</h2>
            </div>
            <div class="w-12 h-12 md:w-16 md:h-16 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 md:w-8 md:h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Online Users Status -->
<div class="card">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6 gap-3">
        <div>
            <h3 class="text-2xl font-bold text-neutral-text">User Activity Status</h3>
            <p class="text-sm text-neutral-text-secondary mt-1">Status aktivitas user secara real-time</p>
        </div>
        <a href="{{ route('admin.users') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg font-medium hover:bg-primary-dark transition-colors text-sm md:text-base">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Kelola Semua
        </a>
    </div>

    <!-- Table (Hidden on mobile, shown on tablet+) -->
    <div class="hidden sm:block overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-neutral-bg-tertiary">
                    <th class="text-left py-3 px-3 md:px-4 text-xs font-semibold text-neutral-text-secondary">Nama</th>
                    <th class="text-left py-3 px-3 md:px-4 text-xs font-semibold text-neutral-text-secondary hidden md:table-cell">Email</th>
                    <th class="text-left py-3 px-3 md:px-4 text-xs font-semibold text-neutral-text-secondary">Status</th>
                    <th class="text-left py-3 px-3 md:px-4 text-xs font-semibold text-neutral-text-secondary">Last Activity</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b border-neutral-bg-tertiary hover:bg-neutral-bg-secondary transition-colors">
                        <td class="py-3 px-3 md:px-4 text-sm text-neutral-text font-medium">{{ $user->name }}</td>
                        <td class="py-3 px-3 md:px-4 text-sm text-neutral-text-secondary hidden md:table-cell">{{ $user->email }}</td>
                        <td class="py-3 px-3 md:px-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->isOnline() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <span class="inline-block w-2 h-2 rounded-full mr-1 {{ $user->isOnline() ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                {{ $user->isOnline() ? 'Online' : 'Offline' }}
                            </span>
                        </td>
                        <td class="py-3 px-3 md:px-4 text-sm text-neutral-text-secondary">
                            {{ $user->last_activity ? $user->last_activity->diffForHumans() : 'Never' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 px-3 md:px-4 text-center text-neutral-text-secondary text-sm">
                            Tidak ada data user
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View (Shown on mobile only) -->
    <div class="sm:hidden space-y-3">
        @forelse($users as $user)
            <div class="bg-neutral-bg-secondary rounded-lg p-4">
                <div class="flex items-center justify-between mb-2">
                    <h4 class="font-semibold text-neutral-text">{{ $user->name }}</h4>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $user->isOnline() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        <span class="inline-block w-2 h-2 rounded-full mr-1 {{ $user->isOnline() ? 'bg-green-500' : 'bg-red-500' }}"></span>
                        {{ $user->isOnline() ? 'Online' : 'Offline' }}
                    </span>
                </div>
                <p class="text-xs text-neutral-text-secondary mb-1">{{ $user->email }}</p>
                <p class="text-xs text-neutral-text-secondary">{{ $user->last_activity ? $user->last_activity->diffForHumans() : 'Never' }}</p>
            </div>
        @empty
            <div class="text-center py-8">
                <p class="text-neutral-text-secondary text-sm">Tidak ada data user</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6 overflow-x-auto">
        {{ $users->links() }}
    </div>
</div>
@endsection

