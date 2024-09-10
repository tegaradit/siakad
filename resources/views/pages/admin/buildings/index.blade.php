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
                    <a href="javascript: void(0);">Data Umum</a>
                  </li>
                  <li class="breadcrumb-item active">Gedung</li>
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
                <h4 class="card-title">Table Gedung</h4>
                <p class="card-title-desc">
                  Table ini berisi code dan nama gedung perguruan tinggi.
                </p>
              </div>
              <div class="card-body">
                <a href="{{ route('buildings.create') }}" class="btn btn-primary mb-3">Tambah Gedung</a>
                <div class="table-responsive">
                  <table class="table table-nowrap align-middle table-bordered" id="datatable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($datas as $index => $data)
                        <tr data-id="1">
                          <td data-field="id" style="width: 40px">{{ $index+1 }}</td>
                          <td data-field="name">{{ $data->code }}</td>
                          <td data-field="age">{{ $data->name }}</td>
                          <td style="width: 80px">
                            {{-- <a href="{{ route('buildings.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                            <!-- Delete form -->
                            <form action="{{ route('buildings.destroy', $data->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>  --}}
                            <form id="delete-form-{{ $data->id }}"
                              onsubmit="event.preventDefault(); confirmDelete({{ $data->id }});"
                              action="{{ route('buildings.destroy', $data->id) }}" method="POST">
                              <a href="{{ route('buildings.edit', $data->id) }}"
                                  class="btn btn-outline-warning btn-sm edit"
                                  title="Edit">
                                  <i class="fas fa-pencil-alt"></i>
                              </a>
                              @csrf
                              @method('DELETE')
                              <button
                                  type="submit"class="btn icon icon-left btn-outline-danger btn-sm delete"><i
                                      class="fas fa-trash-alt"></i></button>
                          </form>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="4" class="text-center alert alert-danger">Data Gedung Kosong</td>
                        </tr>
                      @endforelse
                    </tbody>
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