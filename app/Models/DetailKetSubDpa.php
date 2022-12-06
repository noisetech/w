<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKetSubDpa extends Model
{
    use HasFactory;

    protected $table = 'detail_ket_sub_dpa';

    protected $fillable = [
        'ket_sub_dpa_id', 'sub_rincian_objek', 'jumlah_anggaran'
    ];
}
