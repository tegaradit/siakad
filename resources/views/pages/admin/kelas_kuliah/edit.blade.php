@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Kelas Kuliah</h4>
                </div>

                <!-- Form to edit Kelas Kuliah -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kelas_kuliah.update', $kelasKuliah->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Method PUT for updating data -->

                            <!-- Prodi ID field -->
                            <div class="form-group">
                                <label for="prodi_id">Prodi ID</label>
                                <input type="text" name="prodi_id" class="form-control" value="{{ old('prodi_id', $kelasKuliah->prodi_id) }}" required>
                                @error('prodi_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Semester ID field -->
                            <div class="form-group">
                                <label for="semester_id">Semester ID</label>
                                <input type="text" name="semester_id" class="form-control" value="{{ old('semester_id', $kelasKuliah->semester_id) }}" required>
                                @error('semester_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Course ID field -->
                            <div class="form-group">
                                <label for="course_id">Course ID</label>
                                <input type="text" name="course_id" class="form-control" value="{{ old('course_id', $kelasKuliah->course_id) }}" required>
                                @error('course_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nama Kelas field -->
                            <div class="form-group">
                                <label for="nama_kelas">Nama Kelas</label>
                                <input type="text" name="nama_kelas" class="form-control" value="{{ old('nama_kelas', $kelasKuliah->nama_kelas) }}" required>
                                @error('nama_kelas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jenis Kelas field -->
                            <div class="form-group">
                                <label for="jenis_kelas">Jenis Kelas</label>
                                <input type="text" name="jenis_kelas" class="form-control" value="{{ old('jenis_kelas', $kelasKuliah->jenis_kelas) }}" required>
                                @error('jenis_kelas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- SKS field -->
                            <div class="form-group">
                                <label for="bobot">Bobot (SKS)</label>
                                <input type="number" name="bobot" class="form-control" value="{{ old('bobot', $kelasKuliah->bobot) }}" required>
                                @error('bobot')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Quota field -->
                            <div class="form-group">
                                <label for="quota">Quota</label>
                                <input type="number" name="quota" class="form-control" value="{{ old('quota', $kelasKuliah->quota) }}" required>
                                @error('quota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary mt-3">Update Kelas</button>
                        </form>
                    </div>
                </div>
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
@endsection
