@extends('layouts.admin')


@section('title', 'Perencanaan Pembangunan')
@section('content')
    {{ navbar('Perencanaan Pembangunan', 'List Perencanaan Pembangunan') }}

    <div class="container-fluid py-4">
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <h6 class="mx-4 my-4">Kegiatan | Perencanaan Pembangunan</h6>
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
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="25%">
                                            Anggaran (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($dpa->count() > 0)
                                        @foreach ($dpa as $dp)
                                            @php
                                                $program = DB::table('program')
                                                    ->select('id', 'kode as kode_program', 'nomenklatur as nama_program')
                                                    ->where('id', $dp->program_id)
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
                                                        <td class="text-primary text-sm">[0]</td>
                                                    </tr>
                                                    @php
                                                        $kegiatan = DB::table('kegiatan')
                                                            ->select('id', 'kode as kode_kegiatan', 'nomenklatur as nama_kegiatan')
                                                            ->where('id', $dp->kegiatan_id)
                                                            ->get();
                                                    @endphp
                                                    @if ($kegiatan->count() > 0)
                                                        @foreach ($kegiatan as $kg)
                                                            <tr class="cursor-pointer k"
                                                                onclick="collapseNomenklatur(this)">
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
                                                                <td class="text-primary text-sm">[0]</td>
                                                            </tr>
                                                            @if ($dp->dpa_id != null)
                                                                @php
                                                                    $sub_kegiatan = DB::table('sub_dpa')
                                                                        ->join('sub_kegiatan', 'sub_kegiatan.id', '=', 'sub_dpa.sub_kegiatan_id')
                                                                        ->select('sub_dpa.id as sub_dpa_id', 'sub_kegiatan.id', 'kode as kode_sub_kegiatan', 'nomenklatur as nama_sub_kegiatan')
                                                                        ->where('dpa_id', $dp->dpa_id)
                                                                        ->get();
                                                                @endphp
                                                                @foreach ($sub_kegiatan as $sk)
                                                                    <tr class="cursor-pointer collapse"
                                                                        onclick="collapseNomenklatur(this)">
                                                                        <td class="text-secondary text-sm">
                                                                            <i class="fas fa-plus-circle text-success"
                                                                                role="button" title="Tambah"></i>
                                                                        </td>
                                                                        <td class="text-secondary text-sm"
                                                                            style="white-space:normal;">
                                                                            <div class="row">
                                                                                <div class="col-sm-2"></div>
                                                                                <div class="col-sm-10">
                                                                                    {{ $sk->kode_sub_kegiatan . ' | ' . $sk->nama_sub_kegiatan }}
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-primary text-sm">
                                                                            {{ $dp->total_anggaran == null ? '0,00' : $dp->total_anggaran }}
                                                                        </td>
                                                                    </tr>
                                                                    {{-- @if ($sub_kegiatan->count() > 0)
                                                                        @php
                                                                            $rekening = DB::table('ket_sub_dpa')
                                                                                ->join('detail_ket_sub_dpa', 'detail_ket_sub_dpa.ket_sub_dpa_id', '=', 'ket_sub_dpa.id')
                                                                                ->join('sub_rincian_objek_rekening', 'sub_rincian_objek_rekening.id', '=', 'detail_ket_sub_dpa.sub_rincian_objek')
                                                                                ->select('detail_ket_sub_dpa.id', 'kode', 'uraian_akun')
                                                                                ->where('sub_dpa_id', $sk->sub_dpa_id)
                                                                                ->get();
                                                                        @endphp
                                                                        @foreach ($rekening as $r)
                                                                            <tr class="cursor-pointer collapse"
                                                                                onclick="detailRencanaPembangunan('{{encrypsi($dp->dpa_id)}}', '{{encrypsi($dp->detail_ket_sub_dpa_id)}}')">
                                                                                <td class="text-secondary text-sm">
                                                                                    <i class="fas fa-plus-circle text-success"
                                                                                        role="button" title="Tambah"></i>
                                                                                </td>
                                                                                <td class="text-secondary text-sm"
                                                                                    style="white-space:normal;">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-2"></div>
                                                                                        <div class="col-sm-10">
                                                                                            {{ $r->kode . ' | ' . $r->uraian_akun }}
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="text-primary text-sm">
                                                                                    {{ $dp->total_anggaran == null ? '0,00' : $dp->total_anggaran }}
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif --}}
                                                                @endforeach
                                                            @else
                                                                <tr class="cursor-pointer collapse">
                                                                    <td colspan="3">
                                                                        <div class="row">
                                                                            <div class="col-sm-2"></div>
                                                                            <div class="col-sm-10">
                                                                                Pekerjaan belum di tambahkan
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
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

        function detailRencanaPembangunan(id_dpa, id_detail_ket_sub_dpa) {
            window.location.href = "/dashboard/perencanaan_pembangunan/detail/" + id_dpa + "/" + id_detail_ket_sub_dpa;
        }
    </script>
@endpush
