<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Urusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrusanController extends Controller
{
    public function index()
    {
        return view('pages.urusan.index');
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Urusan::all();

            return datatables()->of($data)

                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='text-warning' title='Edit' href='" . route('urusan.h_edit', $data->id) . "'><i class='fas fa-sm fa-pencil-alt'></i></a>";
                    $button .= "
                    <a class='px-1 text-info' title='Detail' href='" . route('urusan.detail', $data->id) . "'><i class='fas fa-sm fa-eye'></i></a>";
                    $button  .= "<a class='px-1 text-danger hapus' href='#' class='hapus' data-toggle='tooltip' title='Hapus'
                     id='" . $data->id . "'><i class='fas fa-sm fa-trash-alt'></i></a>
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
        return view('pages.urusan.create');
    }

    public function p_tambah(Request $request)
    {
        $rules = [
            'kode' => 'requried',
            'nomenklatur' => 'required'
        ];

        $text = [
            'kode.requried' => 'tidak boleh kosong',
            'nomenklatur.requried' => 'tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $text);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'success',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data = $request->all();

        Urusan::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diubah'
        ]);
    }

    public function h_edit($id)
    {
        $urusan = Urusan::find($id);

        return view('pages.urusan.edit', [
            'urusan' => $urusan
        ]);
    }

    public function detail($id)
    {


        $urusan = Urusan::find($id);
        $unit = Unit::where('urusan_id', $urusan->id)->get();
        return view('pages.urusan.detail', [
            'urusan' => $urusan,
            'unit' => $unit
        ]);
    }

    public function p_edit(Request $request)
    {

        $id = $request->id;

        $urusan = Urusan::find($id);

        $data = $request->all();

        $urusan->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diubah'
        ]);
    }

    public function hapus(Request $request)
    {
        $id = $request->id;

        $urusan = Urusan::find($id);


        $urusan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function h_tambah_unit($id)
    {
        $urusan = Urusan::find($id);

        return view('pages.urusan.create-unit', [
            'urusan' => $urusan,
        ]);
    }

    public function p_tambah_unit_urusan(Request $request)
    {
        $unit = new Unit();
        $unit->urusan_id = $request->urusan_id;
        $unit->kode = $request->kode;
        $unit->nomenklatur = $request->nomenklatur;
        $simpan =  $unit->save();

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan'
            ]);
        }
    }

    public function h_edit_unit_urusan($id)
    {
        $unit = Unit::find($id);

        return view('pages.urusan.edit-unit-urusan', [
            'unit' => $unit
        ]);
    }

    public function p_ubah_unit_urusan($id)
    {
    }

    public function hapus_unit_urusan(Request $request)
    {
        $id = $request->id;
        $unit = Unit::find($id);
        $unit->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
