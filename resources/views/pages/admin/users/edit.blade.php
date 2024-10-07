@extends('layouts.home-layout')

@section('home-content')

    <body>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18"></h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('users.index') }}">Pengguna</a>
                                        </li>
                                        <li class="breadcrumb-item active">Edit</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Pengguna</h4>
                                    <p class="card-title-desc">
                                        Isilah form untuk mengedit data pengguna.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST"
                                        enctype="multipart/form-data" class="form">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group mb-3">
                                            <label for="name">Nama</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $user->name }}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="phone_number">Nomor Telepon</label>
                                            <input type="text" name="phone_number" class="form-control"
                                                value="{{ $user->phone_number }}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $user->email }}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="role_id">Role</label>
                                            <select name="role_id" class="form-control" required>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="photo">Foto</label>
                                            <input type="file" name="photo" class="form-control">
                                            @if ($user->photo)
                                                <img src="{{ asset('storage/' . $user->photo) }}" width="100"
                                                    alt="Foto User" class="mt-2">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <script src="{{ asset('minia/js/minia.min.js') }}"></script>
        @endsection
