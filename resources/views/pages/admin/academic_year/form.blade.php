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
                                @if (isset($academicYear))
                                    Edit Tahun Akademik
                                @else
                                    Tambah Tahun Akademik
                                @endif
                            </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">Data Akademik</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        @if (isset($academicYear))
                                            Edit Tahun Akademik
                                        @else
                                            Tambah Tahun Akademik
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
                                    @if (isset($academicYear))
                                        Edit Tahun Akademik
                                    @else
                                        Tambah Tahun Akademik
                                    @endif
                                </h4>
                            </div>
                            <div class="card-body">
                                <form
                                    action="{{ isset($academicYear) ? route('tahun-akademik.update', $academicYear->id) : route('tahun-akademik.store') }}"
                                    method="POST">
                                    @csrf
                                    @if (isset($academicYear))
                                        @method('PUT')
                                    @endif

                                    <div class="form-group mb-3">
                                        <label for="id">ID Tahun Akademik</label>
                                        <input type="text" class="form-control @error('id') is-invalid @enderror"
                                            id="id" name="id" value="{{ old('id', $academicYear->id ?? '') }}"
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
                                            id="name" name="name"
                                            value="{{ old('name', $academicYear->name ?? '') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="date_range" class="form-label">Rentang Tanggal</label>
                                        <input type="text" class="form-control mb-3"
                                            id="datepicker-range-without-d-value" name="date_range"
                                            value="{{ isset($data) ? $data->start_date . ' to ' . $data->end_date : '' }}"
                                            required>
                                    </div>

                                    <!-- Hidden input untuk Tanggal Mulai dan Selesai -->
                                    <input type="hidden" id="start_date" name="start_date"
                                        value="{{ old('start_date', $academicYear->start_date ?? '') }}">
                                    <input type="hidden" id="end_date" name="end_date"
                                        value="{{ old('end_date', $academicYear->end_date ?? '') }}">

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            @if (isset($academicYear))
                                                Update
                                            @else
                                                Simpan
                                            @endif
                                        </button>
                                        <a href="{{ route('tahun-akademik.index') }}" class="btn btn-secondary">Kembali</a>
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

    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datepicker-range').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: $('#start_date').val() || moment().startOf('month').format('YYYY-MM-DD'),
                endDate: $('#end_date').val() || moment().endOf('month').format('YYYY-MM-DD'),
            }, function(start, end, label) {
                // Set the hidden input values
                $('#start_date').val(start.format('YYYY-MM-DD'));
                $('#end_date').val(end.format('YYYY-MM-DD'));
                // Update the date range input field
                $('#datepicker-range').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>
@endsection
