<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokRekening extends Model
{
    use HasFactory;

    protected $table = 'kelompok_rekening';

    protected $fillable = [
        'akun_rekening_id', 'kode', 'uraian_akun', 'deskripsi_akun'
    ];

    public function akun()
    {
        return $this->belongsTo(AkunRekening::class, 'akun_rekening_id', 'id');
    }
}
