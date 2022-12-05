<?php

namespace App\Http\Controllers;

use App\Models\PerencanaanPembangunan;
use Illuminate\Http\Request;

class PerencanaanPembangunanController extends Controller
{
    public function index()
    {
        $data = [

        ];
        return view('pages.perencanaan-pembangunan.index', $data);
    }

    public function p_tambah(Request $request)
    {
        $data = $request->all();

        $simpan =   PerencanaanPembangunan::create($data);

        if ($simpan) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function form_edit(Request $request)
    {
        $id = $request->id;
        $komponen = PerencanaanPembangunan::find($id);

        $html = '<td>
                    <span class="d-none">1000</span><i class="fas fa-window-close text-danger m-1" role="button" title="Batal" onclick="clearForm()"></i>
                </td>
                <td>
                    <input type="hidden" id="id" name="id" value="'.$komponen->id.'">
                    <input type="text" class="form-control form-control-sm" id="komponen" name="komponen" placeholder="Komponen pekerjaan" value="'.$komponen->komponen.'">
                </td>
                <td>
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-save text-center" role="button" title="Save" onclick="updateKomponenPembangunan('.$komponen->id.')"></i>
                    </div>
                </td>';

        if ($komponen->count() > 0) {
            return response()->json([
                'status' => 'success',
                'html' => $html
            ]);
        }
    }

    public function p_edit(Request $request)
    {
        $id = $request->id;

        $komponen = PerencanaanPembangunan::find($id);

        $data = $request->all();

        $ubah =    $komponen->update($data);


        if ($ubah) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $id = $request->id;

        $komponen = PerencanaanPembangunan::find($id);

        $hapus =    $komponen->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }
}
