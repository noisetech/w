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


                    {{-- <div class="container">
                        <div id="form-create" style="display: none;">
                            <form action="#" method="post" id="form_urusan_step" class="form-inline">
                                @csrf


                                <div class="row">

                                    <label class="col-sm-1 my-2">
                                        No Dpa
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="no_dpa" class="form-control" placeholder="No Dpa">
                                    </div>
                                </div>

                                <div class="row mt-4">

                                    <label class="col-sm-1 my-2">
                                        Urusan
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>
                                </div>


                                <div class="row mt-3">

                                    <label class="col-sm-2 my-2">
                                        Capaian Program
                                    </label>

                                    <label class="col-sm-1 my-2" style="font-size: 12px;">
                                        Indikator
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>



                                    <label class="col-sm-1 my-2" style="font-size: 12px;">
                                        Target
                                    </label>
                                    <div class="col-sm-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <label class="col-sm-4 my-2">
                                        Indikator
                                    </label>

                                    <label class="col-sm-4 my-2">
                                        Tolak Ukur
                                    </label>

                                    <label class="col-sm-3 my-2">
                                        Kinerja
                                    </label>

                                </div>

                                <div class="row">
                                    <div class="col-sm-4 my-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>

                                    <div class="col-sm-4 my-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>

                                    <div class="col-sm-3 my-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-4 my-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>

                                    <div class="col-sm-4 my-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>

                                    <div class="col-sm-3 my-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-4 my-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>

                                    <div class="col-sm-4 my-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>

                                    <div class="col-sm-3 my-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-4 my-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>

                                    <div class="col-sm-4 my-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>

                                    <div class="col-sm-3 my-2">
                                        <input type="text" name="no_dpa" class="form-control">
                                    </div>

                                </div>



                                <div class="row justify-content-end">
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
                    </div> --}}
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $('#dataTable').DataTable();
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
