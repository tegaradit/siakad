@extends('layouts.home-layout')

@section('home-content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Mata Kuliah</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Data Perkuliahan</a></li>
                                <li class="breadcrumb-item active">Mata Kuliah</li>
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
                            <h4 class="card-title">Daftar Mata Kuliah</h4>
                            <p class="card-title-desc">Berikut adalah daftar mata kuliah yang tersedia di sistem.</p>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('course.create') }}" class="btn btn-primary mb-3">Tambah Mata Kuliah</a>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle table-edits table-bordered nowrap" id="course-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Prodi</th>
                                            <th>Education Level</th>
                                            <th>Group_id</th>
                                            <th>Type_id</th>
                                            <th>sks_mk</th>
                                            <th>sks_tm</th>
                                            <th>sks_pr</th>
                                            <th>sks_pl</th>
                                            <th>sks_sim</th>
                                            <th>status</th>
                                            <th>is_sap</th>
                                            <th>is_silabus</th>
                                            <th>is_teaching_material</th>
                                            <th>is_praktikum</th>
                                            <th>effective_starts_date</th>
                                            <th>effective_end_date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                                <!-- Pagination will be handled by DataTables -->
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
                    <script>document.write(new Date().getFullYear());</script> © Minia.
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

<!-- Include JS libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#course-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('course.index') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'code', name: 'code' },
                { data: 'name', name: 'name' },
                { data: 'prodi.name', name: 'prodi.name' },
                { data: 'education_level.nm_jenj_didik', name: 'education_level.nm_jenj_didik' },
                { data: 'course_group.name', name: 'course_group.name' },
                { data: 'course_type.name', name: 'course_type.name' },
                { data: 'sks_mk', name: 'sks_mk' },
                { data: 'sks_tm', name: 'sks_tm' },
                { data: 'sks_pr', name: 'sks_pr' },
                { data: 'sks_pl', name: 'sks_pl' },
                { data: 'sks_sim', name: 'sks_sim' },
                { data: 'status', name: 'status' },
                { data: 'is_sap', name: 'is_sap' },
                { data: 'is_silabus', name: 'is_silabus' },
                { data: 'is_teaching_material', name: 'is_teaching_material' },
                { data: 'is_praktikum', name: 'is_praktikum' },
                { data: 'effective_start_date', name: 'effective_start_date' },
                { data: 'effective_end_date', name: 'effective_end_date' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            columnDefs: [
                { targets: [0], className: 'text-center' }, // Center align No column
                { targets: [18], className: 'text-center' } // Center align Action column
            ],
            "language": {
                "emptyTable": "Data Mata Kuliah Kosong"
            }
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
