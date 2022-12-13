@extends('layouts.admin')
@section('title', 'Detail Perencanaan Pembangunan')
@section('content')
    {{ navbar('Detail Perencanaan Pembangunan', 'Kegiatan | Perencanaan Pembangunan') }}

    <div class="container-fluid py-4">
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <h6 class="mx-4 my-4">Kegiatan | Perencanaan Pembangunan</h6>
                    <div class="container">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#data-umum"
                                        role="tab" aria-controls="profile" aria-selected="true">
                                        Data Umum
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1 {{ $data_umum == null ? 'disabled' : '' }}"
                                        data-bs-toggle="tab" href="#blanko" role="tab" aria-controls="dashboard"
                                        aria-selected="false">
                                        Blanko Monitoring
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            {{-- tab data umum --}}
                            <div class="tab-pane fade show active" id="data-umum" role="tabpanel"
                                aria-labelledby="data-umum-tab">
                                <form action="" method="post" id="formDataUmum">
                                    @csrf
                                    <input type="hidden" name="id"
                                        value="{{ $data_umum != null ? $data_umum->id : '' }}">
                                    <input type="hidden" name="detail_ket_sub_dpa_id" value="{{ $id_detail_ket_sub_dpa }}">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nama Pekerjaan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="pekerjaan"
                                                placeholder="Nama Pekerjaan" value="{{ $data_dpa->pekerjaan }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Sumber Dana</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="sumber_dana"
                                                placeholder="Sumber Dana" value="{{ $data_dpa->sumber_dana }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Tahun Anggaran</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="tahun_anggaran"
                                                placeholder="Tahun Anggaran" value="{{ $data_dpa->tahun }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nilai Kontrak</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="nilai_kontrak"
                                                id="nilai_kontrak" placeholder="Nilai Kontrak"
                                                value="{{ $data_umum != null ? $data_umum->nilai_kontrak : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Nomor Kontrak</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nomor_kontrak"
                                                id="nomor_kontrak" placeholder="Nomor Kontrak"
                                                value="{{ $data_umum != null ? $data_umum->nomor_kontrak : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Tanggal Kontrak</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="tanggal_kontrak"
                                                id="tanggal_kontrak" placeholder="Tanggal Kontrak"
                                                value="{{ $data_umum != null ? $data_umum->tanggal_kontrak : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Pejabat PPK</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="pejabat_ppk"
                                                id="pejabat_ppk" placeholder="Pejabat PPK"
                                                value="{{ $data_umum != null ? $data_umum->pejabat_ppk : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Pelaksana</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="pelaksana" id="pelaksana"
                                                placeholder="Pelaksana" value="{{ $data_umum != null ? $data_umum->pelaksana : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Lokasi Realisasi Anggaran</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="lokasi_realisasi_anggaran"
                                                id="lokasi_realisasi_anggaran" placeholder="Lokasi Realisasi Anggaran"
                                                value="{{ $data_umum != null ? $data_umum->lokasi_realisasi_anggaran : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Jangka Waktu</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="jangka_waktu"
                                                id="jangka_waktu" placeholder="Jangka Waktu"
                                                value="{{ $data_umum != null ? $data_umum->jangka_waktu : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Mulai Kerja</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="mulai_kerja"
                                                id="mulai_kerja" placeholder="Mulai Kerja"
                                                value="{{ $data_umum != null ? $data_umum->mulai_kerja : '' }}">
                                        </div>
                                    </div>
                                    {{-- <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Realisasi Pelaksanaan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="realisasi_pelaksanaan" placeholder="Realisasi Pelaksanaan">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Kendala / Hambatan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="kendala" placeholder="Kendala / Hambatan">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Tenaga Kerja</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="tenaga_kerja" placeholder="Tenaga Kerja">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Penerapan K3</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="penerapan_k3" placeholder="Penerapan K3">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Catatan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea name="catatan" id="catatan" cols="10" placeholder="Catatan" class="form-control"></textarea>
                                        </div>
                                    </div> --}}
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-save me-sm-2" aria-hidden="true"></i> Simpan Data
                                        </button>
                                    </div>
                                </form>
                            </div>
                            {{-- Tab blanko --}}
                            <div class="tab-pane fade" id="blanko" role="tabpanel" aria-labelledby="blanko-tab">
                                <div class="table-responsive">
                                    <form action="" method="post" id="formKomponen">
                                        @csrf
                                        <input type="hidden" name="rencana_pembangunan_id"
                                            value="{{ $data_umum != null ? $data_umum->id : '' }}">
                                        <table class="table align-items-center mb-0" cellspacing="0" width="100%"
                                            id="dataTable">
                                            <thead>
                                                <tr>
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
                                                {{-- $rencana_pembangunan->count() == 0 ||  --}}
                                                @if (count($rencana_pembangunan) == 0)
                                                    @if ($komponen->count() > 0)
                                                        @foreach ($komponen as $kpn)
                                                            <tr>
                                                                <td
                                                                    class="text-secondary text-sm {{ $kpn->parent == 0 ? 'fw-bold' : '' }}">
                                                                    {{ $kpn->komponen }}
                                                                    <input type="hidden" name="komponen[]"
                                                                        value="{{ $kpn->id }}">
                                                                </td>
                                                                <td class="text-secondary text-xs font-weight-bold">
                                                                    <div class="d-flex justify-content-center">
                                                                        <i class="fas fa-plus-circle mx-2 text-success"
                                                                            role="button" title="Tambah"
                                                                            onclick="addFormKomponenPembangunan(this,'{{ $kpn->id }}')"></i>
                                                                        <i class="fas fa-trash mx-2 text-danger"
                                                                            role="button" title="Hapus"
                                                                            onclick="deleteKomponenPembangunan(this)"></i>
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
                                                                            {{ $ch->komponen }}
                                                                            <input type="hidden" name="komponen[]"
                                                                                value="{{ $ch->id }}">
                                                                        </td>
                                                                        <td
                                                                            class="text-secondary text-xs font-weight-bold">
                                                                            <div class="d-flex justify-content-center">
                                                                                <i class="fas fa-trash mx-2 text-danger"
                                                                                    role="button" title="Hapus"
                                                                                    onclick="deleteKomponenPembangunan(this)"></i>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @else
                                                    @if ($rencana_pembangunan->count() > 0)
                                                        @foreach ($rencana_pembangunan as $kpn)
                                                            <tr>
                                                                <td
                                                                    class="text-secondary text-sm {{ $kpn->parent == 0 ? 'fw-bold' : '' }}">
                                                                    {{ $kpn->komponen }}
                                                                    <input type="hidden" name="komponen[]"
                                                                        value="{{ $kpn->komponen_pembangunan_id }}">
                                                                </td>
                                                                <td class="text-secondary text-xs font-weight-bold">
                                                                    <div class="d-flex justify-content-center">
                                                                        @if ($kpn->parent == 0)
                                                                            <i class="fas fa-plus-circle mx-2 text-success"
                                                                                role="button" title="Tambah"
                                                                                onclick="addFormKomponenPembangunan(this,'{{ $kpn->komponen_pembangunan_id }}')"></i>
                                                                            <i class="fas fa-trash mx-2 text-danger"
                                                                                role="button" title="Hapus"
                                                                                onclick="deleteKomponenPembangunan(this)"></i>
                                                                        @else
                                                                            <i class="fas fa-trash mx-2 text-danger"
                                                                                role="button" title="Hapus"
                                                                                onclick="deleteKomponenPembangunan(this)"></i>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endif


                                                <tr class="form-button-data">
                                                    <td></td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <i class="fas fa-plus-circle text-success" role="button"
                                                                title="Tambah"
                                                                onclick="addFormKomponenPembangunan(this, '0')"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="fas fa-save me-sm-2" aria-hidden="true"></i> Simpan Data
                                            </button>
                                        </div>
                                    </form>
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
        $(document).ready(function() {
            saveDataUmum();
            saveDataKomponen()
        });
        var tr = ``;

        function addFormKomponenPembangunan(data, parent) {
            $('.form-button-data').hide();

            let html = `
                <tr class="form-input-data">
                    <td>
                        <div class="row">
                            <div class="col-sm-1">
                                <i class="fas fa-window-close text-danger m-1" role="button" title="Batal" onclick="clearForm()"></i>
                            </div>
                            <div class="col-sm-11">
                                <input type="hidden" id="parent" name="parent" value="` + parent + `">
                                <input type="text" class="form-control form-control-sm" id="komponen" name="komponen" placeholder="Komponen pekerjaan">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-save text-center text-success" role="button" title="Save" onclick="createKomponenPembangunan(this)"></i>
                        </div>
                    </td>
                </tr>
                `;
            $(data).parents('tr').after(html);
        }

        function createKomponenPembangunan(datathis) {
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
                        let bold = `fw-bold`;
                        let tombol = `
                        <i class="fas fa-plus-circle mx-2 text-success"
                            role="button" title="Tambah"
                            onclick="addFormKomponenPembangunan(this,'` + data.latest_data.id + `')"></i>
                        <i class="fas fa-trash mx-2 text-danger"
                            role="button" title="Hapus"
                            onclick="deleteKomponenPembangunan(this)"></i>
                        `;
                        if (data.latest_data.parent != 0) {
                            bold = ``;
                            tombol = `<i class="fas fa-trash mx-2 text-danger"
                            role="button" title="Hapus"
                            onclick="deleteKomponenPembangunan(this)"></i>`;
                        }
                        let html = `
                        <tr>
                            <td
                                class="text-secondary text-xs ` + bold + `">
                                ` + data.latest_data.komponen + `
                                <input type="hidden" name="komponen[]"
                                    value="` + data.latest_data.id + `">
                            </td>
                            <td class="text-secondary text-xs font-weight-bold">
                                <div class="d-flex justify-content-center">
                                    ` + tombol + `
                                </div>
                            </td>
                        </tr>
                        `;
                        let selector = $(datathis).parents('tr');
                        if (data.latest_data.parent == 0) {
                            selector.prev().before(html);
                        } else {
                            selector.before(html);
                        }
                        selector.remove();
                        $('.form-button-data').show();
                        Swal.fire({
                            icon: 'success',
                            text: 'Data telah disimpan',
                            title: 'Berhasil',
                            toast: true,
                            position: 'top-end',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error adding / update data");
                },
            });
        }

        function deleteKomponenPembangunan(data) {
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Anda tidak ingin menggunakan item ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#084594",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus ini!",
                cancelButtonText: "Kembali"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(data).parents('tr').remove();
                }
            });
        }

        function clearForm() {
            $('.form-input-data').empty();
            $('.form-button-data').show();
            tr.show();
        }

        function saveDataUmum() {
            $("#formDataUmum").submit(function(e) {
                e.preventDefault();
                const form = $(this)[0];
                const data = new FormData(form);
                $.ajax({
                    url: "{{ $data_umum == null ? url('/dashboard/perencanaan_pembangunan/insert_data_umum') : url('/dashboard/perencanaan_pembangunan/update_data_umum') }}",
                    method: 'post',
                    data: data,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                text: 'Data telah disimpan',
                                title: 'Berhasil',
                                toast: true,
                                position: 'top-end',
                                timer: 1800,
                                showConfirmButton: false,
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    }
                });
            });
        }

        function saveDataKomponen() {
            $("#formKomponen").submit(function(e) {
                e.preventDefault();
                const form = $(this)[0];
                const data = new FormData(form);
                $.ajax({
                    url: "{{ count($rencana_pembangunan) == 0 ? url('/dashboard/perencanaan_pembangunan/insert_blanko') : url('/dashboard/perencanaan_pembangunan/update_blanko') }}",
                    method: 'post',
                    data: data,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                text: 'Data telah disimpan',
                                title: 'Berhasil',
                                toast: true,
                                position: 'top-end',
                                timer: 1800,
                                showConfirmButton: false,
                            });
                        }
                    }
                });
            });
        }
    </script>
@endpush
