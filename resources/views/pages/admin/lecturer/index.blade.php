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
                                            <a href="javascript: void(0);">Data Perkuliahan</a>
                                        </li>
                                        <li class="breadcrumb-item active">Data Dosen</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Data Dosen</h4>
                                    <p class="card-title-desc">Berikut adalah daftar seluruh dosen.</p>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('lecturer.create') }}" class="btn btn-primary mb-3">Tambah</a>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>NUPTK</th>
                                                    <th>NIDN</th>
                                                    <th>NIK</th>
                                                    <th>Gender</th>
                                                    <th>Nama</th>
                                                    <th>Status Aktif</th>
                                                    <th>Tanggal Lahir</th>
                                                    <th>Tempat Lahir</th>
                                                    <th>Nama Ibu</th>
                                                    <th>Status Pernikahan</th>
                                                    <th>Level Pegawai</th>
                                                    <th>Level Pendidikan</th>
                                                    <th>No Telepon</th>
                                                    <th>Email</th>
                                                    <th>No Surat Tugas</th>
                                                    <th>Tanggal Surat Tugas</th>
                                                    <th>Tanggal TMT Surat Tugas</th>
                                                    <th>Tanggal Keluar</th>
                                                    <th>Prodi ID</th>
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
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
     <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('lecturer.data') }}",
                columns: [{
                        data: null,
                        name: 'no',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart +
                                1; // nomor urut yang dinamis
                        }
                    },
                    {
                        data: 'nuptk',
                        name: 'nuptk'
                    },
                    {
                        data: 'nidn',
                        name: 'nidn'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'active_status.name',
                        name: 'active_status.name'
                    },
                    {
                        data: 'birth_date',
                        name: 'birth_date'
                    },
                    {
                        data: 'birth_place',
                        name: 'birth_place'
                    },
                    {
                        data: 'mothers_name',
                        name: 'mothers_name'
                    },
                    {
                        data: 'mariage_status',
                        name: 'mariage_status'
                    },
                    {
                        data: 'employee_level.name',
                        name: 'employee_level.name'
                    },
                    {
                        data: 'level_education',
                        name: 'level_education'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'assign_letter_number',
                        name: 'assign_letter_number'
                    },
                    {
                        data: 'assign_letter_date',
                        name: 'assign_letter_date'
                    },
                    {
                        data: 'assign_letter_tmt',
                        name: 'assign_letter_tmt'
                    },
                    {
                        data: 'exit_date',
                        name: 'exit_date'
                    },
                    {
                        data: 'prodi.nama_prodi',
                        name: 'prodi.nama_prodi'
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();
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
@endsection
