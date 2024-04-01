<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_mesin',
        'Nama',
        'Deskripsi',
        'Jumlah Stok',
    ];

    protected $dates = ['created_at', 'updated_at'];
}
