@extends('layouts.home-layout')

@section('home-content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="wrapper">
                
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Kelas Kuliah</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Data Perkuliahan</a>
                                    </li>
                                    <li class="breadcrumb-item active">Kelas Kuliah</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DataTables -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Kelas Kuliah</h4>
                                <p class="card-title-desc">Berikut adalah daftar kelas kuliah yang tersedia di sistem.</p>
                                <a href="{{ route('kelas_kuliah.create') }}" class="btn btn-primary mb-3">
                                    <i data-feather="plus-square"></i> Tambah
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode MK</th>
                                                <th>Nama Mata Kuliah</th>
                                                <th>Semester</th>
                                                <th>SKS MK</th>
                                                <th>SKS TM</th>
                                                <th>SKS Prak</th>
                                                <th>SKS Prak Lap.</th>
                                                <th>SKS SIM</th>
                                                <th>Wajib</th>
                                                <th>n Kelas</th>
                                                <th>Actions</th>
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

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('kelas_kuliah.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode_mk',
                    name: 'kode_mk'
                },
                {
                    data: 'nama_mata_kuliah',
                    name: 'nama_mata_kuliah'
                },
                {
                    data: 'semester',
                    name: 'semester'
                },
                {
                    data: 'sks_mk',
                    name: 'sks_mk'
                },
                {
                    data: 'sks_tm',
                    name: 'sks_tm'
                },
                {
                    data: 'sks_prak',
                    name: 'sks_prak'
                },
                {
                    data: 'sks_prak_lap',
                    name: 'sks_prak_lap'
                },
                {
                    data: 'sks_sim',
                    name: 'sks_sim'
                },
                {
                    data: 'wajib',
                    name: 'wajib'
                },
                {
                    data: 'n_kelas',
                    name: 'n_kelas'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>
@endsection
