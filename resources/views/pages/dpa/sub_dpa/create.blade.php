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
    <form action="#" method="post" id="form_tambah" class="form-inline">
        @csrf
        <div class="container-fluid py-4">
            <div class="row my-2">

                <div class="col-lg-2 col-md-3 col-sm-12 h-100">
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


                        </div>
                    </div>
                </div>

                <div class="col-lg-10 col-md-9 col-sm-12">
                    <div class="card h-100 my-4">

                        <div class="card-body ">



                            <div class="row justify-content-end my-4">
                                <div class="col-sm-4">
                                    <a href="#" onclick="dynamic_sub_dpa()" class="btn btn-sm btn-primary"> Tambah Sub
                                        Dpa</a>
                                </div>
                            </div>



                            <div id="bahan_dynamic_sub_dpa">

                                <div class="row">

                                    <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                        Sub Kegiatan:
                                    </label>
                                    <div class="col-sm-12 col-md-9 col-lg-9 mx-0">
                                        <select name="sub_kegiatan_id[]" id="sub_kegiatan" class="form-control" sle>
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
                                        <select name="sumber_dana_id[]" id="sumber_dana" class="form-control" sle>
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
                                        <input type="text" name="lokasi[]" class="form-control" placeholder="Lokasi">
                                        <span class="text-danger error-text no_dpa_error" style="font-size: 12px;"></span>
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
                                        <input type="text" class="form-control" name="target" placeholder="Target">
                                    </div>

                                </div>

                                <div class="row mt-4">

                                    <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                        Waktu Pelaksanaan:
                                    </label>

                                    <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                        <input type="text" name="no_dpa" class="form-control" placeholder="Lokasi">
                                        <span class="text-danger error-text no_dpa_error" style="font-size: 12px;"></span>
                                    </div>
                                </div>

                                <div class="row mt-4">

                                    <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                        Keterangan:
                                    </label>

                                    <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                        <input type="text" name="no_dpa" class="form-control" placeholder="Keterangan">
                                        <span class="text-danger error-text no_dpa_error" style="font-size: 12px;"></span>
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
                                    data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Uraian
                                </button>

                                <div class="collapse" id="collapseExample">

                                    <div class="row mt-4">

                                        <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                            Akun:
                                        </label>
                                        <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                            <select name="bidang_id" id="akun" class="form-control" sle>
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
                                            <select name="bidang_id" id="kelompok" class="form-control" sle>
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
                                            <select name="bidang_id" id="jenis" class="form-control" sle>
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
                                            <select name="bidang_id" id="objek" class="form-control" sle>
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
                                            <select name="bidang_id" id="rincian_objek" class="form-control" sle>
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


                                        <div class="row mt-4">

                                            <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                                Sub Rincian Objek:
                                            </label>
                                            <div class="col-sm-12 col-md-4 col-lg-3 mx-0">
                                                <input type="text" class="form-control"
                                                    placeholder="Sub Rincian Objek">
                                                <span class="text-danger error-text bidang_id_error"
                                                    style="font-size: 12px;"></span>
                                            </div>

                                            <div class="col-sm-12 col-md-1 col-lg-1">

                                            </div>

                                            <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                                Anggaran:
                                            </label>
                                            <div class="col-sm-12 col-md-4 col-lg-4 mx-0">
                                                <input type="text" class="form-control" placeholder="Anggaran">
                                                <span class="text-danger error-text bidang_id_error"
                                                    style="font-size: 12px;"></span>
                                            </div>
                                        </div>

                                        <div id="rincian_uraian_selanjutnya">

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>



                    </div>

                </div>
            </div>
        </div>


        <div class="sub_dpa_dynamic">

        </div>

        <div class="row justify-content-end">
            <div class="col-sm-3">
                <button type="submit" class="btn my-5 btn-sm btn-success btn-save">SIMPAN</button>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function dynamic_sub_dpa() {



            var sub_dpa = `             <div class="container-fluid py-4">
        <div class="row my-2">

            <div class="col-lg-2 col-md-3 col-sm-12 h-100">

            </div>

            <div class="col-lg-10 col-md-9 col-sm-12">
                <div class="card h-100 my-4">

                    <div class="card-body ">


                            <div id="bahan_dynamic_sub_dpa">

                                <div class="row">

                                    <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                        Sub Kegiatan:
                                    </label>
                                    <div class="col-sm-12 col-md-9 col-lg-9 mx-0">
                                        <select name="bidang_id" id="sub_kegiatan" class="form-control" sle>
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
                                        <select name="bidang_id" id="sumber_dana" class="form-control" sle>
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
                                        <input type="text" name="no_dpa" class="form-control" placeholder="Lokasi">
                                        <span class="text-danger error-text no_dpa_error" style="font-size: 12px;"></span>
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
                                        <input type="text" class="form-control" name="target" placeholder="Target">
                                    </div>

                                </div>

                                <div class="row mt-4">

                                    <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                        Waktu Pelaksanaan:
                                    </label>

                                    <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                        <input type="text" name="no_dpa" class="form-control" placeholder="Lokasi">
                                        <span class="text-danger error-text no_dpa_error" style="font-size: 12px;"></span>
                                    </div>
                                </div>

                                <div class="row mt-4">

                                    <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                        Keterangan:
                                    </label>

                                    <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                        <input type="text" name="no_dpa" class="form-control" placeholder="Keterangan">
                                        <span class="text-danger error-text no_dpa_error" style="font-size: 12px;"></span>
                                    </div>
                                </div>






                                <button class="btn btn-sm btn-info mt-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                                    Uraian
                                </button>

                                <div class="collapse" id="collapseExample">

                                    <div class="row mt-4">

                                        <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                            Akun:
                                        </label>
                                        <div class="col-sm-12 col-md-10 col-lg-10 mx-0">
                                            <select name="bidang_id" id="akun" class="form-control" sle>
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
                                            <select name="bidang_id" id="kelompok" class="form-control" sle>
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
                                            <select name="bidang_id" id="jenis" class="form-control" sle>
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
                                            <select name="bidang_id" id="objek" class="form-control" sle>
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
                                            <select name="bidang_id" id="rincian_objek" class="form-control" sle>
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

                                        <div class="row mt-4">

                                            <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                                Sub Rincian Objek:
                                            </label>
                                            <div class="col-sm-12 col-md-4 col-lg-3 mx-0">
                                                <input type="text" class="form-control"
                                                    placeholder="Sub Rincian Objek">
                                                <span class="text-danger error-text bidang_id_error"
                                                    style="font-size: 12px;"></span>
                                            </div>

                                            <div class="col-sm-12 col-md-1 col-lg-1">
                                            </div>

                                            <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                                Anggaran:
                                            </label>
                                            <div class="col-sm-12 col-md-4 col-lg-4 mx-0">
                                                <input type="text" class="form-control" placeholder="Anggaran">
                                                <span class="text-danger error-text bidang_id_error"
                                                    style="font-size: 12px;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
            $('.sub_dpa_dynamic').append(sub_dpa);
            $('.remove').on('click', function() {
                $(this).parent().parent().remove();
            })
        }
    </script>

    <script>
        function dynamic_rincian_uraian() {
            var rincian_uraian = `  <div class="row mt-4">

<label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
    Sub Rincian Objek:
</label>
<div class="col-sm-12 col-md-4 col-lg-3 mx-0">
    <input type="text" class="form-control"
        placeholder="Sub Rincian Objek">
    <span class="text-danger error-text bidang_id_error"
        style="font-size: 12px;"></span>
</div>

<div class="col-sm-12 col-md-1 col-lg-1">

</div>

<label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
    Anggaran:
</label>
<div class="col-sm-12 col-md-4 col-lg-4 mx-0">
    <input type="text" class="form-control" placeholder="Anggaran">
    <span class="text-danger error-text bidang_id_error"
        style="font-size: 12px;"></span>
</div>
</div>`;
            $('#rincian_uraian_selanjutnya').append(rincian_uraian);
            $('.remove').on('click', function() {
                $(this).parent().parent().remove();
            })
        }
    </script>


    <script>
        // $('#akun').select2({
        //     minimumInputLength: 1,
        //     // dropdownParent: $('#exampleModal'),
        //     maximumInputLength: 50,
        //     allowClear: true,
        //     placeholder: '-- Pilih Akun--',
        //     width: '100%',
        //     ajax: {
        //         url: "{{ route('dpa.listAkunRekening') }}",
        //         dataType: 'json',
        //         delay: 500,
        //         processResults: function(data) {
        //             return {
        //                 results: $.map(data, function(item) {
        //                     return {
        //                         text: item.kode + " " + item.uraian_akun,
        //                         id: item.id
        //                     }
        //                 })


        //             };
        //         }
        //     }
        // })

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


        // $('#kelompok').select2({
        //     minimumInputLength: 1,
        //     // dropdownParent: $('#exampleModal'),
        //     maximumInputLength: 50,
        //     allowClear: true,
        //     placeholder: '-- Pilih Kelompok--',
        //     width: '100%',
        //     ajax: {
        //         url: "{{ route('dpa.listUrusan') }}",
        //         dataType: 'json',
        //         delay: 500,
        //         processResults: function(data) {
        //             return {
        //                 results: $.map(data, function(item) {
        //                     return {
        //                         text: item.kode + " " + item.nomenklatur,
        //                         id: item.id
        //                     }
        //                 })


        //             };
        //         }
        //     }
        // })

        // $('#jenis').select2({
        //     minimumInputLength: 1,
        //     // dropdownParent: $('#exampleModal'),
        //     maximumInputLength: 50,
        //     allowClear: true,
        //     placeholder: '-- Pilih Jenis--',
        //     width: '100%',
        //     ajax: {
        //         url: "{{ route('dpa.listUrusan') }}",
        //         dataType: 'json',
        //         delay: 500,
        //         processResults: function(data) {
        //             return {
        //                 results: $.map(data, function(item) {
        //                     return {
        //                         text: item.kode + " " + item.nomenklatur,
        //                         id: item.id
        //                     }
        //                 })


        //             };
        //         }
        //     }
        // })

        // $('#objek').select2({
        //     minimumInputLength: 1,
        //     // dropdownParent: $('#exampleModal'),
        //     maximumInputLength: 50,
        //     allowClear: true,
        //     placeholder: '-- Pilih Objek--',
        //     width: '100%',
        //     ajax: {
        //         url: "{{ route('dpa.listUrusan') }}",
        //         dataType: 'json',
        //         delay: 500,
        //         processResults: function(data) {
        //             return {
        //                 results: $.map(data, function(item) {
        //                     return {
        //                         text: item.kode + " " + item.nomenklatur,
        //                         id: item.id
        //                     }
        //                 })


        //             };
        //         }
        //     }
        // })

        // $('#rincian_objek').select2({
        //     minimumInputLength: 1,
        //     // dropdownParent: $('#exampleModal'),
        //     maximumInputLength: 50,
        //     allowClear: true,
        //     placeholder: '-- Pilih Rincian Objek--',
        //     width: '100%',
        //     ajax: {
        //         url: "{{ route('dpa.listUrusan') }}",
        //         dataType: 'json',
        //         delay: 500,
        //         processResults: function(data) {
        //             return {
        //                 results: $.map(data, function(item) {
        //                     return {
        //                         text: item.kode + " " + item.nomenklatur,
        //                         id: item.id
        //                     }
        //                 })


        //             };
        //         }
        //     }
        // })
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

                    } else {
                        // $.each(data.error, function(prefix, val) {
                        //     $.each(data.error, function(prefix, val) {
                        //         $('span.' + prefix.replace(/\./g, '_') +
                        //             '_error').text(
                        //             val[0]);

                        //     });

                        // });
                    }

                }
            });
        });
    </script>
@endpush