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
                        <h4 class="mb-sm-0 font-size-18">Tambah Periode</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('periode_pmb.index') }}">Periode PMB</a>
                                </li>
                                <li class="breadcrumb-item active">Tambah</li>
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
                            <h4 class="card-title">Tambah Periode Penerimaan Mahasiswa Baru</h4>
                            <p class="card-title-desc">
                                Isilah form untuk menambah data Periode Penerimaan Mahasiswa Baru.
                            </p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('periode_pmb.store') }}" id="form-add-period" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="semester_id">Kode Semester</label>
                                    <input type="text" id="semester_id" readonly class="form-control" value="{{ $semester_id }}">
                                </div>

                                <div class="form-group">
                                    <label for="period_number">Gelombang</label>
                                    <input type="number" name="period_number" id="period_number" class="form-control"
                                        maxlength="1" required>
                                    @error('period_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Durasi</label>
                                    <input type="text" class="form-control" id="datepicker-range" name="period_range" />
                                    @error('period_range')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <Select class="form-control" name="status">
                                        <option selected value="1">Buka</option>
                                        <option value="0">Tutup</option>
                                    </Select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
        document.getElementById('form-add-period').onsubmit = function (form) {
            
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