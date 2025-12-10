<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'toko_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'foto_produk'
    ];

    /**
     * Relasi Balik ke Toko (Many-to-One)
     */
    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    /**
     * Relasi ke Detail Keranjang (One-to-Many)
     */
    public function detailKeranjangs()
    {
        return $this->hasMany(DetailKeranjang::class);
    }

    /**
     * Relasi ke Detail Pesanan (One-to-Many)
     */
    public function detailPesanans()
    {
        // Produk ini muncul di banyak detail pesanan
        return $this->hasMany(DetailPesanan::class);
    }
}
