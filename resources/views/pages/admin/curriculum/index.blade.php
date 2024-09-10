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
                            <h4 class="card-title">Tabel Kurikulumm</h4>
                            <p class="card-title-desc">Tabel ini berisi data kurikulum.</p>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('curriculum.create') }}" class="btn btn-primary mb-3">Tambah Kurikulum</a>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle table-bordered" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Prodi</th>
                                            <th>Jenjang Pendidikan</th>
                                            <th>Semester</th>
                                            <th>Normal Semester</th>
                                            <th>Pass Credit</th>
                                            <th>Mandatory Credit</th>
                                            <th>Choice Credit</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($datas as $index => $data)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->prodi->name }}</td>
                                                <td>{{ $data->education_level->nm_jenj_didik }}</td>
                                                <td>{{ $data->semester->name }}</td>
                                                <td>{{ $data->normal_semester_number }}</td>
                                                <td>{{ $data->pass_credit_number }}</td>
                                                <td>{{ $data->mandatory_credit_number }}</td>
                                                <td>{{ $data->choice_credit_number }}</td>
                                                <td>
                                                    <form id="delete-form-{{ $data->curriculum_id }}"
                                                        onsubmit="event.preventDefault(); confirmDelete('{{ $data->curriculum_id }}');"
                                                        action="{{ route('curriculum.destroy', $data->curriculum_id) }}" method="POST">
                                                        <a href="{{ route('curriculum.edit', $data->curriculum_id) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>                                                    
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center alert alert-danger">Data Kurikulum kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        feather.replace();
    });

    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
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