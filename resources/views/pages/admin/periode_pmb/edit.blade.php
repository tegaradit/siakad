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
                        <h4 class="mb-sm-0 font-size-18">Edit Periode</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('periode_pmb.index') }}">Periode PMB</a>
                                </li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <!-- Form to create a new course -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Periode Penerimaan Mahasiswa Baru</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('periode_pmb.update', $prev_period_data->id) }}" id="form-edit-period" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="status">Kode Semester</label>
                                    <select id="semester-selector" name="semester_id" class="form-control" required>
                                        @foreach ($semester_data as $data)
                                            <option value="{{ $data->semester_id }}" {{ $data->semester_id == $prev_period_data->semester_id ?? 'selected' }}>{{ $data->semester_id . ' - ' . $data->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('semester_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="period_number">Gelombang</label>
                                    <input type="number" name="period_number" id="period_number" class="form-control" maxlength="1" required value="{{ $prev_period_data->period_number }}">
                                    @error('period_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror    
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Durasi</label>
                                    <input type="text" class="form-control" id="datepicker-range-without-d-value" name="period_range" required value="{{ $prev_period_data->start_date }} to {{ $prev_period_data->end_date }}" />
                                    @error('period_range')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option {{ $prev_period_data->status == '0' ? 'selected' : '' }} value="0">Tutup</option>
                                        <option {{ $prev_period_data->status == '1' ? 'selected' : '' }} value="1">Buka</option>
                                    </select>
                                </div>

                                <input type="hidden" name="isAnotherOpen" value="{{ $isAnotherOpen }}" />

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        let confirmSubmit = false
        document.getElementById('form-edit-period').onsubmit = function (form) {
            
            const inpStatusValue = form.target.status.value
            if (!confirmSubmit && inpStatusValue == '1' && "{{ $isAnotherOpen }}" == "1")
                form.preventDefault()

            if ("{{ $isAnotherOpen }}" == "1" && inpStatusValue == '1') {
                Swal.fire({
                    title: 'Ada Periode Lain yang Terbuka',
                    text: 'JIka anda melanjutkan, maka periode lain tersebut akan otomatis di tutup, anda yakin',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Lanjutkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        confirmSubmit = true
                        this.submit()
                    }
                });
            }
        }
    })
</script>
@endsection