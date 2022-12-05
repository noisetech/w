<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Organisasi;
use App\Models\Unit;
use App\Models\Urusan;
use Illuminate\Http\Request;

class PerencanaanOrganisasiController extends Controller
{
    public function urusan()
    {
        return view('pages.perencanaan-organisasi.urusan.index');
    }

    public function data_urusan()
    {
        if (request()->ajax()) {
            $data = Urusan::all();

            return datatables()->of($data)
                ->editColumn('kode', function ($data) {
                    return '<a href="' . route('perencanaan_organisasi.bidang', $data->id) . '">' . $data->kode . ' </a>';
                })
                ->editColumn('nomenklatur', function ($data) {
                    return '<a href="' . route('perencanaan_organisasi.bidang', $data->id) . '">' . $data->nomenklatur . ' </a>';
                })
                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='mx-2' onclick='formEditUrusanById(this)' title='Edit' href='javascript:;' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapusDataUrusan(this)' data-toggle='tooltip' title='Hapus'
                     data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-trash-alt text-danger'></i></a>
                </div>
             ";
                    return $button;
                })

                ->addIndexColumn()
                ->rawColumns(['kode', 'no', 'nomenklatur', 'aksi'])
                ->make('true');
        }
    }

    public function p_tambah_urusan(Request $request)
    {
        $data = $request->all();

        $simpan =  Urusan::create($data);

        if ($simpan) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function formEditUrusanById(Request $request)
    {
        $id = decrypsi($request->id);

        $urusan = Urusan::find($id);

        $html = '<form action="#" method="post" id="form_edit_urusan">

        <input type="hidden" name="_token" value="' . csrf_token() . '" />

        <input type="hidden" name="id" value="' . encrypsi($urusan->id) . '">

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="Kode">Kode</label>
                    <input type="text" class="form-control" name="kode" placeholder="Kode" value="' . $urusan->kode . '">
                </div>
            </div>
            <div class="col-sm-7">
                <div class="form-group">
                    <label for="Kode">Nomenklatur</label>
                    <input type="text" class="form-control" name="nomenklatur"
                        placeholder="Nomenklatur"  value="' . $urusan->nomenklatur . '">
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-sm btn-success btn-save"><i
                        class="fas fa-save"></i></button>
                <button type="button" class="btn btn-sm btn-danger btn-cancel2"><i
                        class="fas fa-times"></i></button>
            </div>
        </div>
    </form>';


        return response()->json($html);
    }

    public function p_formEditUrusanById(Request $request)
    {
        $id =  decrypsi($request->id);

        $urusan = Urusan::find($id);

        $data = $request->all();

        $urusan->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function hapusDataUrusan(Request $request)
    {
        $id = decrypsi($request->id);

        $urusan = Urusan::find($id);

        $urusan->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }

    // bagian bidang



    public function bidang($id)
    {




        $urusan = Urusan::find(decrypsi($id));
        $segment = decrypsi($id);
        $active = 'bidang';

        return view('pages.perencanaan-organisasi.bidang.index', [
            'urusan' => $urusan,
            'segment' => $segment,
            'active' => $active,

        ]);
    }

    public function data_bidang(Request $request)
    {
        if (request()->ajax()) {

            $id_urusan = decrypsi($request->id);

            $data = Bidang::where('urusan_id', $id_urusan)->get();

            return datatables()->of($data)
                ->editColumn('kode', function ($data) {
                    return '<a href="' . route('perencanaan.program', $data->id) . '">' . $data->kode . ' </a>';
                })
                ->editColumn('nomenklatur', function ($data) {
                    return '<a href
                    ="' . route('perencanaan.program', $data->id) . '">' . $data->nomenklatur . ' </a>';
                })

                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='mx-2' onclick='formEditBidangById(this)' title='Edit' href='javascript:;' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapusDataBidang(this)' data-toggle='tooltip' title='Hapus'
                     data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-trash-alt text-danger'></i></a>
                </div>
             ";
                    return $button;
                })

                ->addIndexColumn()
                ->rawColumns(['kode', 'no', 'nomenklatur', 'aksi'])
                ->make('true');
        }
    }



    public function p_form_urusan_bidang(Request $request)
    {
        $data = $request->all();

        $simpan =  Bidang::create($data);

        if ($simpan) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function formEditBidangById(Request $request)
    {
        $id = decrypsi($request->id);

        $bidang = Bidang::find($id);

        $html = '<form action="#" method="post" id="form_edit_bidang">

        <input type="hidden" name="_token" value="' . csrf_token() . '" />

        <input type="hidden" name="id" value="' . encrypsi($bidang->id) . '">

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="Kode">Kode</label>
                    <input type="text" class="form-control" name="kode" placeholder="Kode" value="' . $bidang->kode . '">
                </div>
            </div>
            <div class="col-sm-7">
                <div class="form-group">
                    <label for="Kode">Nomenklatur</label>
                    <input type="text" class="form-control" name="nomenklatur"
                        placeholder="Nomenklatur"  value="' . $bidang->nomenklatur . '">
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-sm btn-success btn-save"><i
                        class="fas fa-save"></i></button>
                <button type="button" class="btn btn-sm btn-danger btn-cancel2"><i
                        class="fas fa-times"></i></button>
            </div>
        </div>
    </form>';


        return response()->json($html);
    }


    public function p_formEditBidangById(Request $request)
    {
        $id =  decrypsi($request->id);

        $bidang = Bidang::find($id);

        $data = $request->all();

        $bidang->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function hapusBidangPerencanaan(Request $request)
    {
        $id = decrypsi($request->id);

        $bidang = Bidang::find($id);

        $hapus =  $bidang->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    // organisasi
    public function organisasi($id)
    {
        $bidang = Bidang::find(decrypsi($id));
        $segment = decrypsi($id);
        $active = 'organisasi';

        return view('pages.perencanaan-organisasi.organisasi.index', [
            'bidang' => $bidang,
            'segment' => $segment,
            'active' => $active
        ]);
    }

    public function data_organisasi(Request $request)
    {
        if (request()->ajax()) {

            $bidang_id = decrypsi($request->id);

            $data = Organisasi::where('bidang_id', $bidang_id)->get();

            return datatables()->of($data)
                ->editColumn('kode', function ($data) {
                    return '<a href="' . route('perencanaan.program', $data->id) . '">' . $data->kode . ' </a>';
                })
                ->editColumn('nomenklatur', function ($data) {
                    return '<a href
                    ="' . route('perencanaan.program', $data->id) . '">' . $data->nomenklatur . ' </a>';
                })

                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='mx-2' onclick='formEditOrganisasigById(this)' title='Edit' href='javascript:;' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapusDataOrganisasi(this)' data-toggle='tooltip' title='Hapus'
                     data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-trash-alt text-danger'></i></a>
                </div>
             ";
                    return $button;
                })

                ->addIndexColumn()
                ->rawColumns(['kode', 'no', 'nomenklatur', 'aksi'])
                ->make('true');
        }
    }

    public function p_formTambahOrganisasi(Request $request)
    {
        $data = $request->all();

        $simpan =  Organisasi::create($data);

        if ($simpan) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }


    public function formEditOrganisasigById(Request $request)
    {
        $id = decrypsi($request->id);

        $organisasi = Organisasi::find($id);

        $html = '<form action="#" method="post" id="form_edit_organisasi">

        <input type="hidden" name="_token" value="' . csrf_token() . '" />

        <input type="hidden" name="id" value="' . encrypsi($organisasi->id) . '">

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="Kode">Kode</label>
                    <input type="text" class="form-control" name="kode" placeholder="Kode" value="' . $organisasi->kode . '">
                </div>
            </div>
            <div class="col-sm-7">
                <div class="form-group">
                    <label for="Kode">Nomenklatur</label>
                    <input type="text" class="form-control" name="nomenklatur"
                        placeholder="Nomenklatur"  value="' . $organisasi->nomenklatur . '">
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-sm btn-success btn-save"><i
                        class="fas fa-save"></i></button>
                <button type="button" class="btn btn-sm btn-danger btn-cancel2"><i
                        class="fas fa-times"></i></button>
            </div>
        </div>
    </form>';


        return response()->json($html);
    }

    public function p_formEditOrganisasigById(Request $request)
    {
        $id =  decrypsi($request->id);

        $organisasi = Organisasi::find($id);

        $data = $request->all();

        $organisasi->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function hapusOrganisasi(Request $request)
    {
        $id = decrypsi($request->id);

        $organisasi = Organisasi::find($id);

        $hapus =   $organisasi->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }


    // unit
    public function unit($id)
    {
        $organisasi = Organisasi::find(decrypsi($id));
        $segment = decrypsi($id);
        $active = 'unit';

        return view('pages.perencanaan-organisasi.unit.index', [
            'organisasi' => $organisasi,
            'segment' => $segment,
            'active' => $active
        ]);
    }

    public function data_unit(Request $request)
    {
        if (request()->ajax()) {

            $organisasi_id = decrypsi($request->id);

            $data = Unit::where('organisasi_id', $organisasi_id)->get();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='mx-2' onclick='formEditUnitById(this)' title='Edit' href='javascript:;' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapusUnit(this)' data-toggle='tooltip' title='Hapus'
                     data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-trash-alt text-danger'></i></a>
                </div>
             ";
                    return $button;
                })

                ->addIndexColumn()
                ->rawColumns(['kode', 'nomenklatur', 'aksi'])
                ->make('true');
        }
    }

    public function p_formTambahUnit(Request $request)
    {
        $data = $request->all();

        $simpan =  Unit::create($data);

        if ($simpan) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function formEditUnitById(Request $request)
    {
        $id = decrypsi($request->id);

        $unit = Unit::find($id);

        $html = '<form action="#" method="post" id="form_edit_unit">

        <input type="hidden" name="_token" value="' . csrf_token() . '" />

        <input type="hidden" name="id" value="' . encrypsi($unit->id) . '">

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="Kode">Kode</label>
                    <input type="text" class="form-control" name="kode" placeholder="Kode" value="' . $unit->kode . '">
                </div>
            </div>
            <div class="col-sm-7">
                <div class="form-group">
                    <label for="Kode">Nomenklatur</label>
                    <input type="text" class="form-control" name="nomenklatur"
                        placeholder="Nomenklatur"  value="' . $unit->nomenklatur . '">
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-sm btn-success btn-save"><i
                        class="fas fa-save"></i></button>
                <button type="button" class="btn btn-sm btn-danger btn-cancel2"><i
                        class="fas fa-times"></i></button>
            </div>
        </div>
    </form>';


        return response()->json($html);
    }

    public function p_formEditUnitgById(Request $request)
    {
        $id =  decrypsi($request->id);

        $unit = Unit::find($id);

        $data = $request->all();

        $unit->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }


    public function hapusUnit(Request $request)
    {
        $id = decrypsi($request->id);

        $unit = Unit::find($id);

        $hapus =   $unit->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }
}
