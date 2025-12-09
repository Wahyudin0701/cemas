<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $fillable = [
        'pesanan_id',
        'toko_id',
        'produk_id',
        'kuantitas', // Renamed from jumlah_produk to match migration
        'harga_saat_pesan', // Renamed from harga_satuan to match migration
        // 'subtotal' // Removed as it doesn't exist in migration
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function toko()
    {
        // Relasi langsung untuk kinerja, sesuai kesepakatan
        return $this->belongsTo(Toko::class);
    }
}
