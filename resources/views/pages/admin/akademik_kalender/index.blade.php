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
                                    <li class="breadcrumb-item active">Kalender Akademik</li>
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
                                <h4 class="card-title">Tabel Kalender Akademik</h4>
                                <p class="card-title-desc">
                                    Tabel ini menyimpan data tanggal kegiatan Akademik.
                                </p>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('kalender-akademik.create') }}" class="btn btn-primary mb-3">Tambah</a>
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle table-edits table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 35px">No</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Deskripsi</th>
                                                <th>Semester ID</th>
                                                <th>Tipe Kalender</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($datas as $index => $data)
                                                <tr data-id="1">
                                                    <td data-field="id">{{ $index + 1 }}</td>
                                                    <td>{{ $data->start_date }}</td>
                                                    <td>{{ $data->end_date }}</td>
                                                    <td>{{ $data->description }}</td>
                                                    <td>{{ $data->semester ? $data->semester->name : 'N/A' }}</td>
                                                    <td>{{ $data->calendar_type ? $data->calendar_type->name : 'N/A' }}</td>

                                                    <td style="width: 80px">
                                                        <a href="{{ route('kalender-akademik.edit', $data->id) }}"
                                                            class="btn btn-outline-warning btn-sm edit" title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>

                                                        <a href="#" class="btn btn-outline-danger btn-sm delete"
                                                            title="delete"
                                                            onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('delete-form-{{ $data->id }}').submit(); }">
                                                            <i class="fas fa-backspace"></i>
                                                        </a>
                                                        <form id="delete-form-{{ $data->id }}"
                                                            action="{{ route('kalender-akademik.destroy', $data->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                    </td>
                                                </tr>

                                            @empty
                                                <tr>
                                                    <td colspan="11" class="text-center alert alert-danger">Data Masih
                                                        Kosong</td>
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
