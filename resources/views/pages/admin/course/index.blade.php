@extends('layouts.home-layout')

@section('home-content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Mata Kuliah</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Data Perkuliahan</a></li>
                                <li class="breadcrumb-item active">Mata Kuliah</li>
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
                            <h4 class="card-title">Daftar Mata Kuliah</h4>
                            <p class="card-title-desc">Berikut adalah daftar mata kuliah yang tersedia di sistem.</p>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('course.create') }}" class="btn btn-primary mb-3">Tambah Mata Kuliah</a>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle table-edits table-bordered nowrap">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      {{-- <th>Course_id</th> --}}
                                      <th>Code</th>
                                      <th>Name</th>
                                      <th>Prodi</th>
                                      <th>Education Level</th>
                                      <th>Group_id</th>
                                      <th>Type_id</th>
                                      <th>sks_mk</th>
                                      <th>sks_tm</th>
                                      <th>sks_pr</th>
                                      <th>sks_pl</th>
                                      <th>sks_sim</th>
                                      <th>status</th>
                                      <th>is_sap</th>
                                      <th>is_silabus</th>
                                      <th>is_teaching_material</th>
                                      <th>is_praktikum</th>
                                      <th>effective_starts_date</th>
                                      <th>effective_end_date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @forelse ($datas as $index => $data)
                                      <tr data-id="{{ $data->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->code }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->prodi->name ?? 'N/A' }}</td>
                                        <td>{{ $data->education_level->nm_jenj_didik ?? 'N/A' }}</td>
                                        <td>{{ $data->course_group->name ?? 'N/A' }}</td>
                                        <td>{{ $data->course_type->name ?? 'N/A' }}</td>
                                        <td>{{ $data->sks_mk }}</td>
                                        <td>{{ $data->sks_tm }}</td>
                                        <td>{{ $data->sks_pr }}</td>
                                        <td>{{ $data->sks_pl }}</td>
                                        <td>{{ $data->sks_sim }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>{{ $data->is_sap ? 'Yes' : 'No' }}</td>
                                        <td>{{ $data->is_silabus ? 'Yes' : 'No' }}</td>
                                        <td>{{ $data->is_teaching_material ? 'Yes' : 'No' }}</td>
                                        <td>{{ $data->is_praktikum ? 'Yes' : 'No' }}</td>
                                        <td>{{ $data->effective_start_date }}</td>
                                        <td>{{ $data->effective_end_date }}</td>
                                        <td>
                                          {{-- <!-- Add your action buttons here -->
                                          <a href="{{ route('course.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                                          <!-- Delete form -->
                                          <form action="{{ route('course.destroy', $data->id) }}" method="POST" style="display:inline;">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger">Delete</button>
                                          </form>  --}}
                                          <form id="delete-form-{{ $data->id }}"
                                            onsubmit="event.preventDefault(); confirmDelete({{ $data->id }});"
                                            action="{{ route('course.destroy', $data->id) }}" method="POST">
                                            <a href="{{ route('course.edit', $data->id) }}"
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
                                        <td colspan="20" class="text-center alert alert-danger">Data Mata Kuliah Kosong</td>
                                      </tr>
                                    @endforelse
                                  </tbody>                                  
                                </table>
                                <!-- Pagination -->
                                {{ $datas->links() }}
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
