@extends('layouts.admin')
@section('title', 'Urusan')
@section('content')
    {{ navbar('Perencanaan Organisasi', 'List Perencanaan Organisasi') }}

    <div class="container-fluid py-4">
        <div class="row my-2">
            <div class="col-lg-3 col-md-2 col-sm-12 h-100">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="alert alert-dark">
                            <strong class="text-white">Urusan</strong>
                        </div>
                        <div class="alert alert-light">
                            <strong>Bidang</strong>
                        </div>
                        <div class="alert alert-light">
                            <strong>Organisasi</strong>
                        </div>
                        <div class="alert alert-light">
                            <strong>Unit</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>Urusan</h6>
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
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>


                    <div class="container">
                        <div id="form-create" style="display: none;">
                            <form action="#" method="post" id="form_urusan_step">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="Kode">Kode</label>
                                            <input type="text" class="form-control" name="kode" placeholder="Kode">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label for="Kode">Nomenklatur</label>
                                            <input type="text" class="form-control" name="nomenklatur"
                                                placeholder="Nomenklatur">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
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
        $("#form_urusan_step").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('perencanaan_organisasi.p_tambah_urusan') }}',
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
                        $('#form_urusan_step')[0].reset();
                        $('#dataTable').DataTable().ajax.reload();

                    }
                }
            });
        });

        $(document).on('submit', '#form_edit_urusan', function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('perencanaan.p_formEditUrusanById') }}',
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
                url: "{{ route('perencanaan_organisasi.data_urusan') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-secondary text-xs font-weight-bold',
                    render: function(data, type, row) {
                        return '<a href="/dashboard/perencanaan_organisasi/bidang/urusan/' + encrypsi(row.id) +
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
                    name: 'aksi'
                },
            ]
        });
    </script>

    <script>
        $('.btn-add').click(function() {
            $('#form-create').show();
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


        function formEditUrusanById(data) {
            let id = $(data).data('id');

            $('.btn-add').hide();

            $.ajax({
                url: '{{ route('perencanaan.formEditUrusanById') }}',
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

        function hapusDataUrusan(data) {
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
                        url: "{{ route('perencanaan_organisasi.hapusDataUrusan') }}",
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
    </script>
@endpush
