<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
use App\Models\Admin;
use App\Models\Pembeli;
use App\Models\Penjual;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class
        ];
    }
    
    // ------------------------------------------------------------------
    // RELASI UNTUK PERAN (SESUAI DENGAN ERD FINAL)
    // ------------------------------------------------------------------

    /**
     * Relasi ke model Admin (One-to-One)
     */
    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class);
    }

    /**
     * Relasi ke model Penjual (One-to-One)
     */
    public function penjual(): HasOne
    {
        return $this->hasOne(Penjual::class);
    }

    /**
     * Relasi ke model Pembeli (One-to-One)
     */
    public function pembeli(): HasOne
    {
        return $this->hasOne(Pembeli::class);
    }

    // ------------------------------------------------------------------
    // HELPER UNTUK MENGELOLA PERAN
    // ------------------------------------------------------------------

    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    public function isPenjual(): bool
    {
        return $this->role === UserRole::Penjual;
    }

    public function isPembeli(): bool
    {
        return $this->role === UserRole::Pembeli;
    }
}