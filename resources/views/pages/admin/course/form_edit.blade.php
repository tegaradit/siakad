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
                            <h4 class="mb-sm-0 font-size-18">Edit Mata Kuliah</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('course.index') }}">Mata Kuliah</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end page title --}}

                <!-- Form to edit a course -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Mata Kuliah</h4>
                                <p class="card-title-desc">Silakan edit data mata kuliah di bawah ini.</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('course.update', $course->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    {{-- <!-- Prodi field -->
                                    <div class="form-group mt-2">
                                        <label for="prodi_id">Prodi</label>
                                        <select name="prodi_id" id="prodi_id" class="form-control" required>
                                            <option value="" selected>Pilih Prodi</option>
                                            @foreach ($prodi as $p)
                                                <option value="{{ $p->id_prodi }}"
                                                    {{ old('prodi_id', $course->prodi_id) == $p->id_prodi ? 'selected' : '' }}>
                                                    {{ $p->nama_prodi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('prodi_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    {{-- <!-- Education Level field -->
                                    <div class="form-group mt-2">
                                        <label for="education_level_id">Tingkat Pendidikan</label>
                                        <select id="level-selector" name="education_level_id" class="form-control" required>
                                            <option value="{{ old('education_level_id', $course->education_level_id) }}">
                                                {{ $course->education_level->nm_jenj_didik ?? 'Pilih Tingkat Pendidikan' }}
                                            </option>
                                        </select>
                                        @error('education_level_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br> --}}

                                    <!-- Prodi field -->
                                    <div class="form-group mt-2">
                                        <label for="prodi_id">Prodi</label>
                                        <select name="prodi_id" id="prodi_id" class="form-control" required>
                                            <option value="" selected>Pilih Prodi</option>
                                            @foreach ($prodi as $p)
                                                <option value="{{ $p->id_prodi }}"
                                                    {{ old('prodi_id', $course->prodi_id ?? '') == $p->id_prodi ? 'selected' : '' }}>
                                                    {{ $p->nama_prodi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Education Level field (Auto-filled) -->
                                    <div class="form-group mt-2">
                                        <label for="education_level_id">Tingkat Pendidikan</label>
                                        <input type="text" id="education_level_id" class="form-control" name="education_level_id" readonly value="{{ old('education_level_id', $course->education_level_id ?? '') }}" required>
                                    </div>

                                    {{-- Course Code --}}
                                    <div class="form-group">
                                        <label for="code">Course Code</label>
                                        <input type="text" name="code" id="code" class="form-control"
                                            value="{{ old('code', $course->code) }}" maxlength="10" required>
                                    </div>

                                    {{-- Course Name --}}
                                    <div class="form-group">
                                        <label for="name">Course Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name', $course->name) }}" maxlength="200" required>
                                    </div>

                                    {{-- Course Group --}}
                                    <div class="form-group">
                                        <label for="group_id">Course Group</label>
                                        <select name="group_id" id="group_id" class="form-control" required>
                                            <option value="">Pilih...</option>
                                            @foreach ($group as $gro)
                                                <option value="{{ $gro->id }}"
                                                    {{ old('group_id', $course->group_id) == $gro->id ? 'selected' : '' }}>
                                                    {{ $gro->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Course Type --}}
                                    <div class="form-group">
                                        <label for="type_id">Course Type</label>
                                        <select name="type_id" id="type_id" class="form-control" required>
                                            <option value="">Pilih...</option>
                                            @foreach ($type as $ty)
                                                <option value="{{ $ty->id }}"
                                                    {{ old('type_id', $course->type_id) == $ty->id ? 'selected' : '' }}>
                                                    {{ $ty->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- SKS Fields --}}
                                    <div class="form-group">
                                        <label for="sks_mk">SKS MK</label>
                                        <input type="number" name="sks_mk" id="sks_mk" class="form-control"
                                            value="{{ old('sks_mk', $course->sks_mk) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sks_tm">SKS TM</label>
                                        <input type="number" name="sks_tm" id="sks_tm" class="form-control"
                                            value="{{ old('sks_tm', $course->sks_tm) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sks_pr">SKS PR</label>
                                        <input type="number" name="sks_pr" id="sks_pr" class="form-control"
                                            value="{{ old('sks_pr', $course->sks_pr) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sks_pl">SKS PL</label>
                                        <input type="number" name="sks_pl" id="sks_pl" class="form-control"
                                            value="{{ old('sks_pl', $course->sks_pl) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sks_sim">SKS SIM</label>
                                        <input type="number" name="sks_sim" id="sks_sim" class="form-control"
                                            value="{{ old('sks_sim', $course->sks_sim) }}" required>
                                    </div>

                                    {{-- Status --}}
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="">Pilih...</option>
                                            <option value="Active"
                                                {{ old('status', $course->status) == 'Active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="Deleted"
                                                {{ old('status', $course->status) == 'Deleted' ? 'selected' : '' }}>Deleted
                                            </option>
                                            <option value="Non-Active"
                                                {{ old('status', $course->status) == 'Non-Active' ? 'selected' : '' }}>
                                                Non-Active</option>
                                        </select>
                                    </div>

                                    {{-- Boolean Fields --}}
                                    <div class="form-group">
                                        <label for="is_sap">Is SAP?</label>
                                        <div class="radio-group">
                                            <input type="radio" class="form-check-input" name="is_sap" value="1"
                                                id="is_sap_yes" {{ old('is_sap', $course->is_sap) == 1 ? 'checked' : '' }}
                                                required>
                                            <label class="form-check-label" for="is_sap_yes">Yes</label>

                                            <input type="radio" class="form-check-input" name="is_sap" value="0"
                                                id="is_sap_no" {{ old('is_sap', $course->is_sap) == 0 ? 'checked' : '' }}
                                                required>
                                            <label class="form-check-label" for="is_sap_no">No</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="is_silabus">Is Silabus?</label>
                                        <div class="radio-group">
                                            <input type="radio" class="form-check-input" name="is_silabus"
                                                value="1" id="is_silabus_yes"
                                                {{ old('is_silabus', $course->is_silabus) == 1 ? 'checked' : '' }}
                                                required>
                                            <label class="form-check-label" for="is_silabus_yes">Yes</label>

                                            <input type="radio" class="form-check-input" name="is_silabus"
                                                value="0" id="is_silabus_no"
                                                {{ old('is_silabus', $course->is_silabus) == 0 ? 'checked' : '' }}
                                                required>
                                            <label class="form-check-label" for="is_silabus_no">No</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="is_teaching_material">Is Teaching Material?</label>
                                        <div class="radio-group">
                                            <input type="radio" class="form-check-input" name="is_teaching_material"
                                                value="1" id="is_teaching_material_yes"
                                                {{ old('is_teaching_material', $course->is_teaching_material) == 1 ? 'checked' : '' }}
                                                required>
                                            <label class="form-check-label" for="is_teaching_material_yes">Yes</label>

                                            <input type="radio" class="form-check-input" name="is_teaching_material"
                                                value="0" id="is_teaching_material_no"
                                                {{ old('is_teaching_material', $course->is_teaching_material) == 0 ? 'checked' : '' }}
                                                required>
                                            <label class="form-check-label" for="is_teaching_material_no">No</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="is_praktikum">Is Praktikum?</label>
                                        <div class="radio-group">
                                            <input type="radio" class="form-check-input" name="is_praktikum"
                                                value="1" id="is_praktikum_yes"
                                                {{ old('is_praktikum', $course->is_praktikum) == 1 ? 'checked' : '' }}
                                                required>
                                            <label class="form-check-label" for="is_praktikum_yes">Yes</label>

                                            <input type="radio" class="form-check-input" name="is_praktikum"
                                                value="0" id="is_praktikum_no"
                                                {{ old('is_praktikum', $course->is_praktikum) == 0 ? 'checked' : '' }}
                                                required>
                                            <label class="form-check-label" for="is_praktikum_no">No</label>
                                        </div>
                                    </div>

                                    {{-- Effective Dates --}}
                                    <div class="form-group">
                                        <label class="form-label">Durasi</label>
                                        <input type="text" class="form-control" id="datepicker-range-without-d-value"
                                            name="course_range" value="{{ old('course_range', $course_range) }}" />
                                        @error('course_range')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    {{-- Submit Button --}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mt-3">Ubah</button>
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
    {{-- <script>
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
                            id: item.id_jenj_didik,
                            text: `${item.nm_jenj_didik}`
                        }))
                    }
                }
            },
            minimumInputLength: 1,
            templateResult(res) {
                return res.text
            }
        });
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Auto-fill education level when prodi is selected
        $('#prodi_id').on('change', function () {
            const prodiId = $(this).val();
            if (prodiId) {
                $.ajax({
                    url: '/get-education-level/' + prodiId,
                    type: 'GET',
                    success: function (data) {
                        $('#education_level_id').val(data.education_level_id);
                    }
                });
            } else {
                $('#education_level_id').val('');
            }
        });
    </script>
@endsection
