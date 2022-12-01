@extends('layouts.admin')
@section('title', 'Objek Rekening')
@section('content')
    {{ navbar('Objek Rekening', 'List Objek Rekening') }}

    <div class="container-fluid py-4">
        <div class="row my-2">
            <div class="col-lg-3 col-md-3 col-sm-12 h-100">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="alert alert-dark">
                            <strong class="text-white">Akun Rekening</strong>
                        </div>
                        <div class="alert alert-dark">
                            <strong class="text-white">Kelompok
                                Rekening
                            </strong>
                        </div>

                        <div class="alert alert-dark">
                            <strong class="text-white">Jenis
                                Rekening
                            </strong>
                        </div>
                        <div class="alert alert-dark">
                            <strong class="text-white">Objek
                                Rekening</strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'rincian objek' ? 'dark' : 'light' }}">
                            <strong
                                class="text-{{ isset($active) && $active == 'rincian objek' ? 'white' : 'black' }}">Rincian
                                Objek Rekening</strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'sub rincian objek' ? 'dark' : 'light' }}">
                            <strong
                                class="text-{{ isset($active) && $active == 'sub rincian objek' ? 'white' : 'black' }}">Sub
                                Rincian Objek Rekening</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-sm-2">
                                <a href="javascript:;" onclick="getBack()" class="btn btn-sm btn-rounded btn-danger"><i
                                        class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>

                        <h6>Objek Rekening</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pb-0">
                            <table class="table align-items-center mb-0" cellspacing="0" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Uraian Akun</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Deskripsi Akun</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <a href="javascript:;" class="btn btn-sm btn-success btn-add">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="container">
                        <div id="form-create-show" style="display: none;">
                            <form action="#" method="post" id="form_create">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="jenis_rekening_id"
                                                value="{{ $jenis->id }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="Kode">Kode</label>
                                            <input type="text" class="form-control" name="kode" placeholder="Kode">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="uraian_akun">Uraian Akun</label>
                                            <input type="text" class="form-control" name="uraian_akun"
                                                placeholder="Uraian Akun">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="deskripsi_akun">Deskripsi Akun</label>
                                            <input type="text" class="form-control" name="deskripsi_akun"
                                                placeholder="Deskripsi Akun">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-danger btn-cancel"><i
                                                    class="fas fa-times"></i></button>
                                            <button type="submit" class="btn btn-sm btn-success btn-save mx-2"><i
                                                    class="fas fa-save"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="form-edit-show">

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
        $("#form_create").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('rekening.p_tambah_objek_rekening') }}',
                method: 'post',
                data: fd,
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
                        $('#form_create')[0].reset();
                        $('#dataTable').DataTable().ajax.reload();

                    }
                }
            });
        });

        $(document).on('submit', '#form_edit', function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('rekening.p_edit_objek_rekening') }}',
                method: 'post',
                data: fd,
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
                            text: 'Data telah diubah',
                            title: 'Berhasil',
                            toast: true,
                            position: 'top-end',
                            timer: 1800,
                            showConfirmButton: false,
                        });
                        $('#form-edit-show').empty();
                        $('.btn-add').show();
                        $('#dataTable').DataTable().ajax.reload();

                    }
                }
            });
        });
    </script>

    <script>
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 5,
            lengthMenu: [
                [5, 10, 20, -1],
                [5, 10, 20, "50"]
            ],
            // responsive: true,
            order: [],
            ajax: {
                url: "{{ route('rekening.data_objek_rekening') }}",
                data: {
                    id: "{{ encrypsi($segment) }}"
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-secondary text-xs font-weight-bold',
                    render: function(data, type, row) {
                        return '<a href="/dashboard/rekening/objek/' + encrypsi(row.id) + '" >' + data +
                            '</a>';
                    }
                },
                {
                    data: 'kode',
                    name: 'kode',
                    className: 'text-secondary text-xs font-weight-bold',
                },
                {
                    data: 'uraian_akun',
                    name: 'uraian_akun',
                    className: 'text-secondary text-xs font-weight-bold',
                },
                {
                    data: 'deskripsi_akun',
                    name: 'deskripsi_akun',
                    className: 'text-secondary text-xs font-weight-bold',
                    render: function(data, type, row) {
                        return '<span style="white-space:normal;">' + row.deskripsi_akun + '</span>';
                    }
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]
        });
    </script>

    <script>
        $('.btn-add').click(function() {
            $('#form-create-show').show();
            $('#form-edit-show').empty();
            $(this).hide();
        });
        $('.btn-cancel').click(function() {
            $('#form-create-show').hide();
            $('.btn-add').show();
        })

        $(document).on('click', '.btn-cancel', function() {
            $('#form-edit-show').empty();
            $('.btn-add').show();
        })



        function edit(data) {
            let id = $(data).data('id');

            $('.btn-add').hide();
            $('#form-create-show').hide();

            $.ajax({
                url: '{{ route('rekening.edit_objek_rekening') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#form-edit-show').html(data);
                    $('#form-create-show').hide();
                }
            });
        }

        function hapus(data) {
            let id = $(data).data('id');
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
                        url: "{{ route('rekening.hapus_objek_rekening') }}",
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
                                $('#dataTable').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            });
        }

        function getBack() {
            window.history.back();
        }
    </script>
@endpush
