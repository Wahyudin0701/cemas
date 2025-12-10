<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjual extends Model
{
    protected $fillable = [
        'user_id',
        'nik',
        'foto_ktp',
        'phone',
        'alamat',
        'is_active'
    ];

    /**
     * Relasi Balik ke User (One-to-One)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Toko (One-to-One)
     */
    public function toko()
    {
        // Satu penjual hanya memiliki satu toko
        return $this->hasOne(Toko::class);
    }
}
