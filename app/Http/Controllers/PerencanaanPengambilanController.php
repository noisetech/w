<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerencanaanPengambilanController extends Controller
{
    public function index()
    {
        $sub_dpa = DB::table('sub_dpa')
            ->select(
                'sub_dpa.id as sub_dpa_id',
                'sub_kegiatan.id as sub_kegiatan_id',
                'sub_kegiatan.kode as sub_kegiatan_kode',
                'sub_kegiatan.nomenklatur as sub_kegiatan_nomenklatur',
                'kegiatan.id as kegiatan_id',
                'kegiatan.kode as kegiatan_Kode'
            )
            ->join('dpa', 'dpa.id', '=', 'sub_dpa.dpa_id')
            ->join('sub_kegiatan', 'sub_kegiatan.id', '=', 'sub_dpa.sub_kegiatan_id')
            ->join('kegiatan', 'kegiatan.id', '=', 'sub_kegiatan.kegiatan_id')
            ->join('program', 'program.id', '=', 'kegiatan.program_id')
            ->get();

        dd($sub_dpa);

        // return view('pages.perencanaan-pengambilan.index', [
        //     'dpa' => $dpa
        // ]);
    }

    public function h_relaisasi($id_dpa)
    {

        $dpa = DB::table('dpa')
            ->select(
                'dpa.id as id_dpa',
                'bidang.kode as kode_bidang',
                'bidang.nomenklatur as nomenklatur_bidang',
                'kegiatan.kode as kode_kegiatan',
                'kegiatan.nomenklatur as nomenklatur_kegiatan',
                'program.kode as kode_program',
                'program.nomenklatur as nomenklatur_program'
            )
            ->join('bidang', 'bidang.id', '=', 'dpa.bidang_id')
            ->join('program', 'program.id', '=', 'dpa.program_id')
            ->join('kegiatan', 'kegiatan.id', '=', 'dpa.kegiatan_id')
            ->where('dpa.id', decrypsi($id_dpa))
            ->first();

        $bulan = DB::table('bulan')->select('*')->get();

        return view('pages.perencanaan-pengambilan.detail', [
            'dpa' => $dpa,
            'bulan' => $bulan
        ]);
    }

    public function tambah_realisasi($id_dpa, $id_bulan)
    {
        $bulan = DB::table('bulan')->where('id', $id_bulan)->first();

        return view('pages.perencanaan-pengambilan.create');
    }

    public function proses_tambah_realisasi(Request $request)
    {
    }
}
