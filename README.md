# Gudang Buku - Sistem Informasi Toko Buku Online

Sistem informasi toko buku online yang memungkinkan pengguna untuk melihat, mencari, dan membeli buku secara online.

## Fitur Utama

### 1. Manajemen Produk
- Menampilkan daftar buku dengan gambar, judul, penulis, dan harga
- Fitur pencarian buku berdasarkan judul atau penulis
- Filter buku berdasarkan kategori
- Detail produk lengkap dengan deskripsi
- Upload gambar produk dengan validasi (JPG, PNG, max 5MB)

### 2. Sistem Kategori
- Pengelompokan buku berdasarkan kategori
- Navigasi kategori yang mudah
- Tampilan jumlah buku per kategori

### 3. Manajemen User
- Registrasi user baru
- Login sistem dengan validasi
- Role-based access (Admin dan User)
- Profil user yang dapat diupdate

### 4. Panel Admin
- Dashboard admin dengan statistik
- Manajemen produk (tambah, edit, hapus)
- Manajemen kategori
- Manajemen user
- Laporan penjualan

### 5. Keranjang Belanja
- Tambah produk ke keranjang
- Update jumlah produk
- Hapus produk dari keranjang
- Kalkulasi total otomatis

### 6. Sistem Pemesanan
- Checkout process
- Form pengisian data pengiriman
- Konfirmasi pesanan
- Status tracking pesanan

## Teknologi yang Digunakan

- PHP 7.4+
- MySQL/MariaDB
- Bootstrap 5
- JavaScript
- HTML5 & CSS3

## Struktur Database

### Tabel Products
- product_id (Primary Key)
- title
- author
- category_id (Foreign Key)
- description
- price
- stock
- image_url
- created_at

### Tabel Categories
- category_id (Primary Key)
- name
- description

### Tabel Users
- user_id (Primary Key)
- username
- email
- password
- role
- created_at

### Tabel Orders
- order_id (Primary Key)
- user_id (Foreign Key)
- total_amount
- status
- created_at

