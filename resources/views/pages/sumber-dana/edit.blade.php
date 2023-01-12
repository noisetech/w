@extends('layouts.admin')


@section('title', 'Sumber Dana')
@section('content')
    {{ navbar('Sumber Dana', 'Edit Sumber Dana') }}


    <div class="container-fluid py-4">
        <div class="row justify-content-center mt-3">
            <div class="col-sm-12">
                <div class="card shadow">

                    <div class="card-body">
                        <form action="#" method="POST" id="sumber_dana">
                            @csrf

                            <input type="hidden" name="id" value="{{ $sumber_dana->id }}">

                            <div class="form-group">
                                <label for="">Sumber:</label>
                                <input type="text" class="form-control" name="sumber_dana" placeholder="Sumber Dana"
                                    value="{{ $sumber_dana->sumber_dana }}">
                                <span class="text-danger error-text sumber_dana_error"></span>
                            </div>


                            <button class="btn mt-3 btn-sm btn-success" type="submit" id="role_btn">
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
        $(document).ready(function() {
            $('.permission').select2({
                minimumInputLength: 3,
                // dropdownParent: $('#exampleModal'),
                maximumSelectionLength: 0,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Permission--',
                width: '100%',
                ajax: {
                    url: "{{ route('listPermission') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });

        $("#sumber_dana").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('sumber_dana.p-edit') }}',
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
                        setTimeout(function() {
                            window.top.location = "{{ route('sumber_dana') }}"
                        }, 1800);
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });
    </script>
@endpush
