<?php

use App\Http\Controllers\Admin\Laporan\LaporanPenjualanController;
use App\Http\Controllers\Admin\Laporan\LaporanStokController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Kasir\PenjualanController;
use App\Http\Controllers\Pembelian\PurchaseOrderController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtMiddleware;

// Halaman utama
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware([JWTMiddleware::class])->group(function() {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.index');
    
    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });
    
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
    
    Route::prefix('purchase_order')->group(function() {
        Route::get('/', [PurchaseOrderController::class, 'index'])->name('purchase_order.index');
        Route::post('/store', [PurchaseOrderController::class, 'store'])->name('purchase_order.store');
    });
    
    Route::prefix('laporan')->group(function() {
        Route::get('/stok', [LaporanStokController::class, 'index'])->name('laporan_stok.index');
        Route::get('/stok/getLaporan/{id}', [LaporanStokController::class, 'getLaporan'])->name('laporan_stok.getLaporan');
    
        Route::get('/penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan_penjualan.index');
        Route::get('/penjualan/getPenjualanDetail/{id}', [LaporanPenjualanController::class, 'getPenjualanDetail'])->name('laporan_penjualan.getPenjualanDetail');
    });
});