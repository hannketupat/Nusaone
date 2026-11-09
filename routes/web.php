<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

// Halaman utama — katalog produk
Route::get('/', [ProductController::class, 'index']);

// Halaman detail produk (dinamis berdasarkan ID)
Route::get('/detail/{id}', [ProductController::class, 'show']);

// CHECKOUT: Hanya SATU route GET dengan parameter {id}
Route::get('/checkout/{id}', [ProductController::class, 'checkout']);

// PROSES CHECKOUT (POST)
Route::post('/checkout/proses', [ProductController::class, 'storeTransaction']);

// HALAMAN BERHASIL (dengan ID transaksi)
Route::get('/berhasil/{id}', [ProductController::class, 'success']);

// ADMIN TRANSAKSI
Route::get('/admin/transactions', [AdminController::class, 'transactions']);
Route::post('/admin/transactions/{id}/status', [AdminController::class, 'updateStatus']);

// ADMIN PRODUK
Route::get('/admin/products', [AdminController::class, 'products']);
Route::get('/admin/products/create', [AdminController::class, 'createProduct']);
Route::post('/admin/products/store', [AdminController::class, 'storeProduct']);