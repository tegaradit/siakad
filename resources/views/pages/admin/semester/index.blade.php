@extends('layouts.home-layout')

@section('home-content')
    <style>
        #datatable td,
        #datatable th {
            text-align: center;
            /* This applies to all table headers and cells */
        }
    </style>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18"></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Data Perkuliahan</a>
                                    </li>
                                    <li class="breadcrumb-item active">Semester</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Semester</h4>
                                <p class="card-title-desc">Berikut adalah daftar semester yang tersedia di sistem.</p>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('semester.create') }}" class="btn btn-primary btn-sm mb-3">
                                    <i class="fa-solid fa-square-plus"></i>
                                    Tambah
                                </a>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                        <i class="mdi mdi-check-all label-icon"></i><strong>Success</strong>-{{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered dt-responsive nowrap w-100"
                                        id="datatable">
                                        <thead>
                                            <tr style="text-align: center">
                                                <th style="width: 30px">No.</th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Semester</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Berhenti</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear());
                        </script> © Minia.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('semester.data') }}',
                columns: [{
                        data: null,
                        name: 'no',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'semester_id',
                        name: 'semester_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'smt',
                        name: 'smt',
                        render: function(data, type, row) {
                            if (data == 1) return 'Ganjil';
                            if (data == 2) return 'Genap';
                            if (data == 3) return 'Pendek';
                            return '';
                        }
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                        render: function(data, type, row) {
                            if (data) {
                                var date = new Date(data);
                                return ("0" + date.getDate()).slice(-2) + "-" +
                                    ("0" + (date.getMonth() + 1)).slice(-2) + "-" +
                                    date.getFullYear();
                            }
                            return '';
                        }
                    },
                    {
                        data: 'end_date',
                        name: 'end_date',
                        render: function(data, type, row) {
                            if (data) {
                                var date = new Date(data);
                                return ("0" + date.getDate()).slice(-2) + "-" +
                                    ("0" + (date.getMonth() + 1)).slice(-2) + "-" +
                                    date.getFullYear();
                            }
                            return '';
                        }
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        render: function(data, type, row) {
                            return data == 1 ?
                                `<i class="bx bx-check-square" style="color: green; font-size: 24px; cursor: pointer;" onclick="changeStatus(${row.semester_id}, ${data})"></i>` :
                                `<i class="bx bx-square" style="color: red; font-size: 24px; cursor: pointer;" onclick="changeStatus(${row.semester_id}, ${data})"></i>`;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ]
            });
        });

        // Function to change status via AJAX
        function changeStatus(id, currentStatus) {
            const action = currentStatus == 1 ? 'nonaktifkan' : 'aktifkan';
            Swal.fire({
                title: `Apakah Anda yakin ingin ${action} semester ini?`,
                text: "Anda tidak dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Ya, ${action}!`,
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/semester/change-status/${id}`,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#datatable').DataTable().ajax.reload();
                            } else {
                                Swal.fire('Error', response.message || 'Gagal mengubah status.',
                                    'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
                        }
                    });
                }
            });
        };

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
