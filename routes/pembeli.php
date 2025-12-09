<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\KeranjangController;

Route::middleware(['auth', 'role:pembeli'])->group(function () {

    Route::get('/dashboard', [PembeliController::class, 'daftarToko'])->name('pembeli.dashboard');

    Route::get('/lihat-toko/{id}', [PembeliController::class, 'lihatToko'])->name('detail-toko');

    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'addToCart'])->name('keranjang.tambah');
    Route::patch('/keranjang/update', [KeranjangController::class, 'updateQuantity'])->name('keranjang.update');
    Route::get('/keranjang/items', [KeranjangController::class, 'getCartItems'])->name('keranjang.items');
    Route::delete('/keranjang/hapus/{produkId}', [KeranjangController::class, 'removeItem'])->name('keranjang.hapus');
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/riwayat-pesanan', [\App\Http\Controllers\OrderHistoryController::class, 'index'])->name('riwayat-pesanan');
    Route::get('/riwayat-pesanan/{id}', [\App\Http\Controllers\OrderHistoryController::class, 'show'])->name('pesanan.detail');
});
