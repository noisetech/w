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
                        <div class="alert alert-dark">
                            <strong class="text-white">Sub Dpa</strong>
                        </div>
                        <div class="alert alert-dark">
                            <strong class="text-white">Rencana Penarikan</strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'tim anggaran' ? 'dark' : 'light' }}">
                            <strong class="text-{{ isset($active) && $active == 'tim anggaran' ? 'white' : 'black' }}">Team
                                Anggaran
                            </strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'tanda tangan ' ? 'dark' : 'light' }}">
                            <strong class="text-{{ isset($active) && $active == 'tanda tangan' ? 'white' : 'black' }}">Tanda
                                Tangan Dpa
                            </strong>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <div class="card h-100 my-4">

                    <div class="card-body ">
                        <form action="#" method="post" id="form_tambah">
                            @csrf


                            <input type="hidden" name="dpa_id" value="{{ $dpa->id }}">

                            <div id="bahan_dynamic_sub_dpa">
                                <div class="row justify-content-end my-4">
                                    <div class="col-sm-3">
                                        <a href="#" onclick="dynamic_rincian_uraian()" class="btn btn-sm btn-primary">
                                            Tambah Team Anggaran</a>
                                    </div>
                                </div>


                                <div class="row mt-4">

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>
                                                Nama:
                                            </label>
                                            <input type="text" name="nama[]" class="sub_rincian form-control"
                                                placeholder="Nama">
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


                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>
                                                Jabatan:
                                            </label>
                                            <input type="text" class="form-control" name="jabatan[]"
                                                placeholder="Anggaran">
                                            <span class="text-danger error-text bidang_id_error"
                                                style="font-size: 12px;"></span>
                                        </div>
                                    </div>





                                </div>

                                <div id="rincian_uraian_selanjutnya">

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
        function dynamic_rincian_uraian() {
            var rincian_uraian = `              <div class="row mt-4">

<div class="col-sm-3">
    <div class="form-group">
        <label>
            Nama:
        </label>
        <input type="text" name="nama[]" class="sub_rincian form-control"
            placeholder="Nama">
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


<div class="col-sm-3">
    <div class="form-group">
        <label>
            Jabatan:
        </label>
        <input type="text" class="form-control" name="jabatan[]"
            placeholder="Anggaran">
        <span class="text-danger error-text bidang_id_error"
            style="font-size: 12px;"></span>
    </div>
</div>





</div>
`;
            $('#rincian_uraian_selanjutnya').append(rincian_uraian);
            $('.remove').on('click', function() {
                $(this).parent().parent().remove();
            })
        }
    </script>



    <script>
        $("#form_tambah").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('dpa.p_tim_anggaran') }}',
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
                            window.top.location = "{{ url('dashboard/dpa/ttd_dpa') }}/" + data
                                .bahan_id_dpa

                        }, 1800);
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }
                }
            });
        });
    </script>
@endpush
