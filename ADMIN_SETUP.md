# Admin Role & Monitoring Setup - DompetKu App

## 📋 Ringkasan Setup

Setup database dengan role admin dan fitur monitoring telah berhasil dibuat dengan data dummy lengkap.

## 👤 Akun yang Tersedia

### Admin Account
- **Email**: admin@example.com
- **Password**: admin123
- **Role**: admin
- **Fungsi**: Monitoring user, kelola username

### User Accounts (Regular)
1. **Demo User** - demo@example.com / demo123
2. **John Doe** - john@example.com / john123
3. **Jane Smith** - jane@example.com / jane123
4. **Budi Rahman** - budi@example.com / budi123
5. **Siti Nurhaliza** - siti@example.com / siti123

## 📊 Fitur Admin

### 1. Admin Dashboard (`/admin/dashboard`)
Admin dapat melihat:
- **Total Users**: Jumlah total user biasa (regular users)
- **Online Users**: Jumlah user yang aktif dalam 30 menit terakhir
- **Offline Users**: Jumlah user yang tidak aktif
- **User Activity List**: Daftar user dengan status online/offline dan last activity

### 2. User Management (`/admin/users`)
Admin dapat:
- Mencari user berdasarkan nama atau email
- Melihat status online/offline setiap user
- **Edit Username**: Mengubah nama user (penting untuk manajemen)

### 3. Real-time Activity Tracking
- Setiap kali user melakukan request, `last_activity` diupdate otomatis
- User dianggap **Online** jika `last_activity` dalam 30 menit terakhir
- User dianggap **Offline** jika tidak ada aktivitas lebih dari 30 menit

## 🗄️ Database Structure

### Tabel Users (Modified)
```sql
- id: int (primary key)
- name: string
- email: string (unique)
- password: string (hashed)
- role: enum('user', 'admin') - default: 'user'
- last_activity: timestamp (nullable)
- email_verified_at: timestamp
- remember_token: string
- created_at: timestamp
- updated_at: timestamp
```

### Tabel User Logins (New)
```sql
- id: int (primary key)
- user_id: foreign key → users.id
- login_at: timestamp
- logout_at: timestamp (nullable)
- ip_address: string (nullable)
- user_agent: string (nullable)
- created_at: timestamp
- updated_at: timestamp
```

## 🔐 Authorization & Middleware

### AdminPolicy (`app/Policies/AdminPolicy.php`)
Menghandle authorization untuk:
- `viewDashboard()`: Hanya admin
- `manageUsers()`: Hanya admin
- `updateUsername()`: Hanya admin
- `viewUserDetails()`: Hanya admin

### Middleware
1. **TrackUserActivity** (`app/Http/Middleware/TrackUserActivity.php`)
   - Otomatis update `last_activity` pada setiap request

2. **IsAdmin** (`app/Http/Middleware/IsAdmin.php`)
   - Proteksi routes admin dari akses user biasa

## 🛣️ Routes

```php
// Admin Dashboard
GET /admin/dashboard                    → AdminController@dashboard

// User Management
GET /admin/users                        → AdminController@users
PUT /admin/users/{user}                 → AdminController@updateUsername

// API Endpoints
GET /admin/api/online-count            → AdminController@getOnlineCount
GET /admin/api/total-count             → AdminController@getTotalCount
POST /admin/api/update-activity        → AdminController@updateActivity
```

## 📁 File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── AdminController.php         (NEW)
│   └── Middleware/
│       ├── TrackUserActivity.php       (NEW)
│       └── IsAdmin.php                 (NEW)
├── Models/
│   ├── User.php                        (MODIFIED)
│   └── UserLogin.php                   (NEW)
└── Policies/
    └── AdminPolicy.php                 (NEW)

database/
├── migrations/
│   ├── 2026_05_04_000001_add_role_to_users_table.php      (NEW)
│   └── 2026_05_04_000002_create_user_logins_table.php     (NEW)
└── seeders/
    └── DemoSeeder.php                  (MODIFIED)

resources/views/
└── admin/                               (NEW)
    ├── dashboard.blade.php              (NEW)
    └── users.blade.php                  (NEW)

routes/
└── web.php                              (MODIFIED)
```

## 🧪 Testing

Untuk menjalankan aplikasi:

```bash
# Install dependencies (jika belum)
composer install
npm install

# Jalankan server
php artisan serve

# Atau dengan Vite
npm run dev  # Di terminal lain
```

Kemudian akses:
- Admin Dashboard: http://localhost:8000/admin/dashboard (login dengan admin@example.com)
- Regular Dashboard: http://localhost:8000/dashboard (login dengan user biasa)

## 📝 Model Methods

### User Model Methods

```php
// Check if user is admin
$user->isAdmin()          // Returns: boolean

// Check if user is online (dalam 30 menit terakhir)
$user->isOnline()         // Returns: boolean

// Get all user logins
$user->logins()           // Returns: Relation
```

## 🔄 Data Summary

- Total Users: 6 (1 admin + 5 regular users)
- Total Transaksi: 50 (10 per user)
- Total Budget: 5 (1 per regular user)

## ✨ Fitur Unggulan

1. **Real-time Activity Tracking**: Memantau aktivitas user secara real-time
2. **Online Status**: User dapat dilihat status online/offline mereka
3. **Username Management**: Admin dapat mengelola/mengubah username user
4. **Search Feature**: Admin dapat mencari user berdasarkan nama atau email
5. **Pagination**: Daftar user menggunakan pagination untuk performa lebih baik
6. **Last Activity Info**: Menampilkan kapan terakhir user aktif
7. **Responsive UI**: Interface yang responsif dan user-friendly

## 🚀 Next Steps (Optional)

Untuk pengembangan lebih lanjut, Anda bisa:
- Tambahkan role 'moderator' atau roles lainnya
- Implementasi session tracking dengan UserLogin model
- Tambahkan export/import user features
- Implementasi user statistics dan analytics
- Tambahkan audit logs untuk aktivitas admin
- Implementasi real-time notifications menggunakan WebSocket (Laravel Echo)

---

**Setup Selesai! Database siap digunakan dengan admin role dan fitur monitoring.** ✅
