<?php

namespace App\Http\Controllers;

use App\Models\MonitoringPembangunan;
use App\Models\KomponenPembangunan;
use App\Models\RencanaPembangunan;
use App\Models\DetRencanaPembangunan;
use App\Models\DokumentasiPembangunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MonitoringPembangunanController extends Controller
{
    public function index()
    {
        $id_dinas = auth()->user()->dinas_id;
        $data_dpa = DB::table('dpa')
            ->select('dpa.id as dpa_id', 'detail_ket_sub_dpa.id as detail_ket_sub_dpa_id', 'dpa.tahun_id', 'dpa.dinas_id', 'sub_dpa.sub_kegiatan_id', 'sub_dpa.sumber_dana_id', 'dinas.dinas', 'tahun.tahun', 'sumber_dana.sumber_dana', 'sub_kegiatan.nomenklatur as pekerjaan', 'rencana_pembangunan.lokasi_realisasi_anggaran', 'rencana_pembangunan.pelaksana', 'rencana_pembangunan.nomor_kontrak', 'rencana_pembangunan.nilai_kontrak', 'rencana_pembangunan.jangka_waktu', DB::raw('SUM(det_rencana_pembangunan.persentase) as persentase'))
            ->join('dinas', 'dinas.id', '=', 'dpa.dinas_id')
            ->join('tahun', 'tahun.id', '=', 'dpa.tahun_id')
            ->join('sub_dpa', 'sub_dpa.dpa_id', '=', 'dpa.id')
            ->join('sub_kegiatan', 'sub_kegiatan.id', '=', 'sub_dpa.sub_kegiatan_id')
            ->join('sumber_dana', 'sumber_dana.id', '=', 'sub_dpa.sumber_dana_id')
            ->join('ket_sub_dpa', 'ket_sub_dpa.sub_dpa_id', '=', 'sub_dpa.id')
            ->join('detail_ket_sub_dpa', 'detail_ket_sub_dpa.ket_sub_dpa_id', '=', 'ket_sub_dpa.id')
            ->join('rencana_pembangunan', 'rencana_pembangunan.detail_ket_sub_dpa_id', '=', 'detail_ket_sub_dpa.id')
            ->join('det_rencana_pembangunan', 'det_rencana_pembangunan.rencana_pembangunan_id', '=', 'rencana_pembangunan.id')
            ->groupBy('dpa.id')
            // ->where('dpa.id', $dec_id_dpa)
            ->get();

        // dd($data_dpa);
        $data = [
            'dpa' => $data_dpa
        ];
        return view('pages.monitoring-pembangunan.index', $data);
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
                ->select('det_rencana_pembangunan.*', 'dokumentasi_pekerjaan_pembangunan.id as dokumentasi_id', 'dokumentasi_pekerjaan_pembangunan.det_rencana_pembangunan', 'dokumentasi_pekerjaan_pembangunan.dokumentasi', 'komponen_pembangunan.parent', 'komponen_pembangunan.komponen')
                ->join('dokumentasi_pekerjaan_pembangunan', 'dokumentasi_pekerjaan_pembangunan.det_rencana_pembangunan', '=', 'det_rencana_pembangunan.id', 'left')
                ->join('komponen_pembangunan', 'komponen_pembangunan.id', '=', 'det_rencana_pembangunan.komponen_pembangunan_id')
                ->where('rencana_pembangunan_id', $data_umum->id)->get();

            $dokumentasi_pembangunan = DB::table('det_rencana_pembangunan')
                ->select('det_rencana_pembangunan.*', 'dokumentasi_pekerjaan_pembangunan.id as dokumentasi_id', 'dokumentasi_pekerjaan_pembangunan.det_rencana_pembangunan', 'dokumentasi_pekerjaan_pembangunan.dokumentasi', 'komponen_pembangunan.parent', 'komponen_pembangunan.komponen')
                ->join('dokumentasi_pekerjaan_pembangunan', 'dokumentasi_pekerjaan_pembangunan.det_rencana_pembangunan', '=', 'det_rencana_pembangunan.id', 'right')
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
            'rencana_pembangunan' => $rencana_pembangunan,
            'dokumentasi_pembangunan' => $dokumentasi_pembangunan

        ];
        // dd($data_dpa);
        return view('pages.monitoring-pembangunan.detail', $data);
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

    public function updateDataBlanko(Request $request)
    {
        if (count($request->id) > 0) {
            $jml_data = count($request->id);
            $incr = 0;
            foreach ($request->id as $key_id => $value_id) {
                $find_data = DetRencanaPembangunan::find($value_id);
                $data = [
                    'volume' => $request->volume[$key_id],
                    'satuan' => $request->satuan[$key_id],
                    'harga' => $request->harga[$key_id],
                    'persentase' => $request->persentase[$key_id],
                    'riil' => $request->riil[$key_id],
                    'keterangan' => $request->keterangan[$key_id],
                ];
                $find_data->update($data);
                $incr++;
            }
            if ($jml_data == $incr) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan!'
            ]);
        }
    }

    public function createDokumentasi(Request $request)
    {
        $data = $request->all();

        $path_file_dokumentasi = public_path() . '/dokumentasi-pembangunan';
        if (!File::exists($path_file_dokumentasi)) {
            File::makeDirectory($path_file_dokumentasi, $mode = 0777, true, true);
        }

        $file = $request->file('dokumentasi');
        $file_name = 'dokumentasi-pembangunan' . md5(rand()) . '-' . uniqid() .
            time() . date('ymd') . '.' . $file->getClientOriginalExtension();
        $file->move($path_file_dokumentasi, $file_name);

        $data['dokumentasi'] = $file_name;
        // dd($data);
        $simpan = DokumentasiPembangunan::create($data);
        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!',
                'id' => $simpan->id
            ]);
        }
    }

    public function updateDokumentasi(Request $request)
    {
        $data = $request->all();

        $dokumentasi = DokumentasiPembangunan::find($data['id']);

        $path_file_dokumentasi = public_path() . '/dokumentasi-pembangunan';
        if ($dokumentasi->dokumentasi != null) {
            File::delete($path_file_dokumentasi . '/' . $dokumentasi->dokumentasi);
        }

        if (!File::exists($path_file_dokumentasi)) {
            File::makeDirectory($path_file_dokumentasi, $mode = 0777, true, true);
        }

        $file = $request->file('dokumentasi');
        $file_name = 'dokumentasi-pembangunan' . md5(rand()) . '-' . uniqid() .
            time() . date('ymd') . '.' . $file->getClientOriginalExtension();
        $file->move($path_file_dokumentasi, $file_name);

        $data['dokumentasi'] = $file_name;
        // dd($data);
        $simpan = $dokumentasi->update($data);
        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!',
                'dokumentasi_id' => $data['id'],
                'dokumentasi' => $file_name
            ]);
        }
    }

    public function findDokumentasi(Request $request)
    {
        $dec_id_dpa = decrypsi($request->id_dpa);
        $dec_id_detail_ket_sub_dpa = decrypsi($request->id_detail_ket_sub_dpa);
        $data_umum = DB::table('rencana_pembangunan')
            ->where('detail_ket_sub_dpa_id', $dec_id_detail_ket_sub_dpa)
            ->first();

        if ($data_umum != NULL) {
            $data_dokumentasi = DB::table('det_rencana_pembangunan')
                ->select('det_rencana_pembangunan.*', 'dokumentasi_pekerjaan_pembangunan.id as dokumentasi_id', 'dokumentasi_pekerjaan_pembangunan.dokumentasi', 'komponen_pembangunan.parent', 'komponen_pembangunan.komponen')
                ->join('dokumentasi_pekerjaan_pembangunan', 'dokumentasi_pekerjaan_pembangunan.det_rencana_pembangunan', '=', 'det_rencana_pembangunan.id', 'right')
                ->join('komponen_pembangunan', 'komponen_pembangunan.id', '=', 'det_rencana_pembangunan.komponen_pembangunan_id')
                ->where('rencana_pembangunan_id', $data_umum->id)
                ->where('dokumentasi_pekerjaan_pembangunan.id', $request->id)->first();
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

        return response()->json([
            'status' => 'success',
            'message' => 'Data ditemukan!',
            'data_dokumentasi' => $data_dokumentasi,
            'data_umum' => $data_umum,
            'data_dpa' => $data_dpa
        ]);
    }

    public function deleteDokumentasi(Request $request)
    {
        $id = $request->id;

        $dokumentasi = DokumentasiPembangunan::find($id);

        $path_file_dokumentasi = public_path() . '/dokumentasi-pembangunan';
        if ($dokumentasi->dokumentasi != null) {
            File::delete($path_file_dokumentasi . '/' . $dokumentasi->dokumentasi);
        }

        $hapus =    $dokumentasi->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function updateDataInformasiPembangunan(Request $request)
    {
        $simpan = RencanaPembangunan::find($request->id);

        $data = $request->all();
        // dd($data);
        $keselamatan_pekerja = array();
        $tim_anggaran = array();
        $catatan = array();

        // keselamatan pekerja
        foreach ($request->key_keselamatan_pekerja as $key_kkp => $value_kkp) {
            $keselamatan_pekerja[$value_kkp] = $request->value_keselamatan_pekerja[$key_kkp];
        }

        // tim anggaran
        foreach ($request->nama_tim_anggaran as $key_nama_tim_anggaran => $value_nama_tim_anggaran) {
            $tim_anggaran[] = [
                'nama_tim_anggaran' => $value_nama_tim_anggaran,
                'nip_tim_anggaran' => $request->nip_tim_anggaran[$key_nama_tim_anggaran],
                'jabatan_tim_anggaran' => $request->jabatan_tim_anggaran[$key_nama_tim_anggaran],
            ];
        }

        // catatan
        foreach ($request->key_catatan as $key_kc => $value_kc) {
            if(gettype($value_kc) == 'array'){
                $tmp_value_catatan = array();
                foreach ($value_kc as $key => $value) {
                    $tmp_value_catatan[$value] = $request->value_catatan[$key_kc][$key];
                }
                // dd($key_kc);
                $catatan[str_replace("'", "", $key_kc)] = $tmp_value_catatan;
            }else {
                $catatan[$value_kc] = $request->value_catatan[$key_kc];
            }

        }

        $data['keselamatan_kontruksi'] = json_encode($keselamatan_pekerja);
        $data['catatan'] = json_encode($catatan);
        $data['tim_monitoring'] = json_encode($tim_anggaran);
        $ubah = $simpan->update($data);
        if ($ubah) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!'
            ]);
        }
    }

    public function getKondisi(Request $request)
    {
        $data = DetRencanaPembangunan::find($request->id);

        if ($data != null) {
            return response()->json([
                'status' => 'success',
                'data' => $data->persentase
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
}
