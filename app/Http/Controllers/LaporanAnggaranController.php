<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanAnggaranController extends Controller
{
    public function index()
    {

        $bahan_data = DB::table('sub_dpa')
            ->select(
                'sub_dpa.id as sub_dpa_id',
                'sub_kegiatan_id',
                'sub_kegiatan.kode as sub_kegiatan_kode',
                'sub_kegiatan.nomenklatur as sub_kegiatan_nomenklatur',
            )
            ->join('sub_kegiatan', 'sub_kegiatan.id', '=', 'sub_dpa.sub_kegiatan_id')
            ->get();



        return view('pages.laporan-anggaran.index', [
            'bahan_data' => $bahan_data
        ]);
    }
}
