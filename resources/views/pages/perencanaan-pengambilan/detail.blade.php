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
                                <h6>Bidang &nbsp; &nbsp; &nbsp; &nbsp; : &nbsp;
                                    {{ $dpa->kode_bidang . ' ' . $dpa->nomenklatur_bidang }}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h6>Kegiatan &nbsp; &nbsp; : &nbsp;
                                    {{ $dpa->kode_kegiatan . ' ' . $dpa->nomenklatur_kegiatan }}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h6>Program &nbsp; &nbsp; &nbsp;: &nbsp; {{ $dpa->kode_program . ' '. $dpa->nomenklatur_program }}</h6>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>List Bulan</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Bulan </th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bulan as $bulan)
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0 px-3">
                                                    {{ Str::ucfirst($bulan->bulan) }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('perencanaan_pengambilan.tambah_realisasi', [$dpa->id_dpa, $bulan->id]) }}"
                                                    class="btn btn-sm btn-info">Input Realisasi</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
