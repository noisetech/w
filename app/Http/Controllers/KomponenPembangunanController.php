<?php

namespace App\Http\Controllers;

use App\Models\KomponenPembangunan;
use Illuminate\Http\Request;

class KomponenPembangunanController extends Controller
{
    public function index()
    {
        $komponen = KomponenPembangunan::where('parent', 0)->get();
        $data = [
            'komponen' => $komponen
        ];
        return view('pages.komponen-pembangunan.index', $data);
    }

    public function p_tambah(Request $request)
    {
        $data = $request->all();

        $simpan =   KomponenPembangunan::create($data);
        $latest_data = KomponenPembangunan::find($simpan->id);
        if ($simpan) {
            return response()->json([
                'status' => 'success',
                'latest_data' => $latest_data
            ]);
        }
    }

    public function form_edit(Request $request)
    {
        $id = $request->id;
        $komponen = KomponenPembangunan::find($id);

        $html = '
                <tr class="form-input-data">
                    <td>
                        <span class="d-none">1000</span><i class="fas fa-window-close text-danger m-1" role="button" title="Batal" onclick="clearForm()"></i>
                    </td>
                    <td>
                        <input type="hidden" id="id" name="id" value="'.$komponen->id.'">
                        <input type="text" class="form-control form-control-sm" id="komponen" name="komponen" placeholder="Komponen pekerjaan" value="'.$komponen->komponen.'">
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-save text-center text-success" role="button" title="Save" onclick="updateKomponenPembangunan('.$komponen->id.', event)"></i>
                        </div>
                    </td>
                </tr>';

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

        $komponen = KomponenPembangunan::find($id);

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

        $komponen = KomponenPembangunan::find($id);
        if ($komponen->parent == 0) {
            $hapus = KomponenPembangunan::where('parent', $id)->delete();
            if ($hapus) {
                $hapus =    $komponen->delete();
            }
        }else {
            $hapus =    $komponen->delete();
        }


        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }
}
