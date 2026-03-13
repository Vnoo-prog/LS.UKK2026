<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'judul', 
        'deskripsi', 
        'gambar', 
        'user_id' 
    ];
    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }
}
