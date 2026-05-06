@extends('layouts.main')

@section('title', 'Dashboard - DompetKu')

@section('content')
<!-- Header -->
<div class="mb-6">
    <p class="text-neutral-text-secondary text-sm">Selamat datang kembali</p>
    <h1 class="text-2xl font-bold text-neutral-text">Halo, {{ Auth::user()->name }}! 👋</h1>
</div>

<!-- Saldo Card (Highlight) -->
<div class="card mb-6 bg-gradient-to-br from-primary to-primary-dark text-white shadow-lg p-6">
    <p class="text-sm font-medium opacity-90 mb-1">Total Saldo</p>
    <h2 class="text-3xl font-bold mb-4">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h2>
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white/20 rounded-xl p-3">
            <p class="text-xs font-medium opacity-80">Pemasukan Total</p>
            <p class="text-lg font-bold">Rp {{ number_format($pemasukan, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white/20 rounded-xl p-3">
            <p class="text-xs font-medium opacity-80">Pengeluaran Total</p>
            <p class="text-lg font-bold">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</p>
        </div>
    </div>
</div>

<!-- Statistik Bulan Ini -->
<div class="grid grid-cols-2 gap-4 mb-6">
    <div class="card">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-medium text-neutral-text-secondary">Pemasukan (Bulan Ini)</p>
            <div class="w-8 h-8 rounded-lg bg-accent-blue/20 flex items-center justify-center">
                <svg class="w-4 h-4 text-accent-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
        </div>
        <p class="text-xl font-bold text-accent-blue">Rp {{ number_format($pemasukan_bulan, 0, ',', '.') }}</p>
    </div>

    <div class="card">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-medium text-neutral-text-secondary">Pengeluaran (Bulan Ini)</p>
            <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
        </div>
        <p class="text-xl font-bold text-red-500">Rp {{ number_format($pengeluaran_bulan, 0, ',', '.') }}</p>
    </div>
</div>

<!-- Budget Info -->
@if($budget)
<div class="card mb-6">
    <div class="flex items-center justify-between mb-3">
        <h3 class="font-semibold text-neutral-text">Budget Bulan Ini</h3>
        <a href="{{ route('budget.index') }}" class="text-primary text-xs font-semibold hover:text-primary-dark">
            Edit
        </a>
    </div>
    
    <div class="mb-3">
        <div class="flex justify-between items-center mb-2 text-xs">
            <span class="text-neutral-text-secondary">{{ number_format($budget->total_pengeluaran ?? 0, 0, ',', '.') }} / Rp {{ number_format($budget->jumlah, 0, ',', '.') }}</span>
            <span class="font-semibold text-neutral-text">{{ min($budget->persentase ?? 0, 100) }}%</span>
        </div>
        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full transition-all duration-300" style="width: {{ min($budget->persentase ?? 0, 100) }}%; background: {{ ($budget->persentase ?? 0) > 100 ? '#ef4444' : (($budget->persentase ?? 0) > 80 ? '#f59e0b' : '#2EC4B6') }};"></div>
        </div>
    </div>

    <p class="text-xs text-neutral-text-secondary">Sisa: <span class="font-semibold text-neutral-text">Rp {{ number_format(max(0, $budget->jumlah - ($budget->total_pengeluaran ?? 0)), 0, ',', '.') }}</span></p>
</div>
@endif

<!-- Transaksi Terbaru -->
<div class="card">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-semibold text-neutral-text">Transaksi Terbaru</h3>
        <a href="{{ route('transaksi.index') }}" class="text-primary text-xs font-semibold hover:text-primary-dark">
            Lihat semua
        </a>
    </div>

    @if($transaksi_terbaru->count())
        <div class="space-y-3">
            @foreach($transaksi_terbaru as $transaksi)
                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ $transaksi->tipe == 'pemasukan' ? 'bg-accent-blue/20' : 'bg-red-100' }}">
                            @if($transaksi->tipe == 'pemasukan')
                                <svg class="w-5 h-5 text-accent-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-sm text-neutral-text">{{ $transaksi->kategori }}</p>
                            <p class="text-xs text-neutral-text-secondary">{{ $transaksi->tanggal->format('d M Y') }}</p>
                        </div>
                    </div>
                    <p class="font-bold {{ $transaksi->tipe == 'pemasukan' ? 'text-accent-blue' : 'text-red-500' }}">
                        {{ $transaksi->tipe == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-neutral-text-secondary text-sm">Belum ada transaksi</p>
            <a href="{{ route('transaksi.create') }}" class="text-primary text-xs font-semibold mt-2 inline-block hover:text-primary-dark">
                Buat transaksi pertama Anda
            </a>
        </div>
    @endif
</div>

<!-- Add Transaction Button -->
<div class="fixed bottom-32 right-6">
    <a href="{{ route('transaksi.create') }}" class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-primary to-primary-dark text-white shadow-lg hover:shadow-xl transition-all hover:scale-110">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
    </a>
</div>
@endsection
