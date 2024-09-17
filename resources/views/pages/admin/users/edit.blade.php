@extends('layouts.home-layout')

@section('home-content')

<body>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="wrapper">
                    <header class="header">
                        <div class="container">
                            <h1 class="header-title">Edit User</h1>
                        </div>
                    </header>

                    <main class="container">
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="form">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone_number">Nomor Telepon</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="role_id">Role</label>
                                <select name="role_id" class="form-control" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="photo">Foto</label>
                                <input type="file" name="photo" class="form-control">
                                @if($user->photo)
                                    <img src="{{ asset('storage/' . $user->photo)  }}" width="100" alt="Foto User" class="mt-2">
                                @endif
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
