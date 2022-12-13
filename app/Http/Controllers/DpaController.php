<?php

namespace App\Http\Controllers;

use App\Models\AkunRekening;
use App\Models\Bidang;
use App\Models\DetailKetSubDpa;
use App\Models\Dinas;
use App\Models\Dpa;
use App\Models\JenisRekening;
use App\Models\Kegiatan;
use App\Models\KelompokRekening;
use App\Models\KetSubDpa;
use App\Models\ObjekRekening;
use App\Models\Organisasi;
use App\Models\Program;
use App\Models\RincianObjekRekening;
use App\Models\SubDpa;
use App\Models\SubKegiatan;
use App\Models\SubRincianObjekRekening;
use App\Models\SumberDana;
use App\Models\Tahun;
use App\Models\Unit;
use App\Models\Urusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DpaController extends Controller
{


    public function listDinas(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Dinas::select("id", "dinas")
                ->Where('dinas', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function listUrusan(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Urusan::select("id", "kode", "nomenklatur")
                ->Where('kode', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function listBidang($id)
    {
        $data = Bidang::where('urusan_id', $id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function listTahun(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Tahun::select("id", "tahun")
                ->Where('tahun', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }



    public function listProgram($id)
    {
        $data = Program::where('id_bidang', $id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function listKegiatan($id)
    {
        $data = Kegiatan::where('program_id', $id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function listOrganisasi($id)
    {
        $data = Organisasi::where('bidang_id', $id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function listUnit($id)
    {
        $data = Unit::where('organisasi_id', $id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function listSubkegiatan()
    {
        $data = SubKegiatan::where('kode', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function listSumberDana()
    {
        $data = SumberDana::where('sumber_dana', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function listAkunRekening()
    {
        $data = AkunRekening::where('kode', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function listKelompokRekening($id)
    {
        $data = KelompokRekening::where('akun_rekening_id', $id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();


        return response()->json($data);
    }

    public function listJenisRekening($id)
    {
        $data = JenisRekening::where('kelompok_rekening_id', $id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();


        return response()->json($data);
    }


    public function listObjekRekening($id)
    {
        // dd($id);
        $data = ObjekRekening::where('jenis_rekening_id', $id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();


        return response()->json($data);
    }


    public function listRincianRekening($id)
    {
        $data = RincianObjekRekening::where('objek_rekening_id', $id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();


        return response()->json($data);
    }

    public function listSubRincianRekening($id)
    {
        $data = SubRincianObjekRekening::where('rincian_objek_rekening_id', $id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();


        return response()->json($data);
    }



    // bagian dpa

    public function index()
    {
        return view('pages.dpa.dpa.index');
    }

    public function data_table_dpa()
    {
        if (request()->ajax()) {
            $data = Dpa::all();

            return datatables()->of($data)
                ->addColumn('urusan', function ($data) {
                    return $data->urusan->kode . ' ' . $data->urusan->nomenklatur;
                })
                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='edit mx-2
                ' title='Edit' href='" . route('tahun.edit', $data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapusDpa(this)' data-toggle='tooltip' title='Hapus'
                data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-trash-alt text-danger'></i></a>
           </div>
        ";;
                    return $button;
                })
                ->rawColumns(['urusan', 'aksi'])
                ->make('true');
        }
    }

    public function h_tambah()
    {

        return view('pages.dpa.dpa.create');
    }

    public function index_sub_dpa(Request $request)
    {
    }

    public function h_tambah_sub_dpa($id)
    {

        $dpa = Dpa::find($id);

        $sub_dpa = SubDpa::where('id', $dpa->id)->get();

        $active = 'sub_dpa';
        return view('pages.dpa.sub_dpa.create', [
            'active' => $active,
            'dpa' => $dpa,
            'sub_dpa' => $sub_dpa
        ]);
    }

    public function insert_dpa_to_session(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'no_dpa' => 'required',
            'urusan_id' => 'required',
            'bidang_id' => 'required',
            'program_id' => 'required',
            'kegiatan_id' => 'required',
            'organisasi_id' => 'required',
            'unit_id' => 'required',
            'tolak_ukur.*' => 'required',
            'kinerja.*' => 'required',
            'indikator_capaian_program' => 'required',
            'target_capaian_program' => 'required',
            'tahun_alokasi.*' => 'required',
            'jumlah_alokasi_dana.*' => 'required',
        ], [
            'tolak_ukur.*.required' => 'tidak boleh kosong',
            'kinerja.*.required' => 'tidak boleh kosong',
            'jumlah_alokasi_dana.*.required' => 'tidak boleh kosong',
            'no_dpa.required' => 'tidak boleh kosong',
            'urusan_id.required' => 'tidak boleh kosong',
            'bidang_id.required' => 'tidak boleh kosong',
            'program_id.required' => 'tidak boleh kosong',
            'kegiatan_id.required' => 'tidak boleh kosong',
            'organisasi_id.required' => 'tidak boleh kosong',
            'unit_id.required' => 'tidak boleh kosong',
            'indikator_capaian_program.required' => 'tidak boleh kosong',
            'target_capaian_program.required' => 'tidak boleh kosong',
            'tahun_alokasi.*.required' => 'tidak boleh kosong',
            'jumlah_alokasi_dana.*.required' => 'tidak boleh kosong',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }


        $indikator = $request->indikator;
        $tolak_ukur = $request->tolak_ukur;
        $kinerja = $request->kinerja;

        $data_indikator_kinerja = array();

        foreach ($indikator as $key_indikator => $value_indikator) {
            $data_indikator_kinerja[] = [
                'indikator' => $value_indikator,
                'tolak_ukur' => $tolak_ukur[$key_indikator],
                'kinerja' => $kinerja[$key_indikator]
            ];
        }

        // dd($data_indikator_kinerja);

        $data_capaian_program = [
            'indikator' => $request->indikator_capaian_program,
            'target' => $request->target_capaian_program,
        ];

        $tahun_alokasi = $request->tahun_alokasi;
        $jumlah_alokasi_dana = $request->jumlah_alokasi_dana;
        // dd($jumlah_alokasi_dana);

        $data_alokasi_tahun = array();

        foreach ($tahun_alokasi as $key_tahun_alokasi => $value_tahun_alokasi) {
            $data_alokasi_tahun[] = [
                'tahun' => $value_tahun_alokasi,
                'jumlah' => $jumlah_alokasi_dana[$key_tahun_alokasi]
            ];
        }




        $dpa = Dpa::create([
            'no_dpa' => $request->no_dpa,
            'urusan_id' => $request->urusan_id,
            'bidang_id' => $request->bidang_id,
            'program_id' => $request->program_id,
            'kegiatan_id' => $request->kegiatan_id,
            'organisasi_id' => $request->organisasi_id,
            'unit_id' => $request->unit_id,
            'alokasi_tahun' => json_encode($data_alokasi_tahun),
            'capaian_program' => json_encode($data_capaian_program),
            'indikator_kinerja' => json_encode($data_indikator_kinerja),
        ]);



        return response()->json([
            'status' => 'success',
            'bahan_dpa_id' => $dpa->id,
        ]);
    }

    public function hapusDPA(Request $request)
    {
        $id = decrypsi($request->id);

        $hapus = DB::table('dpa')->where('id', $id)->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function insert_lanjutan_dpa(Request $request)
    {

        $dpa_id = $request->dpa_id;

        $data_sub_dpa = [
            'dpa_id' => $dpa_id,
            'sub_kegiatan_id' => $request->sub_kegiatan_id,
            'sumber_dana_id' => $request->sumber_dana_id,
            'lokasi' => $request->lokasi,
            'target' => $request->target,
            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'keterangan' => $request->keterangan,
        ];

        $bahan_data_sub_dpa = SubDpa::create($data_sub_dpa);

        $data_ket_sub_dpa = [
            'sub_dpa_id' => $bahan_data_sub_dpa->id,
            'akun' => $request->akun,
            'kelompok' => $request->kelompok,
            'jenis' => $request->jenis,
            'objek' => $request->objek,
            'rincian_objek' => $request->rincian_objek,
        ];

        $bahan_data_ket_sub_dpa =  KetSubDpa::create($data_ket_sub_dpa);


        $sub_rincian = $request->sub_rincian;
        $jumlah_anggaran = $request->jumlah_anggaran;

        $data_ket_sub_dpa = array();

        foreach ($sub_rincian as $key_sub_rincian => $value_sub_rincian) {
            $data_ket_sub_dpa[] = [
                'ket_sub_dpa_id' => $bahan_data_ket_sub_dpa->id,
                'sub_rincian_objek' => $value_sub_rincian,
                'jumlah_anggaran' => $jumlah_anggaran[$key_sub_rincian]
            ];
        }

        $simpan =   DB::table('detail_ket_sub_dpa')->insert($data_ket_sub_dpa);

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'bahan_id_dpa' => $dpa_id
            ]);
        }
    }





    public function recana_pengambilan_dpa($id)
    {
        $dpa = Dpa::find($id);
        $active = 'rencana pengambilan';
        $segement = $id;

        return view('pages.dpa.pengambilan.create', [
            'dpa' => $dpa,
            'active' => $active,
            'segement' => $segement
        ]);
    }


    public function proses_pengambalian(Request $request)
    {
        $id = $request->dpa_id;

        $dpa = Dpa::find($id);

        $bulan = $request->bulan;

        $jumlah = $request->jumlah;

        $data_rencana_penarikan = array();

        foreach ($bulan as $key_bulan => $value_bulan) {
            $data_rencana_penarikan[] = [
                'bulan' => $value_bulan,
                'jumlah' => $jumlah[$key_bulan]
            ];
        }


        $ubah = Dpa::where('id', $dpa->id)
            ->update([
                'rencana_penarikan' => json_encode($data_rencana_penarikan)
            ]);



        if ($ubah) {
            return response()->json([
                'status' => 'success',
                'bahan_id_dpa' => $dpa->id
            ]);
        }
    }

    public function tim_anggaran($id)
    {
        $dpa = Dpa::find($id);

        $active = 'tim anggaran';
        $segement = $id;

        return view('pages.dpa.tim-anggaran.create', [
            'dpa' => $dpa,
            'segment' => $segement,
            'active' => $active
        ]);
    }

    public function p_tim_anggaran(Request $request)
    {


        $id = $request->dpa_id;

        $dpa = Dpa::find($id);

        $nama = $request->nama;

        $nip = $request->nip;
        $jabatan = $request->jabatan;

        $data_tim_anggaran = array();

        foreach ($nama as $key_nama => $value_nama) {
            $data_tim_anggaran[] = [
                'nama' => $value_nama,
                'nip' => $nip[$key_nama],
                'jabatan' => $jabatan[$key_nama]
            ];
        }


        // dd($data_rencana_penarikan);

        $ubah = Dpa::where('id', $dpa->id)
            ->update([
                'tim_anggaran' => json_encode($data_tim_anggaran)
            ]);



        if ($ubah) {
            return response()->json([
                'status' => 'success',
                'bahan_id_dpa' => $dpa->id
            ]);
        }
    }

    public function ttd_dpa($id)
    {
        $dpa = Dpa::find($id);
        $active = 'ttd dpa';
        $segment = $id;

        return view('pages.dpa.ttd-dpa.create', [
            'dpa' => $dpa,
            'active' => $active,
            'segement' => $segment,
        ]);
    }

    public function p_ttd_dpa(Request $request)
    {


        $id = $request->dpa_id;

        // dd($id);

        $dpa = Dpa::find($id);

        $kota = $request->kota;
        $tanggal = $request->tanggal;
        $jabatan_pejabat = $request->jabatan_pejabat;
        $nip = $request->nip;


        $data_ttd_dpa = array();

        foreach ($kota as $key_kota => $value_kota) {
            $data_ttd_dpa[] = [
                'kota' => $value_kota,
                'tanggal' => $tanggal[$key_kota],
                'jabatan_pejabat' => $jabatan_pejabat[$key_kota],
                'nip' => $nip[$key_kota]
            ];
        }

        // dd(json_encode($data_ttd_dpa));

        $ubah = Dpa::where('id', $dpa->id)
            ->update([
                'ttd_dpa' => json_encode($data_ttd_dpa)
            ]);

        if ($ubah) {
            return response()->json([
                'status' => 'success',
                'bahan_id_dpa' => $dpa->id
            ]);
        }
    }
}
