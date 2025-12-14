# 📝 Modern To-Do List App (Laravel)

Aplikasi Manajemen Tugas (To-Do List) berbasis web yang dibangun menggunakan **Laravel** dan **Bootstrap 5**. Proyek ini dirancang untuk memenuhi tugas **Responsi Pemrograman Web I**, dengan fokus pada penerapan konsep MVC, CRUD, Autentikasi, dan User Experience (UX) modern.

## ✨ Fitur Unggulan

### 1. 📋 Manajemen Tugas (CRUD Lengkap)
- **Create:** Tambah tugas baru dengan judul dan deskripsi detail.
- **Read:** Daftar tugas dengan pagination (5 item per halaman) dan fitur **Pencarian (Search)**.
- **Update:** Edit tugas atau tandai status **Selesai/Belum** langsung dari tabel utama (Quick Action).
- **Delete:** Hapus tugas dengan konfirmasi keamanan.
- **Time Tracking:** Menampilkan informasi "Dibuat pada" dan "x menit yang lalu" secara otomatis.

### 2. 🔐 Autentikasi & Keamanan
- **Login & Register:** Sistem autentikasi aman menggunakan Laravel Auth.
- **Password Visibility:** Ikon mata untuk melihat/menyembunyikan password saat login/register.
- **Proteksi Data:** User hanya bisa melihat dan mengedit tugas miliknya sendiri.

### 3. 🎨 Personalisasi & UI Modern
- **Glassmorphism Design:** Antarmuka modern dengan efek transparan dan blur.
- **Dark Mode / Light Mode:** Tema tampilan yang bisa dipilih user dan tersimpan di database.
- **Pengaturan Bahasa:** Opsi Bahasa Indonesia / Inggris (mempengaruhi format tanggal).
- **Profil Pengguna:**
    - Upload & Ganti Foto Profil (Avatar).
    - Ganti Informasi Akun (Nama & Email).
    - Ganti Password.

---

## 🛠️ Teknologi yang Digunakan
- **Backend:** Laravel Framework (PHP 8.1+)
- **Frontend:** Bootstrap 5.3 (via Vite)
- **Database:** MySQL
- **Icon:** FontAwesome 6
- **Font:** Nunito

---

## 🚀 Panduan Instalasi (Step-by-Step)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal (Localhost):

### 1. Persiapan Awal
Pastikan komputer Anda sudah terinstall:
- PHP & Composer
- Node.js & NPM
- Database MySQL (XAMPP/Laragon)

### Langkah-Langkah:
```bash
2. Clone Repository
Buka terminal (CMD/Git Bash), lalu jalankan:
- git clone https://github.com/Ribersa/responsi-web-todolist
- cd responsi-web-todolist

3. Install Dependencies
- composer install
- npm install

4. Konfigurasi Environment
- Salin file `.env.example` menjadi `.env`
- Sesuaikan pengaturan database di file `.env`:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_todolist
DB_USERNAME=root
DB_PASSWORD=

5. Generate Application Key
- php artisan key:generate
- php artisan migrate

6. Setup Penyimpanan Gambar
- php artisan storage:link

7. Build Assets
- npm run build

8. Jalankan Server Lokal
- php artisan serve
- Buka browser dan akses: `http://localhost:8000`

---
