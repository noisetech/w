<?php

namespace App\Http\Controllers;

use App\Models\PerencanaanPembangunan;
use App\Models\KomponenPembangunan;
use App\Models\RencanaPembangunan;
use App\Models\DetRencanaPembangunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerencanaanPembangunanController extends Controller
{
    public function index()
    {
        $id_dinas = auth()->user()->dinas_id;
        $dpa = DB::table('dpa')
            ->select('dpa.*', 'sub_dpa.*', 'ket_sub_dpa.*', 'detail_ket_sub_dpa.*', 'detail_ket_sub_dpa.id as detail_ket_sub_dpa_id', DB::raw('SUM(detail_ket_sub_dpa.jumlah_anggaran) as total_anggaran'))
            ->join('sub_dpa', 'dpa.id', '=', 'sub_dpa.dpa_id')
            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
            ->join('detail_ket_sub_dpa', 'ket_sub_dpa.id', '=', 'detail_ket_sub_dpa.ket_sub_dpa_id')
            ->where('dpa.dinas_id', $id_dinas)
            ->groupBy('detail_ket_sub_dpa.ket_sub_dpa_id')
            ->get();
        // $urusan = DB::table('dpa')->join('urusan', 'dpa.urusan_id', '=', 'urusan.id')->select('dpa.urusan_id', 'urusan.kode as kode_urusan', 'urusan.nomenklatur as nama_urusan')->where('dpa.dinas_id', $id_dinas)->get();
        // $bidang = DB::table('dpa')->select('dpa.bidang_id', 'bidang.kode as kode_bidang', 'bidang.nomenklatur as nama_bidang')->where('dpa.dinas_id', $id_dinas)->get();
        // $program = DB::table('dpa')->join('program', 'dpa.program_id', '=', 'program.id')->select('dpa.program_id', 'program.kode as kode_program', 'program.nomenklatur as nama_program')->where('dpa.dinas_id', $id_dinas)->get();
        // $kegiatan = DB::table('dpa')->join('kegiatan', 'dpa.kegiatan_id', '=', 'kegiatan.id')->select('dpa.kegiatan_id', 'kegiatan.kode as kode_kegiatan', 'kegiatan.nomenklatur as nama_kegiatan')->where('dpa.dinas_id', $id_dinas)->get();
        // $sub_kegiatan = DB::table('dpa')->join('sub_dpa', 'dpa.id', '=', 'sub_dpa.dpa_id')->join('sub_kegiatan', 'sub_dpa.sub_kegiatan_id', '=', 'sub_kegiatan.id')->select('dpa.id', 'sub_dpa.sub_kegiatan_id', 'sub_kegiatan.kode as kode_sub_kegiatan', 'sub_kegiatan.nomenklatur as nama_sub_kegiatan')->where('dpa.dinas_id', $id_dinas)->get();

        // dd($dpa);
        $data = [
            'dpa' => $dpa
        ];
        return view('pages.perencanaan-pembangunan.index', $data);
    }

    public function formDetail($id_dpa, $id_detail_ket_sub_dpa)
    {
        $dec_id_dpa = decrypsi($id_dpa);
        $dec_id_detail_ket_sub_dpa = decrypsi($id_detail_ket_sub_dpa);
        $data_umum = DB::table('rencana_pembangunan')
            ->where('detail_ket_sub_dpa_id', $dec_id_detail_ket_sub_dpa)
            ->first();

        if ($data_umum != NULL) {
            $rencana_pembangunan = DB::table('det_rencana_pembangunan')
                ->select('det_rencana_pembangunan.komponen_pembangunan_id', 'komponen_pembangunan.parent', 'komponen_pembangunan.komponen')
                ->join('komponen_pembangunan', 'komponen_pembangunan.id', '=', 'det_rencana_pembangunan.komponen_pembangunan_id')
                ->where('rencana_pembangunan_id', $data_umum->id)->get();
        } else {
            $rencana_pembangunan = [];
        }

        // dd($rencana_pembangunan);
        $data_dpa = DB::table('dpa')
            ->select('dpa.id as dpa_id', 'dpa.tahun_id', 'dpa.dinas_id', 'sub_dpa.sub_kegiatan_id', 'sub_dpa.sumber_dana_id', 'dinas.dinas', 'tahun.tahun', 'sumber_dana.sumber_dana', 'sub_kegiatan.nomenklatur as pekerjaan')
            ->join('dinas', 'dinas.id', '=', 'dpa.dinas_id')
            ->join('tahun', 'tahun.id', '=', 'dpa.tahun_id')
            ->join('sub_dpa', 'sub_dpa.dpa_id', '=', 'dpa.id')
            ->join('sub_kegiatan', 'sub_kegiatan.id', '=', 'sub_dpa.sub_kegiatan_id')
            ->join('sumber_dana', 'sumber_dana.id', '=', 'sub_dpa.sumber_dana_id')
            ->where('dpa.id', $dec_id_dpa)
            ->first();
        $komponen = KomponenPembangunan::where('parent', 0)->get();
        // dd($rencana_pembangunan->count());
        $data = [
            'komponen' => $komponen,
            'id_detail_ket_sub_dpa' => $id_detail_ket_sub_dpa,
            'data_dpa' => $data_dpa,
            'data_umum' => $data_umum,
            'rencana_pembangunan' => $rencana_pembangunan

        ];
        // dd($data_dpa);
        return view('pages.perencanaan-pembangunan.detail', $data);
    }

    public function insertDataUmum(Request $request)
    {
        $data = $request->all();
        $data['detail_ket_sub_dpa_id'] = decrypsi($request->detail_ket_sub_dpa_id);
        // dd($data);
        $simpan = RencanaPembangunan::create($data);
        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!'
            ]);
        }
    }

    public function updateDataUmum(Request $request)
    {
        $simpan = RencanaPembangunan::find($request->id);

        $data = $request->all();
        $data['detail_ket_sub_dpa_id'] = decrypsi($request->detail_ket_sub_dpa_id);
        $ubah = $simpan->update($data);
        if ($ubah) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!'
            ]);
        }
    }

    public function insertDataBlanko(Request $request)
    {
        $jml_data = count($request->komponen);
        $incr = 0;
        foreach ($request->komponen as $key_komponen => $value_komponen) {
            $data_komponen = [
                'komponen_pembangunan_id' => $value_komponen,
                'rencana_pembangunan_id' =>  $request->rencana_pembangunan_id
            ];
            DetRencanaPembangunan::create($data_komponen);
            $incr++;
        }
        if ($jml_data == $incr) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!'
            ]);
        }
    }

    public function updateDataBlanko(Request $request)
    {
        $del_data = DetRencanaPembangunan::where('rencana_pembangunan_id', $request->rencana_pembangunan_id);
        $deleted = $del_data->delete();
        if ($deleted) {
            $jml_data = count($request->komponen);
            $incr = 0;
            foreach ($request->komponen as $key_komponen => $value_komponen) {
                $data_komponen = [
                    'komponen_pembangunan_id' => $value_komponen,
                    'rencana_pembangunan_id' =>  $request->rencana_pembangunan_id
                ];
                DetRencanaPembangunan::create($data_komponen);
                $incr++;
            }
            if ($jml_data == $incr) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil diupdate!'
                ]);
            }
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal diupdate!'
            ]);
        }
    }
}
