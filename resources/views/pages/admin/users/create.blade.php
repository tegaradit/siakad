@extends('layouts.home-layout')

@section('home-content')

<body>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="wrapper">
                    <header class="header">
                        <div class="container">
                            <h1 class="header-title">Tambah User</h1>
                        </div>
                    </header>

                    <main class="container">
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="form">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone_number">Nomor Telepon</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="role_id">Role</label>
                                <select name="role_id" id="role_id" class="form-control" required>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="photo">Foto</label>
                                <input type="file" name="photo" id="photo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
        <script src="{{ asset('minia/js/minia.min.js') }}"></script>
        @endsection