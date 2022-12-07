@extends('layouts.admin')
@section('title', 'DPA')
@section('content')
    {{ navbar('DPA', 'List DPA') }}




    <div class="container-fluid py-4">
        <div class="row my-2">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>DPA</h6>

                            <a href="{{ route('dpa.h_tambah') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pb-0">
                            <table class="table align-items-center mb-0" cellspacing="0" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO
                                            DPA
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Urusan
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                                        </th>
                                        <th></th>
                                </thead>
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
                url: "{{ route('dpa.data_table_dpa') }}"
            },
            columns: [{
                    data: 'no_dpa',
                    name: 'no_dpa'
                },
                {
                    data: 'urusan',
                    name: 'urusan'
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
    </script>
@endpush
