<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekRekening extends Model
{
    use HasFactory;

    protected $table = 'objek_rekening';

    protected $fillable = [
        'jenis_rekening_id', 'kode', 'uraian_akun', 'deskripsi_akun'
    ];

    public function jenis()
    {
        return $this->belongsTo(JenisRekening::class, 'jenis_rekening_id', 'id');
    }
}
