<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['user_id'];

    /**
     * Relasi Balik ke User (One-to-One)
     */
    public function user()
    {
        // Relasi ini memastikan bahwa setiap baris Admin terhubung ke satu User
        return $this->belongsTo(User::class);
    }
}
