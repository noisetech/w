<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:role-index|role-create|role-edit|role-delete']);
    }

    public function index()
    {
        return view('pages.role.index');
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Role::orderBy('name', 'ASC')->get();

            return datatables()->of($data)

                ->editColumn('aksi', function ($data) {
                    if ($data->name == 'admin') {
                        return "";
                    }
                    $button = "

                    <div class='d-flex justify-content-start'>
                    <a class='edit btn btn btn-sm mx-1
                    btn-info ' title='Detail Role' href='" . route('role.h_detail', $data->id) . "'>Detail</a>";

                    $button .= "   <a class='edit btn btn btn-sm mx-1
                    btn-warning ' title='Edit Role' href='" . route('role.edit', $data->id) . "'>Edit</a>";
                    $button  .= "<button class='hapus btn btn-sm btn-danger' data-toggle='tooltip' title='Hapus'
                         id='" . $data->id . "'>Hapus</button>
                    </div>

                 ";
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make('true');
        }
    }


    public function h_detail($id)
    {
        $role = Role::findOrFail($id);

        $permission = Permission::whereHas('roles', function ($q)
        use ($role) {
            return $q->where('role_has_permissions.role_id', $role->id);
        })->get();

        return view('pages.role.detail', [
            'role' => $role,
            'permission' => $permission
        ]);
    }


    public function h_tambah()
    {
        return view('pages.role.create');
    }

    public function listPermission(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Permission::select("id", "name")
                ->Where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function p_tambah(Request $request)
    {

        $rules = [
            'role' => 'required'
        ];

        $text = [
            'role.required' => 'tidak boleh kosong'
        ];


        $validator = Validator::make($request->all(), $rules, $text);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        } else


            $role = Role::create([
                'name' => $request->input('role')
            ]);


        $role->syncPermissions($request->input('permissions'));

        if ($role) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }



    public function h_edit($id)
    {
        $role  = Role::find($id);

        return view('pages.role.edit', [
            'role' => $role
        ]);
    }

    public function permissionByRole(Request $request)
    {
        $role = Role::find($request->id);

        $permission = Permission::whereHas('roles', function ($q)
        use ($role) {
            return $q->where('role_has_permissions.role_id', $role->id);
        })->get();

        return response()->json($permission);
    }



    public function ubah(Request $request)
    {
        $id = $request->id;
        $role  = Role::findOrFail($id);

        $role->name = $request->role;
        $role->save();


        $role->syncPermissions($request->input('permissions'));

        if ($role) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $id = $request->id;

        $role = Role::findOrFail($id);
        $permissions = $role->permissions;
        $role->revokePermissionTo($permissions);
        $role->delete();

        if ($role) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function hapusPermissionByRole(Request $request)
    {

        $id_permission = $request->id_permission;


        $id_role = $request->id_role;

        $role = Role::find($id_role);


        $id_permission = $request->id_permission;
        $permission = Permission::find($id_permission);


        $delete =  $role->revokePermissionTo($permission);

        if ($delete) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        }
    }
}
