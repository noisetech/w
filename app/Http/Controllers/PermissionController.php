<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {

        return view('pages.permission.index');
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Permission::orderBy('name', 'ASC')->get();

            return datatables()->of($data)
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
                ->rawColumns(['aksi'])
                ->make('true');
        }
    }

    public function h_tambah()
    {
        return view('pages.permission.create');
    }

    public function p_tambah(Request $request)
    {

        $permission = new Permission();
        $permission->name = Str::slug('name');
        $permission->guard_name = 'web';
        $permission->save();

        if ($permission) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditambah'
            ]);
        }
    }


    public function h_edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('pages.permission.edit', [
            'permission' => $permission
        ]);
    }

    public function p_ubah(Request $request)
    {
        $id = $request->id;

        $permission = Permission::findOrFail($id);

        $permission->name = Str::slug('name');
        $permission->guard_name = 'web';
        $permission->save();

        if ($permission) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $id = $request->id;

        $permission = Permission::findOrFail($id);

        $permission->delete();

        if ($permission) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        }
    }
}
