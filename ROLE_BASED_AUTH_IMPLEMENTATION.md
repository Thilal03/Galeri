# Role-Based Authentication Implementation

## Overview

Sistem autentikasi berbasis role telah berhasil diimplementasikan pada Laravel 11 Galeri Foto dengan 2 role: **Admin** dan **User**.

## 🎯 Fitur yang Diimplementasikan

### 1. **Database Migration**

- ✅ Kolom `role` ditambahkan ke tabel `users` (enum: 'admin', 'user')
- ✅ Default role untuk user baru: `user`
- ✅ User yang sudah ada otomatis di-set sebagai `admin`

**File:** `database/migrations/2026_02_26_075014_add_role_to_users_table.php`

### 2. **Registrasi User**

- ✅ RegisterController dengan validasi lengkap
- ✅ Form registrasi dengan field: name, email, password, password_confirmation
- ✅ Validasi: name required, email unique, password min 8 chars
- ✅ Redirect ke login setelah registrasi berhasil

**Files:**

- `app/Http/Controllers/Auth/RegisterController.php`
- `resources/views/auth/register.blade.php`

**Routes:**

- `GET /register` - Tampilkan form registrasi
- `POST /register` - Proses registrasi

### 3. **Middleware Admin**

- ✅ Middleware `IsAdmin` untuk proteksi route admin
- ✅ Redirect ke galeri index dengan error message jika non-admin mencoba akses
- ✅ Registered sebagai alias `admin` di bootstrap/app.php

**File:** `app/Http/Middleware/IsAdmin.php`

### 4. **Route Protection**

#### **Public Routes (Tidak perlu login):**

- `/` - Homepage
- `/login` - Login page
- `/register` - Register page

#### **Authenticated Routes (Perlu login, semua user):**

- `/galeri` - View semua galeri
- `/galeri/{slug}` - View detail galeri
- `/guru` - View semua guru (read-only untuk user)
- `/guru/{id}` - View detail guru
- `/siswa` - View semua siswa (read-only untuk user)
- `/siswa/{id}` - View detail siswa

#### **Admin Only Routes (Perlu login + role admin):**

- `/admin/galeri/*` - CRUD galeri
- `/guru/create` - Create guru
- `/guru/{id}/edit` - Edit guru
- `/guru/{id}/update` - Update guru
- `/guru/{id}/delete` - Delete guru
- `/siswa/create` - Create siswa
- `/siswa/{id}/edit` - Edit siswa
- `/siswa/{id}/update` - Update siswa
- `/siswa/{id}/delete` - Delete siswa

**File:** `routes/web.php`

### 5. **Blade Template Updates**

#### **Guru Index (`resources/views/guru/index.blade.php`):**

- ✅ Tombol "Tambah Guru" hanya muncul untuk admin
- ✅ Tombol Edit & Delete hanya muncul untuk admin
- ✅ Text deskripsi berubah sesuai role (Kelola vs Lihat)

#### **Siswa Index (`resources/views/siswa/index.blade.php`):**

- ✅ Tombol "Tambah Siswa" hanya muncul untuk admin
- ✅ Tombol Edit & Delete hanya muncul untuk admin
- ✅ Text deskripsi berubah sesuai role (Kelola vs Lihat)

#### **Admin Layout (`resources/views/layouts/admin.blade.php`):**

- ✅ Global error message display untuk unauthorized access

#### **Login Page (`resources/views/auth/login.blade.php`):**

- ✅ Success message display untuk registrasi berhasil
- ✅ Link ke halaman register

### 6. **User Model Update**

- ✅ Field `role` ditambahkan ke `$fillable`

**File:** `app/Models/User.php`

## 🔐 Cara Kerja Sistem

### **Flow Registrasi:**

1. User mengakses `/register`
2. Mengisi form (name, email, password, password_confirmation)
3. Data divalidasi
4. User dibuat dengan role `user` (default)
5. Redirect ke `/login` dengan success message

### **Flow Login:**

1. User login dengan email & password
2. Sistem cek kredensial
3. Jika berhasil, user diarahkan ke dashboard sesuai role

### **Flow Akses Admin:**

