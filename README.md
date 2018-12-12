<p align="center">Aplikasi AMDK</p>

<p align="center">
<a href="https://travis-ci.org/cbsanjaya/amdk"><img src="https://travis-ci.org/cbsanjaya/amdk.svg" alt="Build Status"></a>
<a href="https://github.styleci.io/repos/161211216"><img src="https://github.styleci.io/repos/161211216/shield?branch=master" alt="StyleCI"></a>
</p>

## Tentang Aplikasi AMDK

Adalah Aplikasi yang digunakan untuk Manajement Produksi dan Pemasaran Air Minum Dalam Kemasan.

### Installation
#### server requirement
- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension

#### Installing
untuk memudahkan installasi, download dan install [Composer](https://getcomposer.org/) terlebih dahulu. pada folder utama jalankan perintah:

    composer install

Langkah ini dilakukan untuk men-download ketergantungan paket.

Copy dan rename file `.env.example` menjadi `.env` kemudian ubah pengaturan sesuai kebutuhan.

### Problem Solving
#### Key was too long 
jika ada pesan `Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes` ketika migrasi, ubah my.ini menjadi:

    innodb_file_format=Barracuda
    innodb_large_prefix=1
    innodb_default_row_format=dynamic
