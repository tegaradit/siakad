@extends('layouts.home-layout')
@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Tipe Register</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Data Siswa</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Tipe Register
                                    </li>
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
                                <h4 class="card-title">Tabel Tipe Register</h4>
                                <p class="card-title-desc">
                                    Tabel ini menyimpan data Tipe Register yang ada di
                                    sistem.
                                </p>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal"
                                    data-bs-target="#myModal">
                                    <i class="fa-solid fa-square-plus"></i>
                                    Tambah
                                </button>

                                <!-- Modal untuk menambah tipe mahasiswa -->
                                <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                                    aria-hidden="true" data-bs-scroll="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Tambah Tipe Register</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="RegisterTypeForm" action="{{ route('register-type.store') }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama Tipe Register</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" required>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="button" class="btn btn-primary"
                                                    id="saveButton">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal untuk Edit Tipe Register -->
                                <div id="editRegisterTypeModal" class="modal fade" tabindex="-1"
                                    aria-labelledby="editRegisterTypeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editRegisterTypeModalLabel">Edit Tipe Register</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editRegisterTypeForm" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" id="edit_id" name="id">
                                                    <div class="mb-3">
                                                        <label for="edit_name" class="form-label">Nama Tipe Register</label>
                                                        <input type="text" class="form-control" id="edit_name"
                                                            name="name" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <div class="table-responsive">
                                    <table id="datatable"
                                        class="table table-striped table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr style="text-align: center">
                                                <th style="width: 20px">No</th>
                                                <th>Nama Tipe Register</th>
                                                <th style="width: 50px">Aksi</th>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script>
        $(document).ready(function() {
            $("#saveButton").on("click", function() {
                var formData = $("#RegisterTypeForm").serialize();

                $.ajax({
                    type: "POST",
                    url: $("#RegisterTypeForm").attr("action"),
                    data: formData,
                    success: function(response) {
                        $("#myModal").modal("hide");
                        $("#datatable").DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan saat menambahkan Tipe Register.");
                        console.error(xhr);
                    }
                });
            });

            $('#myModal').on('hidden.bs.modal', function() {
                $("#RegisterTypeForm")[0].reset();
            });

            $("#datatable").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('register-type.data') }}",
                columns: [{
                        data: null,
                        name: "no",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart +
                                1;
                        },
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css("text-align", "center");
                        },
                    },
                    {
                        data: "name",
                        name: "name",
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false,
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css("text-align", "center");
                        },
                    },
                ],
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

    <script>
        $(document).ready(function() {
            $("#addRegisterTypeForm").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $("#datatable").DataTable().ajax.reload();
                        $("#myModal").modal("hide");
                        alert(response.success);
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan saat menambahkan Tipe Register.");
                    },
                });
            });

            $("#editRegisterTypeForm").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('register-type.update', ':id') }}'.replace(
                        ":id",
                        $("#edit_id").val()
                    ),
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $("#datatable").DataTable().ajax.reload();
                        $("#editRegisterTypeModal").modal("hide");
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan saat memperbarui Tipe Register.");
                    },
                });
            });

            $(document).on("click", ".edit", function() {
                var id = $(this).data("id");
                var name = $(this).data("name");

                $("#edit_id").val(id);
                $("#edit_name").val(name);
            });
        });
    </script>
@endsection
