<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            )
            ->join('dpa', 'dpa.id', '=', 'sub_dpa.dpa_id')
            ->join('sub_kegiatan', 'sub_kegiatan.id', '=', 'sub_dpa.sub_kegiatan_id')
            ->get();





        return view('pages.perencanaan-pengambilan.index', [
            'sub_dpa' => $sub_dpa
        ]);
    }

    public function h_relaisasi($id_sub_dpa)
    {

        $sub_dpa = DB::table('sub_dpa')
            ->select(
                'sub_dpa.id as sub_dpa_id',
                'sub_kegiatan.id as sub_kegiatan_id',
                'sub_kegiatan.kode as sub_kegiatan_kode',
                'sub_kegiatan.nomenklatur as sub_kegiatan_nomenklatur',
                'kegiatan.id as kegiatan_id',
                'kegiatan.kode as kegiatan_kode',
                'kegiatan.nomenklatur as kegiatan_nomenklatur',
                'program.id as program_id',
                'program.kode as program_kode',
                'program.nomenklatur as program_nomenklatur'
            )
            ->join('dpa', 'dpa.id', '=', 'sub_dpa.dpa_id')
            ->join('sub_kegiatan', 'sub_kegiatan.id', '=', 'sub_dpa.sub_kegiatan_id')
            ->join('kegiatan', 'kegiatan.id', '=', 'sub_kegiatan.kegiatan_id')
            ->join('program', 'program.id', '=', 'kegiatan.program_id')
            ->where('sub_dpa.id', decrypsi($id_sub_dpa))
            ->first();

        $bulan = DB::table('bulan')->select('*')->get();

        return view('pages.perencanaan-pengambilan.detail', [
            'sub_dpa' => $sub_dpa,
            'bulan' => $bulan
        ]);
    }

    public function tambah_realisasi($id_sub_dpa, $id_bulan)
    {
        $bulan = DB::table('bulan')->select('*')->where('id', $id_bulan)->first();

        $bahan_awal = DB::table('sub_dpa')
            ->select(
                'sub_dpa.id as sub_dpa_id',
                'dpa.id as dpa_id',
                'dpa.rencana_penarikan as rencana_penarikan_dpa',
                'ket_sub_dpa.id as ket_sub_dpa_id',
                'akun_rekening.id as akun_rekening_id',
                'kelompok_rekening.id as kelompok_rekening_id',
                'kelompok_rekening.kode as kelompok_rekening_kode',
                'kelompok_rekening.uraian_akun as kelompok_rekening_kode_uraian_akun',
                'jenis_rekening.id as jenis_rekening_id',
                'jenis_rekening.kode as jenis_rekening_kode',
                'jenis_rekening.uraian_akun as jenis_rekening_uraian_akun',
                'objek_rekening.id as objek_rekening_id',
                'objek_rekening.uraian_akun as objek_rekening_uraian_akun',
                'rincian_objek_rekening.id as rincian_objek_rekening_id',
                'rincian_objek_rekening.kode as rincian_objek_rekening_kode',
                'rincian_objek_rekening.uraian_akun as rincian_objek_rekening_uraian_akun',
            )
            ->join('dpa', 'dpa.id', '=', 'sub_dpa.dpa_id')
            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
            ->join('detail_ket_sub_dpa', 'ket_sub_dpa.id', 'detail_ket_sub_dpa.ket_sub_dpa_id')
            ->join('akun_rekening', 'akun_rekening.id', '=', 'ket_sub_dpa.akun')
            ->join('kelompok_rekening', 'akun_rekening.id', 'ket_sub_dpa.kelompok')
            ->join('jenis_rekening', 'jenis_rekening.id', '=', 'ket_sub_dpa.jenis')
            ->join('objek_rekening', 'objek_rekening.id', '=', 'ket_sub_dpa.objek')
            ->join('rincian_objek_rekening', 'rincian_objek_rekening.id', '=', 'ket_sub_dpa.rincian_objek')
            ->where('sub_dpa.id', $id_sub_dpa)
            ->first();

        $total_anggaran = DB::table('detail_ket_sub_dpa')
            ->select(DB::raw('sum(jumlah_anggaran) as jumlah_anggaran'))
            ->join('ket_sub_dpa', 'ket_sub_dpa.id', '=', 'detail_ket_sub_dpa.ket_sub_dpa_id')
            ->groupBy('detail_ket_sub_dpa.ket_sub_dpa_id')
            ->where('detail_ket_sub_dpa.ket_sub_dpa_id', $bahan_awal->ket_sub_dpa_id)
            ->first();

        $data_rencana_penarikan = json_decode($bahan_awal->rencana_penarikan_dpa);

        foreach ($data_rencana_penarikan as $key => $bahan_data) {

            // dd($bahan_data);
            if ($bahan_data->bulan == Str::ucfirst($bulan->bulan)) {
                return view('pages.perencanaan-pengambilan.create', [
                    'bahan_data' => $bahan_data,
                    'bahan_awal' => $bahan_awal,
                    'total_anggaran' => $total_anggaran
                ]);
            }
        }
    }

    public function proses_tambah_realisasi(Request $request)
    {

        $data = $request->all();

        DB::table('rencana_pengambilan')
            ->insert([
                'sub_dpa_id' => $request->sub_dpa_id,
                'bulan' => $request->bulan,
                'pengambilan' =>  intval(str_replace(".", "", $request->rencana_penarikan)) - intval($request->pengambilan),
                'realisasi' => $request->realisasi,
                'status_pelaksana' => $request->status,
                'keterangan_pelaksanaan' => $request->keterangan_status,
                'persentase' => $request->persentase,
                'status_kemanfaatan' => $request->status_kemanfaatan,
                'keterangan_permasalahan' => $request->permasalahan
            ]);
    }
}
