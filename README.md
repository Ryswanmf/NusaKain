# Nusakain - Premium Textile Ecosystem

Nusakain adalah platform E-commerce dan Portofolio modern yang dirancang khusus untuk ekosistem bisnis tekstil premium di Indonesia. Dibangun dengan teknologi terbaru **Laravel 12** dan **Filament 3**, platform ini menawarkan pengalaman belanja kain yang presisi, sistem pembayaran otomatis, dan manajemen operasional yang efisien.

## 🚀 Teknologi Utama
- **Backend:** [Laravel 12.x](https://laravel.com)
- **Admin Panel:** [Filament v3.x](https://filamentphp.com)
- **Database:** MySQL / SQLite
- **Payment Gateway:** [Midtrans Snap](https://midtrans.com)
- **PDF Engine:** [Laravel-DomPDF](https://github.com/barryvdh/laravel-dompdf)
- **Frontend:** Tailwind CSS, Alpine.js, Animate.css, GLightbox

---

## ✨ Fitur Unggulan

### 🛍️ E-Commerce Tekstil Khusus
- **Beli per Meter (Desimal):** Mendukung pembelian kain dengan kuantitas desimal (contoh: 1.5m, 2.25m) dengan kelipatan 0.5m.
- **Kalkulator Kebutuhan Kain:** Alat bantu interaktif bagi pembeli untuk mengestimasi panjang kain berdasarkan jenis pakaian dan ukuran tubuh.
- **Varian Produk:** Manajemen variasi kain berdasarkan warna, material, atau grade khusus.
- **Sistem Voucher:** Penggunaan kode promo (Potongan Rupiah atau Persentase) dengan validasi minimal belanja dan kuota penggunaan.

### 💳 Transaksi & Pembayaran
- **Integrasi Midtrans Snap:** Pembayaran aman menggunakan berbagai metode (Bank Transfer, QRIS, Kartu Kredit).
- **Auto-Sync Payment:** Sinkronisasi status pembayaran secara real-time dari API Midtrans.
- **Manajemen Stok Otomatis:** Stok kain berkurang secara otomatis hanya setelah pembayaran dikonfirmasi berhasil.
- **Auto-Cancel Orders:** Pembatalan otomatis pesanan yang tidak dibayar dalam waktu 24 jam untuk menjaga akurasi stok.
- **Invoice PDF:** Pembuatan dan pengunduhan invoice formal secara otomatis dalam format PDF.

### 👤 Pengalaman Pelanggan (UX)
- **Dashboard Akun Saya:** Ringkasan statistik belanja, riwayat pesanan, dan manajemen wishlist.
- **Review & Rating:** Pembeli dapat memberikan ulasan bintang dan mengunggah foto kain yang telah diterima.
- **Nusakain Assistant:** Widget bantuan melayang di pojok layar untuk akses cepat ke WhatsApp Admin, Lacak Pesanan, dan FAQ.
- **Pencarian & Filter Canggih:** Filter produk berdasarkan kategori, rentang harga, dan status ketersediaan.

### 🛡️ Dashboard Admin Kustom
- **Statistik Bisnis:** Monitoring total penjualan, pendapatan bersih, jumlah pelanggan, dan stok kritis secara visual.
- **Grafik Analitik:** Visualisasi tren pesanan harian dan distribusi kategori produk.
- **Manajemen Lengkap:** CRUD untuk Produk, Pesanan, Voucher, Blog, Portofolio, Tim, dan Kontak Pelanggan.

---

## 🛠️ Panduan Instalasi

### 1. Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- Akun Midtrans (Sandbox/Production)

### 2. Langkah Instalasi
```bash
# Clone repository
git clone <repository-url>
cd Nusakain

# Install dependensi PHP & JS
composer install
npm install && npm run build

# Konfigurasi Environment
cp .env.example .env
php artisan key:generate

# Migrasi Database & Seeding
php artisan migrate --seed

# Link Storage
php artisan storage:link
```

### 3. Konfigurasi .env (Penting)
Pastikan Anda mengisi variabel berikut untuk fitur pembayaran:
```env
MIDTRANS_MERCHANT_ID=your_id
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_IS_PRODUCTION=false
```

### 4. Menjalankan Task Scheduler
Untuk fitur **Auto-Cancel Pesanan**, tambahkan Cron Job berikut di server Anda:
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

---

## 📂 Struktur Folder Utama
- `app/Services/` - Logika integrasi Midtrans dan Shipping.
- `app/Console/Commands/` - Tugas otomatisasi (Cancel Expired Orders).
- `app/Filament/Resources/` - Pengaturan panel administrasi.
- `resources/views/landing_page/` - Seluruh tampilan antarmuka pembeli.
- `resources/views/admin/` - Tampilan dashboard admin kustom.

---

## 🎨 Palet Warna Brand
- **Teal (Primary):** `#0d9488` - Melambangkan profesionalitas dan ketenangan.
- **Slate (Secondary):** `#0f172a` - Melambangkan kemewahan dan kekuatan.
- **Rose (Accent):** `#f43f5e` - Digunakan untuk penekanan urgensi dan promo.

---

© 2026 **Nusakain Indonesia**. Seluruh Hak Cipta Dilindungi.
