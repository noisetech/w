<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
    {
        return view('pages.satuan.index');
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Satuan::orderBy('satuan', 'asc')->get();

            return datatables()->of($data)

                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='edit btn btn btn-sm mx-1
                btn-warning ' title='Edit' href='" . route('satuan.h_edit', $data->id) . "'><i class='fas fa-sm fa-pencil-alt'></i></a>";
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
        return view('pages.satuan.create');
    }

    public function p_tambah(Request $request)
    {
        $data = $request->all();

        $simpan =   Satuan::create($data);

        if ($simpan) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function h_edit($id)
    {
        $satuan = Satuan::find($id);

        return view('pages.satuan.edit', [
            'satuan' => $satuan
        ]);
    }

    public function p_edit(Request $request)
    {
        $id = $request->id;

        $satuan = Satuan::find($id);

        $data = $request->all();

        $ubah =    $satuan->update($data);


        if ($ubah) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $id = $request->id;

        $satuan = Satuan::find($id);

        $hapus =    $satuan->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }
}
