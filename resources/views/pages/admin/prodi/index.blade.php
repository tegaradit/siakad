@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="wrapper">
                    <!-- Sidebar -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18"></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="javascript: void(0);">Data Umum</a>
                                        </li>
                                        <li class="breadcrumb-item active">Prodi</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Data Prodi</h4>
                                    <p class="card-title-desc">Berikut adalah daftar seluruh program studi yang tersedia.</p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap w-100" id="prodi-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Nama Prodi</th>
                                                    <th>Nama Jurusan</th>
                                                    <th>Jenjang Pendidikan</th>
                                                    <th>SKS Lulus</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div> <!-- container -->
            </div> <!-- content -->
        </div> <!-- wrapper -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#prodi-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('prodi') !!}',
                    columns: [
                        { 
                            data: null, 
                            name: 'no',
                            orderable: false, 
                            searchable: false,
                            render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1; // nomor urut yang dinamis
                            },
                            createdCell: function (td, cellData, rowData, row, col) {
                                    $(td).css('text-align', 'center'); // Align center
                            }
                        },
                        {
                            data: 'kode',
                            name: 'kode'
                        },
                        {
                            data: 'nama_prodi',
                            name: 'nama_prodi'
                        },
                        {
                            data: 'nm_jur',
                            name: 'nm_jur'
                        },
                        {
                            data: 'nm_jenj_didik',
                            name: 'nm_jenj_didik'
                        },
                        {
                            data: 'sks_lulus',
                            name: 'sks_lulus'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                    ]
                });
            })
        </script>
    @endsection
