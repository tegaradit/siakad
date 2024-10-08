@extends('layouts.home-layout')

@section('home-content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Kelas Perkuliahan</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="filter_prodi" class="form-label">Program Studi</label>
                                    <select id="filter_prodi" class="form-select">
                                        <option value="">:: Pilih Program Studi ::</option>
                                        @foreach($programs as $program)
                                        <option value="{{ $program->prodi_id }}">{{ $program->prodi_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="filter_semester" class="form-label">Tahun Ajaran</label>
                                    <select id="filter_semester" class="form-select">
                                        <option value="">:: Pilih Tahun Ajaran ::</option>
                                        @foreach($semesters as $semester)
                                        <option value="{{ $semester->semester_id }}">{{ $semester->semester_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped" id="kelasKuliahTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode MK</th>
                                        <th>Nama MK</th>
                                        <th>Kelas</th>
                                        <th>Jenis</th>
                                        <th>Bobot</th>
                                        <th>NIDN</th>
                                        <th>Dosen Pengajar</th>
                                        <th>Asisten Dosen</th>
                                        <th>Kuota</th>
                                        <th>Peserta Kelas</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 

        
        <script>
            $(document).ready(function() {
                var table = $('#kelasKuliahTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('kelas_kuliah.index') }}",
                        data: function(d) {
                            d.prodi_id = $('#filter_prodi').val();
                            d.semester_id = $('#filter_semester').val();
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'course_id',
                            name: 'course_id'
                        },
                        {
                            data: 'nama_kelas',
                            name: 'nama_kelas'
                        },
                        {
                            data: 'jenis_kelas',
                            name: 'jenis_kelas'
                        },
                        {
                            data: 'bobot',
                            name: 'bobot'
                        },
                        {
                            data: 'nidn',
                            name: 'nidn'
                        },
                        {
                            data: 'dosen_pengajar',
                            name: 'dosen_pengajar',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'asisten_dosen',
                            name: 'asisten_dosen'
                        },
                        {
                            data: 'quota',
                            name: 'quota'
                        },
                        {
                            data: 'peserta_kelas',
                            name: 'peserta_kelas',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                $('#filter_prodi, #filter_semester').change(function() {
                    table.draw();
                });
            });
        </script>
        @endsection