@extends('layouts.admin')
@section('title', 'Monitoring Pembangunan')
@section('content')
    {{ navbar('Monitoring Pembangunan', 'List Monitoring Pembangunan') }}

    <div class="container-fluid py-4">
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <h6 class="mx-4 my-4">Kegiatan | Monitoring Pembangunan</h6>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" cellspacing="0" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="5%">
                                            #</th>
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="30%">
                                            Instansi</th>
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="35%">
                                            Nama Pekerjaan</th>
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="10%">
                                            Pelaksanaan Kontrak</th>
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="15%">
                                            Progress Pekerjaan</th>
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="5%">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($dpa->count() > 0)
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($dpa as $dp)
                                            <tr>
                                                <td class="text-secondary text-xs font-weight-bold">{{ $no++ }}</td>
                                                <td class="text-secondary text-xs font-weight-bold">{{ $dp->dinas }}</td>
                                                <td class="text-secondary text-xs font-weight-bold">{{ $dp->pekerjaan }}
                                                </td>
                                                <td class="text-secondary text-xs font-weight-bold text-center">
                                                    <i class="fab fa-searchengin fa-2x cursor-pointer"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $no }}"></i>
                                                </td>
                                                <td class="text-secondary text-xs font-weight-bold">
                                                    <div class="progress-wrapper">
                                                        <div class="progress-info">
                                                            <div class="progress-percentage">
                                                                <span class="text-sm font-weight-bold">{{$dp->persentase}}%</span>
                                                            </div>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                aria-valuenow="{{$dp->persentase}}" aria-valuemin="0" aria-valuemax="100"
                                                                style="width: {{$dp->persentase}}%;"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-secondary text-xs font-weight-bold text-center">
                                                    <a href="{{route('monitoring.pembangunan.detail', [encrypsi($dp->dpa_id), encrypsi($dp->detail_ket_sub_dpa_id)])}}">
                                                        <i class="fab fa-searchengin fa-2x"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="collapse" id="collapse-{{ $no }}">
                                                <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    width="5%">
                                                    Lokasi</th>
                                                <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    width="30%">
                                                    Pelaksana</th>
                                                <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    width="40%">
                                                    Nomor Kontrak</th>
                                                <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    width="10%">
                                                    Jangka Waktu</th>
                                                <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    width="15%">
                                                    Nilai Kontrak (Rp)</th>
                                            </tr>
                                            <tr class="collapse" id="collapse-{{ $no }}">
                                                <td class="text-secondary text-xs font-weight-bold">{{$dp->lokasi_realisasi_anggaran}}</td>
                                                <td class="text-secondary text-xs font-weight-bold">{{$dp->pelaksana}}</td>
                                                <td class="text-secondary text-xs font-weight-bold">{{$dp->nomor_kontrak}}</td>
                                                <td class="text-secondary text-xs font-weight-bold">{{$dp->jangka_waktu}} Hari</td>
                                                <td class="text-secondary text-xs font-weight-bold">{{$dp->nilai_kontrak}}</td>
                                            </tr>
                                            @php
                                                $no++;
                                            @endphp
                                        @endforeach
                                    @endif

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
    </script>
@endpush
