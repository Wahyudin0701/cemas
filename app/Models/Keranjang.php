<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $fillable = ['pembeli_id', 'toko_id'];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class);
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    // Relasi Many-to-Many ke Produk melalui DetailKeranjang
    public function detailKeranjangs()
    {
        return $this->hasMany(DetailKeranjang::class);
    }
}
