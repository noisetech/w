@extends('layouts.admin')


@section('title', 'Perencanaan Pengambilan')
@section('content')
    {{ navbar('Perencanaan Pembangunan', 'List Perencanaan Pengambilan') }}

    <div class="container-fluid py-4">
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <h6 class="mx-4 my-4">Kegiatan | Perencanaan Pengambilan</h6>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" cellspacing="0" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="5%">
                                            #</th>
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="70%">
                                            Kode & Nomenklatur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($dpa->count() > 0)
                                        @foreach ($dpa as $dp)
                                            @php
                                                $program = DB::table('program')
                                                    ->select('id', 'kode as kode_program', 'nomenklatur as nama_program')
                                                    ->where('id', $dp->id_program)
                                                    ->get();
                                            @endphp

                                            @if ($program->count() > 0)
                                                @foreach ($program as $pr)
                                                    <tr class="cursor-pointer" onclick="collapseNomenklatur(this)">
                                                        <td class="text-secondary text-sm">
                                                            <i class="fas fa-plus-circle text-success" role="button"
                                                                title="Tambah"></i>
                                                        </td>
                                                        <td class="text-secondary text-sm">
                                                            {{ $pr->kode_program . ' | ' . $pr->nama_program }}</td>
                                                    </tr>
                                                    @php
                                                        $kegiatan = DB::table('kegiatan')
                                                            ->select('id', 'kode as kode_kegiatan', 'nomenklatur as nama_kegiatan')
                                                            ->where('id', $dp->kegiatan_id)
                                                            ->get();

                                                        // echo "<pre>";
                                                        //     var_dump($kegiatan)
                                                        //     die;;
                                                        // echo "</pre>";

                                                    @endphp

                                                    @if ($kegiatan->count() > 0)
                                                        @foreach ($kegiatan as $kg)
                                                            <tr class="cursor-pointer collapse"
                                                                onclick="detailRencanaPembangunan('{{ encrypsi($dp->dpa_id) }}')">
                                                                <td class="text-secondary text-sm">
                                                                    <i class="fas fa-plus-circle text-success"
                                                                        role="button" title="Tambah"></i>
                                                                </td>
                                                                <td class="text-secondary text-sm"
                                                                    style="white-space:normal;">
                                                                    <div class="row">
                                                                        <div class="col-sm-1"></div>
                                                                        <div class="col-sm-11">
                                                                            {{ $kg->kode_kegiatan . ' | ' . $kg->nama_kegiatan }}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
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

        function detailRencanaPembangunan(id_dpa) {
            window.location.href = "/dashboard/perencanaan_pengambilan/h_tambah/" + id_dpa;
        }
    </script>
@endpush
