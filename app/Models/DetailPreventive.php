<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPreventive extends Model
{
    use HasFactory;
    protected $table = 'detail_preventives';

    protected $fillable = [
        'id_mesin', 'issue', 'perbaikan', 'issue_checked',
        'start', 'end',
        'perbaikan_checked'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function mesin()
    {
        return $this->belongsTo(Mesin::class, 'id_mesin', 'id');
    }

    public function getCheckedStatusColorAttribute()
    {
        return $this->perbaikan_checked == '1' ? 'checked' : 'unchecked';
    }
}
