<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualController;


Route::middleware(['auth' , 'role:penjual'])->prefix('penjual')->group(function () {
    Route::get('/', [PenjualController::class, 'cekStatus'])->name('penjual.cek-status');

    Route::get('/waiting-verification', [PenjualController::class, 'waitingVerification'])->name('penjual.waiting-verification');

    Route::get('/dashboard', [PenjualController::class, 'index'])->name('penjual.dashboard');


    Route::get('/produk/{id}',  [ProdukController::class, 'index'])->name('penjual.detail-produk');
    Route::get('/tambah-produk', [ProdukController::class, 'tambahProduk'])->name('penjual.tambah-produk');
    Route::post('/produk', [ProdukController::class, 'storeProduk'])->name('penjual.produk.store');
    Route::get('penjual/produk/{id}/edit', [ProdukController::class, 'edit'])->name('penjual.edit-produk');
    Route::put('penjual/produk/{id}', [ProdukController::class, 'update'])->name('penjual.produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('penjual.produk.destroy');


    Route::get('/toko', [\App\Http\Controllers\TokoController::class, 'edit'])->name('penjual.toko');
    Route::put('/toko', [\App\Http\Controllers\TokoController::class, 'update'])->name('penjual.toko.update');

    Route::get('/pesanan', [\App\Http\Controllers\SellerOrderController::class, 'index'])->name('penjual.pesanan');
    Route::post('/pesanan/{id}/update', [\App\Http\Controllers\SellerOrderController::class, 'updateStatus'])->name('penjual.pesanan.update');
    Route::post('/pesanan/{id}/cancel', [\App\Http\Controllers\SellerOrderController::class, 'cancelOrder'])->name('penjual.pesanan.cancel');
});
