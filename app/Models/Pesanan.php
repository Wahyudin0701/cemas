<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'pembeli_id',
        'toko_id',
        'tanggal_pesanan',
        'status_pesanan',
        'metode_pengambilan',
        'total_harga_final',
        'catatan_pembeli'
    ];

    protected $casts = [
        'tanggal_pesanan' => 'datetime',
    ];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class);
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    // Relasi One-to-Many ke Detail Pesanan (Item Transaksi)
    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}