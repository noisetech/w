@extends('layouts.admin')
@section('title', 'DPA')
@section('content')
    {{ navbar('DPA', 'Form Tambah DPA') }}

    <div class="container-fluid py-4">
        <div class="row my-2">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-end align-items-center">
                            <h6>TAMBAH DPA</h6>
                        </div>
                    </div>
                    <div class="card-body">
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
                                    <input type="text" readonly name="no_dpa" class="form-control" value="">
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
                                    <input type="text" readonly name="no_dpa" class="form-control">
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
                                    <input type="text" readonly name="no_dpa" class="form-control">
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
                                    <input type="text" readonly name="no_dpa" class="form-control">
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
                                </div>
                            </div>
                        </form>

                    </div>



                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('.urusan').select2({
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
    </script>
@endpush
