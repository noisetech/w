@extends('layouts.admin')
@section('title', 'DPA')
@section('content')
    {{ navbar('DPA', 'Form Tambah DPA') }}

    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 10px !important;
            font-weight: 600 !important;
        }

        .form-control {
            font-size: 12px !important;
            font-weight: 600px !important;
        }

        label {
            font-size: 10px !important;
        }

        strong {
            font-size: 12px;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-sm-12 col-md-2 col-lg-2">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="alert alert-dark">
                            <strong class="text-white">DPA</strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'sub_dpa' ? 'dark' : 'light' }}">
                            <strong class="text-{{ isset($active) && $active == 'sub_dpa' ? 'white' : 'black' }}">SUB
                                DPA
                            </strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'sub_dpa' ? 'dark' : 'light' }}">
                            <strong class="text-{{ isset($active) && $active == 'sub_dpa' ? 'white' : 'black' }}">Rencana
                                Penarikan
                            </strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'sub_dpa' ? 'dark' : 'light' }}">
                            <strong class="text-{{ isset($active) && $active == 'sub_dpa' ? 'white' : 'black' }}">Team
                                Anggaran
                            </strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'sub_dpa' ? 'dark' : 'light' }}">
                            <strong class="text-{{ isset($active) && $active == 'sub_dpa' ? 'white' : 'black' }}">Tanda
                                TAngan Dpa
                            </strong>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-10 col-lg-10">
                <div class="card my-4">
                    <div class="card-header">
                        <a class="btn btn-sm btn-info mt-5" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3"
                            style="float: right">
                            Tambah Sub Dpa
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Sub Dpa</th>

                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Employed</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>


                        <div class="container">
                            <div class="row my-3 justify-content-end">
                                <div class="col-sm-2">
                                    <a class="btn btn-dark" href="{{ route('dpa.recana_pengambilan_dpa', $dpa->id) }}">
                                        Next
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="collapse" id="collapseExample3">
            <div class="row my-2">
                <div class="col-lg-2 col-md-3 col-sm-12 h-100">

                </div>

                <div class="col-lg-10 col-md-9 col-sm-12">
                    <div class="card h-100 my-4">

                        <div class="card-body ">
                            <form action="#" method="post" id="form_tambah" class="form-inline">
                                @csrf


                                <input type="hidden" name="dpa_id" value="{{ $dpa->id }}">

                                <div id="bahan_dynamic_sub_dpa">

                                    <div class="row">

                                        <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                            Sub Kegiatan:
                                        </label>
                                        <div class="col-sm-12 col-md-9 col-lg-9 mx-0">
                                            <select name="sub_kegiatan_id" id="sub_kegiatan" class="form-control">
                                            </select>
                                            <span class="text-danger error-text bidang_id_error"
                                                style="font-size: 12px;"></span>
                                        </div>
                                    </div>



                                    <div class="row mt-4">

                                        <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                            Sumber Dana:
                                        </label>
                                        <div class="col-sm-12 col-md-9 col-lg-9 mx-0">
                                            <select name="sumber_dana_id" id="sumber_dana" class="form-control">
                                            </select>
                                            <span class="text-danger error-text bidang_id_error"
                                                style="font-size: 12px;"></span>
                                        </div>
                                    </div>

                                    <div class="row mt-4">

                                        <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                            Lokasi:
                                        </label>

                                        <div class="col-sm-12 col-md-9 col-lg-9">
                                            <input type="text" name="lokasi" class="form-control" placeholder="Lokasi">
                                            <span class="text-danger error-text no_dpa_error"
                                                style="font-size: 12px;"></span>
                                        </div>
                                    </div>

                                    <div class="row mt-2">

                                        <label class="col-sm-3 my-2 mx-0">
                                            Keluaran Sub Kegiatan:
                                        </label>
                                    </div>

                                    <div class="row">

                                        <label class="col-sm-2 my-2 mx-0">

                                        </label>

                                        <label class="col-sm-6 my-2 mx-0">
                                            Indikator
                                        </label>

                                        <label class="col-sm-4 my-2 mx-0">
                                            Target
                                        </label>

                                    </div>

                                    <div class="row">

                                        <label class="col-sm-2 my-2 mx-0">

                                        </label>

                                        <div class="col-sm-6 my-2 mx-0">
                                            <select class="form-control" disabled></select>
                                        </div>

                                        <div class="col-sm-3 my-2 mx-0">
                                            <input type="number" name="target" class="form-control" name="target"
                                                placeholder="Target">
                                        </div>

                                    </div>

                                    <div class="row mt-4">

                                        <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                            Waktu Pelaksanaan:
                                        </label>

                                        <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                            <input type="text" name="waktu_pelaksanaan" class="form-control"
                                                placeholder="Lokasi">
                                            <span class="text-danger error-text no_dpa_error"
                                                style="font-size: 12px;"></span>
                                        </div>
                                    </div>

                                    <div class="row mt-4">

                                        <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                            Keterangan:
                                        </label>

                                        <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                            <input type="text" name="keterangan" class="form-control"
                                                placeholder="Keterangan">
                                            <span class="text-danger error-text no_dpa_error"
                                                style="font-size: 12px;"></span>
                                        </div>
                                    </div>




                                    {{--
                                <div class="row mt-4 justify-content-end">
                                    <div class="col-sm-2">
                                        <button class="btn btn-success" id="btn_save_sub_dpa">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    </div>
                                </div> --}}

                                    <button class="btn btn-sm btn-info mt-5" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        Uraian
                                    </button>

                                    <div class="collapse" id="collapseExample">

                                        <div class="row mt-4">

                                            <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                                Akun:
                                            </label>
                                            <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                                <select name="akun" id="akun" class="form-control">
                                                </select>
                                                <span class="text-danger error-text bidang_id_error"
                                                    style="font-size: 12px;"></span>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                                Kelompok:
                                            </label>
                                            <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                                <select name="kelompok" id="kelompok" class="form-control" disabled>
                                                    <option value="">--Pilih Akun Dahulu--</option>
                                                </select>
                                                <span class="text-danger error-text bidang_id_error"
                                                    style="font-size: 12px;"></span>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                                Jenis:
                                            </label>
                                            <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                                <select name="jenis" id="jenis" class="form-control" disabled>
                                                    <option value="">--Pilih Kelompok Dahulu--</option>
                                                </select>
                                                <span class="text-danger error-text bidang_id_error"
                                                    style="font-size: 12px;"></span>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                                Objek:
                                            </label>
                                            <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                                <select name="objek" id="objek" class="form-control" disabled>
                                                    <option value="">--Pilih Jenis Dahulu--</option>
                                                </select>
                                                <span class="text-danger error-text bidang_id_error"
                                                    style="font-size: 12px;"></span>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                                Rincian Objek:
                                            </label>
                                            <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                                <select name="rincian_objek" id="rincian_objek" class="form-control"
                                                    disabled>
                                                    <option value="">--Pilih Objek Dahulu--</option>
                                                </select>
                                                <span class="text-danger error-text bidang_id_error"
                                                    style="font-size: 12px;"></span>
                                            </div>
                                        </div>

                                        <button class="btn btn-sm btn-info mt-5" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseExample2" aria-expanded="false"
                                            aria-controls="collapseExample">
                                            Rincian Uraian
                                        </button>

                                        <div class="collapse" id="collapseExample2">



                                            <div class="row justify-content-end my-4">
                                                <div class="col-sm-4">
                                                    <a href="#" onclick="dynamic_rincian_uraian()"
                                                        class="btn btn-sm btn-primary"> Tambah Rincian Uraian</a>
                                                </div>
                                            </div>


                                            <div class="row mt-3">

                                                <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                                    Sub Rincian Objek:
                                                </label>
                                                <div class="col-sm-12 col-md-12 col-lg-12 mx-0">
                                                    <select name="sub_rincian[]" class="sub_rincian form-control"
                                                        disabled>
                                                        <option value="">--Pilih Objek Dahulu--</option>
                                                    </select>
                                                    <span class="text-danger error-text bidang_id_error"
                                                        style="font-size: 12px;"></span>
                                                </div>

                                                <div class="col-sm-12 col-md-1 col-lg-1">

                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                                    Anggaran:
                                                </label>
                                                <div class="col-sm-12 col-md-12 col-lg-12 mx-0">
                                                    <input type="text" class="form-control" name="jumlah_anggaran[]"
                                                        placeholder="Anggaran">
                                                    <span class="text-danger error-text bidang_id_error"
                                                        style="font-size: 12px;"></span>
                                                </div>
                                            </div>

                                            <div id="rincian_uraian_selanjutnya">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn my-4 btn-sm btn-success btn-save">SIMPAN</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>


            </div>


        </div>




    </div>

