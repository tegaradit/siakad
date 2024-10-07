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

                @if ($errors->any)
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                @endif

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

                                    <!-- Prodi Selection -->
                                    <div class="form-group">
                                        <label for="prodi_id">Prodi</label>
                                        <select name="prodi_id" id="prodi_id" class="form-select" required>
                                            <option value="">Pilih Prodi</option>
                                            @foreach ($allProdi as $prodi)
                                                <option value="{{ $prodi->id_prodi }}"
                                                    {{ isset($curriculum) && $curriculum->prodi_id == $prodi->id_prodi ? 'selected' : '' }}>
                                                    {{ $prodi->nama_prodi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div><br>

                                    <!-- Education Level (Auto-filled based on Prodi) -->
                                    <div class="form-group">
                                        <label for="education_level_id">Jenjang Pendidikan</label>
                                        <input type="text" id="education_level_id" name="education_level_id"
                                            class="form-control" readonly
                                            value="{{ isset($curriculum) ? $curriculum->education_level->nm_jenj_didik : '' }}">
                                    </div><br>

                                    <!-- Active Semester Name Display -->
                                    <div class="form-group">
                                        <label for="semester_name">Semester</label>
                                        <input type="text" id="semester_name" name="semester_name" class="form-control"
                                            readonly
                                            value="{{ isset($curriculum) ? $curriculum->semester->name : $semesters->firstWhere('is_active', 1)->name ?? '' }}">
                                    </div><br>

                                    <!-- Hidden input for semester_id -->
                                    <input type="hidden" id="semester_id" name="semester_id"
                                        value="{{ isset($curriculum) ? $curriculum->semester_id : $semesters->firstWhere('is_active', 1)->semester_id ?? '' }}">


                                    <!-- Other Fields -->
                                    <div class="form-group">
                                        <label for="name">Nama Curricululm</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="{{ isset($curriculum) ? $curriculum->name : '' }}" required>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="normal_semester_number">Jumlah Semester Normal</label>
                                        <input type="number" id="normal_semester_number" name="normal_semester_number"
                                            class="form-control" placeholder="0" 
                                            value="{{ isset($curriculum) ? $curriculum->normal_semester_number : '' }}"
                                            required>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="pass_credit_number">Jumlah SKS Lulus</label>
                                        <input type="number" id="pass_credit_number" name="pass_credit_number"
                                            class="form-control" placeholder="0" 
                                            value="{{ isset($curriculum) ? $curriculum->pass_credit_number : '' }}"
                                            required>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="mandatory_credit_number">Jumlah SKS Wajib</label>
                                        <input type="number" id="mandatory_credit_number" name="mandatory_credit_number"
                                            class="form-control" placeholder="0" 
                                            value="{{ isset($curriculum) ? $curriculum->mandatory_credit_number : '' }}"
                                            required>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="choice_credit_number">Jumlah SKS Pilihan</label>
                                        <input type="number" id="choice_credit_number" name="choice_credit_number"
                                            class="form-control" placeholder="0" 
                                            value="{{ isset($curriculum) ? $curriculum->choice_credit_number : '' }}"
                                            required>
                                    </div><br>

                                    <button type="submit"
                                        class="btn btn-primary mb-3">{{ isset($curriculum) ? 'Ubah' : 'Simpan' }}</button>
                                </form>

                                <script>
                                    document.getElementById('prodi_id').addEventListener('change', function() {
                                        const prodiId = this.value;
                                        if (prodiId) {
                                            // Fetch education level based on selected Prodi using AJAX
                                            fetch(`/api/get-education-level/${prodiId}`)
                                                .then(response => response.json())
                                                .then(data => {
                                                    document.getElementById('education_level_id').value = data
                                                        .education_level_name; // Set the name
                                                });
                                        } else {
                                            document.getElementById('education_level_id').value = '';
                                        }
                                    });
                                </script>
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
@endsection
