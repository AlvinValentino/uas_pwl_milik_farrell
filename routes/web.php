<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Kasir\PenjualanController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
// Route::middleware()->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// });

// Protected Routes (butuh login)
// Route::middleware()->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.index');

    Route::prefix('product')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/show/{id}', [ProductController::class, 'show'])->name('product.show');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    Route::prefix('product_category')->group(function() {
        Route::get('/', [ProductCategoryController::class, 'index'])->name('product_category.index');
        Route::post('/store', [ProductCategoryController::class, 'store'])->name('product_category.store');
        Route::get('/show/{id}', [ProductCategoryController::class, 'show'])->name('product_category.show');
        Route::put('/update/{id}', [ProductCategoryController::class, 'update'])->name('product_category.update');
        Route::delete('/destroy/{id}', [ProductCategoryController::class, 'destroy'])->name('product_category.destroy');
    });

    Route::prefix('supplier')->group(function() {
        Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
        Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/show/{id}', [SupplierController::class, 'show'])->name('supplier.show');
        Route::put('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::delete('/destroy/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    });

    Route::prefix('penjualan')->group(function() {
        Route::get('/', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::post('/store', [PenjualanController::class, 'store'])->name('penjualan.store');
    });
    
// });
