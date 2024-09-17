@extends('layouts.home-layout')

@section('home-content')
<style>
    .radio-group input {
        margin-right: 5px; /* Atur jarak antara input dan label */
    }

    .radio-group label {
        margin-right: 15px; /* Atur jarak antar kelompok radio */
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
                                    <a href="{{ route('semester.index') }}">Semester</a>
                                </li>
                                <li class="breadcrumb-item active">{{ isset($semester) ? 'Edit' : 'Tambah' }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <!-- Form to create or edit a semester -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ isset($semester) ? 'Edit Semester' : 'Tambah Semester' }}</h4>
                            <p class="card-title-desc">
                              Isilah form untuk {{ isset($semester) ? 'mengedit' : 'menambah' }} data semester..
                            </p>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($semester) ? route('semester.update', $semester->semester_id) : route('semester.store') }}" method="POST">
                                @csrf
                                @if(isset($semester))
                                    @method('PUT')
                                @endif

                                <!-- Semester ID field -->
                                <div class="form-group">
                                    <label for="semester_id">Semester ID</label>
                                    <input type="text" name="semester_id" id="semester_id" class="form-control" value="{{ old('semester_id', $semester->semester_id ?? '') }}" maxlength="6" {{ isset($semester) ? 'readonly' : '' }} required>
                                    @error('semester_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Name field -->
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $semester->name ?? '') }}" maxlength="20" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Semester Type field -->
                                <div class="form-group">
                                    <label for="smt">SMT</label>
                                    <select name="smt" id="smt" class="form-control" required>
                                        <option value="">Pilih...</option>
                                        <option value="1" {{ old('smt', $semester->smt ?? '') == 1 ? 'selected' : '' }}>Ganjil</option>
                                        <option value="2" {{ old('smt', $semester->smt ?? '') == 2 ? 'selected' : '' }}>Genap</option>
                                        <option value="3" {{ old('smt', $semester->smt ?? '') == 3 ? 'selected' : '' }}>Pendek</option>
                                    </select>                                    
                                    @error('smt')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Is Active field -->
                                <div class="form-group">
                                    <label for="is_active">Is Active?</label>
                                    <div class="radio-group">
                                        <input type="radio" class="form-check-input" name="is_active" value="1" id="is_active_yes" {{ old('is_active', $semester->is_active ?? '') == 1 ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="is_active_yes">Yes</label>
                                
                                        <input type="radio" class="form-check-input" name="is_active" value="0" id="is_active_no" {{ old('is_active', $semester->is_active ?? '') == 0 ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="is_active_no">No</label>
                                    </div>
                                    @error('is_active')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>                                

                                <!-- Start Date field -->
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="datepicker-basic" class="form-control" value="{{ old('start_date', $semester->start_date ?? '') }}" required>
                                    @error('start_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- End Date field -->
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $semester->end_date ?? '') }}" required>
                                    @error('end_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Range</label>
                                    <input type="text" class="form-control" id="datepicker-range"/>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">{{ isset($semester) ? 'Update' : 'Submit' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
