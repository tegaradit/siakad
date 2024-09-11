@extends('layouts.home-layout')

@section('home-content')
<style>
   /* Atur layout agar sidebar dan konten utama terpisah dengan baik */
   .wrapper {
      display: flex;
      min-height: 100vh;
   }

   .sidebar {
      width: 250px;
      /* Sesuaikan lebar sidebar */
      background-color: #f8f9fa;
      height: 100%;
      position: fixed;
   }

   .content {
      flex-grow: 1;
      margin-left: 250px;
      /* Margin sama dengan lebar sidebar */
      padding: 20px;
      overflow-x: auto;
      /* Untuk memungkinkan tabel memiliki scroll horizontal */
   }
</style>

<div class="wrapper">
   <!-- Sidebar -->
   <div class="sidebar">
      <li>
         <a href="javascript: void(0);" class="has-arrow">
            <i data-feather="sliders"></i>
            <span data-key="t-tables">Tables</span>
         </a>
         <ul class="sub-menu" aria-expanded="false">
            <li><a href="tables-editable.html" data-key="t-editable-table">All Prodi</a></li>
         </ul>
      </li>
   </div>

   <!-- Main Content -->
   <div class="content">
      <div class="container-fluid" style="margin-top: 70px;">
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header">
                     <h4 class="card-title">Data Prodi</h4>
                     <!-- <p class="card-title-desc">Berikut adalah daftar seluruh program studi yang tersedia.</p> -->
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-bordered" id="prodi-table">
                           <thead>
                              <tr>
                                 <th>ID</th>
                                 <th>Kode</th>
                                 <th>Nama Prodi</th>
                                 <th>Nama Jurusan</th>
                                 <th>Jenjang Pendidikan</th>
                                 <th>SKS Lulus</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                        </table>
                     </div>
                  </div>
               </div>
            </div> <!-- end col -->
         </div> <!-- end row -->
      </div> <!-- container -->
   </div> <!-- content -->
</div> <!-- wrapper -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
      $(document).ready(function() {
         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });

         $('#prodi-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('prodi.data') !!}',
            columns: [
               { data: 'id', name: 'id' },
               { data: 'kode', name: 'kode' },
               { data: 'nama_prodi', name: 'nama_prodi' },
               { data: 'nm_jur', name: 'nm_jur' },
               { data: 'nm_jenj_didik', name: 'nm_jenj_didik' },
               { data: 'sks_lulus', name: 'sks_lulus' },
               { data: 'status', name: 'status' },
            ]
         });
      })
   </script>
@endsection