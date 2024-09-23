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
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Data Perkuliahan</a>
                                </li>
                                <li class="breadcrumb-item active">Kurikulum</li>
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
                            <h4 class="card-title">Daftar Kurikulum</h4>
                            <p class="card-title-desc">Berikut adalah daftar kurikulum yang tersedia di sistem.</p>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('curriculum.create') }}" class="btn btn-primary mb-3">Tambah</a>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap w-100" id="datatable">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th style="width: 30px">No.</th>
                                            <th>Nama</th>
                                            <th>Prodi</th>
                                            <th>Jenjang Pendidikan</th>
                                            <th>Semester</th>
                                            <th>Normal Semester</th>
                                            <th>Pass Credit</th>
                                            <th>Mandatory Credit</th>
                                            <th>Choice Credit</th>
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

<!-- Include JS libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('curriculum.index') }}',
            columns: [
                // { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
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
                { data: 'name', name: 'name' },
                { data: 'prodi.nama_prodi', name: 'prodi.nama_prodi' },
                { data: 'education_level.nm_jenj_didik', name: 'education_level.nm_jenj_didik' },
                { data: 'semester.semester_id', name: 'semester.semester_id' },
                { data: 'normal_semester_number', name: 'normal_semester_number' },
                { data: 'pass_credit_number', name: 'pass_credit_number' },
                { data: 'mandatory_credit_number', name: 'mandatory_credit_number' },
                { data: 'choice_credit_number', name: 'choice_credit_number' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
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
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
