<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard',  [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/semua-pengguna', [AdminController::class, 'semuaPengguna'])->name('admin.semua-pengguna');

    Route::get('/detail-pengguna/{id}', [AdminController::class, 'detailPengguna'])->name('admin.detail-pengguna');
    Route::get('/admin/penjual/{penjual}/ktp', [AdminController::class, 'lihatKtp'])->name('penjual.ktp');
    Route::post('/admin/toko/{id}/update-status', [AdminController::class, 'updateStatusToko'])->name('admin.update-status-toko');

    Route::post('/toggle-status-user/{id}', [AdminController::class, 'toggleStatusUser'])->name('admin.toggle-status-user');

    Route::get('/semua-toko', [AdminController::class, 'semuaToko'])->name('admin.semua-toko'); 
});
