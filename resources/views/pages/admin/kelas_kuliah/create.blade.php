@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Kelas Kuliah</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kelas-kuliah.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}">
        </div>

        <div class="mb-3">
            <label for="prodi_id" class="form-label">Prodi</label>
            <input type="text" class="form-control" id="prodi_id" name="prodi_id" value="{{ old('prodi_id') }}">
        </div>

        <div class="mb-3">
            <label for="semester_id" class="form-label">Semester</label>
            <input type="text" class="form-control" id="semester_id" name="semester_id" value="{{ old('semester_id') }}">
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
        </div>

        <!-- Add other input fields for the remaining attributes -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
