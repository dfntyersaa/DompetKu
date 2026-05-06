@extends('layouts.main')

@section('title', 'Transaksi - DompetKu')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-neutral-text">Transaksi</h1>
    <p class="text-neutral-text-secondary text-sm">Kelola semua transaksi Anda</p>
</div>

<!-- Add Button -->
<a href="{{ route('transaksi.create') }}" class="btn-primary-lg mb-6 inline-block">
    + Tambah Transaksi
</a>

<!-- Transaksi List -->
@if($transaksi->count())
    <div class="space-y-3">
        @foreach($transaksi as $item)
            <div class="card hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ $item->tipe == 'pemasukan' ? 'bg-accent-blue/20' : 'bg-red-100' }}">
                            @if($item->tipe == 'pemasukan')
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
                            <p class="font-semibold text-neutral-text">{{ $item->kategori }}</p>
                            <p class="text-xs text-neutral-text-secondary">{{ $item->tanggal->format('d M Y') }}</p>
                            @if($item->deskripsi)
                                <p class="text-xs text-neutral-text-secondary mt-1">{{ Str::limit($item->deskripsi, 50) }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-lg {{ $item->tipe == 'pemasukan' ? 'text-accent-blue' : 'text-red-500' }}">
                            {{ $item->tipe == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('transaksi.edit', $item) }}" class="flex-1 text-center py-2 text-sm font-semibold text-primary bg-primary/10 hover:bg-primary/20 rounded-lg transition">
                        Edit
                    </a>
                    <form action="{{ route('transaksi.destroy', $item) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="w-full py-2 text-sm font-semibold text-red-500 bg-red-50 hover:bg-red-100 rounded-lg transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($transaksi->hasPages())
        <div class="mt-6">
            {{ $transaksi->links() }}
        </div>
    @endif
@else
    <div class="card text-center py-12">
        <svg class="w-12 h-12 text-neutral-text-secondary mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <p class="text-neutral-text-secondary font-medium">Belum ada transaksi</p>
        <a href="{{ route('transaksi.create') }}" class="text-primary text-sm font-semibold mt-3 inline-block hover:text-primary-dark">
            Buat transaksi pertama Anda
        </a>
    </div>
@endif
@endsection
