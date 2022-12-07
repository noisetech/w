<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Kegiatan;
use App\Models\Program;
use App\Models\Satuan;
use App\Models\SubKegiatan;
use App\Models\Urusan;
use Illuminate\Http\Request;

class PerencanaanController extends Controller
{

    // urusan
    public function index()
    {
        $active = 'urusan';
        return view('pages.perencanaan.urusan.index', [
            'active' => $active
        ]);
    }



    public function data_urusan()
    {
        if (request()->ajax()) {
            $data = Urusan::all();

            return datatables()->of($data)
                ->editColumn('kode', function ($data) {
                    return '<a href="' . route('perencanaan.bidang', $data->id) . '">' . $data->kode . ' </a>';
                })
                ->editColumn('nomenklatur', function ($data) {
                    return '<a href="' . route('perencanaan.bidang', $data->id) . '">' . $data->nomenklatur . ' </a>';
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


    public function hapusDataUrusan(Request $request)
    {
        $id = decrypsi($request->id);

        $urusan = Urusan::find($id);

        $urusan->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }



    // bagian perencanaan bidang


    public function bidang($id)
    {
        $urusan = Urusan::find($id);
        $segment = $id;
        $active = 'bidang';

        return view('pages.perencanaan.bidang.index', [
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


    //program

    public function program($id)
    {
        $bidang = Bidang::find($id);
        $segment = $id;
        $active = 'bidang program';

        return view('pages.perencanaan.program.index', [
            'bidang' => $bidang,
            'segment' => $segment,
            'active' => $active,

        ]);
    }



    public function data_program(Request $request)
    {
        if (request()->ajax()) {

            $bidang_id = decrypsi($request->id);

            $data = Program::where('id_bidang', $bidang_id)->get();

            return datatables()->of($data)
                ->editColumn('kode', function ($data) {
                    return '<a href="' . route('perencanaan.kegiatan', $data->id) . '">' . $data->kode . ' </a>';
                })
                ->editColumn('nomenklatur', function ($data) {
                    return '<a href
                ="' . route('perencanaan.kegiatan', $data->id) . '">' . $data->nomenklatur . ' </a>';
                })
                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='mx-2' onclick='formEditProgramById(this)' title='Edit' href='javascript:;' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapusDataProgram(this)' data-toggle='tooltip' title='Hapus'
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

    public function p_form_tambah_program(Request $request)
    {
        $data = $request->all();

        $simpan =   Program::create($data);

        if ($simpan) {

            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function formEditProgramById(Request $request)
    {
        $id = decrypsi($request->id);

        $program = Program::find($id);

        $html = '<form action="#" method="post" id="form_edit_program">

        <input type="hidden" name="_token" value="' . csrf_token() . '" />

        <input type="hidden" name="id" value="' . encrypsi($program->id) . '">

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="Kode">Kode</label>
                    <input type="text" class="form-control" name="kode" placeholder="Kode" value="' . $program->kode . '">
                </div>
            </div>
            <div class="col-sm-7">
                <div class="form-group">
                    <label for="Kode">Nomenklatur</label>
                    <input type="text" class="form-control" name="nomenklatur"
                        placeholder="Nomenklatur"  value="' . $program->nomenklatur . '">
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

    public function p_formEditProgramById(Request $request)
    {
        $id =  decrypsi($request->id);

        $program = Program::find($id);

        $data = $request->all();

        $program->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function hapusProgramPerencanaan(Request $request)
    {
        $id = decrypsi($request->id);

        $program = Program::find($id);

        $hapus =  $program->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }


    // kegiatan
    public function kegiatan($id)
    {
        $program = Program::find($id);
        $segment = $id;
        $active = 'kegiatan program';

        return view('pages.perencanaan.kegiatan.index', [
            'program' => $program,
            'segment' => $segment,
            'active' => $active,
        ]);
    }

    public function data_kegiatan(Request $request)
    {
        if (request()->ajax()) {

            $program_id = decrypsi($request->id);

            $data = Kegiatan::where('program_id', $program_id)->get();

            return datatables()->of($data)
                ->editColumn('kode', function ($data) {
                    return '<a href="' . route('perencanaan.sub_kegiatan', $data->id) . '">' . $data->kode . ' </a>';
                })
                ->editColumn('nomenklatur', function ($data) {
                    return '<a href
            ="' . route('perencanaan.sub_kegiatan', $data->id) . '">' . $data->nomenklatur . ' </a>';
                })
                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
                <a class='mx-2' onclick='formEditKegiatanById(this)' title='Edit' href='javascript:;' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapusDataKegiatan(this)' data-toggle='tooltip' title='Hapus'
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

    public function p_form_tambah_kegiatan(Request $request)
    {
        $data = $request->all();

        $simpan =   Kegiatan::create($data);

        if ($simpan) {

            return response()->json([
                'status' => 'success'
            ]);
        }
    }


    public function formEditKegiatanById(Request $request)
    {
        $id = decrypsi($request->id);

        $kegiatan = Kegiatan::find($id);

        $html = '<form action="#" method="post" id="form_edit_kegiatan">

        <input type="hidden" name="_token" value="' . csrf_token() . '" />

        <input type="hidden" name="id" value="' . encrypsi($kegiatan->id) . '">

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="Kode">Kode</label>
                    <input type="text" class="form-control" name="kode" placeholder="Kode" value="' . $kegiatan->kode . '">
                </div>
            </div>
            <div class="col-sm-7">
                <div class="form-group">
                    <label for="Kode">Nomenklatur</label>
                    <input type="text" class="form-control" name="nomenklatur"
                        placeholder="Nomenklatur"  value="' . $kegiatan->nomenklatur . '">
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


    public function p_formEditKegiatanById(Request $request)
    {
        $id =  decrypsi($request->id);

        $kegiatan = Kegiatan::find($id);

        $data = $request->all();

        $kegiatan->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }


    public function hapusKegiatanPerencanaan(Request $request)
    {
        $id = decrypsi($request->id);

        $kegiatan = Kegiatan::find($id);

        $hapus =  $kegiatan->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    // sub kegiatan
    public function sub_kegiatan($id)
    {
        $kegiatan = Kegiatan::find($id);

        $segment = $id;
        $active = 'sub kegiatan';

        return view('pages.perencanaan.sub-kegiatan.index', [
            'kegiatan' => $kegiatan,
            'segment' => $segment,
            'active' => $active,
        ]);
    }

    public function subKegiatanById(Request $request)
    {
        $id = $request->id;

        $bahan_sub_kegiatan = SubKegiatan::where('id', $id)->get();

        return response()->json($bahan_sub_kegiatan);
    }

    public function data_sub_kegiatan(Request $request)
    {
        if (request()->ajax()) {

            $kegiatan_id = decrypsi($request->id);

            $data = SubKegiatan::where('kegiatan_id', $kegiatan_id)->get();

            return datatables()->of($data)
                ->addColumn('satuan', function ($data) {
                    return $data->satuan->satuan;
                })
                ->addColumn('aksi', function ($data) {
                    $button = "

                <div class='d-flex justify-content-start'>
            <a class='edit mx-2' title='Edit' href='#' id='" . encrypsi($data->id) . "' ' data-toggle='modal' data-target='#exampleModal2'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapusDataProgram(this)' data-toggle='tooltip' title='Hapus'
                     data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-trash-alt text-danger'></i></a>
                </div>
             ";
                    return $button;
                })

                ->addIndexColumn()
                ->rawColumns(['kode', 'satuan', 'no', 'nomenklatur', 'aksi'])
                ->make('true');
        }
    }

    public function listSatuanForKegiatan(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data =  Satuan::select("id", "satuan")
                ->Where('satuan', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function p_tambah_sub_kegiatan(Request $request)
    {
        $data = $request->all();

        SubKegiatan::create($data);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function formEditSubKegiatanById(Request $request)
    {
        $id = decrypsi($request->id);

        $sub_kegiatan = SubKegiatan::find($id);

        return response()->json($sub_kegiatan);
    }

    public function listSatuanBySubKegiatan(Request $request)
    {
        $sub_kegiatan = SubKegiatan::find($request->id);

        $satuan = Satuan::where('id', $sub_kegiatan->satuan_id)->get();

        return response()->json($satuan);
    }

    public function p_FormEditSubKegiatan(Request $request)
    {
        $id = $request->id;

        $sub_kegiatan = SubKegiatan::find($id);

        $data = $request->all();

        $sub_kegiatan->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
