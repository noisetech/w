<?php

namespace App\Http\Controllers;

use App\Models\AkunRekening;
use App\Models\Bidang;
use App\Models\Dpa;
use App\Models\Kegiatan;
use App\Models\Organisasi;
use App\Models\Program;
use App\Models\SubDpa;
use App\Models\SubKegiatan;
use App\Models\SumberDana;
use App\Models\Unit;
use App\Models\Urusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Json;

class DpaController extends Controller
{


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

    // bagian dpa

    public function index()
    {
        return view('pages.dpa.dpa.index');
    }

    public function h_tambah()
    {

        return view('pages.dpa.dpa.create');
    }

    public function index_sub_dpa(Request $request)
    {
    }

    public function h_tambah_sub_dpa()
    {
        if (Session::get('dpa') == null) {
            return redirect()->back();
        }

        $active = 'sub_dpa';
        return view('pages.dpa.sub_dpa.create', [
            'active' => $active
        ]);
    }

    public function insert_dpa_to_session(Request $request)
    {
        if ($request->session()->get('dpa') == null) {
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
            ], [
                'tolak_ukur.*.required' => 'tidak boleh kosong',
                'kinerja.*.required' => 'tidak boleh kosong',
                'no_dpa.required' => 'tidak boleh kosong',
                'urusan_id.required' => 'tidak boleh kosong',
                'bidang_id.required' => 'tidak boleh kosong',
                'program_id.required' => 'tidak boleh kosong',
                'kegiatan_id.required' => 'tidak boleh kosong',
                'organisasi_id.required' => 'tidak boleh kosong',
                'unit_id.required' => 'tidak boleh kosong',
                'indikator_capaian_program.required' => 'tidak boleh kosong',
                'target_capaian_program.required' => 'tidak boleh kosong',

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

            $data_capaian_program = [
                'indikator' => $request->indikator_capaian_program,
                'target' => $request->target_capaian_program,
            ];

            $dpa = [
                'no_dpa' => $request->no_dpa,
                'urusan_id' => $request->urusan_id,
                'bidang_id' => $request->bidang_id,
                'program_id' => $request->program_id,
                'kegiatan_id' => $request->kegiatan_id,
                'organisasi_id' => $request->organisasi_id,
                'unit_id' => $request->unit_id,
                'capaian_program' => json_encode($data_capaian_program),
                'indikator_kinerja' => json_encode($data_indikator_kinerja),
            ];



            $request->session()->put('dpa', $dpa);

            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function insert_lanjutan_dpa(Request $request)
    {

        $data = $request->all();



        // bagian sub_dpa
        $sub_kegiatan = $data['sub_kegiatan_id'];
        $sumber_dana = $data['sumber_dana_id'];
        $lokasi = $data['lokasi'];
        $waktu_pelaksanaan = $data['waktu_pelaksanaan'];
        $keterangan = $data['keterangan'];
        $count = count($sub_kegiatan);

        for ($i = 0; $i < $count; $i++) {
            $tempt['sub_kegiatan'] = $sub_kegiatan[$i];
            $tempt['sumber_dana'] = $sumber_dana[$i];
            $tempt['lokasi'] = $lokasi[$i];


            $sub_dpa[] = $tempt;
        }


        $session_dpa =  $request->session()->put('sub_dpa', $sub_dpa);

        


        // akhir sub_dpa
        echo "<pre>";
        var_dump($sub_dpa);
        echo "</pre>";
        die;
    }


    public function berhenti_menambah_dpa()
    {
        Session::forget('dpa');

        return response()->json([
            'status' => 'success',
        ]);
    }
}
