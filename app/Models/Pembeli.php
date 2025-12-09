<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'alamat'
    ];

    /**
     * Relasi Balik ke User (One-to-One)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Keranjang (One-to-Many)
     */
    public function keranjangs()
    {
        // Satu pembeli bisa memiliki banyak keranjang (satu per toko)
        return $this->hasMany(Keranjang::class);
    }

    /**
     * Relasi ke Pesanan (One-to-Many)
     */
    public function pesanans()
    {
        // Satu pembeli bisa membuat banyak pesanan
        return $this->hasMany(Pesanan::class);
    }
}
