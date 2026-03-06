<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    /** @use HasFactory<\Database\Factories\KelasFactory> */
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'kelas';
    protected $fillable = [
        'id',
        'namaKelas',
        'waliKelas',
        'ketuaKelas',
        'kursi',
        'meja',
        'gambar_kelas',
    ];
}
