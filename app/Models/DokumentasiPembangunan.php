<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiPembangunan extends Model
{
    use HasFactory;

    protected $table = 'dokumentasi_pekerjaan_pembangunan';

    protected $fillable = [
        'det_rencana_pembangunan', 'dokumentasi'
    ];
}
