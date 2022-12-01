<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TahunController extends Controller
{
    public function index()
    {
        return view('pages.tahun.index');
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Tahun::orderBy('tahun', 'DESC')->get();

            return datatables()->of($data)

                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='edit btn btn btn-sm mx-1
                btn-warning ' title='Edit' href='" . route('tahun.edit', $data->id) . "'><i class='fas fa-sm fa-pencil-alt'></i></a>";
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
        return view('pages.tahun.create');
    }

    public function p_tambah(Request $request)
    {

        $rules = [
            'tahun' => 'required',
        ];

        $text = [
            'tahun.required' => 'tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $text);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $tahun = new Tahun();
        $tahun->tahun = $request->tahun;


        $simpan =  $tahun->save();


        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan'
            ]);
        }
    }

    public function h_edit($id)
    {
        $tahun = Tahun::find($id);

        return view('pages.tahun.edit', [
            'tahun' => $tahun
        ]);
    }

    public function p_edit(Request $request)
    {
        $id = $request->id;

        $tahun = Tahun::find($id);
        $tahun->tahun = $request->tahun;
        $ubah = $tahun->save();

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
        $tahun = Tahun::find($id);
        $hapus =  $tahun->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        }
    }
}
