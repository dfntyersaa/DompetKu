# DompetKu - Smart Finance Tracker

**DompetKu** adalah aplikasi fullstack **Smart Finance Tracker** yang dirancang dengan desain modern, clean, dan mobile-first. Aplikasi ini membantu Anda mengelola keuangan pribadi dengan mudah dan intuitif.

## Fitur Utama

- **Dashboard Interaktif** - Lihat ringkasan keuangan Anda dalam satu tempat
- **Manajemen Transaksi** - Tambah, edit, dan hapus transaksi dengan mudah
- **Tracking Budget** - Kelola budget bulanan dan pantau progress pengeluaran
- **Statistik Real-time** - Visualisasi data pemasukan dan pengeluaran
- **Desain Mobile-First** - Responsif dan nyaman diakses dari berbagai device
- **Autentikasi Pengguna** - Login dan register yang aman

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Blade Template + Tailwind CSS
- **Database**: SQLite (Default)
- **Authentication**: Laravel Built-in Auth

## Navigasi Aplikasi

### Bottom Navigation
- **Dashboard** - Halaman utama dengan ringkasan finansial
- **Transaksi** - Kelola semua transaksi Anda
- **Budget** - Atur dan pantau budget bulanan
- **Profil** - Informasi user dan logout

## Halaman & Fitur

### 1. Login & Register
- Form login dan register yang clean
- Validasi input yang ketat
- Password encryption dengan hashing

### 2. Dashboard
- Total saldo (Pemasukan - Pengeluaran)
- Statistik pemasukan dan pengeluaran bulan ini
- Info budget bulan ini dengan progress bar
- Transaksi terbaru (5 item)
- Floating action button untuk tambah transaksi

### 3. Transaksi
- Daftar semua transaksi (paginated)
- Fitur pencarian dan filter
- Tambah transaksi baru
  - Toggle tipe (Pemasukan/Pengeluaran)
  - Pilih kategori atau custom
  - Input jumlah, tanggal, dan deskripsi
- Edit transaksi
- Hapus transaksi

### 4. Budget
- Lihat budget bulanan
- Create/Update budget
- Progress bar dengan warna dinamis:
  - 🟢 Hijau: Budget aman (< 80%)
  - 🟡 Kuning: Budget hampir habis (80-100%)
  - 🔴 Merah: Budget terlampaui (> 100%)
- Info dan tips budget

## Fitur Kalkulasi

### Total Saldo
```
Total Saldo = SUM(Pemasukan) - SUM(Pengeluaran)
```

### Budget Status
```
Sisa Budget = Total Budget - SUM(Pengeluaran Bulan Ini)
Persentase = (SUM(Pengeluaran Bulan Ini) / Total Budget) * 100
```

## Tips Penggunaan

1. **Pertama kali login** - Jangan lupa buat budget untuk bulan ini
2. **Tracking detail** - Tambahkan deskripsi pada setiap transaksi penting
3. **Review rutin** - Periksa dashboard setiap hari untuk awareness finansial
4. **Budget planning** - Sesuaikan budget dengan penghasilan dan kebutuhan Anda

## Support

Untuk pertanyaan atau bug report, hubungi tim developer.

---

