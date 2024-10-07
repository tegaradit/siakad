@extends('layouts.home-layout')

@section('home-content')

<body>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="wrapper">
                    <header class="header">
                        <div class="container">
                            <h1 class="header-title">Tambah Kelas Kuliah</h1>
                        </div>
                    </header>

                    <main class="container">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('kelas_kuliah.store') }}" method="POST" class="form">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="prodi_id" class="form-label">Prodi</label>
                                <input type="text" class="form-control" id="prodi_id" name="prodi_id" value="{{ old('prodi_id') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="semester_id" class="form-label">Semester</label>
                                <input type="text" class="form-control" id="semester_id" name="semester_id" value="{{ old('semester_id') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                            </div>

                            <!-- Tambahkan input lain sesuai atribut yang tersisa -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('kelas_kuliah.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
        <script src="{{ asset('minia/js/minia.min.js') }}"></script>
    </div>
</body>

@endsection
