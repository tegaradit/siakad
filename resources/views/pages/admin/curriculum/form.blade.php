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
                            <h4 class="card-title">{{ isset($curriculum) ? 'Edit Curriculum' : 'Tambah Curriculum' }}</h4>
                            <p class="card-title-desc">
                                Isilah form untuk {{ isset($curriculum) ? 'mengedit' : 'menambah' }} data curriculum..
                            </p>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($curriculum) ? route('curriculum.update', $curriculum->curriculum_id) : route('curriculum.store') }}" method="POST">
                                @csrf
                                @if(isset($curriculum))
                                    @method('PUT')
                                @endif

                                <!-- Prodi field -->
                                {{-- <div class="form-group">
                                    <label for="prodi_id">Prodi</label>
                                    <select name="prodi_id" id="prodi_id" class="form-control" required>
                                        <option value="">Pilih Prodi</option>
                                        @foreach($prodi as $p)
                                            <option value="{{ $p->id }}" {{ old('prodi_id', $curriculum->prodi_id ?? '') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('prodi_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <!-- Education Level field -->
                                <div class="form-group">
                                    <label for="education_level_id">Tingkat Pendidikan</label>
                                    <select name="education_level_id" id="education_level_id" class="form-control" required>
                                        <option value="">Pilih Tingkat Pendidikan</option>
                                        @foreach($educationLevels as $level)
                                            <option value="{{ $level->id_jenj_didik }}" {{ old('education_level_id', $curriculum->education_level_id ?? '') == $level->id_jenj_didik ? 'selected' : '' }}>{{ $level->nm_jenj_didik }}</option>
                                        @endforeach
                                    </select>
                                    @error('education_level_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Semester field -->
                                <div class="form-group">
                                    <label for="semester_id">Semester</label>
                                    <select name="semester_id" id="semester_id" class="form-control" required>
                                        <option value="">Pilih Semester</option>
                                        @foreach($semesters as $semester)
                                            <option value="{{ $semester->semester_id }}" {{ old('semester_id', $curriculum->semester_id ?? '') == $semester->semester_id ? 'selected' : '' }}>{{ $semester->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('semester_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Curriculum Name field -->
                                <div class="form-group">
                                    <label for="name">Nama Kurikulum</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $curriculum->name ?? '') }}" maxlength="200" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Normal Semester Number field -->
                                <div class="form-group">
                                    <label for="normal_semester_number">Nomor Semester Normal</label>
                                    <input type="number" name="normal_semester_number" id="normal_semester_number" class="form-control" value="{{ old('normal_semester_number', $curriculum->normal_semester_number ?? '') }}" required>
                                    @error('normal_semester_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Pass Credit Number field -->
                                <div class="form-group">
                                    <label for="pass_credit_number">Jumlah SKS Kelulusan</label>
                                    <input type="number" name="pass_credit_number" id="pass_credit_number" class="form-control" value="{{ old('pass_credit_number', $curriculum->pass_credit_number ?? '') }}" required>
                                    @error('pass_credit_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Mandatory Credit Number field -->
                                <div class="form-group">
                                    <label for="mandatory_credit_number">Jumlah SKS Wajib</label>
                                    <input type="number" name="mandatory_credit_number" id="mandatory_credit_number" class="form-control" value="{{ old('mandatory_credit_number', $curriculum->mandatory_credit_number ?? '') }}" required>
                                    @error('mandatory_credit_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Choice Credit Number field -->
                                <div class="form-group">
                                    <label for="choice_credit_number">Jumlah SKS Pilihan</label>
                                    <input type="number" name="choice_credit_number" id="choice_credit_number" class="form-control" value="{{ old('choice_credit_number', $curriculum->choice_credit_number ?? '') }}" required>
                                    @error('choice_credit_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">{{ isset($curriculum) ? 'Update' : 'Submit' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection