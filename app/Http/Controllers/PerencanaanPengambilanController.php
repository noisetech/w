<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use App\Models\SubDpa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerencanaanPengambilanController extends Controller
{
    public function index()
    {
        $query_dpa = DB::table('dpa')
            ->select(
                'dpa.id as dpa_id',
                'dpa.no_dpa as no_dpa',
                'program.id as id_program',
                'program.kode as kode_program',
                'program.nomenklatur as nomenklaturr_program',
                'kegiatan.id as kegiatan_id',
                'kegiatan.kode as kode_kegiatan',
                'kegiatan.nomenklatur as nomenklaturr_kegiatan'
            )
            ->join('program', 'program.id', '=', 'dpa.program_id')
            ->join('kegiatan', 'kegiatan.id', '=', 'dpa.kegiatan_id')->get();


        $bahan_data_dpa = [];

        foreach ($query_dpa as $key_query_dpa => $value_query_dpa) {
            $bahan_data_dpa[] = $value_query_dpa;
        }

        $dpa = $bahan_data_dpa;


        $query_sub_dpa = DB::table('sub_dpa')
            ->select('sub_dpa.*')
            ->join('dpa', 'dpa.id', '=', 'sub_dpa.dpa_id')
            ->join('sumber_dana', 'sumber_dana.id', '=', 'sub_dpa.sumber_dana_id')
            ->join('sub_kegiatan', 'sub_kegiatan.id', '=', 'sub_dpa.sub_kegiatan_id')
            ->where('sub_dpa.dpa_id', $dpa[0]['id'])
            ->get();

        $bahan_id_sub_dpa = [];

        foreach ($query_sub_dpa as $key_query_sub_dpa => $value_query_sub_dpa) {
            $bahan_data_sub_dpa[] = $value_query_sub_dpa;
        }


        $data = [
            'dpa' => $dpa,
        ];

        return view('pages.perencanaan-pengambilan.index', $data);
    }

    public function h_tambah($id_dpa)
    {

        $sub_dpa = DB::table('sub_dpa')
            ->join('dpa', 'dpa.id', '=', 'sub_dpa.dpa_id')
            ->where('sub_dpa.dpa_id', decrypsi($id_dpa))->get();

        $bahan_sub_dpa_id = [];
        foreach ($sub_dpa as $key_sub_dpa => $value_keb_sub_dpa) {
            $bahan_sub_dpa_id[] = [
                'id' => $value_keb_sub_dpa['id'],
            ];
        }

        $sub_kegiatan = $bahan_sub_dpa_id;

        dd($bahan_sub_dpa_id);

        return view('pages.perencanaan-pengambilan.create');
    }
}
