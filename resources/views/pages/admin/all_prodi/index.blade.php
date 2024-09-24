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
                                        <li class="breadcrumb-item active">Semua Prodi</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Data Program Studi</h4>
                                    <p class="card-title-desc">Berikut adalah daftar seluruh program studi yang tersedia.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatable"
                                            class="table table-striped table-bordered dt-responsive nowrap w-100">
                                            <thead>
                                                <tr style="text-align: center">
                                                    {{-- <th>ID Prodi</th> --}}
                                                    <th>Kode Prodi</th>
                                                    <th>Nama Prodi</th>
                                                    <th>Nama Perguruan Tinggi</th>
                                                    <th>Status</th>
                                                    <th>Jenjang Pendidikan</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('all_prodi.data') }}",
                columns: [
                    // {
                    //     data: 'id_prodi',
                    //     name: 'id_prodi'
                    // },
                    {
                        data: 'kode_prodi',
                        name: 'kode_prodi',
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css({
                                'text-align': 'center',
                                'vertical-align': 'middle'
                            });
                        }
                    },
                    {
                        data: 'nama_prodi',
                        name: 'nama_prodi'
                    },
                    {
                        data: 'nm_lemb',
                        name: 'nm_lemb'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css({
                                'text-align': 'center',
                                'vertical-align': 'middle'
                            });
                        }
                    },
                    {
                        data: 'nm_jenj_didik',
                        name: 'nm_jenj_didik',
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css({
                                'text-align': 'center',
                                'vertical-align': 'middle'
                            });
                        }
                    },
                ]
            });
        });
    </script>
@endsection
