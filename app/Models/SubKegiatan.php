<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKegiatan extends Model
{
    use HasFactory;

    protected $table = 'sub_kegiatan';

    protected $fillable = [
        'kegiatan_id', 'satuan_id', 'kode', 'nomenklatur', 'kinerja', 'indikator'
    ];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
}
