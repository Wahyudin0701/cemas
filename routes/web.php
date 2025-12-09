<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\ProfileController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->controller(ProfileController::class)->group(function () {
    Route::get('/profile/edit', 'edit')->name('profile.edit');
    Route::patch('/profile/edit', 'update')->name('profile.update');
    Route::delete('/profile/edit', 'destroy')->name('profile.destroy');
});

require __DIR__ . '/admin.php';
require __DIR__ . '/penjual.php';
require __DIR__ . '/pembeli.php';

require __DIR__ . '/auth.php';
