<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunRekening extends Model
{
    use HasFactory;

    protected $table = 'akun_rekening';

    protected $fillable = [
        'kode', 'uraian_akun', 'deskripsi_akun'
    ];

    public function kelompok()
    {
        return $this->hasMany(KelompokRekening::class, 'akun_rekening_id');
    }
}
