<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'nomor_tlp',
        'jenjang',
        'judul_buku',
        'kode_buku',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'kategori'
    ];
}
