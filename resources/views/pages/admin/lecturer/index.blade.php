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
                                    <li class="breadcrumb-item active">Dosen</li>
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
                                <h4 class="card-title">Table Dosen</h4>
                                <p class="card-title-desc">
                                    Table ini berisi code dan nama ruangan perguruan tinggi.
                                </p>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('lecturer.create') }}" class="btn btn-primary mb-3">Tambah</a>
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle table-edits table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NUPTK</th>
                                                <th>NIDN</th>
                                                <th>NIK</th>
                                                <th>active_status_id</th>
                                                <th>birth_date</th>
                                                <th>birth_place</th>
                                                <th>mother_name</th>
                                                <th>mariage_status</th>
                                                <th>employee_level_id</th>
                                                <th>level_education</th>
                                                <th>phone_number</th>
                                                <th>email</th>
                                                <th>assign_letter_number</th>
                                                <th>assign_letter_date</th>
                                                <th>assign_letter_tmt</th>
                                                <th>exit_date</th>
                                                <th>ID Prodi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($lecturers as $index => $data)
                                                <tr data-id="{{ $data->id_sp }}">
                                                    <td data-field="id" style="width: 40px">{{ $index + 1 }}</td>
                                                    <td data-field="nuptk">{{ $data->nuptk ?? 'N/A' }}</td>
                                                    <td data-field="nidn">{{ $data->nidn ?? 'N/A' }}</td>
                                                    <td data-field="nik">{{ $data->nik ?? 'N/A' }}</td>
                                                    <td data-field="active_status_id">{{ $data->active_status_id ?? 'N/A' }}
                                                    </td>
                                                    <td data-field="birth_date">{{ $data->birth_date ?? 'N/A' }}</td>
                                                    <td data-field="birth_place">{{ $data->birth_place ?? 'N/A' }}</td>
                                                    <td data-field="mother_name">{{ $data->mother_name ?? 'N/A' }}</td>
                                                    <td data-field="mariage_status">{{ $data->mariage_status ?? 'N/A' }}
                                                    </td>
                                                    <td data-field="employee_level_id">
                                                        {{ $data->employee_level_id ?? 'N/A' }}</td>
                                                    <td data-field="level_education">{{ $data->level_education ?? 'N/A' }}
                                                    </td>
                                                    <td data-field="phone_number">{{ $data->phone_number ?? 'N/A' }}</td>
                                                    <td data-field="email">{{ $data->email ?? 'N/A' }}</td>
                                                    <td data-field="assign_letter_number">
                                                        {{ $data->assign_letter_number ?? 'N/A' }}</td>
                                                    <td data-field="assign_letter_date">
                                                        {{ $data->assign_letter_date ?? 'N/A' }}</td>
                                                    <td data-field="assign_letter_tmt">
                                                        {{ $data->assign_letter_tmt ?? 'N/A' }}</td>
                                                    <td data-field="exit_date">{{ $data->exit_date ?? 'N/A' }}</td>
                                                    <td data-field="id_prodi">{{ $data->id_prodi ?? 'N/A' }}</td>
                                                    <td style="width: 80px">
                                                        <form id="delete-form-{{ $data->id_sp }}"
                                                            onsubmit="event.preventDefault(); confirmDelete({{ $data->id_sp }});"
                                                            action="{{ route('lecturer.destroy', $data->id_sp) }}"
                                                            method="POST">
                                                            <a href="{{ route('lecturer.edit', $data->id_sp) }}"
                                                                class="btn btn-outline-secondary btn-sm edit"
                                                                title="Edit">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn icon icon-left btn-outline-danger btn-sm delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="18" class="text-center alert alert-danger">Tidak Ada Tabel yang Tersedia</td>
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
