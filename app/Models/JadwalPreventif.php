<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPreventif extends Model
{
    protected $table = 'jadwal_preventif';
    use HasFactory;
    protected $fillable = [
        'id', 'id_mesin', 'jadwal_rencana', 'status',
    ];

    protected $dates = ['created_at', 'updated_at'];
}
