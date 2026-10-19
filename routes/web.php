<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Halaman utama — katalog produk
Route::get('/', [ProductController::class, 'index']);

// Halaman detail produk (dinamis berdasarkan ID)
Route::get('/detail/{id}', [ProductController::class, 'show']);

// Halaman checkout & berhasil
Route::get('/checkout', [ProductController::class, 'checkout']);
Route::get('/berhasil', [ProductController::class, 'berhasil']);
// 3. Jalur Menampilkan Formulir Checkout sesuai ID Barang (MATERI P7)
Route::get('/checkout/{id}', [ProductController::class, 'checkout']);

// 4. Jalur Rahasia (POST) untuk Merekam Pesanan ke Database (MATERI P7)
Route::post('/checkout/proses', [ProductController::class, 'storeTransaction']);

// 5. Jalur Menampilkan Halaman Berhasil & Invoice Dinamis (MATERI P7)
Route::get('/berhasil/{id}', [ProductController::class, 'success']);