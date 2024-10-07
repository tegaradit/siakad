@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kelas Kuliah</h1>
    <a href="{{ route('kelas-kuliah.create') }}" class="btn btn-primary">Create New Kelas</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Prodi</th>
                <th>Semester</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kelas_kuliahs as $kelas)
            <tr>
                <td>{{ $kelas->nama_kelas }}</td>
                <td>{{ $kelas->prodi_id }}</td>
                <td>{{ $kelas->semester_id }}</td>
                <td>{{ $kelas->start_date }}</td>
                <td>{{ $kelas->end_date }}</td>
                <td>
                    <a href="{{ route('kelas-kuliah.edit', $kelas->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('kelas-kuliah.destroy', $kelas->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
