@extends('layouts.home-layout')

@section('home-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="main-content">
   <div class="page-content">
      @if (session('success'))
         <div class="alert alert-success mb-5" role="alert">
            {{ session('success') }}
         </div>
      @endif

      <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18"></h4>

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
                     <h4 class="card-title">Data Perwalian / KRS</h4>
                     <p class="card-title-desc">Berikut adalah data KRS yang tersedia di sistem.</p>
                  </div>
                  <div class="card-body">
                     <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm mb-3">
                        <i class="fa-solid fa-square-plus"></i>
                        Tambah
                     </a>
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap w-100"
                           id="krs-table">
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
                                 <th>Action</th>
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

   <footer class="footer">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-6">
               <script>
                  document.write(new Date().getFullYear());
               </script> © Minia.
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
@endsection