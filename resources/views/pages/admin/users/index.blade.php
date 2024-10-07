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
                                        <li class="breadcrumb-item active">Pengguna</li>
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
                                    <h4 class="card-title">Pengguna</h4>
                                     <p class="card-title-desc">Berikut adalah daftar pengguna.</p>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mb-3">
                                        <i class="fa-solid fa-square-plus"></i>
                                        Tambah
                                        </a>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>No Telp</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.getUsers') }}",
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'phone_number', name: 'phone_number' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // Handle delete action
            $(document).on('click', '.deleteUser', function() {
                var userId = $(this).data('id');
                if (confirm("Are you sure you want to delete this user?")) {
                    $.ajax({
                        url: '/users/' + userId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(result) {
                            $('#datatable').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection
