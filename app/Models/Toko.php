<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $fillable = [
        'penjual_id',
        'nama_toko',
        'deskripsi_toko',
        'foto_toko',
        'jam_buka',
        'jam_tutup',
        'lokasi',
        'status_verifikasi'
    ];

    /**
     * Relasi Balik ke Penjual (One-to-One)
     */
    public function penjual()
    {
        return $this->belongsTo(Penjual::class);
    }

    /**
     * Relasi ke Produk (One-to-Many)
     */
    public function produks()
    {
        // Satu toko bisa memiliki banyak produk
        return $this->hasMany(Produk::class);
    }

    /**
     * Relasi ke Detail Pesanan (Untuk Laporan/Kinerja)
     */
    public function detailPesanans()
    {
        // Detail Pesanan yang menjadi tanggung jawab toko ini
        return $this->hasMany(DetailPesanan::class);
    }
}
