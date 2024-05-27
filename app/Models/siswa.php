<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $fillable = ['namabarang', 'gambar', 'deskripsi', 'nomer', 'status', 'statuspost', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
