---
sidebar_position: 1
---

# Installation

1. [Install skijasi](https://skijasi-docs.nadzorserveraweb.hr/getting-started/installation) pertama. Setelah itu, Anda dapat memasukkan paket Skijasi dengan perintah berikut.

Untuk skijasi v2.x (Laravel 8)
```
composer require skijasi/post-module
```

Untuk skijasi v1.x (Laravel 5, 6, 7)
```
composer require skijasi/post-module:^1.0
```

2. Jalankan perintah berikut.

```
php artisan migrate
php artisan skijasi-post:setup
composer dump-autoload
```

Untuk skijasi v2.x (Laravel 8)
```
php artisan db:seed --class="Database\Seeders\Skijasi\Post\SkijasiPostModuleSeeder"
```

Untuk skijasi v1.x (Laravel 5, 6, 7)
```
php artisan db:seed --class=SkijasiPostModuleSeeder
```

3. Tambahkan plugin ke `MIX_SKIJASI_PLUGINS` Anda ke `.env`. Jika Anda memiliki plugin lain yang diinstal, sertakan plugin tersebut menggunakan koma pembatas (,).

```
MIX_SKIJASI_PLUGINS=post-module
```

4. Tambahkan menu plugin ke `MIX_SKIJASI_MENU` Anda ke `.env`. Jika Anda memiliki menu lain, sertakan menu tersebut menggunakan koma pembatas (,).

```
MIX_SKIJASI_MENU=admin,post-module
```

5. Isi variabel lain dalam file `.env`.
    - `MIX_POST_URL_PREFIX=post`
      Awalan untuk mengakses pos | pilihan
    - `MIX_ANALYTICS_ACCOUNT_ID=`
      ID akun dari google analytics | pilihan
    - `MIX_ANALYTICS_WEBPROPERTY_ID=`
      ID properti web dari google analytics | pilihan
    - `MIX_ANALYTICS_VIEW_ID=`
      Lihat id dari google analytics | pilihan