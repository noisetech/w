@extends('layouts.admin')


@section('title', 'Dinas')
@section('content')
    {{ navbar('Dinas', 'Tambah Dinas') }}

    <div class="container-fluid py-4">
        <div class="row justify-content-center mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="#" method="POST" id="dinas_form" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="">Wilayah:</label>
                                <select name="wilayah_id" class="form-control wilayah"></select>
                            </div>

                            <div class="form-group">
                                <label for="">Dinas:</label>
                                <input type="text" name="dinas" class="form-control" placeholder="Dinas">
                            </div>

                            <div class="form-group">
                                <label for="">Logo:</label>
                                <input type="file" name="logo" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="">Icon:</label>
                                <input type="file" name="icon" class="form-control">
                            </div>


                            <button class="btn mt-3 btn-sm btn-success" type="submit">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#dinas_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('dinas.p_tambah') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                // beforeSend: function() {
                //     $(document).find('span.error-text').text('');
                // },
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
                        });
                        setTimeout(function() {
                            window.top.location = "{{ route('dinas') }}"
                        }, 1500);
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.wilayah').select2({
                minimumInputLength: 4,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Wilayah--',
                width: '100%',
                ajax: {
                    url: "{{ route('dinas.listWilayah') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.wilayah,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });
    </script>
@endpush