1. User mencoba akses route admin (misal: `/guru/create`)
2. Middleware `auth` cek apakah user sudah login
3. Middleware `admin` cek apakah user memiliki role `admin`
4. Jika bukan admin, redirect ke `/galeri` dengan error message
5. Jika admin, akses diberikan

### **Flow Akses User Biasa:**

1. User login dan mengakses route yang diizinkan (misal: `/guru`)
2. Middleware `auth` cek apakah user sudah login
3. Akses diberikan untuk view data
4. Tombol create/edit/delete tidak muncul di UI

## 📝 Testing Checklist

### **Test sebagai Admin:**

- [ ] Login dengan akun admin
- [ ] Akses `/admin/galeri` - Harus bisa
- [ ] Akses `/guru/create` - Harus bisa
- [ ] Akses `/siswa/create` - Harus bisa
- [ ] Lihat tombol Edit & Delete di `/guru` - Harus muncul
- [ ] Lihat tombol Edit & Delete di `/siswa` - Harus muncul

### **Test sebagai User Biasa:**

- [ ] Register akun baru (otomatis role: user)
- [ ] Login dengan akun user
- [ ] Akses `/galeri` - Harus bisa
- [ ] Akses `/guru` - Harus bisa (read-only)
- [ ] Akses `/siswa` - Harus bisa (read-only)
- [ ] Akses `/guru/create` - Harus redirect dengan error
- [ ] Akses `/admin/galeri` - Harus redirect dengan error
- [ ] Lihat tombol Edit & Delete di `/guru` - Tidak muncul
- [ ] Lihat tombol Edit & Delete di `/siswa` - Tidak muncul

### **Test Registrasi:**

- [ ] Akses `/register`
- [ ] Submit form dengan data valid
- [ ] Harus redirect ke `/login` dengan success message
- [ ] Login dengan akun baru
- [ ] Cek role di database harus `user`

## 🛠️ Cara Mengubah Role User

### **Via Tinker:**

```bash
php artisan tinker
```

```php
// Ubah user menjadi admin
$user = User::where('email', 'user@example.com')->first();
$user->role = 'admin';
$user->save();

// Ubah user menjadi user biasa
$user = User::where('email', 'admin@example.com')->first();
$user->role = 'user';
$user->save();
```

### **Via Database:**

```sql
-- Ubah menjadi admin
UPDATE users SET role = 'admin' WHERE email = 'user@example.com';

-- Ubah menjadi user
UPDATE users SET role = 'user' WHERE email = 'admin@example.com';
```

## 📂 File yang Dimodifikasi/Dibuat

### **Created:**

1. `database/migrations/2026_02_26_075014_add_role_to_users_table.php`
2. `app/Http/Controllers/Auth/RegisterController.php`
3. `resources/views/auth/register.blade.php`
4. `app/Http/Middleware/IsAdmin.php`

### **Modified:**

1. `app/Models/User.php` - Added `role` to fillable
2. `bootstrap/app.php` - Registered admin middleware
3. `routes/web.php` - Restructured with middleware groups
4. `resources/views/auth/login.blade.php` - Added success message & register link
5. `resources/views/guru/index.blade.php` - Added role-based UI
6. `resources/views/siswa/index.blade.php` - Added role-based UI
7. `resources/views/layouts/admin.blade.php` - Added error message display

## 🚀 Deployment Notes

Setelah pull/clone repository, jalankan:

```bash
# Install dependencies
composer install

# Run migrations
php artisan migrate

# Clear cache
php artisan config:clear
php artisan route:clear
php artisan cache:clear

# Set existing user as admin (optional)
php artisan tinker
User::first()->update(['role' => 'admin']);
```

## 🔒 Security Features

1. **Middleware Protection** - Route dilindungi di level middleware
2. **UI Conditional Rendering** - Tombol admin tidak muncul untuk user biasa
3. **Password Hashing** - Password di-hash dengan bcrypt
4. **CSRF Protection** - Semua form dilindungi CSRF token
5. **Email Unique Validation** - Mencegah duplikasi email
6. **Role Enum** - Role dibatasi hanya 'admin' atau 'user'

## 📞 Support

Jika ada pertanyaan atau issue, silakan hubungi developer atau buat issue di repository.

---

**Implementation Date:** 2026-02-26  
**Laravel Version:** 11.x  
**PHP Version:** 8.2+
