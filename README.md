# CeMas (Community E-Marketplace Aston Villa)

CeMas adalah platform *e-marketplace* berbasis komunitas yang dirancang khusus untuk warga Perumahan Aston Villa. Aplikasi ini bertujuan untuk mendigitalisasi UMKM lokal, mempermudah transaksi antar warga, dan menggerakkan ekonomi rukun tetangga dengan semangat gotong royong.

## Fitur Utama

### 1. Untuk Pembeli (Warga)
- **Katalog Warga:** Jelajahi berbagai produk kebutuhan sehari-hari yang ditawarkan oleh tetangga di sekitar Anda.
- **Harga Warga & Bebas Ongkir:** Nikmati keuntungan belanja lebih ekonomis dengan penawaran khusus dan gratis ongkir untuk area perumahan.
- **Profil Toko & Jam Operasional:** Lihat detail toko, status buka/tutup secara *real-time*, dan informasi kontak penjual.
- **Keranjang & Checkout Mudah:** Tambahkan produk ke keranjang dan lakukan pemesanan dengan mudah.
- **Riwayat Pesanan:** Lacak status pesanan Anda (Menunggu, Diproses, Selesai, atau Dibatalkan).

### 2. Untuk Penjual (UMKM Lokal)
- **Manajemen Toko:** Kelola profil toko, jam operasional, dan lokasi toko.
- **Etalase Produk:** Tambah, edit, dan hapus produk dengan mudah.
- **Manajemen Pesanan:** Terima dan proses pesanan yang masuk dari warga.
- **Dashboard Interaktif:** Pantau statistik penjualan, total pesanan, dan pendapatan.

### 3. Untuk Admin (Pengurus RT)
- **Verifikasi Toko:** Tinjau dan verifikasi pendaftaran toko baru untuk memastikan keamanan dan kepercayaan komunitas.
- **Manajemen Pengguna:** Pantau dan kelola data seluruh pengguna (pembeli dan penjual) di dalam platform.
- **Dashboard Statistik:** Lihat ringkasan aktivitas di dalam *marketplace* warga.

## Teknologi yang Digunakan

Aplikasi ini dibangun menggunakan teknologi modern yang kuat dan andal:

- **Framework Backend:** [Laravel 11](https://laravel.com/) (PHP)
- **Framework Frontend/UI:** [Tailwind CSS](https://tailwindcss.com/) & [Alpine.js](https://alpinejs.dev/)
- **Database:** MySQL
- **Autentikasi:** Laravel Breeze

## Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek CeMas di komputer lokal Anda:

1. **Clone repositori ini:**
   ```bash
   git clone https://github.com/Wahyudin0701/cemas.git
   cd cemas
   ```

2. **Install dependensi PHP dan Node.js:**
   ```bash
   composer install
   npm install
   ```

3. **Salin file konfigurasi environment:**
   ```bash
   cp .env.example .env
   ```

4. **Konfigurasi Database di file `.env`:**
   Sesuaikan `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` dengan konfigurasi MySQL lokal Anda.
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=cemas_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Jalankan Migrasi dan Seeder (Dummy Data):**
   ```bash
   php artisan migrate:fresh --seed
   ```
   *Catatan: Seeder akan otomatis membuat akun Admin, beberapa akun Penjual (beserta tokonya), akun Pembeli, serta data pesanan dummy.*

7. **Kompilasi Aset Frontend:**
   ```bash
   npm run build
   # atau untuk mode development: npm run dev
   ```

8. **Jalankan Development Server:**
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui `http://localhost:8000`.

## Akun Default (Hasil Seeder)

Untuk keperluan *testing*, Anda dapat menggunakan kredensial berikut setelah menjalankan seeder:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@cemas.com` | `password` |
| **Penjual (Toko Budi Jaya)** | `budi@cemas.com` | `password` |
| **Penjual (Aminah Collection)** | `aminah@cemas.com` | `password` |
| **Penjual (Andi Elektronik)** | `andi@cemas.com` | `password` |
| **Pembeli 1** | `joko@cemas.com` | `password` |
| **Pembeli 2** | `siti@cemas.com` | `password` |

---
*Dibuat dengan ❤️ untuk warga Perumahan Aston Villa.*
