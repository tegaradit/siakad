@extends('layouts.home-layout')

@section('home-content')
    <style>
        .radio-group input {
            margin-right: 5px;
        }

        .radio-group label {
            margin-right: 15px;
        }
    </style>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                {{-- start page title --}}
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18"></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('aktivitas-mahasiswa.index') }}">Aktivitas Mahasiswa</a>
                                    </li>
                                    <li class="breadcrumb-item active">Tambah</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end page title --}}

                <!-- Form to create a new course -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Aktivitas Mahasiswa</h4>
                                <p class="card-title-desc">
                                    Isilah form untuk menambah data Aktivitas Mahasiswa.
                                </p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('aktivitas-mahasiswa.store') }}" method="POST">
                                    @csrf

                                    <div class="mb-3 row">
                                        <label for="semester_id" class="col-md-2 col-form-label text-end">Semester:</label>
                                        <div class="col-md-10">
                                            <select class="form-control" id="semester_id" name="semester_id" required>
                                                <option value="" disabled {{ isset($data) ? '' : 'selected' }}>
                                                    Pilih Semester
                                                </option>
                                                @forelse ($semesters as $semester)
                                                    <option value="{{ $semester->semester_id }}"
                                                        {{ (isset($data) && $data->semester_id == $semester->semester_id) || (!isset($data) && isset($active_semester) && $active_semester->semester_id == $semester->semester_id) ? 'selected' : '' }}>
                                                        {{ $semester->name }}
                                                    </option>
                                                @empty
                                                    <option value="" disabled>Tidak ada semester tersedia</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-5 row">
                                        <label for="nipd" class="col-md-2 col-form-label text-end">NIPD:</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" id="nipd" name="nipd"
                                                required>
                                        </div>

                                        <label for="mahasiswa" class="col-md-2 col-form-label text-end">Mahasiswa:</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="mahasiswa" name="mahasiswa"
                                                required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="location" class="col-md-2 col-form-label text-end">Lokasi:</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="location" name="location">
                                        </div>

                                        <label for="sk_number" class="col-md-2 col-form-label text-end">Nomor SK:</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="sk_number" name="sk_number">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="sk_date" class="col-md-2 col-form-label text-end">Tanggal SK:</label>
                                        <div class="col-md-4">
                                            <input type="date" class="form-control" id="sk_date" name="sk_date"
                                                required>
                                        </div>

                                        <label for="activity_type_id" class="col-md-2 col-form-label text-end">Jenis
                                            Aktivitas:</label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="activity_type_id" name="activity_type_id"
                                                required>
                                                <option value="" disabled selected>Pilih Jenis Aktivitas</option>
                                                @foreach ($activity_types as $activity_type)
                                                    <option value="{{ $activity_type->id }}">{{ $activity_type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="description" class="col-md-2 col-form-label text-end">Deskripsi:</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="description" name="description">
                                        </div>
                                    </div>

                                    {{-- Submit Button --}}
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Form -->
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
