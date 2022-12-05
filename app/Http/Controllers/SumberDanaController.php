<?php

namespace App\Http\Controllers;

use App\Models\SumberDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SumberDanaController extends Controller
{
    public function index()
    {
        return view('pages.sumber-dana.index');
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = SumberDana::all();

            return datatables()->of($data)

                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='edit btn btn btn-sm mx-1
                btn-warning ' title='Edit' href='" . route('sumber_dana.h_edit', $data->id) . "'><i class='fas fa-sm fa-pencil-alt'></i></a>";
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
        return view('pages.sumber-dana.create');
    }

    public function p_tambah(Request $request)
    {
        $rules = [
            'sumber_dana' => 'required',
        ];

        $text = [
            'sumber_dana.required' => 'tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $text);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data = $request->all();

        SumberDana::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function h_edit($id)
    {
        $sumber_dana = SumberDana::find($id);

        return view('pages.sumber-dana.edit', [
            'sumber_dana' => $sumber_dana
        ]);
    }

    public function p_edit(Request $request)
    {
        $rules = [
            'sumber_dana' => 'required',
        ];

        $text = [
            'sumber_dana.required' => 'tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $text);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }


        $id = $request->id;

        $sumber_dana = SumberDana::find($id);

        $data = $request->all();

        $sumber_dana->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function hapus(Request $request)
    {
        $id = $request->id;

        $sumber_dana = SumberDana::find($id);


        $sumber_dana->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
