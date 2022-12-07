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
        $dpa = DB::table('dpa')
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


        // dd($dpa);
        // //
        $data = [
            'dpa' => $dpa
        ];

        return view('pages.perencanaan-pengambilan.index', $data);
    }

    public function h_tambah($id_dpa)
    {

        $sub_dpa = DB::table('sub_dpa')
            ->join('dpa', 'dpa.id', '=', 'sub_dpa.dpa_id')
            ->where('sub_dpa.dpa_id', decrypsi($id_dpa))->get();

        dd($sub_dpa);

        return view('pages.perencanaan-pengambilan.create');
    }
}
