@extends('layouts.home-layout')

@section('home-content')
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Curriculum</a></li>
                                    <li class="breadcrumb-item active">Detail</li>
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
                                <h4 class="card-title">Daftar Kursus pada Kurikulum: {{ $curriculum->name }}</h4>
                                <p class="card-title-desc">Berikut adalah daftar kursus yang tersedia untuk kurikulum ini.
                                </p>
                            </div>
                            <div class="card-body">
                                @if (isset($curriculum))
                                    <a href="{{ route('curriculum_course.create', $curriculum->curriculum_id) }}"
                                        class="btn btn-primary btn-sm mb-3">
                                        <i class="fa-solid fa-square-plus"></i>
                                        Tambah
                                    </a>
                                @else
                                    <p>Kurikulum tidak ditemukan.</p>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered dt-responsive nowrap w-100"
                                        id="datatable">
                                        <thead>
                                            <tr style="text-align: center; vertical-align: middle;">
                                                <th style="width: 30px; text-align: center; vertical-align: middle;">No</th>
                                                <th style="text-align: center; vertical-align: middle;">Kode<br>Matakuliah</th>
                                                <th style="text-align: center; vertical-align: middle;">Nama<br>Matakuliah</th>
                                                <th style="text-align: center; vertical-align: middle;">SKS MK</th>
                                                <th style="text-align: center; vertical-align: middle;">SKS TM</th>
                                                <th style="text-align: center; vertical-align: middle;">SKS PR</th>
                                                <th style="text-align: center; vertical-align: middle;">SKS PL</th>
                                                <th style="text-align: center; vertical-align: middle;">SKS SIM</th>
                                                <th style="text-align: center; vertical-align: middle;">Wajib</th>
                                                <th style="text-align: center; vertical-align: middle;">Aksi</th>
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
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> --}}

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <script>
            $(document).ready(function() {
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('curriculum_course.index', $curriculum->curriculum_id) }}', // Ensure curriculum_id is passed here
                    columns: [{
                            data: null,
                            name: 'no',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('text-align', 'center'); // Align center
                            }
                        },
                        {
                            data: 'course.code',
                            name: 'course.code'
                        },
                        {
                            data: 'course_name',
                            name: 'course.name'
                        },
                        {
                            data: 'sks_mk',
                            name: 'sks_mk',
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('text-align', 'center'); // Align center
                            }
                        },
                        {
                            data: 'sks_tm',
                            name: 'sks_tm',
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('text-align', 'center'); // Align center
                            }
                        },
                        {
                            data: 'sks_pr',
                            name: 'sks_pr',
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('text-align', 'center'); // Align center
                            }
                        },
                        {
                            data: 'sks_pl',
                            name: 'sks_pl',
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('text-align', 'center'); // Align center
                            }
                        },
                        {
                            data: 'sks_sim',
                            name: 'sks_sim',
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('text-align', 'center'); // Align center
                            }
                        },
                        {
                            data: 'is_mandatory',
                            name: 'is_mandatory',
                            render: function(data) {
                                return data ? 'Ya' : 'Tidak';
                            },
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('text-align', 'center'); // Align center
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('text-align', 'center'); // Align center
                            }
                        }
                    ]
                });
            });

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
@endsection
