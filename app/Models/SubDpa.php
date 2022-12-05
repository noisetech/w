<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDpa extends Model
{
    use HasFactory;

    protected $table = 'sub_dpa';

    protected $fillable = [
        'dpa_id', 'sub_kegiatan_id', 'sumber_dana_id', 'lokasi', 'target',
        'waktu_pelaksanaan', 'keterangan'
    ];

    public function dpa()
    {
        return $this->belongsTo(Dpa::class, 'dpa_id', 'id');
    }
}
