@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Edit Kalender Akademik</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data Perkuliahan</a></li>
                                    <li class="breadcrumb-item active">Kalender Akademik</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Form Edit Kalender Akademik</h4>

                                <form action="{{ route('kalender_akademik.update', $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') {{-- Method PUT untuk edit/update --}}

                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                            value="{{ old('start_date', $data->start_date) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                            value="{{ old('end_date', $data->end_date) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $data->description) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="semester_id" class="form-label">Semester</label>
                                        <select class="form-control" id="semester_id" name="semester_id" required>
                                            <option value="" disabled>Pilih Semester</option>
                                            @foreach ($semesters as $semester)
                                                <option value="{{ $semester->semester_id }}"
                                                    {{ old('semester_id', $data->semester_id) == $semester->semester_id ? 'selected' : '' }}>
                                                    {{ $semester->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="calendar_type_id" class="form-label">Tipe Kalender</label>
                                        <select class="form-control" id="calendar_type_id" name="calendar_type_id" required>
                                            <option value="" disabled>Pilih Tipe Kalender</option>
                                            @foreach ($calendar_types as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ old('calendar_type_id', $data->calendar_type_id) == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('kalender_akademik.index') }}" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
