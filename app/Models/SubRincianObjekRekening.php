<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRincianObjekRekening extends Model
{
    use HasFactory;

    protected $table = 'sub_rincian_objek_rekening';

    protected $fillable = [
        'rincian_objek_rekening_id', 'kode', 'uraian_akun', 'deskripsi_akun'
    ];

    public function rincian_objek_rekening()
    {
        return $this->belongsTo(RincianObjekRekening::class, 'rincian_objek_rekening_id', 'id');
    }
}
