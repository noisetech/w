@extends('layouts.admin')


@section('title', 'Organisasi')
@section('content')
    {{ navbar('Dinas', 'Edit Dinas') }}

    <div class="container-fluid py-4">
        <div class="row justify-content-center mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="#" method="POST" id="organisasi_form">
                            @csrf

                            <input type="hidden" name="id" value="{{ $organisasi->id }}">

                            <div class="form-group">
                                <label for="">Kode Organisasi:</label>
                                <input type="text" class="form-control" name="kodeOrganisasi"
                                    placeholder="Kode Organisasi" value="{{ $organisasi->kodeOrganisasi }}">
                            </div>


                            <div class="form-group">
                                <label for="">Urusan:</label>
                                <input type="text" class="form-control" name="urusan" placeholder="Urusan"
                                    value="{{ $organisasi->urusan }}">
                            </div>

                            <div class="form-group">
                                <label for="">Nomenklatur:</label>
                                <input type="text" class="form-control" name="nomenklatur" placeholder="Nomenklatur"
                                    value="{{ $organisasi->nomenklatur }}">
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
        $("#organisasi_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('organisasi.p_edit') }}',
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
@endpush
