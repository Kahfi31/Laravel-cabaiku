<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'articles';

    // Menentukan kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = ['title', 'content', 'image', 'user_id'];


    // Menentukan kolom yang tidak boleh diisi secara massal (guarded)
    // protected $guarded = ['id'];

    // Menentukan kolom yang akan di-cast ke tipe tertentu (misalnya timestamp)
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
