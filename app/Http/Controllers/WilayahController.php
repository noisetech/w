<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        return view('pages.wilayah.index');
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Wilayah::orderBy('wilayah', 'DESC')->get();

            return datatables()->of($data)

                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='edit btn btn btn-sm mx-1
                btn-warning ' title='Edit' href='" . route('wilayah.h_edit', $data->id) . "'><i class='fas fa-sm fa-pencil-alt'></i></a>";
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
        return view('pages.wilayah.create');
    }

    public function p_tambah(Request $request)
    {
        $wilayah = new Wilayah();
        $wilayah->wilayah = $request->wilayah;
        $simpan =  $wilayah->save();

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data disimpan'
            ]);
        }
    }

    public function h_edit($id)
    {
        $wilayah = Wilayah::find($id);
        return view('pages.wilayah.edit', [
            'wilayah' => $wilayah
        ]);
    }

    public function p_edit(Request $request)
    {

        $id = $request->id;
        $wilayah = Wilayah::find($id);
        $wilayah->wilayah = $request->wilayah;
        $ubah =  $wilayah->save();

        if ($ubah) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data disimpan'
            ]);
        }
    }

    public function hapus(Request $request)
    {

        $id = $request->id;
        $wilayah = Wilayah::find($id);
        $hapus =  $wilayah->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data disimpan'
            ]);
        }
    }
}
