<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpa extends Model
{
    use HasFactory;

    protected $table = 'dpa';

    protected $fillable = [
        'no_dpa', 'urusan_id', 'bidang_id', 'program_id', 'kegiatan_id', 'organisasi_id',
        'unit_id', 'sasaran_program', 'capain_program', 'alokasi_tahun', 'indikator_kinerja',
        'kelompok_sasaran_kegiatan', 'rencana_penarikan', 'tim_anggaran', 'ttd_dpa'
    ];
}