@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function dynamic_rincian_uraian() {
            var rincian_uraian = `      <div class="row mt-4">

                <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                                    Sub Rincian Objek:
                                                </label>
                                                <div class="col-sm-12 col-md-12 col-lg-12 mx-0">
                                                    <select name="sub_rincian[]" class="sub_rincian form-control"
                                                        disabled>
                                                        <option value="">--Pilih Objek Dahulu--</option>
                                                    </select>
                                                    <span class="text-danger error-text bidang_id_error"
                                                        style="font-size: 12px;"></span>
                                                </div>

        <div class="row mt-4">
            <div class="col-sm-12 col-md-1 col-lg-1">

</div>

<label class="col-sm-12 col-md-12 col-lg-12 my-2 mx-0">
    Anggaran:
</label>
<div class="col-sm-12 col-md-12 col-lg-12 mx-0">
    <input type="text" class="form-control" name="jumlah_anggaran[]"
        placeholder="Anggaran">
    <span class="text-danger error-text bidang_id_error"
        style="font-size: 12px;"></span>
</div>
        </div>
</div>`;
            $('#rincian_uraian_selanjutnya').append(rincian_uraian);
            $('.remove').on('click', function() {
                $(this).parent().parent().remove();
            })
        }
    </script>


    <script>
        $('#akun').select2({
            minimumInputLength: 1,
            // dropdownParent: $('#exampleModal'),
            maximumInputLength: 50,
            allowClear: true,
            placeholder: '-- Pilih Akun--',
            width: '100%',
            ajax: {
                url: "{{ route('dpa.listAkunRekening') }}",
                dataType: 'json',
                delay: 500,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.kode + " " + item.uraian_akun,
                                id: item.id
                            }
                        })


                    };
                }
            }
        })

        $('#akun').change(function() {

            let id = $('#akun').val();


            $('#kelompok').removeAttr('disabled');

            $('#kelompok').select2({
                minimumInputLength: 1,
                // dropdownParent: $('#exampleModal'),
                maximumInputLength: 50,
                allowClear: true,
                width: '100%',
                ajax: {
                    url: "{{ url('dashboard/dpa-listKelompokRekening') }}/" + id,
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.kode + " " + item.uraian_akun,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            })

        });



        $('#kelompok').change(function() {

            let id = $('#kelompok').val();


            $('#jenis').removeAttr('disabled');

            $('#jenis').select2({
                minimumInputLength: 1,
                // dropdownParent: $('#exampleModal'),
                maximumInputLength: 50,
                allowClear: true,
                width: '100%',
                ajax: {
                    url: "{{ url('dashboard/dpa-listJenisRekening') }}/" + id,
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.kode + " " + item.uraian_akun,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            })

        });

        $('#jenis').change(function() {

            let id = $('#jenis').val();


            $('#objek').removeAttr('disabled');

            $('#objek').select2({
                minimumInputLength: 1,
                // dropdownParent: $('#exampleModal'),
                maximumInputLength: 50,
                allowClear: true,
                width: '100%',
                ajax: {
                    url: "{{ url('dashboard/dpa-listObjekRekening') }}/" + id,
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.kode + " " + item.uraian_akun,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            })

        });

        $('#objek').change(function() {

            let id = $('#objek').val();


            $('#rincian_objek').removeAttr('disabled');

            $('#rincian_objek').select2({
                minimumInputLength: 1,
                // dropdownParent: $('#exampleModal'),
                maximumInputLength: 50,
                allowClear: true,
                width: '100%',
                ajax: {
                    url: "{{ url('dashboard/dpa-listRincianRekening') }}/" + id,
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.kode + " " + item.uraian_akun,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            })

        });

        $('#rincian_objek').change(function() {

            let id = $('#rincian_objek').val();


            $('.sub_rincian').removeAttr('disabled');

            $('.sub_rincian').select2({
                minimumInputLength: 1,
                // dropdownParent: $('#exampleModal'),
                maximumInputLength: 50,
                allowClear: true,
                width: '100%',
                ajax: {
                    url: "{{ url('dashboard/dpa-listSubRincianRekening') }}/" + id,
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.kode + " " + item.uraian_akun,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            })

        });



        $('#sumber_dana').select2({
            minimumInputLength: 1,
            // dropdownParent: $('#exampleModal'),
            maximumInputLength: 50,
            allowClear: true,
            placeholder: '-- Pilih Sumber Dana--',
            width: '100%',
            ajax: {
                url: "{{ route('dpa.listSumberDana') }}",
                dataType: 'json',
                delay: 500,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.sumber_dana,
                                id: item.id
                            }
                        })


                    };
                }
            }
        })


        $('#sub_kegiatan').select2({
            minimumInputLength: 1,
            // dropdownParent: $('#exampleModal'),
            maximumInputLength: 50,
            allowClear: true,
            placeholder: '-- Pilih Sub Kegiatan--',
            width: '100%',
            ajax: {
                url: "{{ route('dpa.listSubkegiatan') }}",
                dataType: 'json',
                delay: 500,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.kode + " " + item.nomenklatur,
                                id: item.id
                            }
                        })
                    };
                }
            }
        })
    </script>

    <script>
        $("#form_tambah").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('dpa.insert_lanjutan_dpa') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {

                        Swal.fire({
                            icon: 'success',
                            text: 'Data telah disimpan',
                            title: 'Berhasil',
                            toast: true,
                            position: 'top-end',
                            timer: 1800,
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                            window.top.location =
                                "{{ url('dashboard/rencana-pengambilan/dpa') }}/" + data
                                .bahan_dpa_id;
                        }, 1800);

                    } else {

                    }

                }
            });
        });
    </script>
@endpush
