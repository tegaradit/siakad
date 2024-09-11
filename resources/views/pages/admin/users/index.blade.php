@extends('layouts.home-layout')

@section('home-content')
    <div class="container-fluid table-responsive">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">DataTables</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- DataTables -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Users Table</h4>
                        <p class="card-title-desc">Manage your users here.</p>
                        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DataTables will populate this -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>

    <!-- Scripts -->
    <script src="minia/assets/libs/jquery/jquery.min.js"></script>
    <script src="minia/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="minia/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="minia/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="minia/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="minia/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="minia/assets/libs/jszip/jszip.min.js"></script>
    <script src="minia/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="minia/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="minia/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="minia/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="minia/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="minia/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="minia/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Custom Scripts -->
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
