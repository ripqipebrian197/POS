<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    protected $table = 'jenis';

    // Disesuaikan dengan nama kolom di tabel database
    protected $fillable = [
        'nama_jenis',
    ];
}