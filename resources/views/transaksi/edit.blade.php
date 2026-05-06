@extends('layouts.main')

@section('title', 'Edit Transaksi - DompetKu')

@section('content')
<div class="mb-6">
    <a href="{{ route('transaksi.index') }}" class="text-primary font-semibold text-sm hover:text-primary-dark mb-3 inline-block">
        ← Kembali
    </a>
    <h1 class="text-2xl font-bold text-neutral-text">Edit Transaksi</h1>
</div>

<div class="card">
    <form action="{{ route('transaksi.update', $transaksi) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Tipe Toggle -->
        <div>
            <label class="block text-sm font-semibold text-neutral-text mb-3">Tipe Transaksi</label>
            <div class="grid grid-cols-2 gap-3">
                <label class="relative">
                    <input type="radio" name="tipe" value="pemasukan" class="sr-only peer" {{ $transaksi->tipe == 'pemasukan' ? 'checked' : '' }}>
                    <div class="peer-checked:bg-accent-blue peer-checked:text-white peer-checked:border-accent-blue border-2 border-gray-200 rounded-xl p-3 text-center cursor-pointer font-semibold transition">
                        <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Pemasukan
                    </div>
                </label>
                <label class="relative">
                    <input type="radio" name="tipe" value="pengeluaran" class="sr-only peer" {{ $transaksi->tipe == 'pengeluaran' ? 'checked' : '' }}>
                    <div class="peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 border-2 border-gray-200 rounded-xl p-3 text-center cursor-pointer font-semibold transition">
                        <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Pengeluaran
                    </div>
                </label>
            </div>
            @error('tipe')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori -->
        <div>
            <label for="kategori" class="block text-sm font-semibold text-neutral-text mb-2">Kategori</label>
            <input type="hidden" id="kategori" name="kategori" value="{{ old('kategori', $transaksi->kategori) }}" required>
            <div id="kategoriContainer" class="grid grid-cols-2 gap-2">
            </div>
            @error('kategori')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Jumlah -->
        <div>
            <label for="jumlah" class="block text-sm font-semibold text-neutral-text mb-2">Jumlah</label>
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
                    value="{{ old('jumlah', $transaksi->jumlah) }}"
                    required
                >
            </div>
            @error('jumlah')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggal -->
        <div>
            <label for="tanggal" class="block text-sm font-semibold text-neutral-text mb-2">Tanggal</label>
            <input
                type="date"
                id="tanggal"
                name="tanggal"
                class="input-field"
                value="{{ old('tanggal', $transaksi->tanggal->format('Y-m-d')) }}"
                required
            >
            @error('tanggal')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-sm font-semibold text-neutral-text mb-2">Deskripsi (Opsional)</label>
            <textarea
                id="deskripsi"
                name="deskripsi"
                class="input-field resize-none"
                rows="3"
                placeholder="Tulis catatan..."
            >{{ old('deskripsi', $transaksi->deskripsi) }}</textarea>
            @error('deskripsi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="grid grid-cols-2 gap-3 pt-4">
            <a href="{{ route('transaksi.index') }}" class="text-center py-3 bg-gray-100 text-neutral-text font-semibold rounded-xl hover:bg-gray-200 transition">
                Batal
            </a>
            <button type="submit" class="btn-primary-lg">
                Update
            </button>
        </div>
    </form>
</div>

<script>
    const tipeRadios = document.querySelectorAll('input[name="tipe"]');
    const kategoriContainer = document.getElementById('kategoriContainer');
    const kategoriInput = document.getElementById('kategori');
    const kategoriCustom = document.getElementById('kategoriCustom');

    const categories = {
        pemasukan: ['Gaji', 'Bonus', 'Investasi', 'Lainnya'],
        pengeluaran: ['Makanan', 'Transportasi', 'Hiburan', 'Tagihan', 'Lainnya']
    };

    function updateKategori() {
        const tipe = document.querySelector('input[name="tipe"]:checked').value;
        kategoriContainer.innerHTML = '';
        
        // Reset ke kategori pertama saat tipe berubah
        kategoriInput.value = categories[tipe][0];
        
        categories[tipe].forEach(cat => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = kategoriInput.value === cat ? 'bg-primary text-white rounded-lg p-2 font-semibold text-sm' : 'border-2 border-gray-200 rounded-lg p-2 font-semibold text-sm hover:border-primary transition';
            button.textContent = cat;
            button.onclick = (e) => {
                e.preventDefault();
                kategoriInput.value = cat;
                updateButtonStyles();
            };
            kategoriContainer.appendChild(button);
        });
        updateButtonStyles();
    }

    function updateButtonStyles() {
        const buttons = kategoriContainer.querySelectorAll('button');
        buttons.forEach(btn => {
            if (btn.textContent === kategoriInput.value) {
                btn.className = 'bg-primary text-white rounded-lg p-2 font-semibold text-sm';
            } else {
                btn.className = 'border-2 border-gray-200 rounded-lg p-2 font-semibold text-sm hover:border-primary transition';
            }
        });
    }

    tipeRadios.forEach(radio => {
        radio.addEventListener('change', updateKategori);
    });

    // Initial load
    updateKategori();
</script>
@endsection
