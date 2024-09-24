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
                                        <li class="breadcrumb-item active">Tipe Kalender</li>
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
                                    <h4 class="card-title">Tabel Tipe Kalender</h4>
                                    <p class="card-title-desc">
                                        Tabel ini menyimpan data tipe dari kalender akademik.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('calendar-type.create') }}" class="btn btn-primary btn-sm mb-3"><i data-feather="plus-square"></i>Tambah</a>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                                            <thead>
                                                <tr style="text-align: center">
                                                    <th style="width: 30px" style="text-align: center">No</th>
                                                    <th>Nama Tipe Kalender</th>
                                                    <th style="width: 50px text-align: center">Action</th>
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
                            </script>
                            © Minia.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by
                                <a href="#!" class="text-decoration-underline">Themesbrand</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
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
                    ajax: "{{ route('calendar-type.data') }}",
                    columns: [{
                            data: null,
                            name: 'no',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart +
                                    1; // nomor urut yang dinamis
                            },
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('text-align', 'center');
                            }
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('text-align', 'center');
                            }
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
