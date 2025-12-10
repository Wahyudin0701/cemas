<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
    public function getFotoTokoUrlAttribute()
    {
        if (!$this->foto_toko) {
            return null;
        }
        if(str_starts_with($this->foto_toko, 'http')) {
            return $this->foto_toko;
        }
        $disk = Storage::disk('cloudinary');
        return $disk->url($this->foto_toko);
    }
}
