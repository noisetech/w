@extends('layouts.admin')
@section('title', 'DPA')
@section('content')
    {{ navbar('DPA', 'Form Tambah DPA') }}

    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 10px !important;
            font-weight: 600 !important;
        }

        label {
            font-size: 10px !important;
        }

        strong {
            font-size: 12px;
        }

        .select2-remove-border {
            border: 0px !important;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row my-2">
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

            <div class="col-lg-10 col-md-9 col-sm-12">
                <div class="card h-100 my-4">
                    <div class="card-header pb-4">
                        <h6 class="font">DPA | Bagian Tambah Sub Dpa </h6>
                    </div>
                    <div class="card-body ">
                        <form action="#" method="post" id="form_dpa" class="form-inline">
                            @csrf


                            <div class="row">

                                <label class="no_dpa col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                    No Dpa:
                                </label>

                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <input type="text" name="no_dpa" class="form-control" placeholder="No Dpa">
                                    <span class="text-danger error-text no_dpa_error" style="font-size: 12px;"></span>
                                </div>
                            </div>

                            <div class="row mt-4">

                                <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                    Dinas:
                                </label>
                                <div class="col-sm-12 col-md-9 col-lg-9 mx-0">
                                    <select name="dinas_id" id="dinas" class="js-states form-control"></select>
                                    <span class="text-danger error-text dinas_id_error" style="font-size: 12px;"></span>
                                </div>
                            </div>


                            <div class="row mt-4">

                                <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                    Tahun:
                                </label>
                                <div class="col-sm-12 col-md-9 col-lg-9 mx-0">
                                    <select name="tahun_id" id="tahun" class="js-states form-control"></select>
                                    <span class="text-danger error-text tahun_id_error" style="font-size: 12px;"></span>
                                </div>
                            </div>

                            <div class="row mt-4">

                                <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                    Urusan:
                                </label>
                                <div class="col-sm-12 col-md-9 col-lg-9 mx-0">
                                    <select name="urusan_id" id="urusan" class="js-states form-control"></select>
                                    <span class="text-danger error-text urusan_id_error" style="font-size: 12px;"></span>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                    Pengambilan:
                                </label>
                                <div class="col-sm-12 col-md-9 col-lg-9 mx-0">
                                    <select name="bidang_id" id="bidang" class="js-states form-control" disabled>
                                        <option value="">--Pilih Urusan Dahulu--</option>
                                    </select>
                                    <span class="text-danger error-text bidang_id_error" style="font-size: 12px;"></span>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                    Program:
                                </label>
                                <div class="col-sm-12 col-md-9 col-lg-9 mx-0">
                                    <select name="program_id" id="program" class="form-control" disabled>
                                        <option value="">--Pilih Bidang Dahulu--</option>
                                    </select>
                                    <span class="text-danger error-text program_id_error" style="font-size: 12px;"></span>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <label class="col-sm-12 col-md-2 col-lg-2 my-2 mx-0">
                                    Kegiatan:
                                </label>
                                <div class="col-sm-12 col-md-9 col-lg-9 mx-0">
                                    <select name="kegiatan_id" id="kegiatan" class="form-control" disabled>
                                        <option value="">--Pilih Program Dahulu--</option>
                                    </select>
                                    <span class="text-danger error-text kegiatan_id" style="font-size: 12px;"></span>
                                </div>
                            </div>


                            <div class="row mt-4">
                                <label class="col-sm-12 col-md-2 my-2 mx-0">
                                    Organisasi
                                </label>
                                <div class="col-sm-12 col-md-9 col-lg-9 mx-0">
                                    <select name="organisasi_id" id="organisasi" class="form-control" disabled>
                                        <option value="">--Pilih Kegiatan Dahulu--</option>
                                    </select>
                                    <span class="text-danger error-text organisasi_id_error"
                                        style="font-size: 12px;"></span>
                                </div>
                            </div>


                            <div class="row mt-4">
                                <label class="col-sm-12 col-md-2 my-2 mx-0">
                                    Unit
                                </label>
                                <div class="col-sm-12 col-md-9 col-lg-9 mx-0">
                                    <select name="unit_id" id="unit" class="form-control" disabled>
                                        <option value="">--Pilih Organisasi Dahulu--</option>
                                    </select>
                                    <span class="text-danger error-text urusan_id_error" style="font-size: 12px;"></span>
                                </div>
                            </div>


                            <div class="row mt-3">

                                <label class="col-sm-2 my-2 mx-0">
                                    Capaian Program
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-sm-2">

                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Indikator</label>
                                        <input type="text" name="indikator_capaian_program" class="form-control">
                                        <span class="text-danger error-text indikator_capaian_program_error"
                                            style="font-size: 12px;"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Target</label>
                                        <input type="text" name="target_capaian_program" class="form-control">
                                        <span class="text-danger error-text indikator_capaian_program_error"
                                            style="font-size: 12px;"></span>
                                    </div>
                                </div>
                            </div>



                            <div class="col-sm-3">

                            </div>

                            <div class="row mt-3">
                                <label class="col-sm-4 my-2">
                                    Indikator
                                </label>

                                <label class="col-sm-4 my-2">
                                    Tolak Ukur
                                </label>

                                <label class="col-sm-3 my-2">
                                    Kinerja
                                </label>

                            </div>

                            <div class="row">
                                <div class="col-sm-2 my-2">
                                    <input type="text" readonly name="indikator[]" class="form-control"
                                        value="Capaian Kegiatan">
                                </div>

                                <div class="col-sm-6 my-2">
                                    <input type="text" name="tolak_ukur[]" class="form-control"
                                        placeholder="Tolak Ukur">
                                    <span class="text-danger error-text tolak_ukur_0_error"
                                        style="font-size: 12px;"></span>
                                </div>

                                <div class="col-sm-3 my-2">
                                    <input type="text" name="kinerja[]" class="form-control" placeholder="Kinerja">
                                    <span class="text-danger error-text kinerja_0_error" style="font-size: 12px;"></span>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-2 my-2">
                                    <input type="text" readonly name="indikator[]" class="form-control"
                                        value="Masukan">
                                </div>

                                <div class="col-sm-6 my-2">
                                    <input type="text" name="tolak_ukur[]" class="form-control"
                                        placeholder="Tolak Ukur">
                                    <span class="text-danger error-text tolak_ukur_1_error"
                                        style="font-size: 12px;"></span>
                                </div>

                                <div class="col-sm-3 my-2">
                                    <input type="text" name="kinerja[]" class="form-control" placeholder="Kinerja">
                                    <span class="text-danger error-text kinerja_1_error" style="font-size: 12px;"></span>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-2 my-2">
                                    <input type="text" readonly name="indikator[]" class="form-control"
                                        value="Keluaran">
                                </div>

                                <div class="col-sm-6 my-2">
                                    <input type="text" name="tolak_ukur[]" class="form-control"
                                        placeholder="Tolak Ukur">
                                    <span class="text-danger error-text tolak_ukur_2_error"
                                        style="font-size: 12px;"></span>
                                </div>

                                <div class="col-sm-3 my-2">
                                    <input type="text" name="kinerja[]" class="form-control" placeholder="Kinerja">
                                    <span class="text-danger error-text kinerja_2_error" style="font-size: 12px;"></span>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-2 my-2">
                                    <input type="text" readonly name="indikator[]" class="form-control"
                                        value="Hasil">
                                </div>

                                <div class="col-sm-6 my-2">
                                    <input type="text" name="tolak_ukur[]" class="form-control"
                                        placeholder="Tolak Ukur">
                                    <span class="text-danger error-text tolak_ukur_3_error"
                                        style="font-size: 12px;"></span>
                                </div>

                                <div class="col-sm-3 my-2">
                                    <input type="text" name="kinerja[]" class="form-control" placeholder="Kinerja">
                                    <span class="text-danger error-text kinerja_3_error" style="font-size: 12px;"></span>
                                </div>

                            </div>


                            <div class="listAlokasiTahun">

                            </div>

                            <div id="wew">

                            </div>

                            <i class="fa fa-plus addAlokasiTahun my-4">ADD</i>


                            <div class="row mt-5">
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-sm btn-dark btn-save">Simpan</button>
                                </div>

                            </div>
                    </div>
                    </form>

                </div>



            </div>

        </div>
    </div>
    </div>
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var inputan_tahun_alokasi = 0;
        var validasi_tahun_alokasi = 0;
        // var w = 0;
        $(".addAlokasiTahun").click(function() {
            //add id=galery+counter
            var test = (
                '<div class="row justify-content-center my-3"><div class="col-sm-4 imgUp"><div class="form-group"><input id="tahun_alokasi_' +
                inputan_tahun_alokasi +
                '" class="form-control tahun_alokasi_control" name="tahun_alokasi[]" placeholder="Tahun Alokasi"><span  class="gg text-danger error-text tahun_alokasi_' +
                validasi_tahun_alokasi +
                '_error" style="font-size: 12px;"></span><div class="span_baru"></div><br></div></div><div class="col-sm-2"><i class="fa fa-times del my-3"></i> </div></div>'
            );
            $('#wew').append(test);
            inputan_tahun_alokasi++;
            validasi_tahun_alokasi++; //increment
            // w++; //increment
        });
        $(document).on("click", "i.del", function() {
            $(this).parent().parent().remove();
            validasi_tahun_alokasi--;
            inputan_tahun_alokasi--;
            // w--; //decremnt count
            reset(); //reseting ids
        });


        function reset() {
            var inputan_tahun_alokasi = 0; //declare count
            var validasi_tahun_alokasi = 0;
            $(".tahun_alokasi_control").each(function() {
                $(this).attr('id', 'tahun_alokasi_' + inputan_tahun_alokasi); //change ids
                inputan_tahun_alokasi++; //increment
            });

            $("span.gg").each(function() {
                $(this).attr('class', 'gg'+ ' ' + 'tahun_alokasi_' +
                    validasi_tahun_alokasi + '_error');
                validasi_tahun_alokasi++;
            });

            $('span.gg').addClass('text-danger');
        }
    </script>


    <script>
        $(document).ready(function() {
            styleSelect2();
        });

        function styleSelect2() {
            $('.select2-container').addClass('form-control');
            $('.select2-selection').addClass('select2-remove-border');
        }


        $('#tahun').select2({
            // containerCssClass: "form-control",
            minimumInputLength: 1,
            // dropdownParent: $('#exampleModal'),
            maximumInputLength: 50,
            allowClear: true,
            placeholder: '-- Pilih Tahun--',
            width: '100%',
            ajax: {
                url: "{{ route('dpa.listTahun') }}",
                dataType: 'json',
                delay: 500,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.tahun,
                                id: item.id
                            }
                        })
                    };


                }
            }
        });

        $('#urusan').select2({
            // containerCssClass: "form-control",
            minimumInputLength: 1,
            // dropdownParent: $('#exampleModal'),
            maximumInputLength: 50,
            allowClear: true,
            placeholder: '-- Pilih Urusan--',
            width: '100%',
            ajax: {
                url: "{{ route('dpa.listUrusan') }}",
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
        });

        $('#dinas').select2({
            // containerCssClass: "form-control",
            minimumInputLength: 1,
            // dropdownParent: $('#exampleModal'),
            maximumInputLength: 50,
            allowClear: true,
            placeholder: '-- Pilih Dinas--',
            width: '100%',
            ajax: {
                url: "{{ route('dpa.listDinas') }}",
                dataType: 'json',
                delay: 500,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.dinas,
                                id: item.id
                            }
                        })
                    };


                }
            }
        });

        $('#urusan').change(function() {

            let id = $('#urusan').val();


            $('#bidang').removeAttr('disabled');

            $('#bidang').select2({
                minimumInputLength: 0,
                // dropdownParent: $('#exampleModal'),
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Bidang--',
                width: '100%',
                ajax: {
                    url: "{{ url('dashboard/dpa-list_bidang') }}/" + id,
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
            });

            styleSelect2();
        });

        $('#bidang').change(function() {

            let id = $('#bidang').val();

            $('#program').removeAttr('disabled');

            $('#program').select2({
                minimumInputLength: 0,
                // dropdownParent: $('#exampleModal'),
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Program--',
                width: '100%',
                ajax: {
                    url: "{{ url('dashboard/dpa-list_program') }}/" + id,
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
            });

            styleSelect2();
        });

        $('#program').change(function() {

            let id = $('#program').val();

            $('#kegiatan').removeAttr('disabled');

            $('#kegiatan').select2({
                minimumInputLength: 0,
                // dropdownParent: $('#exampleModal'),
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Program--',
                width: '100%',
                ajax: {
                    url: "{{ url('dashboard/dpa-list_kegiatan') }}/" + id,
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
            });
        });

        $('#kegiatan').change(function() {

            let id = $('#kegiatan').val();

            $('#organisasi').removeAttr('disabled');

            $('#organisasi').select2({
                minimumInputLength: 0,
                // dropdownParent: $('#exampleModal'),
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Program--',
                width: '100%',
                ajax: {
                    url: "{{ url('dashboard/dpa-list_organisasi') }}/" + id,
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
            });
        });

        $('#organisasi').change(function() {

            let id = $('#organisasi').val();

            $('#unit').removeAttr('disabled');

            $('#unit').select2({
                minimumInputLength: 0,
                // dropdownParent: $('#exampleModal'),
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Unit--',
                width: '100%',
                ajax: {
                    url: "{{ url('dashboard/dpa-list_unit') }}/" + id,
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
            });
        });




        $("#form_dpa").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('dpa.insert_dpa_to_session') }}',
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
                                "{{ url('dashboard/dpa/h_tambah_sub_dpa') }}/" + data
                                .bahan_dpa_id;
                        }, 1800);
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix.replace(/\./g, '_') +
                                    '_error').text(
                                    val[0]);

                            });

                        });
                    }

                }
            });
        });
    </script>
@endpush
