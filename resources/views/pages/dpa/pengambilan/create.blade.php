@extends('layouts.admin')
@section('title', 'DPA')
@section('content')
    {{ navbar('DPA', 'Form Tambah Rencana Penarikan') }}

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
                        <div class="alert alert-{{ isset($active) && $active == 'penarikan' ? 'dark' : 'light' }}">
                            <strong class="text-{{ isset($active) && $active == 'penarikan' ? 'white' : 'black' }}">Rencana
                                Penarikan
                            </strong>
                        </div>

                        <div class="alert alert-{{ isset($active) && $active == 'sub_dpa' ? 'dark' : 'light' }}">
                            <strong class="text-{{ isset($active) && $active == 'sub_dpa' ? 'white' : 'black' }}">Team Anggaran
                            </strong>
                        </div>

                        <div class="alert alert-{{ isset($active) && $active == 'sub_dpa' ? 'dark' : 'light' }}">
                            <strong class="text-{{ isset($active) && $active == 'sub_dpa' ? 'white' : 'black' }}">Tanda Tangan
                            </strong>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-10 col-lg-10">
                <div class="card my-4">

                    <div class="card-body">

                        <form action="#" method="POST" id="form_pengambilan">
                            @csrf

                            <input type="text" name="dpa_id" value="{{ $dpa->id }}" hidden>

                            <div class="row mt-5 justify-content-center">
                                <div class="col-sm-4">

                                    <input type="text" name="bulan[]" readonly value="Januari" class="form-control">
                                </div>

                                <div class="col-sm-4">

                                    <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                                </div>

                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4">

                                    <input type="text" name="bulan[]" readonly value="Februari" class="form-control">
                                </div>

                                <div class="col-sm-4">
                                    <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                                </div>

                            </div>


                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4">
                                    <input type="text" name="bulan[]" readonly value="Maret" class="form-control">
                                </div>

                                <div class="col-sm-4">
                                    <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                                </div>

                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4">

                                    <input type="text" name="bulan[]" readonly value="April" class="form-control">
                                </div>

                                <div class="col-sm-4">

                                    <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                                </div>

                            </div>


                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4">

                                    <input type="text" name="bulan[]" readonly value="Mei" class="form-control">
                                </div>

                                <div class="col-sm-4">

                                    <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                                </div>

                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4">

                                    <input type="text" name="bulan[]" readonly value="Juni" class="form-control">
                                </div>

                                <div class="col-sm-4">

                                    <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                                </div>

                            </div>


                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4">

                                    <input type="text" name="bulan[]" readonly value="Juli" class="form-control">
                                </div>

                                <div class="col-sm-4">

                                    <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                                </div>

                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4">

                                    <input type="text" name="bulan[]" readonly value="Agustus" class="form-control">
                                </div>

                                <div class="col-sm-4">

                                    <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                                </div>

                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4">

                                    <input type="text" name="bulan[]" readonly value="September"
                                        class="form-control">
                                </div>

                                <div class="col-sm-4">

                                    <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                                </div>

                            </div>


                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4">

                                    <input type="text" name="bulan[]" readonly value="Oktober" class="form-control">
                                </div>

                                <div class="col-sm-4">

                                    <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                                </div>

                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4">

                                    <input type="text" name="bulan[]" readonly value="November" class="form-control">
                                </div>

                                <div class="col-sm-4">

                                    <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                                </div>

                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-sm-4">

                                    <input type="text" name="bulan[]" readonly value="Desember" class="form-control">
                                </div>

                                <div class="col-sm-4">

                                    <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                                </div>

                            </div>

                            <div class="row mt-5 justify-content-start">

                                <div class="col-sm-2">

                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-primary" type="submit">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="container">
                            <div class="row mt-5 justify-content-end">
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

    </div>

@endsection


@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#form_pengambilan").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('dpa.proses_rencana_pengambilan') }}',
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
                            window.top.location = "{{ url('dashboard/dpa/team_anggaran') }}/"+ data
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
