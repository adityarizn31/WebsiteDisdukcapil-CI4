# Si Lancar — Disdukcapil Majalengka

Aplikasi layanan administrasi kependudukan online berbasis CodeIgniter 4. Aplikasi menyediakan formulir pendaftaran layanan, pengelolaan permohonan melalui halaman admin, serta fitur pelacakan status permohonan menggunakan kode unik.

## Fitur

- Formulir pendaftaran layanan administrasi kependudukan dan unggah dokumen persyaratan.
- Halaman admin untuk melihat permohonan dan memperbarui status.
- Pelacakan status publik menggunakan kode pelacakan unik; data pribadi pemohon tidak ditampilkan.
- Proteksi CSRF pada request dan formulir.

## Teknologi

- PHP 7.3 atau lebih baru (lihat batas versi pada `composer.json`)
- CodeIgniter 4
- MySQL/MariaDB dengan ekstensi PHP `mysqli`
- Composer
- Node.js/npm hanya jika ingin mengelola aset frontend

Pastikan ekstensi PHP yang dibutuhkan CodeIgniter aktif, termasuk `intl`, `mbstring`, `json`, dan `mysqli`.

## Instalasi lokal

1. Clone repository lalu masuk ke direktori proyek.
2. Pasang dependensi PHP:

   ```sh
   composer install
   ```

3. Buat file konfigurasi lokal dengan menyalin `env` menjadi `.env`. Isi minimal:

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'
   database.default.hostname = localhost
   database.default.database = nama_database
   database.default.username = username_database
   database.default.password = password_database
   database.default.DBDriver = MySQLi
   ```

   Buat database MySQL/MariaDB terlebih dahulu dan ganti nilai contoh dengan konfigurasi lokal. Jangan commit file `.env` atau kredensial.

4. Jalankan migrasi untuk membuat tabel kode pelacakan:

   ```sh
   php spark migrate
   ```

   Migrasi aplikasi saat ini membuat tabel `application_tracking`. Tabel layanan dan data awal aplikasi tetap perlu disiapkan sesuai skema database proyek.

5. Jalankan server pengembangan:

   ```sh
   php spark serve
   ```

6. Buka `http://localhost:8080/` di browser.

## Menggunakan pelacakan permohonan

1. Pemohon mengisi dan mengirim salah satu formulir pendaftaran.
2. Setelah berhasil, aplikasi menampilkan kode pelacakan. Pemohon perlu menyimpan kode tersebut.
3. Buka menu **Lacak Permohonan**, masukkan kode, lalu pilih **Lacak**.
4. Aplikasi menampilkan jenis layanan dan status terbaru tanpa membuka data identitas atau dokumen pemohon.

Kode hanya dibuat untuk pengajuan baru setelah migrasi dijalankan. Permohonan yang sudah ada sebelumnya tidak otomatis memperoleh kode pelacakan.

## Pengujian

Jalankan tes yang tersedia dengan:

```sh
composer test
```

## Catatan deployment

- Arahkan document root web server ke direktori `public/`, bukan root repository.
- Gunakan HTTPS dan konfigurasi database/kredensial produksi melalui environment yang aman.
- Pastikan direktori `writable/` memiliki izin tulis yang sesuai.
- Tabel `application_tracking` menghubungkan kode acak ke ID dan jenis layanan; batasi akses database dan jangan menaruh kode pelacakan di URL publik.
- Dokumen administrasi kependudukan mengandung data sensitif. Pastikan penyimpanan dan endpoint unduh dokumen dilindungi sebelum aplikasi digunakan untuk data nyata.
