<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data_bulan =  DB::table('rencana_pengambilan')->pluck('bulan');

        $realisasi = DB::table('rencana_pengambilan')
            ->select(DB::raw('sum(pengambilan) as pengambilan'))
            ->groupBy('bulan')
            ->pluck('pengambilan');





        return view('pages.dashboard', [
            'data_bulan' => $data_bulan,
            'realisasi' => $realisasi
        ]);
    }
}
