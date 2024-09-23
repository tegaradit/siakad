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
                {{-- Start page title --}}
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18"></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('curriculum.index') }}">Curriculum</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ isset($curriculum) ? 'Edit' : 'Tambah' }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End page title --}}

                <!-- Form to create or edit a curriculum -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ isset($curriculum) ? 'Edit Curriculum' : 'Tambah Curriculum' }}
                                </h4>
                                <p class="card-title-desc">
                                    Isilah form untuk {{ isset($curriculum) ? 'mengedit' : 'menambah' }} data curriculum.
                                </p>
                            </div>
                            <div class="card-body">
                                <form
                                    action="{{ isset($curriculum) ? route('curriculum.update', $curriculum->curriculum_id) : route('curriculum.store') }}"
                                    method="POST">
                                    @csrf
                                    @if (isset($curriculum))
                                        @method('PUT')
                                    @endif

                                    <!-- Prodi field -->
                                    <div class="form-group mt-2">
                                        <label for="prodi_id">Prodi</label>
                                        <select name="prodi_id" id="prodi_id" class="form-control" required>
                                            <option value="" selected>Pilih Prodi</option>
                                            @foreach ($prodi as $p)
                                                <option value="{{ $p->id_prodi }}"
                                                    {{ old('prodi_id', $curriculum->prodi_id ?? 'null') == $p->id_prodi ? 'selected' : '' }}>
                                                    {{ $p->nama_prodi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('prodi_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <!-- Education Level field -->
                                    <div class="form-group mt-2">
                                        <label for="education_level_id">Tingkat Pendidikan</label>
                                        <select id="level-selector" name="education_level_id" class="form-control" required>
                                            <option value="{{ isset($curriculum) ? $curriculum->education_level_id : '' }}">
                                                {{ isset($curriculum) ? $curriculum->education_level->nm_jenj_didik : 'Pilih Tingkat Pendidikan' }}
                                            </option>
                                        </select>
                                        @error('education_level_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>

                                    <!-- Semester field -->
                                    <div class="form-group mt-2">
                                        <label for="semester_id">Kode Semester</label>
                                        <select id="semester-selector" name="semester_id" class="form-control" required>
                                            <option value="{{ isset($curriculum) ? $curriculum->semester_id : '' }}">
                                                {{ isset($curriculum) ? $curriculum->semester->name : 'Pilih Semester' }}
                                            </option>
                                        </select>
                                        @error('semester_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br>


                                    <!-- Curriculum Name field -->
                                    <div class="form-group mt-2">
                                        <label for="name">Nama Kurikulum</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name', $curriculum->name ?? '') }}" maxlength="200" required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div><br>

                                    <!-- Normal Semester Number field -->
                                    <div class="form-group mt-2">
                                        <label for="normal_semester_number">Nomor Semester Normal</label>
                                        <input type="number" name="normal_semester_number" id="normal_semester_number"
                                            class="form-control"
                                            value="{{ old('normal_semester_number', $curriculum->normal_semester_number ?? '') }}"
                                            required>
                                        @error('normal_semester_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div><br>

                                    <!-- Pass Credit Number field -->
                                    <div class="form-group mt-2">
                                        <label for="pass_credit_number">Jumlah SKS Kelulusan</label>
                                        <input type="number" name="pass_credit_number" id="pass_credit_number"
                                            class="form-control"
                                            value="{{ old('pass_credit_number', $curriculum->pass_credit_number ?? '') }}"
                                            required>
                                        @error('pass_credit_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div><br>

                                    <!-- Mandatory Credit Number field -->
                                    <div class="form-group mt-2">
                                        <label for="mandatory_credit_number">Jumlah SKS Wajib</label>
                                        <input type="number" name="mandatory_credit_number" id="mandatory_credit_number"
                                            class="form-control"
                                            value="{{ old('mandatory_credit_number', $curriculum->mandatory_credit_number ?? '') }}"
                                            required>
                                        @error('mandatory_credit_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div><br>

                                    <!-- Choice Credit Number field -->
                                    <div class="form-group mt-2">
                                        <label for="choice_credit_number">Jumlah SKS Pilihan</label>
                                        <input type="number" name="choice_credit_number" id="choice_credit_number"
                                            class="form-control"
                                            value="{{ old('choice_credit_number', $curriculum->choice_credit_number ?? '') }}"
                                            required>
                                        @error('choice_credit_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div><br>

                                    <button type="submit"
                                        class="btn btn-primary mt-3">{{ isset($curriculum) ? 'Update' : 'Submit' }}</button>
                                </form>
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
        // Preload for Education Level
        $("#level-selector").select2({
            ajax: {
                delay: 250,
                url: '{{ route('curriculum.search_ed_lev') }}',
                data(params) {
                    var query = {
                        nm_jenj_didik: params.term,
                    }
                    return query;
                },
                processResults(data) {
                    return {
                        results: data.map(item => ({
                            id: item.id_jenj_didik, // The value for the option
                            text: `${item.nm_jenj_didik}` // The displayed text
                        }))
                    }
                }
            },
            minimumInputLength: 1,
            templateResult(res) {
                return res.text
            }
        });

        // Preselect the value if editing
        @if (isset($curriculum))
            var educationLevelId = "{{ $curriculum->education_level_id }}";
            var educationLevelText = "{{ $curriculum->education_level->nm_jenj_didik }}";
            var option = new Option(educationLevelText, educationLevelId, true, true);
            $('#level-selector').append(option).trigger('change');
        @endif


        // Preload for Semester
        $("#semester-selector").select2({
            ajax: {
                delay: 250,
                url: '{{ url('/') }}/admin/periode_pmb/search_semester',
                data(params) {
                    var query = {
                        semester_id: params.term,
                    }
                    return query;
                },
                processResults(data) {
                    return {
                        results: data.map(item => ({
                            id: item.semester_id, // The value for the option
                            text: `${item.semester_id} - ${item.name}` // The displayed text
                        }))
                    }
                }
            },
            minimumInputLength: 1,
            templateResult(res) {
                return res.text
            }
        });

        // Preselect the value if editing
        @if (isset($curriculum))
            var semesterId = "{{ $curriculum->semester_id }}";
            var semesterText = "{{ $curriculum->semester->semester_id }} - {{ $curriculum->semester->name }}";
            var option = new Option(semesterText, semesterId, true, true);
            $('#semester-selector').append(option).trigger('change');
        @endif
    </script>
@endsection
