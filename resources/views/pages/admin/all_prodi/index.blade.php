@extends('layouts.home-layout')


@section('home-content')
    <li>
        <a href="javascript: void(0);" class="has-arrow">
            <i data-feather="sliders"></i>
            <span data-key="t-tables">Tables</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            <li><a href="tables-editable.html" data-key="t-editable-table">All Prodi</a></li>
        </ul>
    </li>
    <div class="container-fluid" style="margin-left: 250px; margin-top: 70px;">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Program Studi</h4>
                        <p class="card-title-desc">Berikut adalah daftar seluruh program studi yang tersedia.
                        </p>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>ID Prodi</th>
                                    <th>ID PT</th>
                                    <th>Kode Prodi</th>
                                    <th>Nama Prodi</th>
                                    <th>Status</th>
                                    <th>ID Jenjang Pendidikan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>

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
                ajax: "{{ route('all_prodi.data') }}", // Mengambil data dari route prodi.data
                columns: [{
                        data: 'id_prodi',
                        name: 'id_prodi'
                    },
                    {
                        data: 'id_pt',
                        name: 'id_pt'
                    },
                    {
                        data: 'kode_prodi',
                        name: 'kode_prodi'
                    },
                    {
                        data: 'nama_prodi',
                        name: 'nama_prodi'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                    {
                        data: 'id_jenjang_pendidikan',
                        name: 'id_jenjang_pendidikan'
                    }
                ]
            });
        });
    </script>
@endsection
