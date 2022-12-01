<?php

namespace App\Http\Controllers;

use App\Models\Dinas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        // $user = User::all
        return view('pages.user.index');
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = User::orderBy('name', 'ASC')->get();
            return datatables()->of($data)
                ->addColumn('dinas', function ($data) {
                    if ($data->dinas == NULL) {
                        return '-';
                    }else{
                        return $data->dinas->dinas;
                    }
                })
                ->addColumn('role', function ($data) {
                    foreach ($data->roles as $key => $value) {
                        return $value->name;
                    }
                })
                ->editColumn('aksi', function ($data) {
                    if ($data->name == 'admin') {
                        $button = "
                    <div class='d-flex justify-content-start'>
                    <a class='edit btn btn btn-sm mx-1
                    btn-warning ' title='Edit Role' href='" . route('role.edit', $data->id) . "'>Edit</a>";
                        return $button;
                    }
                    $button = "
                <div class='d-flex justify-content-start'>
                <a class='edit btn btn btn-sm mx-1
                btn-warning ' title='Edit' href='#'>Edit</a>";
                    $button  .= "<button class='hapus btn btn-sm btn-danger' data-toggle='tooltip' title='Hapus'
                     id='" . $data->id . "'>Hapus</button>
                </div>
             ";
                    return $button;
                })
                ->rawColumns(['dinas', 'permission', 'aksi'])
                ->escapeColumns([])
                ->make('true');
        }
    }


    public function listDinas(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;

            $data = Dinas::select('id', 'dinas')
                ->where('dinas', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function listRole(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;

            $data = Role::select('id', 'name')
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function h_tambah()
    {
        return view('pages.user.create');
    }

    public function p_tambah(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->dinas_id = $request->dinas_id;
        $user->save();

        // cari role
        $role = Role::find($request->role_id);

        $user->assignRole($role->name);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function h_edit($id)
    {
        $user = User::find($id);

        return view('pages.user.edit', [
            'user' => $user
        ]);
    }

    public function hapus(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        // get data role yang dimilik oleh user
        foreach ($user->roles as $key => $value) {
            $role_yang_dimiliki_user = $value->name;
        }

        // menghapus role yang dimilik user antara relasi user dan role
        // libary spatie role permissions
        $user->removeRole($role_yang_dimiliki_user);

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
