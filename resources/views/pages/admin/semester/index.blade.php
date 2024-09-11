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
                            <h4 class="card-title">Tabel Semester</h4>
                            <p class="card-title-desc">
                                Tabel ini berisi data semester.
                            </p>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('semester.create') }}" class="btn btn-primary mb-3">Tambah Semester</a>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-midle table-bordered" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Semester ID</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>SMT</th>roo
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($datas as $index => $data)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ $data->semester_id }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>
                                                    @switch($data->smt)
                                                        @case(1) Ganjil @break
                                                        @case(2) Genap @break
                                                        @case(3) Pendek @break
                                                    @endswitch
                                                </td>
                                                <td>{{ $data->is_active ? 'Active' : 'Inactive' }}</td>
                                                <td>{{ $data->start_date }}</td>
                                                <td>{{ $data->end_date }}</td>
                                                <td>
                                                    <form id="delete-form-{{ $data->semester_id }}"
                                                        onsubmit="event.preventDefault(); confirmDelete({{ $data->semester_id }});"
                                                        action="{{ route('semester.destroy', $data->semester_id) }}" method="POST">
                                                        <a href="{{ route('semester.edit', $data->semester_id) }}" class="btn btn-outline-warning btn-sm edit" title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn icon icon-left btn-outline-danger btn-sm delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>                                                    
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center alert alert-danger">Data Semester Kosong</td>
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
