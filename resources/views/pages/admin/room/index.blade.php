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
                                    <li class="breadcrumb-item active">Ruangan</li>
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
                                <h4 class="card-title">Table Ruangan</h4>
                                <p class="card-title-desc">
                                    Table ini berisi code dan nama ruangan perguruan tinggi.
                                </p>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('room.create') }}" class="btn btn-primary">Tambah Ruangan</a>
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle table-edits table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Nama Ruangan</th>
                                                <th>Posisi Lantai</th>
                                                <th>ID Gedung</th>
                                                <th>Kapasitas</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($rooms as $index => $data)
                                                <tr data-id="{{ $data->id }}">
                                                    <td data-field="id" style="width: 40px">{{ $index + 1 }}</td>
                                                    <td data-field="code">{{ $data->code }}</td>
                                                    <td data-field="name">{{ $data->name }}</td>
                                                    <td data-field="floor_position">{{ $data->floor_position }}</td>
                                                    <td data-field="building_id">{{ $data->building->name ?? 'N/A' }}</td>
                                                    <td data-field="capacity">{{ $data->capacity }}</td>
                                                    <td style="width: 80px">
                                                        <a href="{{ route('room.edit', $data->id) }}"
                                                            class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center alert alert-danger">Tidak ada data ruangan tersedia.</td>
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
