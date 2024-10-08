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

        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-row label {
            flex: 0 0 25%;
            max-width: 25%;
            text-align: right;
            padding-right: 5px;
        }

        .form-row input,
        .form-row select {
            flex: 1;
            margin-left: 5px;
        }

        .form-group {
            margin-bottom: 20px;
            padding: 5px;
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
                                        <a href="{{ route('lecturer.index') }}">Dosen</a>
                                    </li>
                                    <li class="breadcrumb-item active">Tambah</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end page title --}}

                <!-- Form to create a new lecturer -->
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
                                <form action="{{ route('lecturer.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">

                                            {{-- NUPTK --}}
                                            <div class="form-group form-row">
                                                <label for="nuptk">NUPTK</label>
                                                <input type="text" name="nuptk" id="nuptk" class="form-control"
                                                    maxlength="16" required>
                                                @error('nuptk')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- NIDN --}}
                                            <div class="form-group form-row">
                                                <label for="nidn">NIDN</label>
                                                <input type="text" name="nidn" id="nidn" class="form-control"
                                                    maxlength="10">
                                                @error('nidn')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- NIK --}}
                                            <div class="form-group form-row">
                                                <label for="nik">NIK</label>
                                                <input type="text" name="nik" id="nik" class="form-control"
                                                    maxlength="16">
                                            </div>

                                            {{-- Gender --}}
                                            <div class="form-group form-row">
                                                <label for="gender">Gender</label>
                                                <select name="gender" id="gender" class="form-control form-select" required>
                                                    <option value="">Pilih...</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>

                                            {{-- Name --}}
                                            <div class="form-group form-row">
                                                <label for="name">Nama</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    maxlength="200" required>
                                            </div>

                                            {{-- Active Status --}}
                                            <div class="form-group form-row">
                                                <label for="active_status_id">Status Aktif</label>
                                                <select name="active_status_id" id="active_status_id" class="form-select"
                                                    required>
                                                    <option value="">Pilih...</option>
                                                    @foreach ($activeStatuses as $status)
                                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- Birth Date --}}
                                            <div class="form-group form-row">
                                                <label for="birth_date">Tanggal Lahir</label>
                                                <input type="date" name="birth_date" id="birth_date" class="form-control"
                                                    required>
                                            </div>

                                            {{-- Birth Place --}}
                                            <div class="form-group form-row">
                                                <label for="birth_place">Tempat Lahir</label>
                                                <input type="text" name="birth_place" id="birth_place"
                                                    class="form-control" maxlength="100" required>
                                            </div>

                                            {{-- Mother's Name --}}
                                            <div class="form-group form-row">
                                                <label for="mothers_name">Nama Ibu</label>
                                                <input type="text" name="mothers_name" id="mothers_name"
                                                    class="form-control" maxlength="200" required>
                                            </div>

                                            {{-- Marital Status --}}
                                            <div class="form-group form-row">
                                                <label for="mariage_status">Status Pernikahan</label>
                                                <select name="mariage_status" id="mariage_status" class="form-control form-select"
                                                    required>
                                                    <option value="">Pilih...</option>
                                                    <option value="belum kawin">Belum Kawin</option>
                                                    <option value="kawin">Kawin</option>
                                                    <option value="cerai hidup">Cerai Hidup</option>
                                                    <option value="cerai mati">Cerai Mati</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            {{-- Employee Level --}}
                                            <div class="form-group form-row">
                                                <label for="employee_level_id">Level Pegawai</label>
                                                <select name="employee_level_id" id="employee_level_id"
                                                    class="form-control form-select" required>
                                                    <option value="">Pilih...</option>
                                                    @foreach ($employeeLevels as $level)
                                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- Level of Education --}}
                                            <div class="form-group form-row">
                                                <label for="level_education">Level Pendidikan</label>
                                                <select name="level_education" id="level_education" class="form-control form-select"
                                                    required>
                                                    <option value="">Pilih...</option>
                                                    <option value="S1">S1</option>
                                                    <option value="S2">S2</option>
                                                    <option value="S3">S3</option>
                                                </select>
                                            </div>

                                            {{-- Phone Number --}}
                                            <div class="form-group form-row">
                                                <label for="phone_number">No Telepon</label>
                                                <input type="text" name="phone_number" id="phone_number"
                                                    class="form-control" maxlength="13">
                                            </div>

                                            {{-- Email --}}
                                            <div class="form-group form-row">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    maxlength="255">
                                            </div>



                                            {{-- Assign Letter Number --}}
                                            <div class="form-group form-row">
                                                <label for="assign_letter_number">No Surat Tugas</label>
                                                <input type="text" name="assign_letter_number"
                                                    id="assign_letter_number" class="form-control" maxlength="30">
                                            </div>

                                            {{-- Assign Letter Date --}}
                                            <div class="form-group form-row">
                                                <label for="assign_letter_date">Tanggal Surat Tugas</label>
                                                <input type="date" name="assign_letter_date" id="assign_letter_date"
                                                    class="form-control">
                                            </div>

                                            {{-- Assign Letter TMT --}}
                                            <div class="form-group form-row">
                                                <label for="assign_letter_tmt">Tanggal TMT Surat Tugas</label>
                                                <input type="date" name="assign_letter_tmt" id="assign_letter_tmt"
                                                    class="form-control">
                                            </div>

                                            {{-- Exit Date --}}
                                            <div class="form-group form-row">
                                                <label for="exit_date">Tanggal Keluar</label>
                                                <input type="date" name="exit_date" id="exit_date"
                                                    class="form-control">
                                            </div>

                                            {{-- All Prodi --}}

                                            <div class="form-group form-row mt-2">
                                                <label for="prodi_id">Prodi</label>
                                                <select name="prodi_id" id="prodi_id" class="form-control form-select" required>
                                                    <option value="" selected>Pilih...</option>
                                                    @foreach ($prodiList as $p)
                                                        <option value="{{ $p->id_prodi }}" {{-- asumsikan 'id_prodi' adalah field di tabel all_prodi --}}
                                                            {{ old('prodi_id', $curriculum->prodi_id ?? '') == $p->id_prodi ? 'selected' : '' }}>
                                                            {{ $p->nama_prodi }} {{-- asumsikan 'nama_prodi' adalah field untuk nama di tabel all_prodi --}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('prodi_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Submit Button --}}
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
    <!-- End Form -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script>
        $("#prodi-selector").select2({
            ajax: {
                delay: 250,
                url: '{{ url('/') }}/admin/all_prodi/search_prodi',
                data(params) {
                    var query = {
                        nama_prodi: params.term,
                    }
                    return query;
                },
                processResults(data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: `${item.nama_prodi}`
                        }))
                    }
                }
            },
            minimumInputLength: 1,
            templateResult(res) {
                return res.text
            }
        })
    </script> --}}
@endsection
