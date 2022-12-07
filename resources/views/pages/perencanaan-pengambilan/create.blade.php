@extends('layouts.admin')


@section('title', 'Perencanaan Pengambilan')
@section('content')
    {{ navbar('Perencanaan Pembangunan', 'Tambah Perencanaan Pengambilan') }}

    <div class="container-fluid py-4">
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <h6 class="mx-4 my-4">Kegiatan | Tambah Perencanaan Pengambilan</h6>
                    <div class="card-body">

                        <form action="">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Belanja</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Belanja</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Belanja</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Belanja</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Jenis</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Jenis</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Jenis</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Jenis</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4 justify-content-end">
                                <div class="col-sm-2">
                                    <button class="btn btn-success">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
