<?php

namespace App\Http\Controllers;

use App\Models\PerencanaanPembangunan;
use App\Models\KomponenPembangunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerencanaanPembangunanController extends Controller
{
    public function index()
    {
        $id_dinas = auth()->user()->dinas_id;
        $dpa = DB::table('dpa')
                ->select('dpa.*', 'sub_dpa.*', 'ket_sub_dpa.*', 'detail_ket_sub_dpa.*', DB::raw('SUM(detail_ket_sub_dpa.jumlah_anggaran) as jumlah_anggaran'))
                ->join('sub_dpa', 'dpa.id', '=', 'sub_dpa.dpa_id', 'left')
                ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id', 'left')
                ->join('detail_ket_sub_dpa', 'ket_sub_dpa.id', '=', 'detail_ket_sub_dpa.ket_sub_dpa_id', 'left')
                ->where('dpa.dinas_id', $id_dinas)
                ->groupBy('detail_ket_sub_dpa.ket_sub_dpa_id')
                ->get();
        // $urusan = DB::table('dpa')->join('urusan', 'dpa.urusan_id', '=', 'urusan.id')->select('dpa.urusan_id', 'urusan.kode as kode_urusan', 'urusan.nomenklatur as nama_urusan')->where('dpa.dinas_id', $id_dinas)->get();
        // $bidang = DB::table('dpa')->select('dpa.bidang_id', 'bidang.kode as kode_bidang', 'bidang.nomenklatur as nama_bidang')->where('dpa.dinas_id', $id_dinas)->get();
        // $program = DB::table('dpa')->join('program', 'dpa.program_id', '=', 'program.id')->select('dpa.program_id', 'program.kode as kode_program', 'program.nomenklatur as nama_program')->where('dpa.dinas_id', $id_dinas)->get();
        // $kegiatan = DB::table('dpa')->join('kegiatan', 'dpa.kegiatan_id', '=', 'kegiatan.id')->select('dpa.kegiatan_id', 'kegiatan.kode as kode_kegiatan', 'kegiatan.nomenklatur as nama_kegiatan')->where('dpa.dinas_id', $id_dinas)->get();
        // $sub_kegiatan = DB::table('dpa')->join('sub_dpa', 'dpa.id', '=', 'sub_dpa.dpa_id')->join('sub_kegiatan', 'sub_dpa.sub_kegiatan_id', '=', 'sub_kegiatan.id')->select('dpa.id', 'sub_dpa.sub_kegiatan_id', 'sub_kegiatan.kode as kode_sub_kegiatan', 'sub_kegiatan.nomenklatur as nama_sub_kegiatan')->where('dpa.dinas_id', $id_dinas)->get();

        // dd($urusan->count());
        $data = [
            'dpa' => $dpa
        ];
        return view('pages.perencanaan-pembangunan.index', $data);
    }

    public function formDetail($id_dpa, $id_detail_ket_sub_dpa)
    {
        $dec_id_dpa = decrypsi($id_dpa);
        $dec_id_detail_ket_sub_dpa = decrypsi($id_detail_ket_sub_dpa);
        $komponen = KomponenPembangunan::where('parent', 0)->get();
        $data = [
            'komponen' => $komponen
        ];
        return view('pages.perencanaan-pembangunan.detail', $data);
    }
}
