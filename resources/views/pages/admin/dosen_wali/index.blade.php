@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                {{-- art page title --}}
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Daftar Dosen Wali:
                                {{ $lecturer ? $lecturer->name : 'N/A' }}
                            </h4>
                            <!-- Nama dosen ditampilkan di sini -->
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Data Perkuliahan</a>
                                    </li>
                                    <li class="breadcrumb-item active">Dosen Wali
                                        <!-- Nama dosen ditampilkan di breadcrumb -->
                                    </li>
                                </ol>
                            </div>
                        </div>
                        {{-- end page title --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <a href="{{route('dosen_wali.create_manual', $lecture_id_input) }}" class="btn btn-primary btn-sm mb-3">
                                            Tambah (dengan input manual)
                                        </a> --}}

                                        <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal"
                                            data-bs-target="#createModal">
                                            Tambah (dengan input manual)
                                        </button>
                                        <a href="{{ route('dosen_wali.select_mahasiswa', $lecture_id_input) }}"
                                            class="btn text-white bg-dark btn-sm mb-3">
                                            <i class="text-white bg-dark"></i> Tambah (dengan memilih mahasiswa)
                                        </a>

                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-check-all"></i> {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered dt-responsive nowrap w-100"
                                                id="datatable">
                                                <thead>
                                                    <tr style="text-align: center">
                                                        <th style="width:20px">No</th>
                                                        <th>NIM</th>
                                                        <th>Nama</th>
                                                        <th style="width: 60px; text-align:center">Aksi</th>
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
    </div>
    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createForm" action="{{ route('dosen_wali.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Dosen Wali</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="mb-3">
                        <div class="modal-body">
                            <input type="hidden" name="lecture_id" value="{{ $lecturer->id }}" />
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="nim" name="nim" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dosen_wali.index', $lecture_id_input) }}',
                columns: [{
                        data: null,
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'nim',
                        name: 'nim',
                        className: 'text-center'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ]
            });

            function reloadTable() {
                table.ajax.reload(null, false); 
            }
        });
    </script>
    <script>
        $('#nim').on('input', function() {
            var nim = $(this).val();

            if (nim) {
                var url = '{{ route('get.nama', ':nim') }}';
                url = url.replace(':nim', nim);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        if (data.nama) {
                            $('#nama').val(data.nama);
                        } else {
                            $('#nama').val('');
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        alert('Gagal mengambil data Nama. Silakan coba lagi.');
                    }
                });
            } else {
                $('#nama').val('');
            }
        });
    </script>
@endsection
