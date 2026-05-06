@extends('layouts.main')

@section('title', 'Tambah Transaksi - DompetKu')

@section('content')
<!-- Header -->
<div class="mb-6 md:mb-8">
    <a href="{{ route('transaksi.index') }}" class="text-primary font-semibold text-sm hover:text-primary-dark mb-3 inline-flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali
    </a>
    <h1 class="text-3xl md:text-4xl font-bold text-neutral-text">Tambah Transaksi</h1>
</div>

<div class="card max-w-2xl mx-auto">
    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Tipe Toggle -->
        <div>
            <label class="block text-sm font-semibold text-neutral-text mb-3">Tipe Transaksi</label>
            <div class="grid grid-cols-2 gap-3">
                <label class="relative cursor-pointer">
                    <input type="radio" name="tipe" value="pemasukan" class="sr-only peer" checked>
                    <div class="peer-checked:bg-accent-blue peer-checked:text-white peer-checked:border-accent-blue border-2 border-gray-200 rounded-xl p-3 md:p-4 text-center font-semibold transition">
                        <svg class="w-5 h-5 md:w-6 md:h-6 mx-auto mb-1 md:mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="text-sm md:text-base">Pemasukan</span>
                    </div>
                </label>
                <label class="relative cursor-pointer">
                    <input type="radio" name="tipe" value="pengeluaran" class="sr-only peer">
                    <div class="peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 border-2 border-gray-200 rounded-xl p-3 md:p-4 text-center font-semibold transition">
                        <svg class="w-5 h-5 md:w-6 md:h-6 mx-auto mb-1 md:mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="text-sm md:text-base">Pengeluaran</span>
                    </div>
                </label>
            </div>
            @error('tipe')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori -->
        <div>
            <label for="kategori" class="block text-sm font-semibold text-neutral-text mb-3">Kategori</label>
            <input type="hidden" id="kategori" name="kategori" value="{{ old('kategori', 'Gaji') }}" required>
            <div id="kategoriContainer" class="grid grid-cols-2 sm:grid-cols-3 gap-2">
            </div>
            @error('kategori')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
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
                    placeholder="10000"
                    step="1"
                    min="0"
                    value="{{ old('jumlah') }}"
                    required
                >
            </div>
            @error('jumlah')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggal -->
        <div>
            <label for="tanggal" class="block text-sm font-semibold text-neutral-text mb-2">Tanggal</label>
            <input
                type="date"
                id="tanggal"
                name="tanggal"
                class="input-field w-full"
                value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                required
            >
            @error('tanggal')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-sm font-semibold text-neutral-text mb-2">Deskripsi (Opsional)</label>
            <textarea
                id="deskripsi"
                name="deskripsi"
                class="input-field resize-none"
                rows="4"
                placeholder="Tulis catatan atau keterangan..."
            >{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="grid grid-cols-2 gap-3 pt-6 border-t border-gray-200">
            <a href="{{ route('transaksi.index') }}" class="text-center py-3 px-4 bg-gray-100 text-neutral-text font-semibold rounded-xl hover:bg-gray-200 transition text-sm md:text-base">
                Batal
            </a>
            <button type="submit" class="py-3 px-4 bg-primary text-white font-semibold rounded-xl hover:bg-primary-dark transition text-sm md:text-base">
                Simpan
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
            button.className = kategoriInput.value === cat ? 'bg-primary text-white rounded-lg px-3 py-2 md:px-4 md:py-3 font-semibold text-xs md:text-sm transition' : 'border-2 border-gray-200 rounded-lg px-3 py-2 md:px-4 md:py-3 font-semibold text-xs md:text-sm hover:border-primary transition';
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
                btn.className = 'bg-primary text-white rounded-lg px-3 py-2 md:px-4 md:py-3 font-semibold text-xs md:text-sm transition';
            } else {
                btn.className = 'border-2 border-gray-200 rounded-lg px-3 py-2 md:px-4 md:py-3 font-semibold text-xs md:text-sm hover:border-primary transition';
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
