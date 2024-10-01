@extends('layouts.home-layout')

@section('home-content')
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ isset($course) ? 'Edit' : 'Tambah' }} Matakuliah Kurikulum: {{ $curriculum->name }}</h4>
                                
                                <!-- Start Form -->
                                <form method="POST"
                                    action="{{ isset($course) ? route('curriculum_course.update', [$curriculum->curriculum_id, $course->id]) : route('curriculum_course.store', $curriculum->curriculum_id) }}">
                                    @csrf
                                    @if (isset($course))
                                        @method('PUT')
                                    @endif

                                    <!-- Select Course -->
                                    <div class="form-group">
                                        <label for="course-select">Pilih Kursus:</label>
                                        <select id="course-select" class="form-control" name="course_id" required>
                                            <option value="">Pilih Kursus</option>
                                            @if(isset($course))
                                                <option value="{{ $course->id }}" selected>{{ $course->name }}</option>
                                            @endif
                                        </select>
                                        @error('course_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Input SKS MK -->
                                    <div class="mb-3">
                                        <label for="sks_mk" class="form-label">SKS MK</label>
                                        <input type="number" class="form-control @error('sks_mk') is-invalid @enderror" id="sks_mk" name="sks_mk"
                                            value="{{ isset($course) ? $course->sks_mk : old('sks_mk') }}" required>
                                        @error('sks_mk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Input SKS TM -->
                                    <div class="mb-3">
                                        <label for="sks_tm" class="form-label">SKS TM</label>
                                        <input type="number" class="form-control @error('sks_tm') is-invalid @enderror" id="sks_tm" name="sks_tm"
                                            value="{{ isset($course) ? $course->sks_tm : old('sks_tm') }}">
                                        @error('sks_tm')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Input SKS PR -->
                                    <div class="mb-3">
                                        <label for="sks_pr" class="form-label">SKS PR</label>
                                        <input type="number" class="form-control @error('sks_pr') is-invalid @enderror" id="sks_pr" name="sks_pr"
                                            value="{{ isset($course) ? $course->sks_pr : old('sks_pr') }}">
                                        @error('sks_pr')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Input SKS PL -->
                                    <div class="mb-3">
                                        <label for="sks_pl" class="form-label">SKS PL</label>
                                        <input type="number" class="form-control @error('sks_pl') is-invalid @enderror" id="sks_pl" name="sks_pl"
                                            value="{{ isset($course) ? $course->sks_pl : old('sks_pl') }}">
                                        @error('sks_pl')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Input SKS SIM -->
                                    <div class="mb-3">
                                        <label for="sks_sim" class="form-label">SKS SIM</label>
                                        <input type="number" class="form-control @error('sks_sim') is-invalid @enderror" id="sks_sim" name="sks_sim"
                                            value="{{ isset($course) ? $course->sks_sim : old('sks_sim') }}">
                                        @error('sks_sim')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Mandatory Field -->
                                    <div class="mb-3">
                                        <label for="is_mandatory" class="form-label">Apakah Wajib?</label>
                                        <select class="form-select @error('is_mandatory') is-invalid @enderror" id="is_mandatory" name="is_mandatory">
                                            <option value="1" {{ isset($course) && $course->is_mandatory ? 'selected' : '' }}>Ya</option>
                                            <option value="0" {{ isset($course) && !$course->is_mandatory ? 'selected' : '' }}>Tidak</option>
                                        </select>
                                        @error('is_mandatory')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($course) ? 'Update' : 'Simpan' }}
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
    <!-- Link CSS Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection

@section('scripts')
    <!-- Link JS Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#course-select').select2({
            placeholder: 'Pilih Kursus',
            minimumInputLength: 1,
            ajax: {
                url: '{{ route('courses.get') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(function (course) {
                            return {
                                id: course.id,
                                text: course.name
                            };
                        })
                    };
                },
                cache: true
            }
        });
    });
    </script>
@endsection
