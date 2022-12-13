@extends('layouts.admin')
@section('title', 'Sub Kegiatan')
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
                        <div class="alert alert-{{ isset($active) && $active == 'sub kegiatan' ? 'dark' : 'light' }}">
                            <strong class="text-{{ isset($active) && $active == 'sub kegiatan' ? 'white' : 'black' }}">Bidang
                            </strong>
                        </div>

                        <div class="alert alert-{{ isset($active) && $active == 'sub kegiatan' ? 'dark' : 'light' }}">
                            <strong
                                class="text-{{ isset($active) && $active == 'sub kegiatan' ? 'white' : 'black' }}">Program
                            </strong>
                        </div>
                        <div class="alert alert-{{ isset($active) && $active == 'sub kegiatan' ? 'dark' : 'light' }}">
                            <strong
                                class="text-{{ isset($active) && $active == 'sub kegiatan' ? 'white' : 'black' }}">Kegiatan</strong>
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

                        <h6>Sub Kegiatan</h6>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Satuan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kinerja</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Indikator</th>
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
                            <form action="#" method="post" id="form_tambah_sub_kegiatan">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="kegiatan_id"
                                                value="{{ $kegiatan->id }}">
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
                                            <label for="Kode">Satuan</label>
                                            <select name="satuan_id" class="form-control satuan_tambah"></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label for="">Nomenklatur</label>
                                            <input type="text" name="nomenklatur" placeholder="Nomenklatur"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="">Kinerja</label>
                                            <input type="text" name="kinerja" placeholder="Kinerja" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="">Indikator</label>
                                            <input type="text" name="indikator" placeholder="Indikator"
                                                class="form-control">
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

                        <div id="form-edit" style="display: none;">
                            <form action="#" method="post" id="form_edit_sub_kegiatan">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="kegiatan_id"
                                                value="{{ $kegiatan->id }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="id"
                                                id="id_sub_kegiatan">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="Kode">Kode</label>
                                            <input type="text" class="form-control" name="kode" placeholder="Kode"
                                                id="kode_edit">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Kode">Satuan</label>
                                            <select name="satuan_id" class="form-control satuan_edit"></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label for="">Nomenklatur</label>
                                            <input type="text" name="nomenklatur" placeholder="Nomenklatur"
                                                class="form-control" id="nomenklatur_edit">
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="">Kinerja</label>
                                            <input type="text" name="kinerja" placeholder="Kinerja"
                                                class="form-control" id="kinerja_edit">
                                        </div>
                                    </div>

                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="">Indikator</label>
                                            <input type="text" name="indikator" placeholder="Indikator"
                                                class="form-control" id="indikator_edit">
                                        </div>
                                    </div>


                                    <div class="col-sm-1">
                                        <button type="submit" class="btn btn-sm btn-success btn-save"><i
                                                class="fas fa-save"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger btn-cancel-4"><i
                                                class="fas fa-times"></i></button>
                                    </div>
                                </div>
                            </form>
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
                url: "{{ route('perencanaan.data_sub_kegiatan') }}",
                data: {
                    id: "{{ $segment }}"
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-secondary text-xs font-weight-bold',
                    render: function(data, type, row, ) {
                        return '<a href="#" >' + data +
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
                    data: 'satuan',
                    name: 'satuan',
                    className: 'text-secondary text-xs font-weight-bold',
                },


                {
                    data: 'kinerja',
                    name: 'kinerja',
                    className: 'text-secondary text-xs font-weight-bold',
                },
                {
                    data: 'indikator',
                    name: 'indikator',
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
        $("#form_tambah_sub_kegiatan").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('perencanaan.p_tambah_sub_kegiatan') }}',
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
                        $('#form_tambah_sub_kegiatan')[0].reset();
                        $('#dataTable').DataTable().ajax.reload();
                        $('#form_tambah_sub_kegiatan').show();
                        $('.btn-add').show();
                    }
                }
            });
        });
        $("#form_edit_sub_kegiatan").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('perencanaan.p_FormEditSubKegiatan') }}',
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
                        $('#form_edit_sub_kegiatan')[0].reset();
                        $('#dataTable').DataTable().ajax.reload();
                        $('#form-edit').hide();
                        $('.btn-add').show();


                    }
                }
            });
        });


        function hapusSubKegiatan(data) {
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
                        url: "{{ route('perencanaan.hapusSubKegiatanPerencanaan') }}",
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





        $('.satuan_tambah').select2({
            minimumInputLength: 1,
            // dropdownParent: $('#exampleModal'),
            maximumInputLength: 50,
            allowClear: true,
            placeholder: '-- Pilih Satuan--',
            width: '100%',
            ajax: {
                url: "{{ route('perencanaan.listSatuanForKegiatan') }}",
                dataType: 'json',
                delay: 500,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.satuan,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('.satuan_edit').select2({
            minimumInputLength: 1,
            // dropdownParent: $('#exampleModal'),
            maximumSelectionLength: 0,
            maximumInputLength: 50,
            allowClear: true,
            placeholder: '-- Pilih Satuan--',
            width: '100%',
            ajax: {
                url: "{{ route('perencanaan.listSatuanForKegiatan') }}",
                dataType: 'json',
                delay: 500,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.satuan,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    </script>

    <script>
        $('.btn-add').click(function() {
            $('#form-create').show();
            $(this).show();
        });


        $('.btn-cancel').click(function() {
            $('#form-create').hide();
            $('.btn-add').show();
        })



        $(document).on('click', '.btn-cancel-4', function() {
            $('#form-edit').hide();
            $('.btn-add').show();
        })

        $(document).on('click', '.edit', function(e) {
            $('#form-edit').show();
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('perencanaan.formEditSubKegiatanById') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    // console.log(data);
                    $('#kode_edit').val(data.kode);
                    $('#nomenklatur_edit').val(data.nomenklatur);
                    $('#kinerja_edit').val(data.kinerja);
                    $('#indikator_edit').val(data.indikator);
                    $('#id_sub_kegiatan').val(data.id);

                    var satuan_id = data.id;


                    $.ajax({
                        type: 'GET',
                        url: "{{ route('perencanaan.listSatuanBySubKegiatan') }}",
                        data: {
                            id: satuan_id
                        }
                    }).then(function(data) {
                        console.log(data);
                        for (i = 0; i < data.length; i++) {
                            // selected
                            var newOption = new Option(data[i].satuan, data[i].id, true,
                                true);

                            $('.satuan_edit').append(newOption).trigger('change');
                        }
                    });


                }
            });
        });

        function getBack() {
            window.history.back();
        }
    </script>
@endpush
