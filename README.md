## BAK Yudharta

BAK Yudharta Adalah Aplikasi Keuangan di Universitas Yudharta Pasuruan.

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
