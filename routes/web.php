<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesananSayaController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// 1. JALUR PUBLIK / FRONT-STORE
Route::get('/', [ProductController::class, 'index']);
Route::get('/detail/{id}', [ProductController::class, 'show']);

// 2. JALUR AUTENTIKASI (LOGIN, REGISTER, LOGOUT)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// 3. JALUR PEMBELI (WAJIB LOGIN)
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', function () {
        return redirect('/');
    });
    Route::get('/checkout/{id}', [ProductController::class, 'checkout']);
    Route::post('/checkout/proses', [ProductController::class, 'storeTransaction']);
    Route::get('/pesanan-saya', [PesananSayaController::class, 'index']);
    Route::get('/berhasil/{id}', [ProductController::class, 'success']);
});

// 4. JALUR ADMIN / SELLER CENTER (WAJIB LOGIN + ROLE ADMIN)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/transactions', [AdminController::class, 'transactions']);
    Route::post('/admin/transactions/{id}/status', [AdminController::class, 'updateStatus']);

    Route::get('/admin/products', [AdminController::class, 'products']);
    Route::get('/admin/products/create', [AdminController::class, 'createProduct']);
    Route::post('/admin/products/store', [AdminController::class, 'storeProduct']);

    Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct']);
    Route::post('/admin/products/{id}/update', [AdminController::class, 'updateProduct']);
    Route::post('/admin/products/{id}/delete', [AdminController::class, 'deleteProduct']);
});
