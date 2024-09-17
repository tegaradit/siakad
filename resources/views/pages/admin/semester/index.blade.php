@extends('layouts.home-layout')

@section('home-content')
<style>
    #datatable td, #datatable th {
        text-align: center; /* This applies to all table headers and cells */
    }
</style>
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
                                <li class="breadcrumb-item active">Semester</li>
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
                            <h4 class="card-title">Daftar Semester</h4>
                            <p class="card-title-desc">Berikut adalah daftar semester yang tersedia di sistem.</p>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('semester.create') }}" class="btn btn-primary mb-3">Tambah</a>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap w-100" id="datatable">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th style="width: 30px">No.</th>
                                            <th>Semester ID</th>
                                            <th>Nama</th>
                                            <th>Tipe</th>
                                            <th>SMT</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Berhenti</th>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('semester.data') }}',
            columns: [
                { 
                    data: null, 
                    name: 'no',
                    orderable: false, 
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1; // nomor urut yang dinamis
                    },
                    // createdCell: function (td, cellData, rowData, row, col) {
                    //     $(td).css('text-align', 'center'); // Align center
                    // }
                },
                { data: 'semester_id', name: 'semester_id' },
                { data: 'name', name: 'name' },
                { data: 'smt', name: 'smt' },
                { data: 'is_active', name: 'is_active' },
                { 
                    data: 'start_date', 
                    name: 'start_date',
                    render: function (data, type, row) {
                        if (data) {
                            var date = new Date(data);
                            return ("0" + date.getDate()).slice(-2) + "/" + 
                                ("0" + (date.getMonth() + 1)).slice(-2) + "/" + 
                                date.getFullYear();
                        }
                        return '';
                    }
                },
                { 
                    data: 'end_date', 
                    name: 'end_date',
                    render: function (data, type, row) {
                        if (data) {
                            var date = new Date(data);
                            return ("0" + date.getDate()).slice(-2) + "/" + 
                                ("0" + (date.getMonth() + 1)).slice(-2) + "/" + 
                                date.getFullYear();
                        }
                        return '';
                    }
                },
                { 
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false, 
                }
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
