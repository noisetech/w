@extends('layouts.admin')
@section('title', 'Program')
@section('content')
    {{ navbar('Perencanaan', 'List Perencanaan') }}

    <div class="container-fluid py-4">
        <div class="row my-2">
            <div class="col-lg-3 col-md-3 col-sm-12 h-100">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="alert alert-dark">
                            <strong class="text-white">Urusan</strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'bidang program' ? 'dark' : 'light' }}">
                            <strong
                                class="text-{{ isset($active) && $active == 'bidang program' ? 'white' : 'black' }}">Bidang
                            </strong>
                        </div>

                        <div class="alert alert-{{ isset($active) && $active == 'bidang program' ? 'dark' : 'light' }}">
                            <strong
                                class="text-{{ isset($active) && $active == 'bidang program' ? 'white' : 'black' }}">Program
                            </strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'kegiatan' ? 'dark' : 'light' }}">
                            <strong
                                class="text-{{ isset($active) && $active == 'kegiatan' ? 'white' : 'black' }}">Kegiatan</strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'sub kegiatan' ? 'dark' : 'light' }}">
                            <strong class="text-{{ isset($active) && $active == 'sub kegiatan' ? 'white' : 'black' }}">Sub
                                Kegiatan</strong>
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

                        <h6>Program</h6>
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
                                            Nomenklatur</th>
                                        {{-- <th>Aksi</th> --}}
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>



                    <div class="container">
                        <div id="form-create" style="display: none;">
                            <form action="#" method="post" id="form_tambah_program">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="id_bidang"
                                                value="{{ $bidang->id }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="Kode">Kode</label>
                                            <input type="text" class="form-control" name="kode" placeholder="Kode">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Kode">Nomenklatur</label>
                                            <input type="text" class="form-control" name="nomenklatur"
                                                placeholder="Nomenklatur">
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="submit" class="btn btn-sm btn-success btn-save"><i
                                                class="fas fa-save"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger btn-cancel"><i
                                                class="fas fa-times"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="form-edit">

                        </div>
                    </div>
                    <div class="d-flex justify-content-end mx-4">
                        <a href="javascript:;" class="btn btn-sm btn-success btn-add">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>



            </div>
        </div>

    </div>
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
                url: "{{ route('perencanaan.data_program') }}",
                data: {
                    id: "{{ encrypsi($segment) }}"
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-secondary text-xs font-weight-bold',
                    render: function(data, type, row) {
                        return '<a href="/dashboard/perencanaan/kegiatan/program/' + encrypsi(row.id) +
                            '" >' + data +
                            '</a>';
                    }
                },
                {
                    data: 'kode',
                    name: 'kode',
                    className: 'text-secondary text-xs font-weight-bold',
                },
                {
                    data: 'nomenklatur',
                    name: 'nomenklatur',
                    className: 'text-secondary text-xs font-weight-bold',
                },

                {
                    data: 'aksi',
                    name: 'aksi',
                },
            ]
        });
    </script>

    <script>
        $("#form_tambah_program").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('perencanaan.p_form_tambah_program') }}',
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
                        $('#form_tambah_program')[0].reset();
                        $('#dataTable').DataTable().ajax.reload();
                        $('#form-create').hide();
                        $('.btn-add').show();

                    }
                }
            });
        });


        function hapusDataProgram(data) {
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
                        url: "{{ route('perencanaan.hapusProgramPerencanaan') }}",
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





        // bagian input edit bidang
        function formEditProgramById(data) {
            let id = $(data).data('id');

            $('.btn-add').hide();

            $.ajax({
                url: '{{ route('perencanaan.formEditProgramById') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#form-edit').html(data);
                    $('#form-create').hide();
                }
            });
        }


        // form submit edit bidang
        $(document).on('submit', '#form_edit_program', function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('perencanaan.p_formEditProgramById') }}',
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
                        $('#form-edit').empty();
                        $('.btn-add').show();
                        $('#dataTable').DataTable().ajax.reload();

                    }
                }
            });
        });
    </script>

    <script>
        $('.btn-add').click(function() {
            $('#form-create').show();
            $(this).hide();
        });

        $('.btn-add2').click(function() {
            $('#form-create2').show();
            $(this).hide();
        });
        $('.btn-cancel').click(function() {
            $('#form-create').hide();
            $('.btn-add').show();
        })

        $(document).on('click', '.btn-cancel2', function() {
            $('#form-edit').empty();
            $('.btn-add').show();
        })

        $('.btn-cancel-3').click(function() {
            $('#form-create2').hide();
            $('.btn-add2').show();
        })

        $(document).on('click', '.btn-cancel-4', function() {
            $('#form_edit_program').empty();
            $('.btn-add2').show();
        })

        function getBack() {
            window.history.back();
        }
    </script>
@endpush
