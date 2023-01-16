@extends('layouts.admin')


@section('title', 'Realisasi')
@section('content')
    {{ navbar('Realisasi', 'Realisasi') }}

    <div class="container-fluid py-4">

        <div class="card shadow">
            <div class="card-header">
                <h6>Form Realisasi</h6>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Bulan</label>
                                <input type="text" class="form-control" name="bulan" readonly>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Rencana Penarikan</label>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Pengambilan</label>
                                <input type="text" class="form-control" name="pengambilan" readonly>
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Realisasi</label>
                                <input type="text" class="form-control" name="realisasi" placeholder="Realisasi">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h5 class="mt-3 mb-4">Anggaran</h5>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Belanja Modal</label>
                                <input type="text" name="kelompok" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Belanja Modal</label>
                                <input type="text" name="kelompok" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Belanja Modal</label>
                                <input type="text" name="kelompok" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Belanja Modal</label>
                                <input type="text" name="kelompok" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h5 class="mt-3 mb-3">Pelaksanaan</h5>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="a">A. Perencanaan ( 1% <= progess 11% )</option>
                                    <option value="b">B. Perencanaan ( 11% <= progess 26% )</option>
                                    <option value="c">C. Perencanaan ( 26% <= progess 100% )</option>
                                    <option value="d">D. Perencanaan ( Selesai 100% )</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Persentase(%)</label>
                                        <input type="text" name="persentase" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Status Kemanfaatan</label>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="status_kemanfaatan"
                                                id="customRadio1" value="belum di manfaatkan">
                                            <label class="custom-control-label" for="customRadio1">Belum
                                                dimanfaatkan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_kemanfaatan"
                                                id="customRadio2" value="sudah dimanfaatkan">
                                            <label class="custom-control-label" for="customRadio2">Sudah
                                                dimanfaatkan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea name="keterangan_status" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h5 class="mt-3 mb-3">Permasalahan</h5>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea name="permasalahan" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Dokumen</label>
                                <br>
                                <input type="file" name="dokumen" class="form-control-file" readonly>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Foto</label>
                                <br>
                                <input type="file" name="dokumen" class="form-control-file" readonly>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Video</label>
                                <br>
                                <input type="file" name="dokumen" class="form-control-file" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <button class="btn btn-sm btn-dark" type="submit">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



    </div>
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
