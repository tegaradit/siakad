@extends('layouts.home-layout')

@section('home-content')
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18">Periode Penerimaan Mahasiswa Baru</h4>

                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Perkuliahan</a></li>
                        <li class="breadcrumb-item active">Periode Penerimaan Mahasiswa Baru</li>
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
                     <h4 class="card-title">Daftar Periode Penerimaan Mahasiswa Baru</h4>
                     <p class="card-title-desc">Berikut adalah daftar Periode Penerimaan Mahasiswa Baru yang tersedia di sistem.</p>
                  </div>
                  <div class="card-body">
                     <a href="{{ route('periode_pmb.create') }}" class="btn btn-primary mb-3">
                        <i data-feather="plus-square"></i>
                        Tambah
                     </a>
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap w-100" id="periodePmb-table">
                           <thead>
                              <tr>
                                 <th>Kode Semester</th>
                                 <th>Gelombang Pendaftaran</th>
                                 <th>Tanggal Mulai</th>
                                 <th>Tanggal Selesai</th>
                                 <th>Status</th>
                                 <th>Aksi</th>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   $(document).ready(function () {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

      $('#periodePmb-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{{ route('periode_pmb.index') }}',
         columns: [
            { data: 'semester_id', name: 'kode semester', orderable: false },
            { data: 'period_number', name: 'Gelombang Pendaftaran' },
            { data: 'start_date', name: 'tanggal mulai' },
            { data: 'end_date', name: 'tanggal selesai' },
            { 
               data: 'status', 
               name: 'status',
               render (data, _, row) {
                  return data == 1 ? 
                     `
                     <form action="{{ route('periode_pmb.toggle_status') }}?id=${row.id}" method="post">
                        <input value="{{ csrf_token() }}" type="hidden" name="_token" />
                        {{ method_field('put') }}
                        <button type="submit" style="outline: none; border: none; background: none">
                           <i class="fas fa-key text-info"></i>
                           buka
                        </button>
                     </form>
                     ` 
                     : 
                     `
                     <form action="{{ route('periode_pmb.toggle_status') }}?id=${row.id}" method="post">
                        <input value="{{ csrf_token() }}" type="hidden" name="_token" />
                        {{ method_field('put') }}
                        <button type="submit" style="outline: none; border: none; background: none">
                           <i class="fas fa-lock text-danger"></i>
                           tutup
                        </button>
                     </form>
                     `
               }
            },
            { data: 'action', name: 'action', orderable: false, searchable: false }
         ],
         columnDefs: [
            { targets: [0, 1, 2, 3, 4, 5], className: 'text-center' }, 
         ],
         language: {
            emptyTable: "Data Penerimaan Mahasiswa Baru Kosong"
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