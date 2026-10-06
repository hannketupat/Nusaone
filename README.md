# E-Commerce Laravel

Tugas Pemrograman Web Pertemuan 




## Cara Setup

Buka Laragon, klik **Start All** biar Apache dan MySQL nyala.

Buka terminal, masuk ke folder proyek:

```
cd nama-folder-proyek
```

Install dependency:

```
composer install
```

Copy file environment:

```
copy .env.example .env
```

Kalau pakai Mac/Linux:

```
cp .env.example .env
```

Generate app key:

```
php artisan key:generate
```

---

## Bikin Database

Buka http://localhost/phpmyadmin, bikin database baru namanya `ecommerce_db`.

Buka file `.env`, sesuaikan bagian ini:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_db
DB_USERNAME=root
DB_PASSWORD=
```

DB_PASSWORD dibiarkan kosong aja, Laragon defaultnya gitu.

---

## Migrasi & Isi Data

```
php artisan migrate:fresh --seed
```

Ini bakal bikin tabel products sama ngisi 6 produk dari seeder.

---

## Jalanin

```
php artisan serve
```

Buka http://localhost:8000 di browser.

---

## Coba Cek

- http://localhost:8000 → katalog
- http://localhost:8000/detail/1 → detail produk pertama
- http://localhost:8000/detail/6 → detail produk terakhir
- http://localhost:8000/detail/999 → harusnya muncul 404

---

## Route

| URL | Fungsi |
|---|---|
| `/` | Katalog |
| `/detail/{id}` | Detail produk |
| `/checkout` | Checkout |
| `/berhasil` | Halaman sukses |

---

## Kalau Ada Error

**composer/php not recognized**
Buka terminal dari Laragon aja, atau restart CMD.

**Could not open input file: artisan**
Salah folder. Masuk ke folder yang ada file `artisan`.

**Halaman utama jadi 404**
Cek `routes/web.php`, pastikan `Route::get('/', ...)` masih ada.

**Undefined variable $product**
Controller belum kirim variabel. Cek `ProductController@show`.

**Class "App\Models\Product" not found**
Tambahin `use App\Models\Product;` di atas controller.

**/detail/999 ga muncul 404**
Ganti `Product::find($id)` jadi `Product::findOrFail($id)`.

**Layout detail pecah karena deskripsi panjang**
Tambahin `overflow-wrap: break-word;` di CSS deskripsi.

---

## Folder Penting

```
app/Http/Controllers/ProductController.php
resources/views/katalog.blade.php
resources/views/detail.blade.php
routes/web.php
database/seeders/
public/assets/images/
```

Guru: Sulthan Alawy Shihab, S.Kom