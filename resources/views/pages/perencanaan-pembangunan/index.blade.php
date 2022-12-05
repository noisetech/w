@extends('layouts.admin')


@section('title', 'Perencanaan Pembangunan')
@section('content')
    {{ navbar('Perencanaan Pembangunan', 'List Perencanaan Pembangunan') }}

    <div class="container-fluid py-4">
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <h6 class="mx-4 my-4">Perencanaan Pembangunan</h6>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" cellspacing="0" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="5%">
                                            #</th>
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="60%">
                                            Kode & Nomenklatur</th>
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="25%">
                                            Anggaran (Rp)</th>
                                        <th class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center"
                                            width="10%">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-secondary text-sm">
                                            <i class="fas fa-plus-circle text-success" role="button" title="Tambah"
                                                onclick="collapseNomenklatur('#nomenklatur-1', this)"></i>
                                        </td>
                                        <td class="text-secondary text-sm">bhh jh hjb</td>
                                        <td class="text-secondary text-sm">67.900.00</td>
                                        <td class="text-secondary text-xs font-weight-bold">
                                            <div class="d-flex justify-content-center">
                                                <i class="fas fa-plus-circle mx-2 text-success" role="button"
                                                    title="Tambah"></i>
                                                <i class="fas fa-edit mx-2 text-info" role="button"
                                                    title="Edit Pekerjaan"></i>
                                                <i class="fas fa-trash mx-2 text-danger" role="button" title="Hapus"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="collapse" id="nomenklatur-1">
                                        <td class="text-secondary text-sm">
                                            <i class="fas fa-plus-circle text-success" role="button" title="Tambah" onclick="collapseNomenklatur('#nomenklatur-2', this)"></i>
                                        </td>
                                        <td class="text-secondary text-sm" style="white-space:normal;">
                                            <div class="row">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-11">
                                                    white-space:normal;gsjhbshgbdg jhbjhsf hjfbsjhf sfjhbsfshbf shjbsfsbfs
                                                    fsufbsuhf sjhfbsf ufsf
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-secondary text-sm">67.900.00</td>
                                        <td class="text-secondary text-xs font-weight-bold">
                                            <div class="d-flex justify-content-center">
                                                <i class="fas fa-plus-circle mx-2 text-success" role="button"
                                                    title="Tambah"></i>
                                                <i class="fas fa-edit mx-2 text-info" role="button"
                                                    title="Edit Pekerjaan"></i>
                                                <i class="fas fa-trash mx-2 text-danger" role="button" title="Hapus"></i>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="collapse" id="nomenklatur-2">
                                        <td class="text-secondary text-sm">
                                            <i class="fas fa-plus-circle text-success" role="button" title="Tambah" onclick="collapseNomenklatur('#nomenklatur-2', this)"></i>
                                        </td>
                                        <td class="text-secondary text-sm" style="white-space:normal;">
                                            <div class="row">
                                                <div class="col-sm-2"></div>
                                                <div class="col-sm-10">
                                                    white-space:normal;gsjhbshgbdg jhbjhsf hjfbsjhf sfjhbsfshbf shjbsfsbfs
                                                    fsufbsuhf sjhfbsf ufsf
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-secondary text-sm">67.900.00</td>
                                        <td class="text-secondary text-xs font-weight-bold">
                                            <div class="d-flex justify-content-center">
                                                <i class="fas fa-plus-circle mx-2 text-success" role="button"
                                                    title="Tambah"></i>
                                                <i class="fas fa-edit mx-2 text-info" role="button"
                                                    title="Edit Pekerjaan"></i>
                                                <i class="fas fa-trash mx-2 text-danger" role="button" title="Hapus"></i>
                                            </div>
                                        </td>
                                    </tr>
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

        function collapseNomenklatur(selector, data) {
            let check = $(selector).collapse('toggle');
            if ($(selector).hasClass('terbuka') == false) {
                $(data).removeClass('fas fa-plus-circle text-success');
                $(data).addClass('fas fa-minus-circle text-warning');
                $(selector).addClass('terbuka');
            }else{
                $(selector).removeClass('terbuka');
                $(data).removeClass('fas fa-minus-circle text-warning');
                $(data).addClass('fas fa-plus-circle text-success');
            }
        }
    </script>
@endpush
