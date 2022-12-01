<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    public function index()
    {


        return view('pages.organisasi.index');
    }


    public function data()
    {
        if (request()->ajax()) {
            $data = Organisasi::all();
            return datatables()->of($data)

                ->addColumn('aksi', function ($data) {
                    $button = "

            <div class='d-flex justify-content-start'>
            <a class='edit btn btn btn-sm mx-1
            btn-warning ' title='Edit' href='" . route('organisasi.h_edit', $data->id) . "'><i class='fas fa-sm fa-pencil-alt'></i></a>";
                    $button  .= "<button class='hapus btn btn-sm btn-danger' data-toggle='tooltip' title='Hapus'
                 id='" . $data->id . "'><i class='fas fa-sm fa-trash-alt'></i></button>
            </div>

         ";
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make('true');
        }
    }


    public function h_tambah()
    {
        return view('pages.organisasi.create');
    }

    public function p_tambah(Request $request)
    {
        $organisasi = new Organisasi();
        $organisasi->kodeOrganisasi = $request->kodeOrganisasi;
        $organisasi->urusan = $request->urusan;
        $organisasi->nomenklatur = $request->nomenklatur;
        $organisasi->save();
        $simpan = $organisasi->save();

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan'
            ]);
        }
    }

    public function h_edit($id)
    {
        $organisasi = Organisasi::find($id);
        return view('pages.organisasi.edit', [
            'organisasi' => $organisasi
        ]);
    }

    public function p_edit(Request $request)
    {
        $id = $request->id;

        $organisasi = Organisasi::find($id);
        $organisasi->kodeOrganisasi = $request->kodeOrganisasi;
        $organisasi->urusan = $request->urusan;
        $organisasi->nomenklatur = $request->nomenklatur;
        $ubah =  $organisasi->save();

        if ($ubah) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $id = $request->id;
        $organisasi = Organisasi::find($id);

        $hapus = $organisasi->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        }
    }
}
