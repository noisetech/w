<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetRencanaPembangunan extends Model
{
    use HasFactory;

    protected $table = 'det_rencana_pembangunan';

    protected $fillable = [
        'rencana_pembangunan_id', 'komponen_pembangunan_id', 'volume', 'satuan', 'harga', 'persentase', 'riil', 'keterangan'
    ];
}
