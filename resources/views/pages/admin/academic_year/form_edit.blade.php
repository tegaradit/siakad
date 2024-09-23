@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Edit Tahun Akademik</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('tahun-akademik.index') }}">Data Akademik</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Tahun Akademik</li>
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
                                <h4 class="card-title mb-4">Form Edit Tahun Akademik</h4>

                                <form action="{{ route('tahun-akademik.update', $academicYear->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Rentang Tanggal -->
                                    <div class="mb-3">
                                        <label for="date_range" class="form-label">Rentang Tanggal</label>
                                        <input type="text" id="datepicker-range-without-d-value"class="form-control @error('date_range') is-invalid @enderror"
                                            id="date_range" name="date_range"
                                            value="{{ old('start_date', $academicYear->start_date) . ' to ' . old('end_date', $academicYear->end_date) }}"
                                            required>
                                        @error('date_range')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Tanggal Mulai (Hidden) -->
                                    <input type="hidden" id="start_date" name="start_date"
                                        value="{{ old('start_date', $academicYear->start_date) }}">

                                    <!-- Tanggal Selesai (Hidden) -->
                                    <input type="hidden" id="end_date" name="end_date"
                                        value="{{ old('end_date', $academicYear->end_date) }}">

                                    <div class="form-group mb-3">
                                        <label for="id">ID Tahun Akademik</label>
                                        <input type="text" class="form-control @error('id') is-invalid @enderror"
                                            id="id" name="id" value="{{ old('id', $academicYear->id) }}"
                                            required maxlength="4">
                                        @error('id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="name">Nama Tahun Akademik</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $academicYear->name) }}"
                                            required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('tahun-akademik.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Include daterangepicker.js -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $(document).ready(function() {
            // Initialize date range picker
            $('#date_range').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: $('#start_date').val(),
                endDate: $('#end_date').val(),
            }, function(start, end) {
                // Set the hidden input values and display the range
                $('#start_date').val(start.format('YYYY-MM-DD'));
                $('#end_date').val(end.format('YYYY-MM-DD'));
                $('#date_range').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>
@endsection
