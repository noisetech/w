<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Dpa;
use App\Models\Kegiatan;
use App\Models\Organisasi;
use App\Models\Program;
use App\Models\SubDpa;
use App\Models\Unit;
use App\Models\Urusan;
use Illuminate\Http\Request;
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

    // bagian dpa

    public function index()
    {
        return view('pages.dpa.dpa.index');
    }

    public function h_tambah()
    {
        return view('pages.dpa.dpa.create');
    }

    public function sub_dpa($id)
    {
        $id = decrypsi($id);

        $sub_dpa = SubDpa::find($id);

        $segement = $id;

        $active = 'Sub Dpa';

        return view('pages.dpa.sub_dpa.index', [
            'sub_dpa' => $sub_dpa,
            'segement' => $segement,
            'active' => $active,
        ]);
    }

    public function insert_dpa_to_session(Request $request)
    {
        $bahan_dpa = Dpa::latest()->first();

        if ($bahan_dpa == NULL) {
            $id_dpa = 1;
        } else {
            $id_dpa = $bahan_dpa->id + 1;
        }

        if ($request->session()->get('dpa') == null) {

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
                'id' => $id_dpa,
                'no_dpa' => $request->no_dpa,
                'urusan_id' => $request->urusan_id,
                'bidang_id' => $request->bidang_id,
                'program_id' => $request->program_id,
                'kegiatan_id' => $request->kegiatan_id,
                'organisasi_id' => $request->organisasi_id,
                'unit_id' => $request->unit_id,
                'data_capaian_program' => json_encode($data_capaian_program),
                'data_indikator_kinerja' => json_encode($data_indikator_kinerja),
            ];

            $request->session()->put('dpa', $dpa);

            return response()->json([
                'status' => 'success'
            ]);
        }
    }
}
