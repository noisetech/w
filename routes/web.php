<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\DinasController;
use App\Http\Controllers\DpaController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\PerencanaanOrganisasiController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SumberDanaController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\KomponenPembangunanController;
use App\Http\Controllers\PerencanaanPembangunanController;
use App\Http\Controllers\PembangunanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::prefix('dashboard')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // General route
        Route::post('encrypsi', [GeneralController::class, 'encrypsi'])->name('encrypsi');
        Route::post('decrypsi', [GeneralController::class, 'decrypsi'])->name('decrypsi');

        // permission
        Route::get('/permissions', [PermissionController::class, 'index'])
            ->name('permission');
        Route::get('/permissions/data', [PermissionController::class, 'data'])
            ->name('permission.data');
        Route::get('permissions-h_tambah', [PermissionController::class, 'h_tambah'])
            ->name('permissions.h_tambah');



        // role
        Route::get('/role', [RoleController::class, 'index'])
            ->name('role');
        Route::get('/role/data', [RoleController::class, 'data'])
            ->name('role.data');
        Route::get('/role/h-tambah', [RoleController::class, 'h_tambah'])
            ->name('role.h-tambah');
        Route::get('/list-permision-for-role', [RoleController::class, 'listPermission'])
            ->name('listPermission');
        Route::post('/role/p-tambah', [RoleController::class, 'p_tambah'])
            ->name('role.p-tambah');
        Route::get('/role/edit/{id}', [RoleController::class, 'h_edit'])
            ->name('role.edit');
        Route::post('role-ubah', [RoleController::class, 'ubah'])
            ->name('role.ubah');
        Route::get('/role/detai/{id}', [RoleController::class, 'h_detail'])
            ->name('role.h_detail');
        Route::post('/role.hapus', [RoleController::class, 'hapus'])
            ->name('role.hapus');
        Route::get('/role/permissionbyrole', [RoleController::class, 'permissionByRole'])
            ->name('role.permissionByRole');
        Route::post('role.hapusPermissionByRole', [RoleController::class, 'hapusPermissionByRole'])
            ->name('role.hapusPermissionByRole');

        // User
        Route::get('user', [UserController::class, 'index'])
            ->name('user');
        Route::get('user.data', [UserController::class, 'data'])
            ->name('user.data');
        Route::get('user-h_tambah', [UserController::class, 'h_tambah'])
            ->name('user.h_tambah');
        Route::post('user.p_tambah', [UserController::class, 'p_tambah'])
            ->name('user.p_tambah');
        Route::get('user-h_edit/{id}', [UserController::class, 'h_edit'])
            ->name('user.h_edit');
        Route::post('user.p_edit', [UserController::class, 'p_edit'])
            ->name('user.p_edit');
        Route::post('user.hapus', [UserController::class, 'hapus'])
            ->name('user.hapus');
        Route::get('user.listDinas', [UserController::class, 'listDinas'])
            ->name('user.listDinas');
        Route::get('user.listRole', [UserController::class, 'listRole'])
            ->name('user.listRole');



        // tahun
        Route::get('/tahun', [TahunController::class, 'index'])
            ->name('tahun');
        Route::get('tahun.data', [TahunController::class, 'data'])
            ->name('tahun.data');
        Route::get('tahun-tambah-data', [TahunController::class, 'h_tambah'])
            ->name('tahun.h-tambah');
        Route::post('tahun.tambah', [TahunController::class, 'p_tambah'])
            ->name('tahun.p_tambah');
        Route::post('tahun.hapus', [TahunController::class, 'hapus'])
            ->name('tahun.hapus');
        Route::get('tahun-edit/{id}', [TahunController::class, 'h_edit'])
            ->name('tahun.edit');
        Route::post('tahun.update', [TahunController::class, 'p_edit'])
            ->name('tahun.p_edit');


        // wilayah
        Route::get('wilayah', [WilayahController::class, 'index'])
            ->name('wilayah');
        Route::get('wilayah.data', [WilayahController::class, 'data'])
            ->name('wilayah.data');
        Route::get('wilayah-create', [WilayahController::class, 'h_tambah'])
            ->name('wilayah.h_tambah');
        Route::post('wilayan.p_tambah', [WilayahController::class, 'p_tambah'])
            ->name('wilayah.p_tambah');
        Route::get('wilayah-edit/{id}', [WilayahController::class, 'h_edit'])
            ->name('wilayah.h_edit');
        Route::post('wilayah.p_edit', [WilayahController::class, 'p_edit'])
            ->name('wilayah.p_edit');
        Route::post('wilayah.hapus', [WilayahController::class, 'hapus'])
            ->name('wilayah.hapus');

        //satuan
        Route::get('satuan', [SatuanController::class, 'index'])
            ->name('satuan');
        Route::get('satuan.data', [SatuanController::class, 'data'])
            ->name('satuan.data');
        Route::get('satuan/h_tambah', [SatuanController::class, 'h_tambah'])
            ->name('satuan.h_tambah');
        Route::post('satuan.p_tambah', [SatuanController::class, 'p_tambah'])
            ->name('satuan.p_tambah');
        Route::get('satuan/h_edit/{id}', [SatuanController::class, 'h_edit'])
            ->name('satuan.h_edit');
        Route::post('satuan.p_edit', [SatuanController::class, 'p_edit'])
            ->name('satuan.p_edit');
        Route::post('satuan.hapus', [SatuanController::class, 'hapus'])
            ->name('satuan.hapus');



        // organisasi
        Route::get('organisasi', [OrganisasiController::class, 'index'])
            ->name('organisasi');
        Route::get('organisasi-data', [OrganisasiController::class, 'data'])
            ->name('organisasi.data');
        Route::get('organisasi-h_tambah', [OrganisasiController::class, 'h_tambah'])
            ->name('organisasi.h_tambah');
        Route::post('organisasi.p_tambah', [OrganisasiController::class, 'p_tambah'])
            ->name('organisasi.p_tambah');
        Route::get('organisasi-h_edit/{id}', [OrganisasiController::class, 'h_edit'])
            ->name('organisasi.h_edit');
        Route::post('organisasi.p_edit', [OrganisasiController::class, 'p_edit'])
            ->name('organisasi.p_edit');

        // dinas
        Route::get('dinas', [DinasController::class, 'index'])
            ->name('dinas');
        Route::get('dinas.data', [DinasController::class, 'data'])
            ->name('dinas.data');
        Route::get('dinas-h_tambah', [DinasController::class, 'h_tambah'])
            ->name('dinas.h_tambah');
        Route::post('dinas.p_tambah', [DinasController::class, 'p_tambah'])
            ->name('dinas.p_tambah');
        Route::get('dinas.listWilayah', [DinasController::class, 'listWilayah'])
            ->name('dinas.listWilayah');




        // sumber dana
        Route::get('sumber_dana', [SumberDanaController::class, 'index'])
            ->name('sumber_dana');
        Route::get('sumber_dana.data', [SumberDanaController::class, 'data'])
            ->name('sumber_dana.data');
        Route::get('sumber_dana-ph_tambah', [SumberDanaController::class, 'h_tambah'])
            ->name('sumber_dana.h_tambah');
        Route::post('sumber_dana.p-tambah', [SumberDanaController::class, 'p_tambah'])
            ->name('sumber_dana.p-tambah');
        Route::get('sumber_dana-h_edit/{id}', [SumberDanaController::class, 'h_edit'])
            ->name('sumber_dana.h_edit');
        Route::post('sumber_dana.p_edit', [SumberDanaController::class, 'p_edit'])
            ->name('sumber_dana.p-edit');
        Route::post('sumber_dana.p_hapus', [SumberDanaController::class, 'hapus'])
            ->name('sumber_dana.hapus');

        // perencanaan
        // bagian urusan
        Route::get('perencanaan/urusan', [PerencanaanController::class, 'index'])
            ->name('perencanaan');
        Route::get('perencanaan.data_urusan', [PerencanaanController::class, 'data_urusan'])
            ->name('perencanaan.data_urusan');
        Route::post('perencanaan.urusan.p_tambah', [PerencanaanController::class, 'p_tambah_urusan'])
            ->name('perencanaan.p_tambah_urusan');
        Route::get('perencanaan.formEditUrusanById,', [PerencanaanController::class, 'formEditUrusanById'])
            ->name('perencanaan.formEditUrusanById');
        Route::post('perencanaan.p_formEditUrusanById,', [PerencanaanController::class, 'p_formEditUrusanById'])
            ->name('perencanaan.p_formEditUrusanById');
        Route::post('perencanaan.hapusDataUrusan', [PerencanaanController::class, 'hapusDataUrusan'])
            ->name('perencanaan.hapusDataUrusan');

        // perencanaan
        // bagian bidang
        Route::get('perencanaan/bidang/urusan/{id}', [PerencanaanController::class, 'bidang'])
            ->name('perencanaan.bidang');
        Route::get('perencanaan.data_bidang', [PerencanaanController::class, 'data_bidang'])
            ->name('perencanaan.data_bidang');
        Route::post('perencanaan.p_form_urusan_bidang', [PerencanaanController::class, 'p_form_urusan_bidang'])
            ->name('perencanaan.p_form_urusan_bidang');
        Route::get('perencanaan.formEditBidangById', [PerencanaanController::class, 'formEditBidangById'])
            ->name('perencanaan.formEditBidangById');
        Route::post('perencanaan.p_formEditBidangById', [PerencanaanController::class, 'p_formEditBidangById'])
            ->name('perencanaan.p_formEditBidangById');
        Route::post('perencanaan.p_hapus_urusan_bidang', [PerencanaanController::class, 'hapusBidangPerencanaan'])
            ->name('perencanaan.hapusBidangPerencanaan');


        // perencanaan
        // bagian bidang
        Route::get('perencanaan/program/bidang/{id}', [PerencanaanController::class, 'program'])
            ->name('perencanaan.program');
        Route::get('perencanaan.data_program', [PerencanaanController::class, 'data_program'])
            ->name('perencanaan.data_program');
        Route::post('perencanaan.p_form_tambah_program', [PerencanaanController::class, 'p_form_tambah_program'])
            ->name('perencanaan.p_form_tambah_program');
        Route::get('perencanaan.formEditProgramById', [PerencanaanController::class, 'formEditProgramById'])
            ->name('perencanaan.formEditProgramById');
        Route::post('perencanaan.p_formEditProgramById', [PerencanaanController::class, 'p_formEditProgramById'])
            ->name('perencanaan.p_formEditProgramById');
        Route::post('perencanaan.hapusProgramPerencanaan', [PerencanaanController::class, 'hapusProgramPerencanaan'])
            ->name('perencanaan.hapusProgramPerencanaan');


        // perencanaan
        // bagian bidang
        Route::get('perencanaan/kegiatan/program/{id}', [PerencanaanController::class, 'kegiatan'])
            ->name('perencanaan.kegiatan');
        Route::get('perencanaan.data_kegiatan', [PerencanaanController::class, 'data_kegiatan'])
            ->name('perencanaan.data_kegiatan');
        Route::post('perencanaan.p_form_tambah_kegiatan', [PerencanaanController::class, 'p_form_tambah_kegiatan'])
            ->name('perencanaan.p_form_tambah_kegiatan');
        Route::get('perencanaan.formEditKegiatanById', [PerencanaanController::class, 'formEditKegiatanById'])
            ->name('perencanaan.formEditKegiatanById');
        Route::post('perencanaan.p_formEditKegiatanById', [PerencanaanController::class, 'p_formEditKegiatanById'])
            ->name('perencanaan.p_formEditKegiatanById');
        Route::post('perencanaan.hapusKegiatanPerencanaan', [PerencanaanController::class, 'hapusKegiatanPerencanaan'])
            ->name('perencanaan.hapusKegiatanPerencanaan');

        // perencanaan
        // sub_kegiatan
        Route::get('perencanaan/sub-kegiatan/kegiatan/{id}', [PerencanaanController::class, 'sub_kegiatan'])
            ->name('perencanaan.sub_kegiatan');
        Route::get('perencanaan.data_sub_kegiatan', [PerencanaanController::class, 'data_sub_kegiatan'])
            ->name('perencanaan.data_sub_kegiatan');
        Route::get('perencanaan.sub-kegiatan.list_satuan', [PerencanaanController::class, 'listSatuanForKegiatan'])
            ->name('perencanaan.listSatuanForKegiatan');
        Route::post('perencanaan.p_tambah_sub_kegiatan', [PerencanaanController::class, 'p_tambah_sub_kegiatan'])
            ->name('perencanaan.p_tambah_sub_kegiatan');
        Route::get('perencanaan.formEditSubKegiatanById', [PerencanaanController::class, 'formEditSubKegiatanById'])
            ->name('perencanaan.formEditSubKegiatanById');
        Route::get('perencanaan.listSatuanBySubKegiatan', [PerencanaanController::class, 'listSatuanBySubKegiatan'])
            ->name('perencanaan.listSatuanBySubKegiatan');
        Route::get('perencanaan.subKegiatanById', [PerencanaanController::class, 'subKegiatanById'])
            ->name('perencanaan.subKegiatanById');
        Route::post('perencanaan.p_FormEditSubKegiatan', [PerencanaanController::class, 'p_FormEditSubKegiatan'])
            ->name('perencanaan.p_FormEditSubKegiatan');



        // perencanaan Organisasi
        // bagian urusan
        Route::get('perencanaan_organisasi/urusan', [PerencanaanOrganisasiController::class, 'urusan'])
            ->name('perencanaan_organisasi.urusan');
        Route::get('perencanaan_organisasi.data_urusan', [PerencanaanOrganisasiController::class, 'data_urusan'])
            ->name('perencanaan_organisasi.data_urusan');
        Route::post('perencanaan_organisasi.urusan.p_tambah_urusan', [PerencanaanOrganisasiController::class, 'p_tambah_urusan'])
            ->name('perencanaan_organisasi.p_tambah_urusan');
        Route::get('perencanaan_organisasi.formEditUrusanById,', [PerencanaanOrganisasiController::class, 'formEditUrusanById'])
            ->name('perencanaan_organisasi.formEditUrusanById');
        Route::post('perencanaan_organisasi.p_formEditUrusanById,', [PerencanaanOrganisasiController::class, 'p_formEditUrusanById'])
            ->name('perencanaan_organisasi.p_formEditUrusanById');
        Route::post('perencanaan_organisasi.hapusDataUrusan', [PerencanaanOrganisasiController::class, 'hapusDataUrusan'])
            ->name('perencanaan_organisasi.hapusDataUrusan');


        // perencanaan organisasi
        // bagian bidang
        Route::get('perencanaan_organisasi/bidang/urusan/{id}', [PerencanaanOrganisasiController::class, 'bidang'])
            ->name('perencanaan_organisasi.bidang');
        Route::get('perencanaan_organisasi.data_bidang', [PerencanaanOrganisasiController::class, 'data_bidang'])
            ->name('perencanaan_organisasi.data_bidang');
        Route::post('perencanaan_organisasi.p_form_urusan_bidang', [PerencanaanOrganisasiController::class, 'p_form_urusan_bidang'])
            ->name('perencanaan_organisasi.p_form_urusan_bidang');
        Route::get('perencanaan_organisasi.formEditBidangById', [PerencanaanOrganisasiController::class, 'formEditBidangById'])
            ->name('perencanaan_organisasi.formEditBidangById');
        Route::post('perencanaan_organisasi.p_formEditBidangById', [PerencanaanOrganisasiController::class, 'p_formEditBidangById'])
            ->name('perencanaan_organisasi.p_formEditBidangById');
        Route::post('perencanaan_organisasi.p_hapus_urusan_bidang', [PerencanaanOrganisasiController::class, 'hapusBidangPerencanaan'])
            ->name('perencanaan_organisasi.hapusBidangPerencanaan');

        // perencanaan organisasi
        // bagian organisasi
        Route::get('perencanaan_organisasi/organisasi/bidang/{id}', [PerencanaanOrganisasiController::class, 'organisasi'])
            ->name('perencanaan_organisasi.organisasi');
        Route::get('perencanaan_organisasi.data_organisasi', [PerencanaanOrganisasiController::class, 'data_organisasi'])
            ->name('perencanaan_organisasi.data_organisasi');
        Route::post('perencanaan_organisasi.p_formTambahOrganisasi', [PerencanaanOrganisasiController::class, 'p_formTambahOrganisasi'])
            ->name('perencanaan_organisasi.p_formTambahOrganisasi');
        Route::post('perencanaan_organisasi.hapusOrganisasi', [PerencanaanOrganisasiController::class, 'hapusOrganisasi'])
            ->name('perencanaan_organisasi.hapusOrganisasi');
        Route::get('perencanaan_organisasi.formEditBidangById', [PerencanaanOrganisasiController::class, 'formEditBidangById'])
            ->name('perencanaan_organisasi.formEditBidangById');
        Route::get('perencanaan_organisasi.formEditOrganisasigById', [PerencanaanOrganisasiController::class, 'formEditOrganisasigById'])
            ->name('perencanaan_organisasi.formEditOrganisasigById');
        Route::post('perencanaan_organisasi.p_formEditOrganisasigById', [PerencanaanOrganisasiController::class, 'p_formEditOrganisasigById'])
            ->name('perencanaan_organisasi.p_formEditOrganisasigById');

        // perencaan unit
        Route::get('perencanaan_organisasi/unit/organisasi/{id}', [PerencanaanOrganisasiController::class, 'unit'])
            ->name('perencanaan_organisasi.unit');
        Route::get('perencanaan_organisasi.data_unit', [PerencanaanOrganisasiController::class, 'data_unit'])
            ->name('perencanaan_organisasi.data_unit');
        Route::post('perencanaan_organisasi.p_formTambahUnit', [PerencanaanOrganisasiController::class, 'p_formTambahUnit'])
            ->name('perencanaan_organisasi.p_formTambahUnit');
        Route::post('perencanaan_organisasi.hapusUnit', [PerencanaanOrganisasiController::class, 'hapusUnit'])
            ->name('perencanaan_organisasi.hapusUnit');
        Route::get('perencanaan_organisasi.formEditUnitById', [PerencanaanOrganisasiController::class, 'formEditUnitById'])
            ->name('perencanaan_organisasi.formEditUnitById');
        Route::post('perencanaan_organisasi.p_formEditUnitgById', [PerencanaanOrganisasiController::class, 'p_formEditUnitgById'])
            ->name('perencanaan_organisasi.p_formEditUnitgById');


        // anggaran
        // bagian dpa
        Route::get('dpa', [DpaController::class, 'index'])
            ->name('dpa');
        Route::get('dpa/h_tambah', [DpaController::class, 'h_tambah'])
            ->name('dpa.h_tambah');
        Route::get('dpa/h_tambah_sub_dpa', [DpaController::class, 'h_tambah_sub_dpa'])
            ->name('dpa.h_tambah_sub_dpa ');
        Route::get('dpa.list_urusan', [DpaController::class, 'listUrusan'])
            ->name('dpa.listUrusan');
        Route::get('dpa-list_bidang/{id}', [DpaController::class, 'listBidang']);
        Route::get('dpa-list_program/{id}', [DpaController::class, 'listProgram']);
        Route::get('dpa-list_kegiatan/{id}', [DpaController::class, 'listKegiatan']);
        Route::get('dpa-list_organisasi/{id}', [DpaController::class, 'listOrganisasi']);
        Route::get('dpa-list_unit/{id}', [DpaController::class, 'listUnit']);
        Route::post('dpa.insert_dpa_to_session', [DpaController::class, 'insert_dpa_to_session'])
            ->name('dpa.insert_dpa_to_session');
        Route::post('dpa.insert_lanjutan_dpa', [DpaController::class, 'insert_lanjutan_dpa'])
            ->name('dpa.insert_lanjutan_dpa');


        Route::get('dpa.listSubkegiatan', [DpaController::class, 'listSubkegiatan'])
            ->name('dpa.listSubkegiatan');
        Route::get('dpa.listSumberDana', [DpaController::class, 'listSumberDana'])
            ->name('dpa.listSumberDana');
        Route::get('dpa.listAkunRekening', [DpaController::class, 'listAkunRekening'])
            ->name('dpa.listAkunRekening');


        // rekening
        // akun_rekening
        Route::get('rekening', [RekeningController::class, 'index'])
            ->name('rekening');
        Route::get('rekening.data_akun_rekening', [RekeningController::class, 'data_akun'])
            ->name('rekening.data_akun_rekening');
        Route::post('rekening.p_tambah_akun_rekening', [RekeningController::class, 'p_tambah_akun_rekening'])
            ->name('rekening.p_tambah_akun_rekening');
        Route::get('rekening.edit_akun_rekening', [RekeningController::class, 'edit_akun_rekening'])
            ->name('rekening.edit_akun_rekening');
        Route::post('rekening.p_edit_akun_rekening', [RekeningController::class, 'p_edit_akun_rekening'])
            ->name('rekening.p_edit_akun_rekening');
        Route::post('rekening.hapus_akun_rekening', [RekeningController::class, 'hapus_akun_rekening'])
            ->name('rekening.hapus_akun_rekening');

        // rekening
        // kelompok_rekening
        Route::get('rekening/kelompok/{id}', [RekeningController::class, 'kelompok'])
            ->name('rekening.kelompok');
        Route::get('rekening.data_kelompok_rekening', [RekeningController::class, 'data_kelompok'])
            ->name('rekening.data_kelompok_rekening');
        Route::post('rekening.p_tambah_kelompok_rekening', [RekeningController::class, 'p_tambah_kelompok_rekening'])
            ->name('rekening.p_tambah_kelompok_rekening');
        Route::get('rekening.edit_kelompok_rekening', [RekeningController::class, 'edit_kelompok_rekening'])
            ->name('rekening.edit_kelompok_rekening');
        Route::post('rekening.p_edit_kelompok_rekening', [RekeningController::class, 'p_edit_kelompok_rekening'])
            ->name('rekening.p_edit_kelompok_rekening');
        Route::post('rekening.hapus_kelompok_rekening', [RekeningController::class, 'hapus_kelompok_rekening'])
            ->name('rekening.hapus_kelompok_rekening');

        // rekening
        // jenis_rekening
        Route::get('rekening/jenis/{id}', [RekeningController::class, 'jenis'])
            ->name('rekening.jenis');
        Route::get('rekening.data_jenis_rekening', [RekeningController::class, 'data_jenis'])
            ->name('rekening.data_jenis_rekening');
        Route::post('rekening.p_tambah_jenis_rekening', [RekeningController::class, 'p_tambah_jenis_rekening'])
            ->name('rekening.p_tambah_jenis_rekening');
        Route::get('rekening.edit_jenis_rekening', [RekeningController::class, 'edit_jenis_rekening'])
            ->name('rekening.edit_jenis_rekening');
        Route::post('rekening.p_edit_jenis_rekening', [RekeningController::class, 'p_edit_jenis_rekening'])
            ->name('rekening.p_edit_jenis_rekening');
        Route::post('rekening.hapus_jenis_rekening', [RekeningController::class, 'hapus_jenis_rekening'])
            ->name('rekening.hapus_jenis_rekening');

        // rekening
        // objek_rekening
        Route::get('rekening/objek/{id}', [RekeningController::class, 'objek'])
            ->name('rekening.objek');
        Route::get('rekening.data_objek_rekening', [RekeningController::class, 'data_objek'])
            ->name('rekening.data_objek_rekening');
        Route::post('rekening.p_tambah_objek_rekening', [RekeningController::class, 'p_tambah_objek_rekening'])
            ->name('rekening.p_tambah_objek_rekening');
        Route::get('rekening.edit_objek_rekening', [RekeningController::class, 'edit_objek_rekening'])
            ->name('rekening.edit_objek_rekening');
        Route::post('rekening.p_edit_objek_rekening', [RekeningController::class, 'p_edit_objek_rekening'])
            ->name('rekening.p_edit_objek_rekening');
        Route::post('rekening.hapus_objek_rekening', [RekeningController::class, 'hapus_objek_rekening'])
            ->name('rekening.hapus_objek_rekening');

        // rekening
        // rincian_objek_rekening
        Route::get('rekening/rincian_objek/{id}', [RekeningController::class, 'rincian_objek'])
            ->name('rekening.rincian_objek');
        Route::get('rekening.data_rincian_objek_rekening', [RekeningController::class, 'data_rincian_objek'])
            ->name('rekening.data_rincian_objek_rekening');
        Route::post('rekening.p_tambah_rincian_objek_rekening', [RekeningController::class, 'p_tambah_rincian_objek_rekening'])
            ->name('rekening.p_tambah_rincian_objek_rekening');
        Route::get('rekening.edit_rincian_objek_rekening', [RekeningController::class, 'edit_rincian_objek_rekening'])
            ->name('rekening.edit_rincian_objek_rekening');
        Route::post('rekening.p_edit_rincian_objek_rekening', [RekeningController::class, 'p_edit_rincian_objek_rekening'])
            ->name('rekening.p_edit_rincian_objek_rekening');
        Route::post('rekening.hapus_rincian_objek_rekening', [RekeningController::class, 'hapus_rincian_objek_rekening'])
            ->name('rekening.hapus_rincian_objek_rekening');

        // rekening
        // sub_rincian_objek_rekening
        Route::get('rekening/sub_rincian_objek/{id}', [RekeningController::class, 'sub_rincian_objek'])
            ->name('rekening.sub_rincian_objek');
        Route::get('rekening.data_sub_rincian_objek_rekening', [RekeningController::class, 'data_sub_rincian_objek'])
            ->name('rekening.data_sub_rincian_objek_rekening');
        Route::post('rekening.p_tambah_sub_rincian_objek_rekening', [RekeningController::class, 'p_tambah_sub_rincian_objek_rekening'])
            ->name('rekening.p_tambah_sub_rincian_objek_rekening');
        Route::get('rekening.edit_sub_rincian_objek_rekening', [RekeningController::class, 'edit_sub_rincian_objek_rekening'])
            ->name('rekening.edit_sub_rincian_objek_rekening');
        Route::post('rekening.p_edit_sub_rincian_objek_rekening', [RekeningController::class, 'p_edit_sub_rincian_objek_rekening'])
            ->name('rekening.p_edit_sub_rincian_objek_rekening');
        Route::post('rekening.hapus_sub_rincian_objek_rekening', [RekeningController::class, 'hapus_sub_rincian_objek_rekening'])
            ->name('rekening.hapus_sub_rincian_objek_rekening');

        // komponen pembangunan
        // komponen pembangunan
        Route::get('komponen_pembangunan', [KomponenPembangunanController::class, 'index'])
            ->name('komponen.pembangunan');
        Route::post('komponen_pembangunan/p_tambah', [KomponenPembangunanController::class, 'p_tambah'])->name('komponen.pembangunan.p_tambah');
        Route::post('komponen_pembangunan/form_edit', [KomponenPembangunanController::class, 'form_edit'])->name('komponen.pembangunan.form_edit');
        Route::post('komponen_pembangunan/p_edit', [KomponenPembangunanController::class, 'p_edit'])->name('komponen.pembangunan.p_edit');

        // perencanaan pembangunan
        // perencanaan pembangunan
        Route::get('perencanaan_pembangunan', [PerencanaanPembangunanController::class, 'index'])
            ->name('perencanaan.pembangunan');

        // pembangunan
        // master pembangunan
        Route::get('pembangunan', [PembangunanController::class, 'index'])
            ->name('pembangunan');

    });

Auth::routes(['register' => false]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
