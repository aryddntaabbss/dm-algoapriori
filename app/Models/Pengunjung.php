<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_whatsapp',
        'jenjang',
        'kategori',
        'tanggal',
    ];
}
