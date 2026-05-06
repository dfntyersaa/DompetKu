# 🔐 Admin Credentials & Quick Start

## Login Credentials

### Admin Account
```
Email: admin@example.com
Password: admin123
```

### Regular Users (untuk testing)
```
1. demo@example.com / demo123
2. john@example.com / john123
3. jane@example.com / jane123
4. budi@example.com / budi123
5. siti@example.com / siti123
```

## 🚀 Quick Access

Setelah login dengan akun admin:

| Fitur | URL | Deskripsi |
|-------|-----|-----------|
| Admin Dashboard | `/admin/dashboard` | Lihat statistik user online/offline |
| Manage Users | `/admin/users` | Kelola username dan lihat status user |
| Search User | `/admin/users?search=nama` | Cari user berdasarkan nama/email |

## 📊 Admin Dashboard Features

### Status Display
- **Total Users**: Jumlah seluruh user biasa
- **Online Users**: User dengan aktivitas dalam 30 menit terakhir
- **Offline Users**: User tanpa aktivitas lebih dari 30 menit

### User Management
- Lihat semua user dengan status online/offline
- Lihat kapan terakhir user aktif
- Edit/ubah username user
- Search dan filter user

## 🔄 How It Works

1. **Activity Tracking**: Setiap request dari user akan update `last_activity` mereka
2. **Online Status**: Sistem otomatis menentukan online/offline berdasarkan 30 menit terakhir
3. **Username Management**: Admin bisa mengubah nama user melalui modal edit
4. **Real-time Updates**: Status user terupdate secara real-time

## 🛠️ Testing Scenarios

### Scenario 1: Monitor Online Users
1. Login dengan admin account
2. Buka `/admin/dashboard`
3. Lihat "Online Users" dan "Offline Users" counter
4. Lihat daftar user dengan status mereka

### Scenario 2: Edit User Username
1. Login dengan admin account
2. Buka `/admin/users`
3. Klik button "Edit" pada user yang ingin diubah
4. Ubah username baru
5. Klik "Simpan"

### Scenario 3: Search User
1. Login dengan admin account
2. Buka `/admin/users`
3. Input nama atau email di search box
4. Klik "Cari"
5. Hasil akan difilter sesuai pencarian

## 📱 API Endpoints (untuk frontend integration)

Admin bisa mengakses API endpoints ini:

```javascript
// Get online users count
GET /admin/api/online-count
Response: { "online": 2 }

// Get total users count
GET /admin/api/total-count
Response: { "total": 5 }

// Update user activity
POST /admin/api/update-activity
Response: { "success": true }
```

## 🔐 Security

- Admin routes dilindungi middleware `IsAdmin`
- Hanya user dengan role 'admin' yang bisa akses
- User biasa akan dapat error 403 jika mencoba akses admin routes
- Authorization dicheck menggunakan AdminPolicy

## 📝 Database Info

- **SQLite** database (database.sqlite)
- **6 users**: 1 admin + 5 regular users
- **50 transaksi**: Dummy data untuk testing
- **5 budgets**: 1 per user (regular users)

---

**Siap untuk digunakan! Happy testing! 🎉**
