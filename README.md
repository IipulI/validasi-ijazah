## Built by
>Muhammad Syaifullah Nurrohman (221106043033) - Reguler A

## Tujuan
Aplikasi ini dibuat untuk memenuhi tugas akhir mata kuliah basis data

## Yang Diperlukan

- Pastikan PHP sudah terinstal dengan versi > 8.1
- Pastikan Composer terinstal dengan versi > 2.4
- Pastikan NodeJS tersintal dengan versi > 18.x
- Pastikan Git sudah terinstal

## Instalasi

- Clone package menggunakan git
  ```bash
  git clone https://github.com/IipulI/validasi-ijazah.git 
  ```
- Buka folder project
- Jalankan perintah
  ```bash
  composer install
  ```
- Setelah composer jalankan untuk membuild website perintah
  ```bash
  npm install && npm run build
  ```
- Jalankan perintah untuk membuat table database
  ```bash
  php artisan migrate:fresh
  ```
- Jalankan perintah untuk membuat data admin
  ```bash
  Php artisan db:seed
  ```
- Jalankan perintah untuk menjalankan webserver pada laptop
  ```bash
  php artisan serve --port=8000
  ```
- Buka Browser, lalu pada alamat url browser buka 
  ```
  localhost:8000
  ```
