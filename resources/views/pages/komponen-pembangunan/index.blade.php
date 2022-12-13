@extends('layouts.admin')


@section('title', 'Komponen Pembangunan')
@section('content')
    {{ navbar('Komponen Pembangunan', 'List Komponen Pembangunan') }}

    <div class="container-fluid py-4">
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <h6 class="mx-4 my-4">Komponen Pembangunan</h6>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" cellspacing="0" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <th
                                            class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Komponen</th>
                                        <th
                                            class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @if ($komponen->count() > 0)
                                        @foreach ($komponen as $kpn)
                                            <tr>
                                                <td class="text-secondary text-sm {{ $kpn->parent == 0 ? 'fw-bold' : '' }}">
                                                    {{ $no++ }}</td>
                                                <td class="text-secondary text-sm {{ $kpn->parent == 0 ? 'fw-bold' : '' }}">
                                                    <span class="wrap_longtext">{{ $kpn->komponen }}</span>
                                                </td>
                                                <td class="text-secondary text-xs font-weight-bold">
                                                    <div class="d-flex justify-content-center">
                                                        <i class="fas fa-plus-circle mx-2 text-success" role="button"
                                                            title="Tambah"
                                                            onclick="addFormKomponenPembangunan(this,'{{ $kpn->id }}')"></i>
                                                        <i class="fas fa-edit mx-2 text-info" role="button"
                                                            title="Edit Pekerjaan"
                                                            onclick="editFormKomponenPembangunan('{{ $kpn->id }}', this)"></i>
                                                        <i class="fas fa-trash mx-2 text-danger" role="button"
                                                            title="Hapus"
                                                            onclick="deleteKomponenPembangunan('{{ $kpn->id }}')"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $child = DB::table('komponen_pembangunan')
                                                    ->where('parent', $kpn->id)
                                                    ->get();
                                            @endphp
                                            @if ($child->count() > 0)
                                                @foreach ($child as $ch)
                                                    <tr>
                                                        <td
                                                            class="text-secondary text-xs {{ $ch->parent == 0 ? 'fw-bold' : '' }}">
                                                            {{ $no++ }}</td>
                                                        <td
                                                            class="text-secondary text-xs {{ $ch->parent == 0 ? 'fw-bold' : '' }}">
                                                            <span class="wrap_longtext">{{ $ch->komponen }}</span>
                                                        </td>
                                                        <td class="text-secondary text-xs font-weight-bold">
                                                            <div class="d-flex justify-content-center">
                                                                <i class="fas fa-edit mx-2 text-info" role="button"
                                                                    title="Edit Pekerjaan"
                                                                    onclick="editFormKomponenPembangunan('{{ $ch->id }}', this)"></i>
                                                                <i class="fas fa-trash mx-2 text-danger" role="button"
                                                                    title="Hapus"
                                                                    onclick="deleteKomponenPembangunan('{{ $ch->id }}')"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif

                                    <tr class="form-button-data">
                                        <td colspan="2"></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <i class="fas fa-plus-circle text-success" role="button" title="Tambah"
                                                    onclick="addFormKomponenPembangunan(this, '0')"></i>
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
        var tr = ``;

        function addFormKomponenPembangunan(data, parent) {
            $('.form-button-data').hide();

            let html = `
                <tr class="form-input-data">
                    <td>
                        <span class="d-none">1000</span><i class="fas fa-window-close text-danger m-1" role="button" title="Batal" onclick="clearForm()"></i>
                    </td>
                    <td>
                        <input type="hidden" id="parent" name="parent" value="` + parent + `">
                        <input type="text" class="form-control form-control-sm" id="komponen" name="komponen" placeholder="Komponen pekerjaan">
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-save text-center text-success" role="button" title="Save" onclick="createKomponenPembangunan(event)"></i>
                        </div>
                    </td>
                </tr>
                `;
            $(data).parents('tr').after(html);
        }

        function createKomponenPembangunan(e) {
            e.preventDefault();
            let parent = $('#parent').val();
            let komponen = $('#komponen').val();
            $.ajax({
                url: '{{ route('komponen.pembangunan.p_tambah') }}',
                type: "POST",
                data: {
                    parent: parent,
                    komponen: komponen,
                    _token: '{{ csrf_token() }}'
                },
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
                        }).then((result) => {
                            window.location.reload();
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error adding / update data");
                },
            });
        }

        function editFormKomponenPembangunan(id, datathis) {
            tr = $(datathis).parents('tr').hide();
            $.ajax({
                url: '{{ route('komponen.pembangunan.form_edit') }}',
                type: "POST",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.status == 'success') {
                        $('.form-button-data').hide();
                        $(datathis).parents('tr').after(data.html);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error adding / update data");
                },
            });
        }

        function updateKomponenPembangunan(id, e) {
            e.preventDefault();
            let komponen = $('#komponen').val();
            $.ajax({
                url: '{{ route('komponen.pembangunan.p_edit') }}',
                type: "POST",
                data: {
                    id: id,
                    komponen: komponen,
                    _token: '{{ csrf_token() }}'
                },
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
                        }).then((result) => {
                            window.location.reload();
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error adding / update data");
                },
            });
        }

        function deleteKomponenPembangunan(id) {
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#084594",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus ini!",
                cancelButtonText: "Kembali"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('komponen.pembangunan.hapus') }}',
                        type: "POST",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status = 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Data telah dihapus',
                                    title: 'Berhasil',
                                    toast: true,
                                    position: 'top-end',
                                    timer: 3000,
                                    showConfirmButton: false,
                                }).then((result) => {
                                    window.location.reload();
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert("Error get data from ajax");
                        },
                    });
                }
            });
        }

        function clearForm() {
            $('.form-input-data').empty();
            $('.form-button-data').show();
            tr.show();
        }
    </script>

@endpush
