@extends('layouts.home-layout')

@section('home-content')
    <style>
        .radio-group input {
            margin-right: 5px;
            /* Atur jarak antara input dan label */
        }

        .radio-group label {
            margin-right: 15px;
            /* Atur jarak antar kelompok radio */
        }
    </style>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- Start Page Title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18"></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Matakuliah Curriculum</a></li>
                                    <li class="breadcrumb-item active">{{ isset($course) ? 'Edit' : 'Tambah' }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Page Title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ isset($course) ? 'Edit' : 'Tambah' }} Matakuliah Kurikulum:
                                    {{ $curriculum->name }}</h4>
                                <p class="card-title-desc">
                                    Isilah form untuk menambah data mata kuliah.
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Start Form -->
                                    <form method="POST"
                                        action="{{ isset($course) ? route('curriculum_course.update', [$curriculum->curriculum_id, $course->id]) : route('curriculum_course.store', $curriculum->curriculum_id) }}">
                                        @csrf
                                        @if (isset($course))
                                            @method('PUT')
                                        @endif

                                        <!-- Select Course -->
                                        <div class="form-group mb-4">
                                            <label for="status">Matakuliah</label>
                                            <select id="course-selector" name="course_id" class="form-control" required>
                                                <option value="{{ isset($courses) ? $courses[0]->id : '' }}" selected>
                                                    {{ isset($courses) ? $courses[0]->code . ' - ' . $courses[0]->name : '' }}
                                                </option>
                                            </select>
                                        </div>


                                        <!-- Start Two Columns Layout -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Input SMT -->
                                                {{-- <div class="mb-3">
                                                    <label for="smt" class="form-label">Semester</label>
                                                    <input type="number"
                                                        class="form-control @error('smt') is-invalid @enderror"
                                                        id="smt" name="smt"
                                                        value="{{ isset($course) ? $course->smt : old('smt') }}" required>
                                                    @error('smt')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div> --}}

                                                <div class="mb-3">
                                                    <label for="smt" class="form-label">Semester</label>
                                                    <select name="smt" id="smt" class="form-select" required>
                                                        <option value="">Pilih...</option>

                                                        @if ($semester->smt == 1)
                                                            {{-- Jika semester Ganjil --}}
                                                            @for ($i = 1; $i <= 8; $i += 2)
                                                                <option value="{{ $i }}"
                                                                    {{ old('smt', $course->smt ?? '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}</option>
                                                            @endfor
                                                        @elseif ($semester->smt == 2)
                                                            {{-- Jika semester Genap --}}
                                                            @for ($i = 2; $i <= 8; $i += 2)
                                                                <option value="{{ $i }}"
                                                                    {{ old('smt', $course->smt ?? '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}</option>
                                                            @endfor
                                                        @elseif ($semester->smt == 3)
                                                            {{-- Jika semester Pendek (menampilkan semua semester 1-8) --}}
                                                            @for ($i = 1; $i <= 8; $i++)
                                                                <option value="{{ $i }}"
                                                                    {{ old('smt', $course->smt ?? '') == $i ? 'selected' : '' }}>
                                                                    {{ $i }}</option>
                                                            @endfor
                                                        @endif
                                                    </select>
                                                    @error('smt')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Input SKS MK -->
                                                <div class="mb-3">
                                                    <label for="sks_mk" class="form-label">SKS Matakuliah</label>
                                                    <input type="number"
                                                        class="form-control @error('sks_mk') is-invalid @enderror"
                                                        id="sks_mk" name="sks_mk"
                                                        value="{{ isset($course) ? $course->sks_mk : old('sks_mk') }}">
                                                    @error('sks_mk')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Input SKS TM -->
                                                <div class="mb-3">
                                                    <label for="sks_tm" class="form-label">SKS Tatap muka</label>
                                                    <input type="number"
                                                        class="form-control @error('sks_tm') is-invalid @enderror"
                                                        id="sks_tm" name="sks_tm"
                                                        value="{{ isset($course) ? $course->sks_tm : old('sks_tm') }}">
                                                    @error('sks_tm')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <!-- Input SKS PR -->
                                                <div class="mb-3">
                                                    <label for="sks_pr" class="form-label">SKS Praktikum</label>
                                                    <input type="number"
                                                        class="form-control @error('sks_pr') is-invalid @enderror"
                                                        id="sks_pr" name="sks_pr"
                                                        value="{{ isset($course) ? $course->sks_pr : old('sks_pr') }}">
                                                    @error('sks_pr')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Input SKS PL -->
                                                <div class="mb-3">
                                                    <label for="sks_pl" class="form-label">SKS Praktikum Lapangan</label>
                                                    <input type="number"
                                                        class="form-control @error('sks_pl') is-invalid @enderror"
                                                        id="sks_pl" name="sks_pl"
                                                        value="{{ isset($course) ? $course->sks_pl : old('sks_pl') }}">
                                                    @error('sks_pl')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Input SKS SIM -->
                                                <div class="mb-3">
                                                    <label for="sks_sim" class="form-label">SKS Simulasi</label>
                                                    <input type="number"
                                                        class="form-control @error('sks_sim') is-invalid @enderror"
                                                        id="sks_sim" name="sks_sim"
                                                        value="{{ isset($course) ? $course->sks_sim : old('sks_sim') }}">
                                                    @error('sks_sim')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Two Columns Layout -->

                                        <!-- Mandatory Field -->
                                        <div class="mb-3">
                                            <label for="is_mandatory" class="form-label">Apakah Wajib?</label>
                                            <div class="radio-group">
                                                <input class="form-check-input @error('is_mandatory') is-invalid @enderror"
                                                    type="radio" name="is_mandatory" id="mandatory_yes" value="1"
                                                    {{ isset($course) && $course->is_mandatory == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="mandatory_yes">
                                                    Ya
                                                </label>

                                                <input class="form-check-input @error('is_mandatory') is-invalid @enderror"
                                                    type="radio" name="is_mandatory" id="mandatory_no" value="0"
                                                    {{ isset($course) && $course->is_mandatory == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="mandatory_no">
                                                    Tidak
                                                </label>
                                            </div>

                                            @error('is_mandatory')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <br>
                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary">
                                            {{ isset($course) ? 'Ubah' : 'Simpan' }}
                                        </button>
                                    </form>
                                    <!-- End Form -->
                                </div>
                            </div>
                        </div>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // Inisialisasi Select2 untuk memilih course
        $("#course-selector").select2({
            ajax: {
                delay: 250,
                url: '{{ route('curriculum_course.search_course', ['curriculum_id' => $curriculum->curriculum_id]) }}',
                data: function(params) {
                    return {
                        term: params.term, // Pencarian berdasarkan term (course.code)
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id, // Value yang dikirim ke server
                                text: item.text // Text yang ditampilkan (course.code - course.name)
                            };
                        })
                    };
                }
            },
            minimumInputLength: 1, // Mulai pencarian setelah 1 karakter
            placeholder: "Pilih Matakuliah...",
            allowClear: true
        });

        // Event listener untuk menangkap perubahan course_id
        $("#course-selector").on('change', function() {
            var courseId = $(this).val();

            if (courseId) {
                // Lakukan AJAX request ke server untuk mengambil SKS berdasarkan course_id
                $.ajax({
                    url: '{{ route('curriculum_course.get_course_sks') }}', // Route untuk mengambil data SKS
                    type: 'GET',
                    data: {
                        course_id: courseId
                    },
                    success: function(data) {
                        // Isi input SKS berdasarkan response
                        $('#sks_mk').val(data.sks_mk);
                        $('#sks_tm').val(data.sks_tm);
                        $('#sks_pr').val(data.sks_pr);
                        $('#sks_pl').val(data.sks_pl);
                        $('#sks_sim').val(data.sks_sim);
                    },
                    error: function() {
                        alert('Gagal mengambil data SKS. Silakan coba lagi.');
                    }
                });
            }
        });
    </script>
@endsection
