<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerencanaanPengambilanController extends Controller
{
    public function index()
    {
        $dpa = DB::table('dpa')
            ->select('dpa.id as id_dpa', 'dpa.no_dpa', 'urusan.nomenklatur as nomenklatur')
            ->join('urusan', 'urusan.id', '=', 'dpa.urusan_id')
            ->get();

        // dd($dpa);

        return view('pages.perencanaan-pengambilan.index', [
            'dpa' => $dpa
        ]);
    }

    public function h_relaisasi($id_dpa)
    {

        $dpa = DB::table('dpa')
            ->select('dpa.id as id_dpa', 'bidang.kode as kode_bidang', 'bidang.nomenklatur as nomenklatur_bidang')
            ->join('bidang', 'bidang.id', '=', 'dpa.bidang_id')
            ->where('dpa.id', decrypsi($id_dpa))
            ->first();





        return view('pages.perencanaan-pengambilan.create', [
            'dpa' => $dpa
        ]);
    }
}
