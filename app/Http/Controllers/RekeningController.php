<?php

namespace App\Http\Controllers;

use App\Models\AkunRekening;
use App\Models\KelompokRekening;
use App\Models\JenisRekening;
use App\Models\ObjekRekening;
use App\Models\RincianObjekRekening;
use App\Models\SubRincianObjekRekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{

    // urusan
    public function index()
    {
        $active = 'akun';
        return view('pages.rekening.akun.index', [
            'active' => $active
        ]);
    }



    public function data_akun()
    {
        if (request()->ajax()) {
            $data = AkunRekening::all();

            return datatables()->of($data)
                ->editColumn('kode', function ($data) {
                    return '<a href="' . route('rekening.kelompok', encrypsi($data->id)) . '">' . $data->kode . ' </a>';
                })
                ->editColumn('uraian_akun', function ($data) {
                    return '<a href="' . route('rekening.kelompok', encrypsi($data->id)) . '">' . $data->uraian_akun . ' </a>';
                })
                ->editColumn('deskripsi_akun', function ($data) {
                    return '<a href="' . route('rekening.kelompok', encrypsi($data->id)) . '">' . $data->deskripsi_akun . ' </a>';
                })
                ->addColumn('aksi', function ($data) {
                    $button = "
                <div class='d-flex justify-content-start'>
                <a class='mx-2' onclick='edit(this)' title='Edit' href='javascript:;' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapus(this)' data-toggle='tooltip' title='Hapus'
                     data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-trash-alt text-danger'></i></a>
                </div>
             ";
                    return $button;
                })

                ->addIndexColumn()
                ->rawColumns(['kode', 'uraian_akun', 'deskripsi_akun', 'aksi'])
                ->make('true');
        }
    }

    public function p_tambah_akun_rekening(Request $request)
    {
        $data = $request->all();

        $simpan =  AkunRekening::create($data);

        if ($simpan) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function edit_akun_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $akun = AkunRekening::find($id);

        $html = '<form action="#" method="post" id="form_edit">
                    <input type="hidden" name="_token" value="' . csrf_token() . '" />

                    <input type="hidden" name="id" value="' . encrypsi($akun->id) . '">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="Kode">Kode</label>
                                <input type="text" class="form-control" name="kode" placeholder="Kode" value="'.$akun->kode.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="uraian_akun">Uraian Akun</label>
                                <input type="text" class="form-control" name="uraian_akun"
                                    placeholder="Uraian Akun" value="'.$akun->uraian_akun.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="deskripsi_akun">Deskripsi Akun</label>
                                <input type="text" class="form-control" name="deskripsi_akun"
                                    placeholder="Deskripsi Akun" value="'.$akun->deskripsi_akun.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-danger btn-cancel"><i
                                        class="fas fa-times"></i></button>
                                <button type="submit" class="btn btn-sm btn-success btn-save mx-1"><i
                                        class="fas fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                </form>';


        return response()->json($html);
    }

    public function p_edit_akun_rekening(Request $request)
    {
        $id =  decrypsi($request->id);

        $akun = AkunRekening::find($id);

        $data = $request->all();

        $akun->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function hapus_akun_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $akun = AkunRekening::find($id);

        $akun->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }

    // bagian kelompok

    public function kelompok($id)
    {
        $dec_id = decrypsi($id);
        $akun = AkunRekening::find($dec_id);
        $segment = $dec_id;
        $active = 'kelompok';

        return view('pages.rekening.kelompok.index', [
            'akun' => $akun,
            'segment' => $segment,
            'active' => $active,

        ]);
    }

    public function data_kelompok(Request $request)
    {
        if (request()->ajax()) {

            $id_akun_rekening = decrypsi($request->id);

            $data = KelompokRekening::where('akun_rekening_id', $id_akun_rekening)->get();

            return datatables()->of($data)
                ->editColumn('kode', function ($data) {
                    return '<a href="' . route('rekening.jenis', encrypsi($data->id)) . '">' . $data->kode . ' </a>';
                })
                ->editColumn('uraian_akun', function ($data) {
                    return '<a href="' . route('rekening.jenis', encrypsi($data->id)) . '">' . $data->uraian_akun . ' </a>';
                })
                ->editColumn('deskripsi_akun', function ($data) {
                    return '<a href="' . route('rekening.jenis', encrypsi($data->id)) . '">' . $data->deskripsi_akun . ' </a>';
                })

                ->addColumn('aksi', function ($data) {
                    $button = "
                <div class='d-flex justify-content-start'>
                <a class='mx-2' onclick='edit(this)' title='Edit' href='javascript:;' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapus(this)' data-toggle='tooltip' title='Hapus' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-trash-alt text-danger'></i></a>
                </div>
             ";
                    return $button;
                })

                ->addIndexColumn()
                ->rawColumns(['kode', 'uraian_akun', 'deskripsi_akun', 'aksi'])
                ->make('true');
        }
    }

    public function p_tambah_kelompok_rekening(Request $request)
    {
        $data = $request->all();

        $simpan =  KelompokRekening::create($data);

        if ($simpan) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function edit_kelompok_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $kelompok = KelompokRekening::find($id);

        $html = '<form action="#" method="post" id="form_edit">

                    <input type="hidden" name="_token" value="' . csrf_token() . '" />

                    <input type="hidden" name="id" value="' . encrypsi($kelompok->id) . '">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="Kode">Kode</label>
                                <input type="text" class="form-control" name="kode" placeholder="Kode" value="'.$kelompok->kode.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="uraian_akun">Uraian Akun</label>
                                <input type="text" class="form-control" name="uraian_akun"
                                    placeholder="Uraian Akun" value="'.$kelompok->uraian_akun.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="deskripsi_akun">Deskripsi Akun</label>
                                <input type="text" class="form-control" name="deskripsi_akun"
                                    placeholder="Deskripsi Akun" value="'.$kelompok->deskripsi_akun.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-danger btn-cancel"><i
                                        class="fas fa-times"></i></button>
                                <button type="submit" class="btn btn-sm btn-success btn-save mx-1"><i
                                        class="fas fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                </form>';


        return response()->json($html);
    }

    public function p_edit_kelompok_rekening(Request $request)
    {
        $id =  decrypsi($request->id);

        $kelompok = KelompokRekening::find($id);

        $data = $request->all();

        $kelompok->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function hapus_kelompok_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $kelompok = KelompokRekening::find($id);

        $hapus =  $kelompok->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }


    //jenis

    public function jenis($id)
    {
        $dec_id = decrypsi($id);
        $kelompok = KelompokRekening::find($dec_id);
        $segment = $dec_id;
        $active = 'jenis';

        return view('pages.rekening.jenis.index', [
            'kelompok' => $kelompok,
            'segment' => $segment,
            'active' => $active,

        ]);
    }

    public function data_jenis(Request $request)
    {
        if (request()->ajax()) {

            $kelompok_id = decrypsi($request->id);

            $data = JenisRekening::where('kelompok_rekening_id', $kelompok_id)->get();

            return datatables()->of($data)
                ->editColumn('kode', function ($data) {
                    return '<a href="' . route('rekening.objek', encrypsi($data->id)) . '">' . $data->kode . ' </a>';
                })
                ->editColumn('uraian_akun', function ($data) {
                    return '<a href="' . route('rekening.objek', encrypsi($data->id)) . '">' . $data->uraian_akun . ' </a>';
                })
                ->editColumn('deskripsi_akun', function ($data) {
                    return '<a href="' . route('rekening.objek', encrypsi($data->id)) . '">' . $data->deskripsi_akun . ' </a>';
                })

                ->addColumn('aksi', function ($data) {
                    $button = "
                <div class='d-flex justify-content-start'>
                <a class='mx-2' onclick='edit(this)' title='Edit' href='javascript:;' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapus(this)' data-toggle='tooltip' title='Hapus' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-trash-alt text-danger'></i></a>
                </div>
             ";
                    return $button;
                })

                ->addIndexColumn()
                ->rawColumns(['kode', 'uraian_akun', 'deskripsi_akun', 'aksi'])
                ->make('true');
        }
    }

    public function p_tambah_jenis_rekening(Request $request)
    {
        $data = $request->all();

        $simpan = JenisRekening::create($data);

        if ($simpan) {

            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function edit_jenis_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $jenis = JenisRekening::find($id);

        $html = '<form action="#" method="post" id="form_edit">

                    <input type="hidden" name="_token" value="' . csrf_token() . '" />

                    <input type="hidden" name="id" value="' . encrypsi($jenis->id) . '">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="Kode">Kode</label>
                                <input type="text" class="form-control" name="kode" placeholder="Kode" value="'.$jenis->kode.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="uraian_akun">Uraian Akun</label>
                                <input type="text" class="form-control" name="uraian_akun"
                                    placeholder="Uraian Akun" value="'.$jenis->uraian_akun.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="deskripsi_akun">Deskripsi Akun</label>
                                <input type="text" class="form-control" name="deskripsi_akun"
                                    placeholder="Deskripsi Akun" value="'.$jenis->deskripsi_akun.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-danger btn-cancel"><i
                                        class="fas fa-times"></i></button>
                                <button type="submit" class="btn btn-sm btn-success btn-save mx-1"><i
                                        class="fas fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                </form>';


        return response()->json($html);
    }

    public function p_edit_jenis_rekening(Request $request)
    {
        $id =  decrypsi($request->id);

        $jenis = JenisRekening::find($id);

        $data = $request->all();

        $jenis->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function hapus_jenis_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $jenis = JenisRekening::find($id);

        $hapus =  $jenis->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }


    // objek
    public function objek($id)
    {
        $dec_id = decrypsi($id);
        $jenis = JenisRekening::find($dec_id);
        $segment = $dec_id;
        $active = 'objek';

        return view('pages.rekening.objek.index', [
            'jenis' => $jenis,
            'segment' => $segment,
            'active' => $active,
        ]);
    }

    public function data_objek(Request $request)
    {
        if (request()->ajax()) {

            $jenis_id = decrypsi($request->id);

            $data = ObjekRekening::where('jenis_rekening_id', $jenis_id)->get();

            return datatables()->of($data)
                ->editColumn('kode', function ($data) {
                    return '<a href="' . route('rekening.rincian_objek', encrypsi($data->id)) . '">' . $data->kode . ' </a>';
                })
                ->editColumn('uraian_akun', function ($data) {
                    return '<a href="' . route('rekening.rincian_objek', encrypsi($data->id)) . '">' . $data->uraian_akun . ' </a>';
                })
                ->editColumn('deskripsi_akun', function ($data) {
                    return '<a href="' . route('rekening.rincian_objek', encrypsi($data->id)) . '">' . $data->deskripsi_akun . ' </a>';
                })

                ->addColumn('aksi', function ($data) {
                    $button = "
                <div class='d-flex justify-content-start'>
                <a class='mx-2' onclick='edit(this)' title='Edit' href='javascript:;' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapus(this)' data-toggle='tooltip' title='Hapus' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-trash-alt text-danger'></i></a>
                </div>
             ";
                    return $button;
                })

                ->addIndexColumn()
                ->rawColumns(['kode', 'uraian_akun', 'deskripsi_akun', 'aksi'])
                ->make('true');
        }
    }

    public function p_tambah_objek_rekening(Request $request)
    {
        $data = $request->all();

        $simpan =   ObjekRekening::create($data);

        if ($simpan) {

            return response()->json([
                'status' => 'success'
            ]);
        }
    }


    public function edit_objek_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $objek = ObjekRekening::find($id);

        $html = '<form action="#" method="post" id="form_edit">

                    <input type="hidden" name="_token" value="' . csrf_token() . '" />

                    <input type="hidden" name="id" value="' . encrypsi($objek->id) . '">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="Kode">Kode</label>
                                <input type="text" class="form-control" name="kode" placeholder="Kode" value="'.$objek->kode.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="uraian_akun">Uraian Akun</label>
                                <input type="text" class="form-control" name="uraian_akun"
                                    placeholder="Uraian Akun" value="'.$objek->uraian_akun.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="deskripsi_akun">Deskripsi Akun</label>
                                <input type="text" class="form-control" name="deskripsi_akun"
                                    placeholder="Deskripsi Akun" value="'.$objek->deskripsi_akun.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-danger btn-cancel"><i
                                        class="fas fa-times"></i></button>
                                <button type="submit" class="btn btn-sm btn-success btn-save mx-1"><i
                                        class="fas fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                </form>';


        return response()->json($html);
    }


    public function p_edit_objek_rekening(Request $request)
    {
        $id =  decrypsi($request->id);

        $objek = ObjekRekening::find($id);

        $data = $request->all();

        $objek->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }


    public function hapus_objek_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $objek = ObjekRekening::find($id);

        $hapus =  $objek->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    // rekening
    // rincian objek
    public function rincian_objek($id)
    {
        $dec_id = decrypsi($id);
        $objek = ObjekRekening::find($dec_id);
        $segment = $dec_id;
        $active = 'rincian objek';

        return view('pages.rekening.rincian_objek.index', [
            'objek' => $objek,
            'segment' => $segment,
            'active' => $active,
        ]);
    }

    public function data_rincian_objek(Request $request)
    {
        if (request()->ajax()) {

            $objek_rekening_id = decrypsi($request->id);

            $data = RincianObjekRekening::where('objek_rekening_id', $objek_rekening_id)->get();

            return datatables()->of($data)
                ->editColumn('kode', function ($data) {
                    return '<a href="' . route('rekening.sub_rincian_objek', encrypsi($data->id)) . '">' . $data->kode . ' </a>';
                })
                ->editColumn('uraian_akun', function ($data) {
                    return '<a href="' . route('rekening.sub_rincian_objek', encrypsi($data->id)) . '">' . $data->uraian_akun . ' </a>';
                })
                ->editColumn('deskripsi_akun', function ($data) {
                    return '<a href="' . route('rekening.sub_rincian_objek', encrypsi($data->id)) . '">' . $data->deskripsi_akun . ' </a>';
                })

                ->addColumn('aksi', function ($data) {
                    $button = "
                <div class='d-flex justify-content-start'>
                <a class='mx-2' onclick='edit(this)' title='Edit' href='javascript:;' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapus(this)' data-toggle='tooltip' title='Hapus' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-trash-alt text-danger'></i></a>
                </div>
             ";
                    return $button;
                })

                ->addIndexColumn()
                ->rawColumns(['kode', 'uraian_akun', 'deskripsi_akun', 'aksi'])
                ->make('true');
        }
    }

    public function p_tambah_rincian_objek_rekening(Request $request)
    {
        $data = $request->all();

        $create = RincianObjekRekening::create($data);

        if ($create) {
            return response()->json([
            'status' => 'success'
        ]);
        }
    }

    public function edit_rincian_objek_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $rincian_objek = RincianObjekRekening::find($id);

        $html = '<form action="#" method="post" id="form_edit">

                    <input type="hidden" name="_token" value="' . csrf_token() . '" />

                    <input type="hidden" name="id" value="' . encrypsi($rincian_objek->id) . '">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="Kode">Kode</label>
                                <input type="text" class="form-control" name="kode" placeholder="Kode" value="'.$rincian_objek->kode.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="uraian_akun">Uraian Akun</label>
                                <input type="text" class="form-control" name="uraian_akun"
                                    placeholder="Uraian Akun" value="'.$rincian_objek->uraian_akun.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="deskripsi_akun">Deskripsi Akun</label>
                                <input type="text" class="form-control" name="deskripsi_akun"
                                    placeholder="Deskripsi Akun" value="'.$rincian_objek->deskripsi_akun.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-danger btn-cancel"><i
                                        class="fas fa-times"></i></button>
                                <button type="submit" class="btn btn-sm btn-success btn-save mx-1"><i
                                        class="fas fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                </form>';

        return response()->json($html);
    }

    public function p_edit_rincian_objek_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $rincian_objek = RincianObjekRekening::find($id);

        $data = $request->all();

        $rincian_objek->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }

     public function hapus_rincian_objek_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $rincian_objek = RincianObjekRekening::find($id);

        $hapus =  $rincian_objek->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    // rekening
    // sub rincian objek
    public function sub_rincian_objek($id)
    {
        $dec_id = decrypsi($id);
        $rincian_objek = RincianObjekRekening::find($dec_id);
        $segment = $dec_id;
        $active = 'sub rincian objek';

        return view('pages.rekening.sub_rincian_objek.index', [
            'rincian_objek' => $rincian_objek,
            'segment' => $segment,
            'active' => $active,
        ]);
    }

    public function data_sub_rincian_objek(Request $request)
    {
        if (request()->ajax()) {

            $rincian_objek_rekening_id = decrypsi($request->id);

            $data = SubRincianObjekRekening::where('rincian_objek_rekening_id', $rincian_objek_rekening_id)->get();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = "
                <div class='d-flex justify-content-start'>
                <a class='mx-2' onclick='edit(this)' title='Edit' href='javascript:;' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-pencil-alt text-warning'></i></a>";
                    $button  .= "<a href='javascript:;' onclick='hapus(this)' data-toggle='tooltip' title='Hapus' data-id='" . encrypsi($data->id) . "'><i class='fas fa-sm fa-trash-alt text-danger'></i></a>
                </div>
             ";
                    return $button;
                })

                ->addIndexColumn()
                ->rawColumns(['aksi'])
                ->make('true');
        }
    }

    public function p_tambah_sub_rincian_objek_rekening(Request $request)
    {
        $data = $request->all();

        $create = SubRincianObjekRekening::create($data);

        if ($create) {
            return response()->json([
            'status' => 'success'
        ]);
        }
    }

    public function edit_sub_rincian_objek_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $sub_rincian_objek = SubRincianObjekRekening::find($id);

        $html = '<form action="#" method="post" id="form_edit">

                    <input type="hidden" name="_token" value="' . csrf_token() . '" />

                    <input type="hidden" name="id" value="' . encrypsi($sub_rincian_objek->id) . '">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="Kode">Kode</label>
                                <input type="text" class="form-control" name="kode" placeholder="Kode" value="'.$sub_rincian_objek->kode.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="uraian_akun">Uraian Akun</label>
                                <input type="text" class="form-control" name="uraian_akun"
                                    placeholder="Uraian Akun" value="'.$sub_rincian_objek->uraian_akun.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="deskripsi_akun">Deskripsi Akun</label>
                                <input type="text" class="form-control" name="deskripsi_akun"
                                    placeholder="Deskripsi Akun" value="'.$sub_rincian_objek->deskripsi_akun.'">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-danger btn-cancel"><i
                                        class="fas fa-times"></i></button>
                                <button type="submit" class="btn btn-sm btn-success btn-save mx-1"><i
                                        class="fas fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                </form>';

        return response()->json($html);
    }

    public function p_edit_sub_rincian_objek_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $sub_rincian_objek = SubRincianObjekRekening::find($id);

        $data = $request->all();

        $sub_rincian_objek->update($data);

        return response()->json([
            'status' => 'success'
        ]);
    }

     public function hapus_sub_rincian_objek_rekening(Request $request)
    {
        $id = decrypsi($request->id);

        $sub_rincian_objek = SubRincianObjekRekening::find($id);

        $hapus =  $sub_rincian_objek->delete();

        if ($hapus) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }
}
