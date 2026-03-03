# Sistem Galeri - Dokumentasi

## Deskripsi

Sistem CRUD Galeri dengan fitur multiple upload foto, terdiri dari halaman admin untuk manajemen galeri dan halaman frontend untuk menampilkan galeri kepada pengunjung.

## Fitur Utama

### Backend (Admin Panel)

1. **CRUD Galeri Lengkap**
    - Create: Tambah galeri baru dengan multiple upload foto
    - Read: Lihat daftar dan detail galeri
    - Update: Edit galeri dan tambah foto baru
    - Delete: Hapus galeri dan foto individual

2. **Multiple Upload Foto**
    - Upload lebih dari 1 foto sekaligus
    - Preview foto sebelum upload
    - Caption untuk setiap foto
    - Validasi format dan ukuran file

3. **Autentikasi**
    - Login required untuk akses admin
    - Session management
    - Logout functionality

4. **Validasi**
    - Form validation
    - Controller validation
    - Error handling

### Frontend

1. **Halaman Galeri**
    - Menampilkan semua galeri aktif
    - Grid layout responsive
    - Pagination

2. **Detail Galeri**
    - Menampilkan semua foto dalam galeri
    - Lightbox untuk view foto full size
    - Caption foto
    - Responsive grid layout

## Struktur Database

### Tabel: galeri

- `id` (Primary Key)
- `judul` (String)
- `slug` (String, Unique) - Auto-generated dari judul
- `deskripsi` (Text, Nullable)
- `thumbnail` (String, Nullable) - Foto pertama sebagai thumbnail
- `is_active` (Boolean) - Status aktif/tidak aktif
- `created_at` (Timestamp)
- `updated_at` (Timestamp)

### Tabel: detail_galeri

- `id` (Primary Key)
- `galeri_id` (Foreign Key) - Relasi ke tabel galeri (CASCADE on delete)
- `foto` (String) - Path file foto
- `caption` (String, Nullable)
- `urutan` (Integer) - Urutan foto
- `created_at` (Timestamp)
- `updated_at` (Timestamp)

## Instalasi & Setup

### 1. Clone/Setup Project

```bash
cd c:/laragon/www/galeri
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Setup

Pastikan file `.env` sudah dikonfigurasi dengan benar:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Create Storage Link

```bash
php artisan storage:link
```

### 7. Seed Admin User

```bash
php artisan db:seed --class=AdminUserSeeder
```

### 8. Start Development Server

```bash
php artisan serve
```

## Kredensial Login Admin

**Email:** admin@galeri.com  
**Password:** password

## URL Routes

### Frontend

- **Home:** `http://localhost:8000/`
- **Galeri Index:** `http://localhost:8000/galeri`
- **Detail Galeri:** `http://localhost:8000/galeri/{slug}`

### Admin

- **Login:** `http://localhost:8000/login`
- **Admin Galeri:** `http://localhost:8000/admin/galeri`
- **Create Galeri:** `http://localhost:8000/admin/galeri/create`
- **Edit Galeri:** `http://localhost:8000/admin/galeri/{id}/edit`
- **Show Galeri:** `http://localhost:8000/admin/galeri/{id}`

## Cara Penggunaan

### Menambah Galeri Baru (Admin)

1. Login ke admin panel
2. Klik menu "Galeri"
3. Klik tombol "Tambah Galeri"
4. Isi form:
    - Judul galeri (required)
    - Deskripsi (optional)
    - Upload foto (minimal 1 foto, bisa multiple)
    - Tambahkan caption untuk setiap foto (optional)
    - Centang "Aktifkan galeri" jika ingin langsung aktif
5. Klik "Simpan Galeri"

### Mengedit Galeri (Admin)

1. Dari halaman daftar galeri, klik tombol "Edit" (icon pensil)
2. Update informasi yang diperlukan
3. Tambah foto baru jika diperlukan
4. Hapus foto yang tidak diinginkan
5. Klik "Update Galeri"

### Menghapus Galeri (Admin)

1. Dari halaman daftar galeri, klik tombol "Hapus" (icon trash)
2. Konfirmasi penghapusan
3. Galeri dan semua fotonya akan terhapus

### Melihat Galeri (Frontend)

1. Buka halaman galeri: `http://localhost:8000/galeri`
2. Klik "Lihat Galeri" pada galeri yang ingin dilihat
3. Klik foto untuk melihat dalam ukuran penuh (lightbox)

## Validasi

### Form Validation

- **Judul:** Required, max 255 karakter
- **Foto:** Required saat create, format: jpeg, png, jpg, gif, max 2MB per file
- **Caption:** Optional, max 255 karakter

### File Upload

- Format yang diizinkan: JPEG, PNG, JPG, GIF
- Ukuran maksimal: 2MB per file
- Multiple upload: Ya
- Storage: `storage/app/public/galeri/`

## Fitur Keamanan

1. **Authentication Middleware:** Semua route admin dilindungi dengan middleware auth
2. **CSRF Protection:** Semua form menggunakan CSRF token
3. **File Validation:** Validasi tipe dan ukuran file
4. **SQL Injection Prevention:** Menggunakan Eloquent ORM
5. **XSS Prevention:** Blade templating auto-escape

## Teknologi yang Digunakan

- **Backend:** Laravel 11
- **Database:** MySQL
- **Frontend:** Bootstrap 5, Font Awesome 6
- **JavaScript:** Vanilla JS, jQuery (untuk lightbox)
- **Image Viewer:** Lightbox2

## Struktur File

### Models

- `app/Models/Galeri.php` - Model untuk tabel galeri
- `app/Models/DetailGaleri.php` - Model untuk tabel detail_galeri

### Controllers

- `app/Http/Controllers/Admin/GaleriController.php` - Controller admin CRUD
- `app/Http/Controllers/Frontend/GaleriController.php` - Controller frontend display
- `app/Http/Controllers/Auth/LoginController.php` - Controller authentication

### Views

**Admin:**

- `resources/views/admin/galeri/index.blade.php` - Daftar galeri
- `resources/views/admin/galeri/create.blade.php` - Form tambah galeri
- `resources/views/admin/galeri/edit.blade.php` - Form edit galeri
- `resources/views/admin/galeri/show.blade.php` - Detail galeri

**Frontend:**

- `resources/views/frontend/galeri/index.blade.php` - Halaman galeri
- `resources/views/frontend/galeri/show.blade.php` - Detail galeri

**Auth:**

- `resources/views/auth/login.blade.php` - Halaman login

### Migrations

- `database/migrations/2026_02_12_084458_create_galeri_table.php`
- `database/migrations/2026_02_12_084506_create_detail_galeri_table.php`

### Routes

- `routes/web.php` - Semua route aplikasi

## Troubleshooting

### Error: Storage link not found

```bash
php artisan storage:link
```

### Error: Permission denied pada storage

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Foto tidak muncul

1. Pastikan storage link sudah dibuat
2. Cek permission folder storage
3. Pastikan file ada di `storage/app/public/galeri/`

### Error saat upload foto

1. Cek ukuran file (max 2MB)
2. Cek format file (jpeg, png, jpg, gif)
3. Cek permission folder storage

## Catatan Penting

1. Foto pertama yang diupload akan otomatis menjadi thumbnail galeri
2. Slug dibuat otomatis dari judul galeri
3. Saat menghapus galeri, semua foto terkait akan ikut terhapus (CASCADE)
4. Hanya galeri dengan status aktif yang ditampilkan di frontend
5. Route foto menggunakan custom route untuk keamanan

## Support

Untuk pertanyaan atau masalah, silakan hubungi developer.
