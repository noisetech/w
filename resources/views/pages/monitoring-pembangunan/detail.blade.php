@extends('layouts.admin')
@section('title', 'Detail Monitoring Pembangunan')
@section('content')
    {{ navbar('Detail Monitoring Pembangunan', 'Kegiatan | Monitoring Pembangunan') }}

    <div class="container-fluid py-4">
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <h6 class="mx-4 my-4">Kegiatan | Monitoring Pembangunan</h6>
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
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1 {{ $data_umum == null ? 'disabled' : '' }}"
                                        data-bs-toggle="tab" href="#dokumentasi" role="tab" aria-controls="dashboard"
                                        aria-selected="false">
                                        Dokumentasi
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
                                            <label class="col-form-label">Pelaksana</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="pelaksana"
                                                placeholder="Pelaksana" value="{{ $data_dpa->dinas }}" readonly>
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
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Progress Pelaksanaan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="progress_pelaksanaan"
                                                placeholder="Progress Pelaksanaan" name="progress_pelaksanaan"
                                                value="{{ $data_umum != null ? $data_umum->progress_pelaksanaan : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Rencana Pelaksanaan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="rencana_pelaksanaan"
                                                placeholder="Rencana Pelaksanaan" name="rencana_pelaksanaan"
                                                value="{{ $data_umum != null ? $data_umum->rencana_pelaksanaan : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Realisasi Pelaksanaan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="realisasi_pelaksanaan"
                                                placeholder="Realisasi Pelaksanaan" name="realisasi_pelaksanaan"
                                                value="{{ $data_umum != null ? $data_umum->realisasi_pelaksanaan : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Deviasi Pelaksanaan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="deviasi_pelaksanaan"
                                                placeholder="Deviasi Pelaksanaan" name="deviasi_pelaksanaan"
                                                value="{{ $data_umum != null ? $data_umum->deviasi_pelaksanaan : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Kendala / Hambatan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="kendala"
                                                placeholder="Kendala / Hambatan" name="kendala_hambatan"
                                                value="{{ $data_umum != null ? $data_umum->kendala_hambatan : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Tenaga Kerja</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="tenaga_kerja"
                                                placeholder="Tenaga Kerja" name="tenaga_kerja"
                                                value="{{ $data_umum != null ? $data_umum->tenaga_kerja : '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Penerapan K3</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="penerapan_k3" id="penerapan_k3" class="form-control">
                                                <option value="ya" {{ ($data_umum != null && isset($data_umum->penerapan_k3) && $data_umum->penerapan_k3 == 'ya') ? 'selected' : '' }}>Ya
                                                </option>
                                                <option value="tidak" {{ ($data_umum != null && isset($data_umum->penerapan_k3) && $data_umum->penerapan_k3 == 'tidak') ? 'selected' : '' }}>Tidak
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">Catatan</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea name="catatan" id="catatan" cols="10" placeholder="Catatan" class="form-control" name="catatan">{{ $data_umum != null ? $data_umum->catatan : '' }}</textarea>
                                        </div>
                                    </div>
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
                                                        class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Volume</th>
                                                    <th
                                                        class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Satuan</th>
                                                    <th
                                                        class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Harga</th>
                                                    <th
                                                        class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Persentase (%)</th>
                                                    <th
                                                        class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Riil</th>
                                                    <th
                                                        class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($rencana_pembangunan->count() > 0)
                                                    @foreach ($rencana_pembangunan as $kpn)
                                                        <tr>
                                                            <td
                                                                class="text-secondary text-sm {{ $kpn->parent == 0 ? 'fw-bold' : '' }}">
                                                                <span class="wrap_longtext">{{ $kpn->komponen }}</span>
                                                                <input type="hidden" name="id[]"
                                                                    value="{{ $kpn->id }}">
                                                                <input type="hidden" name="komponen[]"
                                                                    value="{{ $kpn->komponen_pembangunan_id }}">
                                                            </td>
                                                            <td class="text-secondary text-sm">
                                                                <input type="number" name="volume[]" id="volume"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $kpn->volume }}">
                                                            </td>
                                                            <td class="text-secondary text-sm">
                                                                <input type="text" name="satuan[]" id="satuan"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $kpn->satuan }}">
                                                            </td>
                                                            <td class="text-secondary text-sm">
                                                                <input type="number" name="harga[]" id="harga"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $kpn->harga }}">
                                                            </td>
                                                            <td class="text-secondary text-sm">
                                                                <input type="number" name="persentase[]" id="persentase"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $kpn->persentase }}">
                                                            </td>
                                                            <td class="text-secondary text-sm">
                                                                <select name="riil[]" id="riil"
                                                                    class="form-control form-control-sm">
                                                                    <option value="belum"
                                                                        {{ $kpn->riil == 'belum' ? 'selected' : '' }}>
                                                                        Belum</option>
                                                                    <option value="sudah"
                                                                        {{ $kpn->riil == 'sudah' ? 'selected' : '' }}>
                                                                        Sudah</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-secondary text-sm">
                                                                <input type="text" name="keterangan[]" id="keterangan"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $kpn->keterangan }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif

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
                            {{-- Dokumentasi --}}
                            <div class="tab-pane fade" id="dokumentasi" role="tabpanel"
                                aria-labelledby="dokumentasi-tab">
                                <div class="d-flex justify-content-between">
                                    <h6>Dokumentasi Pekerjaan</h6>
                                    <a class="btn btn-sm btn-success" data-bs-toggle="collapse"
                                        href="#collapseFormDocumentasi" role="button" aria-expanded="false"
                                        aria-controls="collapseFormDocumentasi">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                                <div class="collapse my-4" id="collapseFormDocumentasi">
                                    <div class="card card-body">
                                        <form action="" method="post" id="formDokumentasi"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-12">
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <label class="col-form-label">Sub Kegiatan</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="sub_kegiatan"
                                                                placeholder="Sub Kegiatan"
                                                                value="{{ $data_dpa->pekerjaan }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <label class="col-form-label">Lokasi</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="lokasi"
                                                                placeholder="Lokasi"
                                                                value="{{ $data_umum->lokasi_realisasi_anggaran }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <label class="col-form-label">Tahun nggaran</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="lokasi"
                                                                placeholder="Tahun nggaran"
                                                                value="{{ $data_dpa->tahun }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <label class="col-form-label">Pekerjaan</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <select name="det_rencana_pembangunan"
                                                                id="det_rencana_pembangunan"
                                                                class="form-control det_rencana_pembangunan">
                                                                <option value="">Pilih</option>
                                                                @if (count($rencana_pembangunan) > 0)
                                                                    @foreach ($rencana_pembangunan as $rp)
                                                                        @if ($rp->parent == 0 && $rp->det_rencana_pembangunan == null)
                                                                            <option value="{{ $rp->id }}">
                                                                                {{ $rp->komponen }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <label class="col-form-label">Kondisi (%)</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="progress-wrapper">
                                                                <div class="progress-info">
                                                                    <div class="progress-percentage">
                                                                        <span
                                                                            class="text-sm font-weight-bold show-persen">0%</span>
                                                                    </div>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-gradient-primary show-progress"
                                                                        role="progressbar" aria-valuenow="0"
                                                                        aria-valuemin="0" aria-valuemax="100"
                                                                        style="width: 0%;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <label class="col-form-label">Dokumentasi</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <input type="file" class="form-control dokumentasi"
                                                                name="dokumentasi" placeholder="Dokumentasi"
                                                                accept="image/*">
                                                            <small class="text-info">Maksimal Gambar 235x265px dengan Size
                                                                Max 4MB</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header p-0 mx-3 position-relative z-index-1">
                                                            <a href="javascript:;" class="d-block">
                                                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/curved-images/curved14.jpg"
                                                                    class="img-fluid border-radius-lg show-image">
                                                            </a>
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="card-text mb-2 text-center">Preview of Dokumentasi
                                                                Selected
                                                        </div>
                                                    </div>
                                                    <button type="button"
                                            class="btn btn-danger btn-lg w-100 mt-4" onclick="batalCreate()">Batal</button>
                                                    <button type="submit"
                                                        class="btn btn-primary btn-lg w-100 mt-4">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="my-4" id="collapseFormEditDocumentasi"></div>
                                <div class="row block-list-dokumentasi">
                                    @if (count($dokumentasi_pembangunan) > 0)
                                        @foreach ($dokumentasi_pembangunan as $rp)
                                            @if ($rp->parent == 0)
                                                <div class="col-lg-4 col-md-4 col-sm-12 mt-4">
                                                    <div class="card">
                                                        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                                            <a href="{{ asset('dokumentasi-pembangunan/' . $rp->dokumentasi) }}"
                                                                target="_blank" class="dokumentasi-href-{{$rp->dokumentasi_id}}">
                                                                <img src="{{ asset('dokumentasi-pembangunan/' . $rp->dokumentasi) }}"
                                                                    class="border-radius-lg dokumentasi-{{$rp->dokumentasi_id}}" width="100%"
                                                                    height="251px">
                                                            </a>
                                                        </div>

                                                        <div class="card-body pt-2">
                                                            <span
                                                                class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">{{ $data_dpa->pekerjaan }}</span>
                                                            <a href="javascript:;"
                                                                class="card-title h5 d-block text-darker">
                                                                {{ $rp->komponen }}
                                                            </a>
                                                            <h1 class="card-description text-center my-4">
                                                                {{ $rp->persentase }}%
                                                            </h1>
                                                            <div class="author align-items-center">
                                                                <div class="avatar shadow"
                                                                    style="color: black !important">
                                                                    <i class="fas fa-map-marked-alt fa-lg"></i>
                                                                </div>
                                                                <div class="name ps-3">
                                                                    <span>Lokasi :
                                                                        {{ $data_umum->lokasi_realisasi_anggaran }}</span>
                                                                    <div class="stats">
                                                                        <small>Tahun Anggaran :
                                                                            {{ $data_dpa->tahun }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <span class="badge badge-danger m-2 cursor-pointer"
                                                                style="color:#17c1e8;" onclick="editDokumentasi('{{ $rp->dokumentasi_id }}', event, this)"><i class="fas fa-edit"></i></span>
                                                            <span class="badge badge-danger m-2 cursor-pointer"
                                                                style="color:#ea0606;"
                                                                onclick="deleteDokumentasi('{{ $rp->dokumentasi_id }}', event, this)"><i
                                                                    class="fas fa-trash"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
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
            saveDataKomponen();
            saveDataDokumentasi();
            updateDataDokumentasi();

            $('.det_rencana_pembangunan').change(function() {
                $.ajax({
                    url: "{{ url('/dashboard/monitoring/pembangunan/get_kondisi') }}",
                    method: 'post',
                    data: {
                        id: $(this).val(),
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            $('.show-persen').html(data.data + '%');
                            $('.show-progress').attr('aria-valuenow', data.data);
                            $('.show-progress').css('width', data.data + '%');
                        }
                    }
                });
            });
        });

        function saveDataUmum() {
            $("#formDataUmum").submit(function(e) {
                e.preventDefault();
                const form = $(this)[0];
                const data = new FormData(form);
                $.ajax({
                    url: "{{ url('/dashboard/monitoring/pembangunan/update_data_umum') }}",
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
                    url: "{{ url('/dashboard/monitoring/pembangunan/update_blanko') }}",
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

        function saveDataDokumentasi() {
            $("#formDokumentasi").submit(function(e) {
                e.preventDefault();
                if ($('.det_rencana_pembangunan').val() == '' || $(".dokumentasi").val() == '') {
                    Swal.fire({
                        icon: 'error',
                        text: 'Form Pekerjaan dan dokumentasi tidak boleh kosong!',
                        title: 'Oppss',
                        toast: true,
                        position: 'top-end',
                        timer: 1800,
                        showConfirmButton: false,
                    });
                } else {
                    const form = $(this)[0];
                    const data = new FormData(form);
                    $.ajax({
                        url: "{{ url('/dashboard/monitoring/pembangunan/create_dokumentasi') }}",
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

                                addCard(data.id);

                                $('#formDokumentasi')[0].reset();
                                $('.show-persen').html(0 + '%');
                                $('.show-progress').attr('aria-valuenow', 0);
                                $('.show-progress').css('width', 0 + '%');
                                $('#collapseFormDocumentasi').collapse('hide');
                            }
                        }
                    });
                }
            });
        }

        function updateDataDokumentasi() {
            $(document).on('submit', '#formEditDokumentasi', function(e) {
                e.preventDefault();
                if ($("#formEditDokumentasi .dokumentasi").val() == '') {
                    Swal.fire({
                        icon: 'error',
                        text: 'Form Pekerjaan dan dokumentasi tidak boleh kosong!',
                        title: 'Oppss',
                        toast: true,
                        position: 'top-end',
                        timer: 1800,
                        showConfirmButton: false,
                    });
                } else {
                    const form = $(this)[0];
                    const data = new FormData(form);
                    $.ajax({
                        url: "{{ url('/dashboard/monitoring/pembangunan/update_dokumentasi') }}",
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
                                let link = "{{ asset('dokumentasi-pembangunan') }}" + '/' + data.dokumentasi;
                                $('.dokumentasi-href-' + data.dokumentasi_id).attr('href', link);
                                $('.dokumentasi-' + data.dokumentasi_id).attr('src', link);

                                batalEdit();
                            }
                        }
                    });
                }
            });
        }

        function batalCreate() {
            $('#formDokumentasi')[0].reset();
            $('.show-persen').html(0 + '%');
            $('.show-progress').attr('aria-valuenow', 0);
            $('.show-progress').css('width', 0 + '%');
            $('#collapseFormDocumentasi').collapse('hide');
        }

        function batalEdit() {
            $('#collapseFormEditDocumentasi').empty();
        }

        function deleteDokumentasi(id, e, data) {
            e.preventDefault();
            Swal.fire({
                title: 'Anda ingin menghapus data?',
                text: "Data telah dihapus tidak bisa di kembalikan!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('monitoring.pembangunan.delete_dokumentasi') }}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res, status) {
                            if (status = '200') {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Data telah dihapus',
                                    title: 'Berhasil',
                                    toast: true,
                                    position: 'top-end',
                                    timer: 3000,
                                    showConfirmButton: false,
                                });
                                $(data).parent().prev().prev().parent().parent().remove();
                            }
                        },
                    })
                }
            })
        }

        function addCard(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('monitoring.pembangunan.find_dokumentasi') }}",
                data: {
                    id: id,
                    id_dpa: "{{ Request::segment(5) }}",
                    id_detail_ket_sub_dpa: "{{ Request::segment(6) }}",
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.status = 'success') {
                        $('.block-list-dokumentasi').append(`
                            <div class="col-lg-4 col-md-4 col-sm-12 mt-4">
                                <div class="card">
                                    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                        <a href="{{ asset('dokumentasi-pembangunan') }} ` + '/' + data
                            .data_dokumentasi.dokumentasi + `"
                                            target="_blank">
                                            <img src="{{ asset('dokumentasi-pembangunan') }}` + '/' + data
                            .data_dokumentasi.dokumentasi +
                            `"
                                                class="border-radius-lg" width="100%"
                                                height="251px">
                                        </a>
                                    </div>

                                    <div class="card-body pt-2">
                                        <span
                                            class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">` +
                            data.data_dpa
                            .pekerjaan + `</span>
                                        <a href="javascript:;"
                                            class="card-title h5 d-block text-darker">
                                            ` + data.data_dokumentasi.komponen + `
                                        </a>
                                        <h1 class="card-description text-center my-4">
                                            ` + data.data_dokumentasi.persentase + `%
                                        </h1>
                                        <div class="author align-items-center">
                                            <div class="avatar shadow"
                                                style="color: black !important">
                                                <i class="fas fa-map-marked-alt fa-lg"></i>
                                            </div>
                                            <div class="name ps-3">
                                                <span>Lokasi :
                                                    ` + data.data_umum.lokasi_realisasi_anggaran + `</span>
                                                <div class="stats">
                                                    <small>Tahun Anggaran :
                                                        ` + data.data_dpa.tahun + `</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <span class="badge badge-danger m-2 cursor-pointer"
                                            style="color:#17c1e8;" onclick="editDokumentasi('` + data.data_dokumentasi.dokumentasi_id + `', event, this)"><i class="fas fa-edit"></i></span>
                                        <span class="badge badge-danger m-2 cursor-pointer"
                                            style="color:#ea0606;"
                                            onclick="deleteDokumentasi('` + data.data_dokumentasi.dokumentasi_id + `', event, this)"><i
                                                class="fas fa-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                },
            });
        }

        function editDokumentasi(id, e, data) {
            e.preventDefault();
            batalCreate();
            $.ajax({
                type: "POST",
                url: "{{ route('monitoring.pembangunan.find_dokumentasi') }}",
                data: {
                    id: id,
                    id_dpa: "{{ Request::segment(5) }}",
                    id_detail_ket_sub_dpa: "{{ Request::segment(6) }}",
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.status = 'success') {
                        console.log(data);
                        $('#collapseFormEditDocumentasi').html(`
                        <div class="card card-body">
                            <form action="" method="post" id="formEditDokumentasi"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="` + data.data_dokumentasi.dokumentasi_id + `">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Sub Kegiatan</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="sub_kegiatan"
                                                    placeholder="Sub Kegiatan"
                                                    value="`+data.data_dpa.pekerjaan+`" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Lokasi</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="lokasi"
                                                    placeholder="Lokasi"
                                                    value="`+data.data_umum.lokasi_realisasi_anggaran+`"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Tahun nggaran</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="lokasi"
                                                    placeholder="Tahun nggaran"
                                                    value="`+data.data_dpa.tahun+`" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Pekerjaan</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="det_rencana_pembangunan" id="det_rencana_pembangunan" value="`+data.data_dokumentasi.id+`">
                                                <input class="form-control" value="`+data.data_dokumentasi.komponen+`" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Kondisi (%)</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="progress-wrapper">
                                                    <div class="progress-info">
                                                        <div class="progress-percentage">
                                                            <span
                                                                class="text-sm font-weight-bold show-persen">`+data.data_dokumentasi.persentase+`%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-primary show-progress"
                                                            role="progressbar" aria-valuenow="`+data.data_dokumentasi.persentase+`"
                                                            aria-valuemin="0" aria-valuemax="100"
                                                            style="width: `+data.data_dokumentasi.persentase+`%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Dokumentasi</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control dokumentasi"
                                                    name="dokumentasi" placeholder="Dokumentasi"
                                                    accept="image/*">
                                                <small class="text-info">Maksimal Gambar 235x265px dengan Size
                                                    Max 4MB</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="card-header p-0 mx-3 position-relative z-index-1">
                                                <a href="javascript:;" class="d-block">
                                                    <img src="{{ asset('dokumentasi-pembangunan') }}` + '/' + data.data_dokumentasi.dokumentasi + `"
                                                        class="img-fluid border-radius-lg show-image">
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text mb-2 text-center">Preview of Dokumentasi
                                                    Selected
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-danger btn-lg w-100 mt-4" onclick="batalEdit()">Batal</button>
                                        <button type="submit"
                                            class="btn btn-primary btn-lg w-100 mt-4">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        `);
                        $('#collapseFormEditDocumentasi').show('fast');
                    }
                },
            });
        }

        function readURLLogo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(".show-image").attr("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on("change", ".dokumentasi", function(e) {
            readURLLogo(this);
        });
    </script>
@endpush
