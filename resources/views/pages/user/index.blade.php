@extends('layouts.admin')


@section('title', 'Users')
@section('content')
{{ navbar('Users', 'List Users') }}

    <div class="container-fluid py-4">
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('user.h_tambah') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" cellspacing="0" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Dinas</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
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
        $(document).ready(function() {
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
                    url: "{{ route('user.data') }}"
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'dinas',
                        name: 'dinas'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },

                ]
            });
        });
    </script>

    <script>
        $(document).on('click', '.hapus', function(e) {
            e.preventDefault();
            let id = $(this).attr('id')
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
                        url: "{{ route('user.hapus') }}",
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
            })
        });
    </script>
@endpush
