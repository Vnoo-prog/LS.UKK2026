<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi secara massal (mass assignment).
     * Kita ganti name dan email menjadi username dan role.
     */
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat data diubah ke JSON/Array.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Pengaturan tipe data (Casts).
     */
    protected function casts(): array
    {
        return [
            //
        ];
    }

    /**
     * Relasi ke tabel Komentar (Satu User bisa punya banyak Komentar)
     */
    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }
}