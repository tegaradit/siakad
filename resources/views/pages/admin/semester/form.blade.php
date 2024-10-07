@extends('layouts.home-layout')

@section('home-content')
<style>
    .radio-group input {
        margin-right: 5px;
        /* Atur jarak antara input dan label */
    }

    .radio-group label {
        margin-right: 15px;
        /* Atur jarak antar kelompok radio */
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('semester.index') }}">Semester</a>
                                </li>
                                <li class="breadcrumb-item active">{{ isset($semester) ? 'Edit' : 'Tambah' }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ isset($semester) ? 'Edit Semester' : 'Tambah Semester' }}</h4>
                            <p class="card-title-desc">
                                Isilah form untuk {{ isset($semester) ? 'mengedit' : 'menambah' }} data semester.
                            </p>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($semester) ? route('semester.update', $semester->semester_id) : route('semester.store') }}" method="POST" id="form-semester">
                                @csrf
                                @if (isset($semester))
                                    @method('PUT')
                                @endif

                                <div class="form-group mt-2">
                                    <label for="semester_id">Semester ID</label>
                                    <input type="text" name="semester_id" id="semester_id" class="form-control"
                                        value="{{ old('semester_id', $semester->semester_id ?? '') }}" maxlength="6"
                                        {{ isset($semester) ? 'readonly' : '' }} required>
                                    @error('semester_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div><br>

                                <div class="form-group mt-2">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $semester->name ?? '') }}" maxlength="20" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div><br>

                                <div class="form-group mt-2">
                                    <label for="smt">SMT</label>
                                    <select name="smt" id="smt" class="form-select" required>
                                        <option value="">Pilih...</option>
                                        <option value="1" {{ old('smt', $semester->smt ?? '') == 1 ? 'selected' : '' }}>Ganjil</option>
                                        <option value="2" {{ old('smt', $semester->smt ?? '') == 2 ? 'selected' : '' }}>Genap</option>
                                        <option value="3" {{ old('smt', $semester->smt ?? '') == 3 ? 'selected' : '' }}>Pendek</option>
                                    </select>
                                    @error('smt')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div><br>

                                <div class="form-group mt-2">
                                    <label for="is_active">Apakah Active?</label>
                                    <div class="radio-group">
                                        <input type="radio" class="form-check-input" name="is_active" value="1"
                                            id="is_active_yes" {{ old('is_active', $semester->is_active ?? '') == 1 ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="is_active_yes">Active</label>

                                        <input type="radio" class="form-check-input" name="is_active" value="0"
                                            id="is_active_no" {{ old('is_active', $semester->is_active ?? '') == 0 ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="is_active_no">Non-Active</label>
                                    </div>
                                    @error('is_active')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div><br>

                                <div class="form-group mt-2">
                                    <label for="date_range" class="form-label">Rentang Tanggal</label>
                                    <input type="text" class="form-control mb-3"
                                        id="{{ isset($semester) ? 'datepicker-range-without-d-value' : 'datepicker-range' }}"
                                        name="date_range"
                                        value="{{ isset($semester) ? $semester->start_date . ' to ' . $semester->end_date : '' }}" required>
                                    @error('date_range')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div><br>

                                {{-- <button type="submit" class="btn btn-primary mt-3">Submit</button> --}}
                                <button type="submit" class="btn btn-primary mb-3">{{ isset($semester) ? 'Ubah' : 'Simpan' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear());
                    </script> © Minia.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Initialize form submit action
        let confirmSubmit = false;

        $('#form-semester').on('submit', function (e) {
            const is_active = $('input[name="is_active"]:checked').val(); // Check selected is_active

            if (!confirmSubmit && is_active == '1' && "{{ $isAnotherActive }}" == '1') {
                e.preventDefault(); // Prevent form submission

                Swal.fire({
                    title: 'Sudah Ada Semester yang Aktif',
                    text: 'Jika Anda melanjutkan, semester lain yang aktif akan dinonaktifkan. Apakah Anda yakin ingin melanjutkan?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Lanjutkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        confirmSubmit = true; // Allow submission on next trigger
                        $('#form-semester').submit(); // Resubmit the form
                    }
                });
            }
        });
    });
</script>
@endsection