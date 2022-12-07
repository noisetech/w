@extends('layouts.admin')
@section('title', 'DPA')
@section('content')
    {{ navbar('DPA', 'Form Tambah DPA') }}

    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 10px !important;
            font-weight: 600 !important;
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
                            <strong class="text-{{ isset($active) && $active == 'sub_dpa' ? 'white' : 'black' }}">Team Anggaran
                            </strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'sub_dpa' ? 'dark' : 'light' }}">
                            <strong class="text-{{ isset($active) && $active == 'sub_dpa' ? 'white' : 'black' }}">Tanda TAngan Dpa
                            </strong>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-lg-10 col-md-9 col-sm-12">
                <div class="card h-100 my-4">
                    <div class="card-header">
                        <h6 class="mx-2 my-4">DPA | Tanda Tangan Dpa</h6>
                    </div>
                    <div class="card-body ">
                        <form action="#" method="post" id="form_tambah">
                            @csrf


                            <input type="hidden" name="dpa_id" value="{{ $dpa->id }}">

                            <div class="row mt-4">

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>
                                            Kota:
                                        </label>
                                        <input type="text" name="" class="sub_rincian form-control">
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>
                                            Tanggal:
                                        </label>
                                        <input type="text" class="form-control" name="jumlah_anggaran[]"
                                            placeholder="Anggaran">
                                        <span class="text-danger error-text bidang_id_error"
                                            style="font-size: 12px;"></span>
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>
                                            Jabatan Pejabat:
                                        </label>
                                        <input type="text" class="form-control" name="jumlah_anggaran[]"
                                            placeholder="Anggaran">
                                        <span class="text-danger error-text bidang_id_error"
                                            style="font-size: 12px;"></span>
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>
                                            Nip:
                                        </label>
                                        <input type="text" class="form-control" name="jumlah_anggaran[]"
                                            placeholder="Anggaran">
                                        <span class="text-danger error-text bidang_id_error"
                                            style="font-size: 12px;"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>
                                            Kota:
                                        </label>
                                        <input type="text" name="kota[]" class="sub_rincian form-control">
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>
                                            Tanggal:
                                        </label>
                                        <input type="text" class="form-control" name="tanggal[]"
                                            placeholder="Anggaran">
                                        <span class="text-danger error-text bidang_id_error"
                                            style="font-size: 12px;"></span>
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>
                                            Jabatan Pejabat:
                                        </label>
                                        <input type="text" class="form-control" name="jabatan_pejabat[]"
                                            placeholder="Anggaran">
                                        <span class="text-danger error-text bidang_id_error"
                                            style="font-size: 12px;"></span>
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>
                                            Nip:
                                        </label>
                                        <input type="text" class="form-control" name="nip[]"
                                            placeholder="Anggaran">
                                        <span class="text-danger error-text bidang_id_error"
                                            style="font-size: 12px;"></span>
                                    </div>
                                </div>
                            </div>



                            <div class="col-sm-6">
                                <button type="submit" class="btn my-5 btn-sm btn-success btn-save">SIMPAN</button>
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
