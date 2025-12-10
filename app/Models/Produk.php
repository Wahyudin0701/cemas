<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
     * Appends accessors to JSON arrays.
     */
    protected $appends = ['foto_produk_url'];

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
    public function getFotoProdukUrlAttribute()
    {
        if (!$this->foto_produk) {
            return null;
        }
        if(str_starts_with($this->foto_produk, 'http')) {
            return $this->foto_produk;
        }
        $disk = Storage::disk('cloudinary');
        return $disk->url($this->foto_produk);
    }
}
