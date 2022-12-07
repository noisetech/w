<?php

namespace App\Http\Controllers;

use App\Models\Dinas;
use App\Models\Tahun;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DinasController extends Controller
{
    public function index()
    {
        return view('pages.dinas.index');
    }


    public function data()
    {
        if (request()->ajax()) {
            $data = Dinas::orderBy('dinas', 'ASC')->get();

            return datatables()->of($data)
                ->editColumn('logo', function ($data) {
                    return $data->logo ? '<img src="' . asset('logo-dinas/' . $data->logo) . '" width="50" class="img-thumbnail"/>' : 2;
                })
                ->editColumn('icon', function ($data) {
                    return $data->icon ? '<img src="' . asset('icon-dinas/' . $data->icon) . '" width="50" class="img-thumbnail"/>' : 2;
                })
                ->addColumn('wilayah', function ($data) {
                    return $data->wilayah->wilayah;
                })
                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='edit btn btn btn-sm mx-1
                btn-warning ' title='Edit' href='#'><i class='fas fa-sm fa-pencil-alt'></i></a>";
                    $button  .= "<button class='hapus btn btn-sm btn-danger' data-toggle='tooltip' title='Hapus'
                     id='" . $data->id . "'><i class='fas fa-sm fa-trash-alt'></i></button>
                </div>

             ";
                    return $button;
                })
                ->rawColumns(['logo', 'wilayah', 'aksi'])
                ->make('true');
        }
    }

    public function h_tambah()
    {
        return view('pages.dinas.create');
    }

    public function listWilayah(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Wilayah::select("id", "wilayah")
                ->Where('wilayah', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }





    public function p_tambah(Request $request)
    {
        $dinas = new Dinas();
        $dinas->wilayah_id = $request->wilayah_id;
        $dinas->dinas = $request->dinas;
        $dinas->save();

        // logo
        $path_file_logo_dinas = public_path() . '/logo-dinas';
        if (!File::exists($path_file_logo_dinas)) {
            File::makeDirectory($path_file_logo_dinas, $mode = 0777, true, true);
        }

        $file = $request->file('logo');
        $file_name = 'file-logo-dinas' . md5(rand()) . '-' . uniqid() .
            time() . date('ymd') . '.' . $file->getClientOriginalExtension();
        $file->move($path_file_logo_dinas, $file_name);


        $dinas->logo = $file_name;


        // icon
        $path_file_icon_dinas = public_path() . '/icon-dinas';
        if (!File::exists($path_file_icon_dinas)) {
            File::makeDirectory($path_file_icon_dinas, $mode = 0777, true, true);
        }

        $file_icon = $request->file('icon');
        $file_icon_name = 'file-icon-dinas' . md5(rand()) . '-' . uniqid() .
            time() . date('ymd') . '.' . $file_icon->getClientOriginalExtension();
        $file_icon->move($path_file_icon_dinas, $file_icon_name);


        $dinas->logo = $file_name;
        $dinas->icon = $file_icon_name;

        $simpan = $dinas->save();

        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan'
            ]);
        }
    }

    public function h_edit($id)
    {
    }

    public function p_edit(Request $request)
    {
    }

    public function hapus(Request $request)
    {
    }
}
