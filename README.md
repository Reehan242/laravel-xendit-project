# Xendit Integration - Laravel Project

## Deskripsi Proyek
Sebuah aplikasi sederhana yang mengimplementasikan sistem pembayaran menggunakan Xendit sebagai payment gateway. Proyek ini dirancang untuk mensimulasikan alur transaksi pembayaran dengan integrasi API Xendit.

## Fitur Utama:
- **Produk Placeholder**:
    -Data produk (2 produk) didefinisikan langsung di database tanpa fitur manajemen CRUD.
- **Manajemen Pesanan**:
    -Membuat data order berdasarkan produk yang dipilih pelanggan.
    -Status order (pending, paid, failed) dapat diperbarui secara manual melalui route /notification, yang akan memeriksa status pembayaran pada Xendit.
- **Integrasi Xendit**:
    -Membuat invoice pembayaran menggunakan API Xendit.

## Teknologi yang Digunakan
- **Framework**: Laravel 11
- **Database**: MySQL
- **Frontend**: Bootstrap 5
- **API** : Xendit payment gateway
- **Language**: PHP, HTML, CSS, JavaScript

---

## Cara setup projek agar bisa dijalankan
- Pastikan sudah menginstal composer 
- Download projek ini sebagai zip atau clone menggunakan :
  ```https://github.com/Reehan242/laravel-xendit-project.git```
- Ekstrak file projek
- Di folder projek, buka terminal dan jalankan perintah ```composer install```
- Ubah nama file .env.example menjadi .env
- Pada .env, ubah settingan nya sesuai dengan apa yang akan digunakan (seperti db_name, username, host, password , dan api key.)
- Migrasi database dengan command : ```php artisan migrate``` atau ```php artisan migrate:fresh```
- Jika sudah, projek sudah dapat dijalankan dengan menjalankan artisan command ```php artisan serve```.

## Preview Project
- Screenshot tampilan project
![Screenshot of the app](preview_images/preview_4.png "Home")
![Screenshot of the app](preview_images/preview_1.png "Checkout Address Form")
![Screenshot of the app](preview_images/preview_2.png "Xendit Payment Page")
![Screenshot of the app](preview_images/preview_3.png "Xendit Payment Page 2")

