@extends('layouts.home-layout')

@section('home-content')
    <style>
        #datatable th {
            text-align: center;
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
                                        <a href="javascript: void(0);">Data Aktivitas</a>
                                    </li>
                                    <li class="breadcrumb-item active">Aktivitas Mahasiswa</li>
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
                                <h4 class="card-title">Daftar Aktivitas Mahasiswa</h4>
                                <p class="card-title-desc">Berikut adalah daftar aktivitas mahasiswa yang tersedia di
                                    sistem.</p>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('aktivitas-mahasiswa.create') }}" class="btn btn-primary btn-sm mb-3">
                                    <i class="fa-solid fa-square-plus"></i>
                                    Tambah
                                </a>

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show"
                                        role="alert">
                                        <i
                                            class="mdi mdi-check-all label-icon"></i><strong>Success</strong>-{{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered dt-responsive nowrap w-100"
                                        id="datatable">
                                        <thead>
                                            <tr style="text-align: center">
                                                <th style="width: 30px">No.</th>
                                                <th>NIPD</th>
                                                <th>Semester</th>
                                                <th>Judul</th>
                                                <th>Lokasi</th>
                                                <th>Nomor SK</th>
                                                <th>Tanggal SK</th>
                                                <th>Deskripsi</th>
                                                <th>Jenis Aktivitas</th>
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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('aktivitas-mahasiswa.data') }}',
                columns: [{
                        data: null,
                        name: 'no',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        className: 'text-center'
                    },
                    {
                        data: 'id_reg_pd',
                        name: 'mahasiswa_pt.nipd',
                    },
                    {
                        data: 'semester_id',
                        name: 'semester.name',
                        className: 'text-center'
                    },
                    {
                        data: 'title',
                        name: 'title',
                    },
                    {
                        data: 'location',
                        name: 'location',
                    },
                    {
                        data: 'sk_number',
                        name: 'sk_number',
                    },
                    {
                        data: 'sk_date',
                        name: 'sk_date',
                        render: function(data, type, row) {
                            if (data) {
                                var date = new Date(data);
                                return ("0" + date.getDate()).slice(-2) + "-" +
                                    ("0" + (date.getMonth() + 1)).slice(-2) + "-" +
                                    date.getFullYear();
                            }
                            return '';
                        },
                        className: 'text-center'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'activity_type_id',
                        name: 'activity_type.name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
