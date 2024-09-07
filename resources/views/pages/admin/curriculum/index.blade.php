@extends('layouts.home-layout')

$@section('home-content')
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
                  <li class="breadcrumb-item active">Kurikulum</li>
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
                <h4 class="card-title">Table Kurikulum</h4>
                <p class="card-title-desc">
                  Table ini berisi data kurikulum yang ada.
                </p>
              </div>
              <div class="card-body">
                {{-- <a href="{{ route('course.create') }}" class="btn btn-primary">Tambah Mata Kuliah</a> --}}
                <div class="table-responsive">
                  <table class="table table-nowrap align-middle table-edits table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>curriculum_id</th>
                        <th>Prodi_id</th>
                        <th>Education_level_id</th>
                        <th>Semester_id</th>
                        <th>Name</th>
                        <th>Normal_semester_number</th>
                        <th>Pass_credit_number</th>
                        <th>Mandatory_credit_number</th>
                        <th>Choice_credit_number</th>
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
                              <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                              </a>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="11" class="text-center alert alert-danger">Data Kurikulum Kosong</td>
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
@endsection