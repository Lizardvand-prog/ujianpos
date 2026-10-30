# UJIANPOS

Aplikasi web sederhana untuk mengelola data supplier dan sales. Proyek ini dibuat sebagai tugas ujian praktik TKJ 35 Rumah Gemilang Indonesia.

## Teknologi
- PHP Native (PDO)
- MariaDB / MySQL
- Bootstrap 5
- CodeIgniter 4 (Migration dan Seeder)

## Fitur
- Dashboard
- CRUD Supplier
- CRUD Sales
- Relasi Sales dengan Supplier
- Konfirmasi penghapusan dan validasi formulir

## Struktur Database
Database: `ujianpos`

### Tabel suppliers
- id
- name
- address
- phone
- email

### Tabel sales
- id
- supplier_id
- total

Relasi `sales.supplier_id` mengacu pada `suppliers.id`, dengan aturan ON DELETE CASCADE dan ON UPDATE CASCADE.

## Instalasi
1. Salin folder proyek ke direktori web server.
2. Buat database bernama `ujianpos`.
3. Sesuaikan konfigurasi koneksi database pada `koneksi.php`.
4. Pastikan Apache, PHP, dan MariaDB aktif.
5. Buka aplikasi melalui browser.

## Migration dan Seeder
File migration dan seeder tersedia di:
- `app/Database/Migrations/`
- `app/Database/Seeds/`

## Pengembang
TKJ 35 — Rumah Gemilang Indonesia
