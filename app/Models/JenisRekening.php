<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisRekening extends Model
{
    use HasFactory;

    protected $table = 'jenis_rekening';

    protected $fillable = [
        'kelompok_rekening_id', 'kode', 'uraian_akun', 'deskripsi_akun'
    ];

    public function objek()
    {
        return $this->hasMany(ObjekRekening::class, 'jenis_rekening_id');
    }
}
