@extends('layouts.admin')


@section('title', 'Realisasi')
@section('content')
    {{ navbar('Realisasi', 'List Sub Kegiatan') }}

    <div class="container-fluid py-4">


        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <h6 class="mx-4 mt-3">List Sub Kegiatan</h6>
                    <div class="card-body">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Sub Kegiatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sub_dpa as $sub_dpa)
                                            <tr>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0 px-3">
                                                        {{ $sub_dpa->sub_kegiatan_kode . ' ' . $sub_dpa->sub_kegiatan_nomenklatur }}
                                                    </p>
                                                </td>


                                                <td class="align-middle text-star text-sm">
                                                    <a
                                                        href="{{ route('perencaan_pengambilan.h_relaisasi', encrypsi($sub_dpa->sub_dpa_id)) }}">
                                                        <span class="badge badge-sm bg-dark">
                                                            Realisasi
                                                        </span></a>

                                                    {{-- <a
                                                        href="{{ route('perencaan_pengambilan.h_relaisasi', encrypsi($sub_dpa->sub_dpa_id)) }}">
                                                        <span class="badge badge-sm bg-info">
                                                            Detail
                                                        </span></a> --}}
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
