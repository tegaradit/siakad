@extends('layouts.home-layout')

@section('home-content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-itmes-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0)">Mata Kuliah</a>
                                </li>
                                <li class="breadcrumb-item active">Tambah</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <!-- Form to create a new building -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Mata Kuliah</h4>
                            <p class="card-title-desc">
                              Isilah form untuk menambah data mata kuliah.
                            </p>
                        </div>
                        <div class="card-body">
                            {{-- <form action="{{ route('buildings.store') }}" method="POST"> --}}
                                @csrf

                                <!-- Code field -->
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
                                    @error('code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Name field -->
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
