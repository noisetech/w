@extends('layouts.admin')
@section('title', 'Laporan Anggaran')
@section('content')
    {{ navbar('Laporan', 'Laporan Anggaran') }}




    <div class="container-fluid py-4">
        <div class="row my-2">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Table Laporan Anggaran</h6>

                            <span>Tahun 2022</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th rowspan="3" class="align-middle text-center">No</th>
                                        <th rowspan="3" class="align-middle text-center">Kegiatan</th>
                                        <th colspan="15" class="align-middle text-center">Anggaran</th>
                                        <th colspan="2" class="align-middle text-center">Capaian Kinerja</th>
                                        <th rowspan="3" class="align-middle text-center">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="align-middle text-center">Total</th>
                                        <th colspan="3" class="align-middle text-center">Belanja Operasi</th>
                                        <th colspan="3" class="align-middle text-center">Belanja Modal</th>
                                        <th colspan="3" class="align-middle text-center">Belanja Tidak Terduga</th>
                                        <th colspan="3" class="align-middle text-center">Belanja Transfer</th>
                                        <th colspan="2" class="align-middle text-center">%</th>
                                    </tr>
                                    <tr>
                                        <th>Anggaran</th>
                                        <th>Realisasi</th>
                                        <th>%</th>
                                        <th>Anggaran</th>
                                        <th>Realisasi</th>
                                        <th>%</th>
                                        <th>Anggaran</th>
                                        <th>Realisasi</th>
                                        <th>%</th>
                                        <th>Anggaran</th>
                                        <th>Realisasi</th>
                                        <th>%</th>
                                        <th>Anggaran</th>
                                        <th>Realisasi</th>
                                        <th>%</th>
                                        <th class="text-center">RENC</th>
                                        <th class="text-center">REAL</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($bahan_data as $bahan_data)
                                        <tr>
                                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center">{{ $bahan_data->sub_kegiatan_nomenklatur }}
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp


                                                    @php
                                                        $bahan_total_anggaran = DB::table('detail_ket_sub_dpa')
                                                            ->select(DB::raw('sum(jumlah_anggaran) as jumlah_anggaran'))
                                                            ->join('ket_sub_dpa', 'ket_sub_dpa.id', '=', 'detail_ket_sub_dpa.ket_sub_dpa_id')
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_total_anggaran as $bahan_total_anggaran)
                                                        {{ $bahan_total_anggaran->jumlah_anggaran }}
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @php
                                                            $bahan_rencana_pengambilan = DB::table('rencana_pengambilan')
                                                                ->select('pengambilan')
                                                                ->join('sub_dpa', 'sub_dpa.id', '=', 'rencana_pengambilan.sub_dpa_id')
                                                                ->get();
                                                        @endphp

                                                        @foreach ($bahan_rencana_pengambilan as $bahan_rencana_pengambilan)
                                                            {{ $bahan_rencana_pengambilan->pengambilan }}
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @php
                                                        $bahan_rencana_pengambilan = DB::table('rencana_pengambilan')
                                                            ->select('persentase')
                                                            ->join('sub_dpa', 'sub_dpa.id', '=', 'rencana_pengambilan.sub_dpa_id')
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_rencana_pengambilan as $bahan_rencana_pengambilan)
                                                        {{ $bahan_rencana_pengambilan->persentase }}
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @if (
                                                            $bahan_kedua->uraian_akun_kelompok_rekening == 'BELANJA OPERASI' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'Belanja Operasi' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'belanja operasi')
                                                            @if (!empty($bahan_kedua))
                                                                @php
                                                                    $bahan_total_anggaran = DB::table('detail_ket_sub_dpa')
                                                                        ->select(DB::raw('sum(jumlah_anggaran) as jumlah_anggaran'))
                                                                        ->join('ket_sub_dpa', 'ket_sub_dpa.id', '=', 'detail_ket_sub_dpa.ket_sub_dpa_id')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($bahan_total_anggaran as $bahan_total_anggaran)
                                                                    {{ $bahan_total_anggaran->jumlah_anggaran }}
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @if (
                                                            $bahan_kedua->uraian_akun_kelompok_rekening == 'BELANJA OPERASI' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'Belanja Operasi' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'belanja operasi')
                                                            @if (!empty($bahan_kedua))
                                                                @php
                                                                    $bahan_rencana_pengambilan = DB::table('rencana_pengambilan')
                                                                        ->select('pengambilan')
                                                                        ->join('sub_dpa', 'sub_dpa.id', '=', 'rencana_pengambilan.sub_dpa_id')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($bahan_rencana_pengambilan as $bahan_rencana_pengambilan)
                                                                    {{ $bahan_rencana_pengambilan->pengambilan }}
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @if (
                                                            $bahan_kedua->uraian_akun_kelompok_rekening == 'BELANJA OPERASI' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'Belanja Operasi' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'belanja operasi')
                                                            @if (!empty($bahan_kedua))
                                                                @php
                                                                    $bahan_rencana_pengambilan = DB::table('rencana_pengambilan')
                                                                        ->select('persentase')
                                                                        ->join('sub_dpa', 'sub_dpa.id', '=', 'rencana_pengambilan.sub_dpa_id')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($bahan_rencana_pengambilan as $bahan_rencana_pengambilan)
                                                                    {{ $bahan_rencana_pengambilan->persentase }}
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @if (
                                                            $bahan_kedua->uraian_akun_kelompok_rekening == 'BELANJA MODAL' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'Belanja Modal' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'belanja modal')
                                                            @if (!empty($bahan_kedua))
                                                                @php
                                                                    $bahan_total_anggaran = DB::table('detail_ket_sub_dpa')
                                                                        ->select(DB::raw('sum(jumlah_anggaran) as jumlah_anggaran'))
                                                                        ->join('ket_sub_dpa', 'ket_sub_dpa.id', '=', 'detail_ket_sub_dpa.ket_sub_dpa_id')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($bahan_total_anggaran as $bahan_total_anggaran)
                                                                    {{ $bahan_total_anggaran->jumlah_anggaran }}
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @if (
                                                            $bahan_kedua->uraian_akun_kelompok_rekening == 'BELANJA MODAL' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'Belanja Modal' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'belanja modal')
                                                            @if (!empty($bahan_kedua))
                                                                @php
                                                                    $bahan_rencana_pengambilan = DB::table('rencana_pengambilan')
                                                                        ->select('pengambilan')
                                                                        ->join('sub_dpa', 'sub_dpa.id', '=', 'rencana_pengambilan.sub_dpa_id')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($bahan_rencana_pengambilan as $bahan_rencana_pengambilan)
                                                                    {{ $bahan_rencana_pengambilan->pengambilan }}
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @if (
                                                            $bahan_kedua->uraian_akun_kelompok_rekening == 'BELANJA MODAL' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'Belanja Modal' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'belanja modal')
                                                            @if (!empty($bahan_kedua))
                                                                @php
                                                                    $bahan_rencana_pengambilan = DB::table('rencana_pengambilan')
                                                                        ->select('persentase')
                                                                        ->join('sub_dpa', 'sub_dpa.id', '=', 'rencana_pengambilan.sub_dpa_id')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($bahan_rencana_pengambilan as $bahan_rencana_pengambilan)
                                                                    {{ $bahan_rencana_pengambilan->persentase }}
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @if (
                                                            $bahan_kedua->uraian_akun_kelompok_rekening == 'BELANJA TIDAK TERDUGA' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'Belanja Tidak Terduga' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'belanja tidak terduga')
                                                            @if (!empty($bahan_kedua))
                                                                @php
                                                                    $bahan_total_anggaran = DB::table('detail_ket_sub_dpa')
                                                                        ->select(DB::raw('sum(jumlah_anggaran) as jumlah_anggaran'))
                                                                        ->join('ket_sub_dpa', 'ket_sub_dpa.id', '=', 'detail_ket_sub_dpa.ket_sub_dpa_id')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($bahan_total_anggaran as $bahan_total_anggaran)
                                                                    {{ $bahan_total_anggaran->jumlah_anggaran }}
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @if (
                                                            $bahan_kedua->uraian_akun_kelompok_rekening == 'BELANJA TIDAK TERDUGA' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'Belanja Tidak Terduga' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'belanja tidak terduga')
                                                            @if (!empty($bahan_kedua))
                                                                @php
                                                                    $bahan_rencana_pengambilan = DB::table('rencana_pengambilan')
                                                                        ->select('pengambilan')
                                                                        ->join('sub_dpa', 'sub_dpa.id', '=', 'rencana_pengambilan.sub_dpa_id')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($bahan_rencana_pengambilan as $bahan_rencana_pengambilan)
                                                                    {{ $bahan_rencana_pengambilan->pengambilan }}
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @if (
                                                            $bahan_kedua->uraian_akun_kelompok_rekening == 'BELANJA TIDAK TERDUGA' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'Belanja Tidak Terduga' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'belanja tidak terduga')
                                                            @if (!empty($bahan_kedua))
                                                                @php
                                                                    $bahan_rencana_pengambilan = DB::table('rencana_pengambilan')
                                                                        ->select('persentase')
                                                                        ->join('sub_dpa', 'sub_dpa.id', '=', 'rencana_pengambilan.sub_dpa_id')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($bahan_rencana_pengambilan as $bahan_rencana_pengambilan)
                                                                    {{ $bahan_rencana_pengambilan->persentase }}
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @if (
                                                            $bahan_kedua->uraian_akun_kelompok_rekening == 'BELANJA TRANSFER' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'Belanja Transafer' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'belanja transfer')
                                                            @if (!empty($bahan_kedua))
                                                                @php
                                                                    $bahan_total_anggaran = DB::table('detail_ket_sub_dpa')
                                                                        ->select(DB::raw('sum(jumlah_anggaran) as jumlah_anggaran'))
                                                                        ->join('ket_sub_dpa', 'ket_sub_dpa.id', '=', 'detail_ket_sub_dpa.ket_sub_dpa_id')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($bahan_total_anggaran as $bahan_total_anggaran)
                                                                    {{ $bahan_total_anggaran->jumlah_anggaran }}
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @if (
                                                            $bahan_kedua->uraian_akun_kelompok_rekening == 'BELANJA TRANSFER' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'Belanja Transfer' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'belanja transfer')
                                                            @if (!empty($bahan_kedua))
                                                                @php
                                                                    $bahan_rencana_pengambilan = DB::table('rencana_pengambilan')
                                                                        ->select('pengambilan')
                                                                        ->join('sub_dpa', 'sub_dpa.id', '=', 'rencana_pengambilan.sub_dpa_id')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($bahan_rencana_pengambilan as $bahan_rencana_pengambilan)
                                                                    {{ $bahan_rencana_pengambilan->pengambilan }}
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (!empty($bahan_data))
                                                    @php
                                                        $bahan_kedua = DB::table('sub_dpa')
                                                            ->select('sub_dpa.*', 'ket_sub_dpa.id as ket_sub_dpa_id', 'kelompok_rekening.uraian_akun as uraian_akun_kelompok_rekening')
                                                            ->join('ket_sub_dpa', 'sub_dpa.id', '=', 'ket_sub_dpa.sub_dpa_id')
                                                            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'ket_sub_dpa.kelompok')
                                                            ->where('sub_dpa.id', $bahan_data->sub_dpa_id)
                                                            ->get();
                                                    @endphp

                                                    @foreach ($bahan_kedua as $bahan_kedua)
                                                        @if (
                                                            $bahan_kedua->uraian_akun_kelompok_rekening == 'BELANJA TRANSFER' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'Belanja Transfer' ||
                                                                $bahan_kedua->uraian_akun_kelompok_rekening == 'belanja transfer')
                                                            @if (!empty($bahan_kedua))
                                                                @php
                                                                    $bahan_rencana_pengambilan = DB::table('rencana_pengambilan')
                                                                        ->select('persentase')
                                                                        ->join('sub_dpa', 'sub_dpa.id', '=', 'rencana_pengambilan.sub_dpa_id')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($bahan_rencana_pengambilan as $bahan_rencana_pengambilan)
                                                                    {{ $bahan_rencana_pengambilan->persentase }}
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">1500000</td>
                                            <td class="align-middle text-center">5%</td>
                                            <td class="align-middle text-center"></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-center">Jumlah Belanja Operasi</td>
                                        <td class="text-center">1500000</td>
                                        <td class="text-center">3000000</td>
                                        <td class="text-center">5%</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="text-center">Jumlah Belanja Modal</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="text-center">Jumlah Belanja Tidak Terdgua</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="text-center">Jumlah Belanja Transfer</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="text-center">Total</td>
                                        <td class="text-center">1500000</td>
                                        <td class="text-center">3000000</td>
                                        <td class="text-center">5%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    @endsection

    @push('script')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>
    @endpush
