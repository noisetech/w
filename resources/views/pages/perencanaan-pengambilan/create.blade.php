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
                <form action="#" method="POST" id="form_tambah">
                    @csrf

                    <input type="hidden" name="sub_dpa_id" class="form-control" value="{{ $bahan_awal->sub_dpa_id }}">


                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Bulan</label>
                                <input type="text" class="form-control" name="bulan" readonly
                                    value="{{ $bahan_data->bulan }}">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Rencana Penarikan</label>
                                <input type="text" class="form-control" readonly name="rencana_penarikan"
                                    value="{{ number_format($bahan_data->jumlah, 0, '.', '.') }}">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Pengambilan</label> <sup style="font-size: 10px"
                                    class="text-danger">*jangan melebihi rencana penarikan</sup>
                                <input type="text" class="form-control" name="pengambilan">
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
                                <label for="">{{ $bahan_awal->kelompok_rekening_kode_uraian_akun }}</label>
                                <input type="text" name="kelompok" class="form-control" readonly
                                    value="{{ number_format($total_anggaran->jumlah_anggaran, 0, '.', '.') }}">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">{{ $bahan_awal->jenis_rekening_uraian_akun }}</label>
                                <input type="text" name="kelompok" class="form-control" readonly value="0">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">{{ $bahan_awal->objek_rekening_uraian_akun }}</label>
                                <input type="text" name="kelompok" class="form-control" readonly value="0">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">{{ $bahan_awal->rincian_objek_rekening_uraian_akun }}</label>
                                <input type="text" name="kelompok" class="form-control" readonly value="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h5 class="mt-3 mb-3">Pelaksanaan</h5>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="A. Perencanaan ( 1% <= progess 11% )">A. Perencanaan ( 1% <= progess 11% )</option>
                                    <option value="B. Perencanaan ( 11% <= progess 26% )">B. Perencanaan ( 11% <= progess 26% )</option>
                                    <option value="C. Perencanaan ( 26% <= progess 100% )">C. Perencanaan ( 26% <= progess 100% )</option>
                                    <option value="D. Perencanaan ( Selesai 100% )">D. Perencanaan ( Selesai 100% )</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Persentase(%)</label> <sup style="font-size: 10px"
                                            class="text-danger">*jangan melebihi status pelaksanaan</sup>
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


    <script>
        $("#form_tambah").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('perencanaan_pengambilan.store') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                // beforeSend: function() {
                //     $(document).find('span.error-text').text('');
                // },
                success: function(data) {
                    if (data.status == 'success') {

                        Swal.fire({
                            icon: 'success',
                            text: 'Data telah disimpan',
                            title: 'Berhasil',
                            toast: true,
                            position: 'top-end',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                            window.top.location = "{{ route('perencanaan_pengambilan') }}"
                        }, 1500);
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
