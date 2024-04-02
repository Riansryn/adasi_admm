<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'spareparts';

    protected $fillable = [
        'nama_sparepart',
        'deskripsi',
        'jumlah_stok',
        'nomor_mesin'
    ];

    protected $dates = ['created_at', 'updated_at'];
}
