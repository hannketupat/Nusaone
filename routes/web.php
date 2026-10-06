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