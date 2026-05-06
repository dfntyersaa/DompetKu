@extends('layouts.main')

@section('title', 'Budget - DompetKu')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-neutral-text">Budget Bulanan</h1>
    <p class="text-neutral-text-secondary text-sm">Kelola budget Anda untuk bulan {{ now()->locale('id')->format('F Y') }}</p>
</div>

<!-- Budget Summary Card -->
@if($budget)
    <div class="card mb-6 bg-gradient-to-br from-primary to-primary-dark text-white shadow-lg">
        <p class="text-sm font-medium opacity-90 mb-1">Total Budget</p>
        <h2 class="text-3xl font-bold mb-4">Rp {{ number_format($budget->jumlah, 0, ',', '.') }}</h2>
        
        <div class="mb-4">
            <div class="flex justify-between items-center mb-2 text-sm">
                <span class="opacity-90">Pengeluaran: Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
                <span class="font-bold">{{ min($persentase, 100) }}%</span>
            </div>
            <div class="w-full h-3 bg-white/30 rounded-full overflow-hidden">
                <div class="h-full transition-all duration-300 bg-white" style="width: {{ min($persentase, 100) }}%;"></div>
            </div>
        </div>

        <div class="bg-white/20 rounded-lg p-3">
            <p class="text-xs font-medium opacity-80">Sisa Budget</p>
            <p class="text-2xl font-bold">Rp {{ number_format(max(0, $budget->jumlah - $totalPengeluaran), 0, ',', '.') }}</p>
        </div>

        @if($persentase > 100)
            <p class="text-xs mt-3 opacity-90">⚠️ Budget telah terlampaui!</p>
        @elseif($persentase > 80)
            <p class="text-xs mt-3 opacity-90">⚡ Budget hampir habis, berhati-hatilah!</p>
        @endif
    </div>

    <!-- Edit Budget Form -->
    <div class="card mb-6">
        <h3 class="font-semibold text-neutral-text mb-4">Ubah Budget</h3>
        <form action="{{ route('budget.update', $budget) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')
            
            <div class="flex gap-2">
                <div class="relative flex-1">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-text-secondary font-semibold">Rp</span>
                    <input
                        type="number"
                        name="jumlah"
                        class="input-field pl-12"
                        placeholder="0"
                        step="0.01"
                        min="0"
                        value="{{ $budget->jumlah }}"
                        required
                    >
                </div>
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-semibold px-6 rounded-xl transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Delete Budget -->
    <form action="{{ route('budget.destroy', $budget) }}" method="POST" class="mb-6">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Hapus budget ini?')" class="w-full py-3 bg-red-50 text-red-500 font-semibold rounded-xl hover:bg-red-100 transition">
            Hapus Budget
        </button>
    </form>
@else
    <div class="card mb-6">
        <h3 class="font-semibold text-neutral-text mb-4">Buat Budget Bulan Ini</h3>
        <form action="{{ route('budget.store') }}" method="POST" class="space-y-3">
            @csrf
            
            <div>
                <label for="jumlah" class="block text-sm font-semibold text-neutral-text mb-2">Jumlah Budget</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-text-secondary font-semibold">Rp</span>
                    <input
                        type="number"
                        id="jumlah"
                        name="jumlah"
                        class="input-field pl-12"
                        placeholder="0"
                        step="0.01"
                        min="0"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn-primary-lg">
                Buat Budget
            </button>
        </form>
    </div>
@endif

<!-- Budget Information -->
<div class="card">
    <h3 class="font-semibold text-neutral-text mb-4">Informasi Budget</h3>
    
    <div class="space-y-3">
        <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
            <div class="w-8 h-8 rounded-lg bg-accent-blue/20 flex items-center justify-center flex-shrink-0 mt-1">
                <svg class="w-4 h-4 text-accent-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-sm text-neutral-text">Apa itu Budget?</p>
                <p class="text-xs text-neutral-text-secondary mt-1">Budget adalah rencana pengeluaran bulanan Anda. Pantau progress untuk mengontrol keuangan dengan lebih baik.</p>
            </div>
        </div>

        <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
            <div class="w-8 h-8 rounded-lg bg-accent-yellow/20 flex items-center justify-center flex-shrink-0 mt-1">
                <svg class="w-4 h-4 text-accent-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-sm text-neutral-text">Pantau Progress</p>
                <p class="text-xs text-neutral-text-secondary mt-1">Progress bar akan berubah warna berdasarkan kondisi pengeluaran Anda.</p>
            </div>
        </div>

        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0 mt-1">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2M6.75 7.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM17.25 13.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-sm text-neutral-text">Kendali Pengeluaran</p>
                <p class="text-xs text-neutral-text-secondary mt-1">Tetapkan batas pengeluaran dan hindari pengeluaran berlebihan setiap bulannya.</p>
            </div>
        </div>
    </div>
</div>
@endsection
