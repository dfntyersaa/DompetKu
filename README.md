# DompetKu - Smart Finance Tracker

**DompetKu** adalah aplikasi fullstack **Smart Finance Tracker** yang dirancang dengan desain modern, clean, dan mobile-first. Aplikasi ini membantu Anda mengelola keuangan pribadi dengan mudah dan intuitif.

## 🎨 Fitur Utama

- **Dashboard Interaktif** - Lihat ringkasan keuangan Anda dalam satu tempat
- **Manajemen Transaksi** - Tambah, edit, dan hapus transaksi dengan mudah
- **Tracking Budget** - Kelola budget bulanan dan pantau progress pengeluaran
- **Statistik Real-time** - Visualisasi data pemasukan dan pengeluaran
- **Desain Mobile-First** - Responsif dan nyaman diakses dari berbagai device
- **Autentikasi Pengguna** - Login dan register yang aman

## 🛠️ Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Blade Template + Tailwind CSS
- **Database**: SQLite (Default)
- **Authentication**: Laravel Built-in Auth

## 📋 Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- SQLite (atau database lain)

## 🚀 Instalasi & Setup

### 1. Clone Project
```bash
cd d:\PERKODINGAN\ DUNIAWI\Kuliah\Semester\ 4\Pemweb
cd DompetKu-App
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup
```bash
php artisan migrate
php artisan db:seed --class=DemoSeeder
```

### 5. Build Assets
```bash
npm run build
```

### 6. Jalankan Server
```bash
php artisan serve
```

Server akan berjalan di `http://127.0.0.1:8000`

## 👤 Demo Account

Setelah menjalankan seeder, gunakan akun demo ini:

- **Email**: demo@example.com
- **Password**: demo123

## 📱 Navigasi Aplikasi

### Bottom Navigation
- **Dashboard** - Halaman utama dengan ringkasan finansial
- **Transaksi** - Kelola semua transaksi Anda
- **Budget** - Atur dan pantau budget bulanan
- **Profil** - Informasi user dan logout

## 🎯 Halaman & Fitur

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

## 🎨 Desain & UI

### Warna Palet
- **Primary**: #2EC4B6 (Hijau Teal)
- **Primary Dark**: #1FA39A (Hijau Teal Gelap)
- **Accent Yellow**: #FFE66D
- **Accent Blue**: #4D96FF
- **Background**: #F8FAFC
- **Card**: #FFFFFF

### Typography
- Font: Poppins, Inter
- Heading: Semi-bold / Bold
- Body: Regular

### Komponen
- Card: `rounded-2xl`, `shadow-md`, `bg-white`
- Button: `rounded-xl`, gradient hover effects
- Input: `rounded-xl`, focus ring style
- Progress Bar: Dynamic width & color

## 📊 Database Schema

### Users Table
- id, name, email, password, email_verified_at, created_at, updated_at

### Transaksis Table
- id, user_id (FK), tipe, kategori, jumlah, deskripsi, tanggal, timestamps

### Budgets Table
- id, user_id (FK), jumlah, bulan, tahun, timestamps

## 🔐 Authorization & Security

- **Policies**: TransaksiPolicy, BudgetPolicy
- User hanya bisa melihat/edit data mereka sendiri
- CSRF Protection
- Password hashing dengan bcrypt

## 💡 Fitur Kalkulasi

### Total Saldo
```
Total Saldo = SUM(Pemasukan) - SUM(Pengeluaran)
```

### Budget Status
```
Sisa Budget = Total Budget - SUM(Pengeluaran Bulan Ini)
Persentase = (SUM(Pengeluaran Bulan Ini) / Total Budget) * 100
```

## 🔄 Development Workflow

### Asset Building
```bash
# Development mode dengan hot reload
npm run dev

# Production build
npm run build
```

### Database Commands
```bash
# Jalankan migrations
php artisan migrate

# Seed demo data
php artisan db:seed --class=DemoSeeder

# Fresh database
php artisan migrate:fresh --seed
```

## 📁 Struktur Project

```
DompetKu-App/
├── app/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   ├── TransaksiController.php
│   │   └── BudgetController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Transaksi.php
│   │   └── Budget.php
│   └── Policies/
│       ├── TransaksiPolicy.php
│       └── BudgetPolicy.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   └── main.blade.php
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   ├── transaksi/
│   │   ├── budget/
│   │   └── dashboard.blade.php
│   └── css/
│       └── app.css
├── routes/
│   └── web.php
└── database/
    ├── migrations/
    └── seeders/
        └── DemoSeeder.php
```

## 🎯 Tips Penggunaan

1. **Pertama kali login** - Jangan lupa buat budget untuk bulan ini
2. **Tracking detail** - Tambahkan deskripsi pada setiap transaksi penting
3. **Review rutin** - Periksa dashboard setiap hari untuk awareness finansial
4. **Budget planning** - Sesuaikan budget dengan penghasilan dan kebutuhan Anda

## 📞 Support

Untuk pertanyaan atau bug report, hubungi tim developer.

---

**Dikembangkan dengan ❤️ untuk mengelola keuangan Anda dengan lebih baik.**

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
