@extends('layouts.home-layout')

@section('home-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18">Data Mahasiswa</h4>

                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Perkuliahan</a></li>
                        <li class="breadcrumb-item active">Data Mahasiswa</li>
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
                     <h4 class="card-title">Daftar Mahasiswa</h4>
                     <p class="card-title-desc">Berikut adalah daftar Mahasiswa yang tersedia di sistem.</p>
                  </div>
                  <div class="card-body">
                     <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm mb-3">
                        <i class="fa-solid fa-square-plus"></i>
                        Tambah
                     </a>
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap w-100" id="mahasiswa-table">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>NPM</th>
                                 <th>Nama</th>
                                 <th>Angkatan</th>
                                 <th>Jenis Klamin</th>
                                 <th>Tempat Lahir</th>
                                 <th>Tanggal Lahir</th>
                                 <th>Program Studi</th>
                                 <th>Jenis/Kelas</th>
                                 <th>Status</th>
                                 <!-- <th>SINK</th> -->
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   $(document).ready(function () {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

      $('#mahasiswa-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{{ route('mahasiswa.index') }}',
         columns: [
            {
               data: null,
               name: 'no',
               orderable: false,
               searchable: false,
               className: 'text-center',
               render: function(data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart +
                     1; // nomor urut yang dinamis
               }
            },
            { data: 'NPM', name: 'NPM', orderable: false },
            { data: 'Nama', name: 'Nama' },
            { data: 'Angkatan', name: 'Angkatan' },
            { data: 'JenisKelamin', name: 'JenisKelamin' },
            { data: 'TempatLahir', name: 'TempatLahir' },
            { data: 'TanggalLahir', name: 'TanggalLahir' },
            { data: 'ProgramStudi', name: 'ProgramStudi' },
            { data: 'Jenis', name: 'Jenis' },
            {
               data: 'StatusData', 
               name: 'StatusData',
               render (data, _, row) {
                  return data != 0 ? 
                     `
                     <button class="btn btn-info" style="outline: none; border: none;">
                        Aktif
                     </button>
                     ` 
                     : 
                     `
                     <button class="btn btn-danger" style="outline: none; border: none;">
                        Tidak Aktif
                     </button>
                     `
               }
            },
            { data: 'action', name: 'action', orderable: false, searchable: false }
         ],
         columnDefs: [
            { targets: [0, 1, 2, 3, 4, 5, 6, 7], className: 'text-center' }, 
         ],
         language: {
            emptyTable: "Data Mahasiswa Masih Kosong"
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