<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetSubDpa extends Model
{
    use HasFactory;

    protected $table = 'ket_sub_dpa';

    protected $fillable = [
        'sub_dpa_id', 'akun', 'kelompok', 'jenis', 'objek', 'rincian_objek'
    ];

    public function sub_dpa()
    {
        return $this->belongsTo(SubDpa::class, 'sub_dpa_id', 'id');
    }

    public function relasi_detail_ket_sub_dpa()
    {
        return $this->hasMany(DetailKetSubDpa::class, 'ket_sub_dpa_id');
    }

    public function relasi_akun()
    {
        return $this->belongsTo(AkunRekening::class, 'akun', 'id');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisRekening::class, 'jenis', 'id');
    }


    public function objek()
    {
        return $this->belongsTo(ObjekRekening::class, 'jenis', 'id');
    }

    public function rincian_objek()
    {
        return $this->belongsTo(RincianObjekRekening::class, 'jenis', 'id');
    }
}
