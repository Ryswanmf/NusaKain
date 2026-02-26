# Nusakain - Premium Textile Ecosystem

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/filament-%23fbad18.svg?style=for-the-badge)
![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)
![Midtrans](https://img.shields.io/badge/Midtrans-Payment-blue?style=for-the-badge)
![WebP](https://img.shields.io/badge/Image-WebP_Optimized-teal?style=for-the-badge)

Nusakain adalah platform E-commerce dan Portofolio modern yang dirancang khusus untuk ekosistem bisnis tekstil premium di Indonesia. Dibangun dengan teknologi terbaru Laravel 12 dan Filament 3, platform ini menawarkan pengalaman belanja kain yang presisi, sistem pembayaran otomatis, dan manajemen operasional yang efisien.

## Teknologi Utama
- Backend: Laravel 12.x
- Admin Panel: Filament v3.x
- Database: MySQL / SQLite
- Payment Gateway: Midtrans Snap
- PDF Engine: Laravel-DomPDF
- Image Processing: Intervention Image (WebP Optimized)
- Spreadsheet Engine: Maatwebsite Excel
- Frontend: Tailwind CSS, Alpine.js, Animate.css, GLightbox

---

## Fitur Unggulan

### E-Commerce Tekstil Khusus
- Beli per Meter (Desimal): Mendukung pembelian kain dengan kuantitas desimal (contoh: 1.5m, 2.25m) dengan kelipatan 0.5m.
- Kalkulator Kebutuhan Kain: Alat bantu interaktif bagi pembeli untuk mengestimasi panjang kain berdasarkan jenis pakaian dan ukuran tubuh.
- Varian Produk: Manajemen variasi kain berdasarkan warna, material, atau grade khusus.
- Sistem Voucher: Penggunaan kode promo (Potongan Rupiah atau Persentase) dengan validasi minimal belanja dan kuota penggunaan.

### Transaksi & Pembayaran
- Integrasi Midtrans Snap: Pembayaran aman menggunakan berbagai metode (Bank Transfer, QRIS, Kartu Kredit).
- Auto-Sync Payment: Sinkronisasi status pembayaran secara real-time dari API Midtrans.
- Manajemen Stok Otomatis: Stok kain berkurang secara otomatis (mendukung desimal) hanya setelah pembayaran dikonfirmasi berhasil.
- Auto-Cancel Orders: Pembatalan otomatis pesanan yang tidak dibayar dalam waktu 24 jam untuk menjaga akurasi stok.
- Invoice PDF: Pembuatan invoice otomatis dalam format PDF lengkap dengan Stempel dan Tanda Tangan digital dinamis.

### Pengalaman Pelanggan (UX)
- Dashboard Akun Saya: Ringkasan statistik belanja, riwayat pesanan, dan manajemen wishlist.
- Visual Status Timeline: Garis waktu interaktif di halaman pesanan untuk melacak progres transaksi (Dipesan, Diproses, Dikirim, Selesai).
- Review & Rating: Pembeli dapat memberikan ulasan bintang dan mengunggah foto kain yang telah diterima.
- Nusakain Assistant: Widget bantuan melayang untuk akses cepat ke WhatsApp Admin, Lacak Pesanan, dan FAQ.
- Magnifier Zoom: Fitur kaca pembesar pada foto produk untuk melihat detail serat dan tekstur kain secara mendalam tanpa pecah.
- Social Auth: Login cepat satu klik menggunakan akun Google.

### Dashboard Admin Kustom
- Analitik Keuntungan (Profit): Perhitungan otomatis keuntungan bersih harian berdasarkan harga modal (COGS), harga jual, dan diskon voucher.
- Ekspor Laporan: Pengunduhan laporan penjualan dalam format Excel (.xlsx) dan PDF profesional dengan filter rentang tanggal.
- Statistik Bisnis: Monitoring real-time total penjualan, pendapatan lunas, jumlah pelanggan, dan stok kritis (< 5m).
- Manajemen Konten Dinamis: Pengaturan penuh logo, nama situs, slogan, alamat, dan media sosial melalui panel admin.

---

## Panduan Instalasi

### 1. Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- Akun Midtrans (Sandbox/Production)
- Google Cloud Console (untuk Social Auth)

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
Pastikan Anda mengisi variabel berikut:
```env
# Midtrans
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_IS_PRODUCTION=false

# Google Auth
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URL="http://127.0.0.1:8000/auth/google/callback"
```

### 4. Menjalankan Task Scheduler
Untuk fitur Auto-Cancel Pesanan, tambahkan Cron Job berikut di server Anda:
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

---

## Struktur Folder Utama
- `app/Exports/` - Konfigurasi ekspor data Excel.
- `app/Services/` - Logika integrasi Midtrans, Image Processing (WebP), dan WhatsApp.
- `app/Console/Commands/` - Tugas otomatisasi (Cancel Expired Orders).
- `app/Observers/` - Pemantauan perubahan stok dan notifikasi wishlist.
- `resources/views/landing_page/` - Antarmuka pembeli (Frontend).
- `resources/views/admin/` - Tampilan dashboard admin kustom dan laporan.

---

## Palet Warna Brand
- Teal (Primary): #0d9488 - Melambangkan profesionalitas dan detail tekstil.
- Slate (Secondary): #0f172a - Melambangkan kemewahan dan integritas.
- Rose (Accent): #f43f5e - Digunakan untuk penekanan promo dan status urgensi.

---

© 2026 **Nusakain Indonesia**. Seluruh Hak Cipta Dilindungi Riswan.
