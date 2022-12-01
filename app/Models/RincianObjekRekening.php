<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianObjekRekening extends Model
{
    use HasFactory;

    protected $table = 'rincian_objek_rekening';

    protected $fillable = [
        'objek_rekening_id', 'kode', 'uraian_akun', 'deskripsi_akun'
    ];

    public function sub_rincian_objek()
    {
        return $this->hasMany(SubRincianObjekRekening::class, 'rincian_objek_rekening_id');
    }
}
