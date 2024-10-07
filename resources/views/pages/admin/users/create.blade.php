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
                                        <li class="breadcrumb-item active">Tambah</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tambah Dosen</h4>
                                    <p class="card-title-desc">
                                        Isilah form untuk menambah data dosen.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data"
                                        class="form">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="name">Nama</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="phone_number">Nomor Telepon</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="password_confirmation">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="role_id">Role</label>
                                            <select name="role_id" id="role_id" class="form-control" required>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="photo">Foto</label>
                                            <input type="file" name="photo" id="photo" class="form-control"
                                                required>
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
