# Nusakain - Modern Textile Business Platform

Nusakain adalah platform digital berbasis web untuk bisnis tekstil/kain yang modern dan profesional. Dibangun dengan **Laravel 12** dan **Filament 3**, aplikasi ini dirancang untuk memudahkan pengelolaan produk, portofolio, blog, serta interaksi dengan pelanggan melalui admin panel yang intuitif.

---

## 🚀 Tech Stack

- **Framework:** [Laravel 12.x](https://laravel.com)
- **Admin Panel:** [Filament v3.x](https://filamentphp.com) (Custom path: `/riswan`)
- **Frontend Styling:** [Tailwind CSS](https://tailwindcss.com) (Modern "Toska" Theme)
- **Database:** SQLite (Default) / MySQL / PostgreSQL
- **Auth:** Laravel Breeze (Customized UI)

---

## ✨ Fitur Utama

### 1. Katalog Produk
- Manajemen kain premium dengan kategori (Katun, Linen, Denim, dll).
- Otomatisasi generate Slug untuk URL yang SEO-friendly.
- Tampilan grid produk yang responsif dan elegan.

### 2. Portofolio Proyek
- Menampilkan kolaborasi dengan berbagai brand fashion.
- Detail klien, kategori proyek, dan tanggal pelaksanaan.

### 3. Blog & Artikel
- Berbagi tips fashion dan tren industri tekstil.
- Manajemen artikel lengkap dengan ringkasan (excerpt) dan konten panjang.

### 4. Manajemen Tim (Tentang Kami)
- Showcase profil tim di balik Nusakain.
- Pengaturan urutan tampilan tim melalui admin panel.

### 5. Kontak & Inkuiri
- Formulir kontak fungsional untuk pesan pelanggan.
- Notifikasi pesan belum dibaca (unread) di dashboard admin.

### 6. Dashboard Admin Modern
- Statistik real-time (Total Produk, Portofolio, Artikel, Pesan Baru).
- Tema warna "Toska" (Teal) yang konsisten dengan frontend.

---

## 🛠 Panduan Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM

### Langkah-langkah
1. **Clone Repository:**
   ```bash
   git clone <repository-url>
   cd Nusakain
   ```

2. **Instal Dependensi:**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi Database:**
   ```bash
   php artisan migrate
   ```

5. **Link Storage:**
   ```bash
   php artisan storage:link
   ```

6. **Jalankan Aplikasi:**
   ```bash
   npm run dev
   # Buka terminal baru
   php artisan serve
   ```

---

## 📂 Struktur Proyek Utama

- `app/Filament/Resources/` - Konfigurasi admin panel (Product, Portfolio, Post, Contact, TeamMember).
- `app/Models/` - Definisi database dan logika model.
- `app/Http/Controllers/` - Logika penanganan request landing page.
- `resources/views/landing_page/` - Tampilan frontend utama.
- `resources/views/layouts/app.blade.php` - Layout utama (Header & Footer).
- `routes/web.php` - Definisi rute URL aplikasi.

---

## 🔐 Akses Admin

- **URL:** `http://localhost:8000/riswan`
- **Warna Tema:** Toska (Teal)
- **Fitur Dashboard:** Stats Overview Widget untuk monitoring data.

---

## 🎨 Kustomisasi Warna
Website ini menggunakan palet warna **Toska** menggunakan Tailwind CSS:
- Primary: `teal-600`
- Secondary/Accent: `cyan-600`
- Background: `gray-50/50`

---

© 2026 Nusakain Indonesia. Developed as a Modern Textile Solution.
