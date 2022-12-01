<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //permission for permission
        Permission::create(['name' => 'permission-index']);
        Permission::create(['name' => 'permission-create']);
        Permission::create(['name' => 'permission-edit']);
        Permission::create(['name' => 'permission-delete']);

        //permission for role
        Permission::create(['name' => 'role-index']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-edit']);
        Permission::create(['name' => 'role-detail']);
        Permission::create(['name' => 'role-delete']);

        //permission for users
        Permission::create(['name' => 'user-index']);
        Permission::create(['name' => 'user-create']);
        Permission::create(['name' => 'user-edit']);
        Permission::create(['name' => 'user-delete']);

         //permission for tahun
         Permission::create(['name' => 'tahun-index']);
         Permission::create(['name' => 'tahun-create']);
         Permission::create(['name' => 'tahun-edit']);
         Permission::create(['name' => 'tahun-delete']);

         //permission for wilayah
         Permission::create(['name' => 'wilayah-index']);
         Permission::create(['name' => 'wilayah-create']);
         Permission::create(['name' => 'wilayah-edit']);
         Permission::create(['name' => 'wilayah-delete']);
    }
}
