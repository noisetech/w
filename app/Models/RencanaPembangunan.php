<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaPembangunan extends Model
{
    use HasFactory;

    protected $table = 'rencana_pembangunan';

    protected $fillable = [
        'detail_ket_sub_dpa_id', 'nilai_kontrak', 'nomor_kontrak', 'tanggal_kontrak', 'pejabat_ppk', 'pelaksana', 'lokasi_realisasi_anggaran', 'jangka_waktu', 'mulai_kerja', 'progress_pelaksanaan', 'rencana_pelaksanaan', 'realisasi_pelaksanaan', 'deviasi_pelaksanaan', 'kendala_hambatan', 'tenaga_kerja', 'penerapan_k3', 'keterangan', 'keselamatan_kontruksi', 'tim_monitoring', 'catatan'
    ];
}
