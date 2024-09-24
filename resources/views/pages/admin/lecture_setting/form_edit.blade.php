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
                                    <li class="breadcrumb-item active">Edit Setting Perkuliahan</li>
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
                                <h4 class="card-title">Form Edit Setting Perkuliahan</h4>
                                <p class="card-title-desc">
                                    Edit data konfigurasi maksimal dan minimal pertemuan untuk setiap prodi.
                                </p>
                            </div>

                            <div class="card-body">
                                <!-- Tampilkan pesan error jika ada -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Form Edit -->
                                <form action="{{ route('lecture-setting.update', $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Method PUT untuk update data -->

                                    <div class="form-group">
                                        <label for="prodi_id">Pilih Program Studi</label>
                                        <select name="prodi_id" id="prodi_id" class="form-control">
                                            <option value="">-- Pilih Program Studi --</option>
                                            @foreach ($prodis as $prodi)
                                                <option value="{{ $prodi->id_prodi }}"
                                                    {{ $data->prodi_id == $prodi->id_prodi ? 'selected' : '' }}>
                                                    {{ $prodi->nama_prodi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('prodi_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="max_number_of_meets" class="form-label">Maks Jumlah Pertemuan</label>
                                        <input type="number" class="form-control" id="max_number_of_meets"
                                            name="max_number_of_meets" value="{{ $data->max_number_of_meets }}"
                                            placeholder="Masukkan Maks Jumlah Pertemuan" required>
                                        @error('max_number_of_meets')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="min_number_of_presence" class="form-label">Min Jumlah Kehadiran</label>
                                        <input type="number" class="form-control" id="min_number_of_presence"
                                            name="min_number_of_presence" value="{{ $data->min_number_of_presence }}"
                                            placeholder="Masukkan Min Jumlah Kehadiran" required>
                                        @error('min_number_of_presence')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="is_prodi" class="form-label">Is Prodi</label>
                                        <select class="form-select" id="is_prodi" name="is_prodi" required>
                                            <option value="1" {{ $data->is_prodi ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ !$data->is_prodi ? 'selected' : '' }}>No</option>
                                        </select>
                                        @error('is_prodi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
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
