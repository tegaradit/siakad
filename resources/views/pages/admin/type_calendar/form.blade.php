@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">
                                @if (isset($calendarType))
                                    Edit Tipe Kalender
                                @else
                                    Tambah Tipe Kalender
                                @endif
                            </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Data Perkuliahan</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        @if (isset($calendarType))
                                            Edit Tipe Kalender
                                        @else
                                            Tambah Tipe Kalender
                                        @endif
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    @if (isset($calendarType))
                                        Edit Tipe Kalender
                                    @else
                                        Tambah Tipe Kalender
                                    @endif
                                </h4>
                            </div>
                            <div class="card-body">
                                <form
                                    action="{{ isset($calendarType) ? route('calendar-type.update', $calendarType->id) : route('calendar-type.store') }}"
                                    method="POST">
                                    @csrf
                                    @if (isset($calendarType))
                                        @method('PUT')
                                    @endif

                                    <div class="form-group mb-3">
                                        <label for="name">Nama Tipe Kalender</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name"
                                            value="{{ old('name', $calendarType->name ?? '') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            @if (isset($calendarType))
                                                Update
                                            @else
                                                Simpan
                                            @endif
                                        </button>
                                        <a href="{{ route('calendar-type.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        © Minia.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by
                            <a href="#!" class="text-decoration-underline">Themesbrand</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
