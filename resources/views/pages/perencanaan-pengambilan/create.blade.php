@extends('layouts.admin')


@section('title', 'Realisasi')
@section('content')
    {{ navbar('Realisasi', 'Realisasi') }}

    <div class="container-fluid py-4">


        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <h6 class="mx-4 mt-3">Detail</h6>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h6>Bidang &nbsp; &nbsp; &nbsp; &nbsp; : &nbsp; {{ $dpa->kode_bidang }}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h6>Kegiatan &nbsp; &nbsp; : &nbsp; asdasdad</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h6>Program &nbsp; &nbsp; &nbsp;: &nbsp;asdasdad</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h6>Organisasi &nbsp;: &nbsp;asdasdad</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h6>Unit &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : asdasdad</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Realisasi</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Bulan</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jumlah</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Relaisasi</th>

                                        {{-- <th></th>/ --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 px-3">Januari</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Rp. 30.000.000</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">30%</span>
                                        </td>

                                        {{-- <td class="align-middle">
                                            <button class="btn btn-link text-success mb-0">
                                                Proses
                                            </button>
                                        </td> --}}
                                    </tr>

                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 px-3">Februari</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Rp. 45.000.000</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">40%</span>
                                        </td>

                                        {{-- <td class="align-middle">
                                            <button class="btn btn-link text-success mb-0">
                                                Proses
                                            </button>
                                        </td> --}}
                                    </tr>

                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0 px-3">Maret</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Rp. 25.000.000</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">35%</span>
                                        </td>

                                        {{-- <td class="align-middle">
                                            <button class="btn btn-link text-success mb-0">
                                                Proses
                                            </button>
                                        </td> --}}
                                    </tr>


                                </tbody>
                            </table>
                        </div>

                        <div class="container">
                            <div class="row mt-3">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Catatan Kendala">
                                </div>

                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Realisasi">
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row mt-4">
                                <div class="col-sm-2">
                                    <button class="btn btn-success" type="submit">
                                        Proses
                                    </button>
                                </div>

                                <div class="col-sm-2">
                                    <button class="btn btn-dark" type="submit">
                                        Simpan
                                    </button>
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
        $(document).ready(function() {});

        function collapseNomenklatur(data) {
            let next = $(data).next();
            next.collapse('toggle');
            if (next.hasClass('terbuka') == false) {
                $(data).children().children('i').removeClass('fas fa-plus-circle text-success');
                $(data).children().children('i').addClass('fas fa-minus-circle text-warning');
                next.addClass('terbuka');
            } else {
                next.removeClass('terbuka');
                $(data).children().children('i').removeClass('fas fa-minus-circle text-warning');
                $(data).children().children('i').addClass('fas fa-plus-circle text-success');
            }
        }

        function detailRencanaPembangunan(id_dpa) {
            window.location.href = "/dashboard/perencanaan_pengambilan/h_tambah/" + id_dpa;
        }
    </script>
@endpush
