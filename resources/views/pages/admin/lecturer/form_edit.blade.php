@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Lecturer</h4>
                </div>

                <!-- Form to edit an existing lecturer -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('lecturer.update', $lecturer->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Method PUT untuk mengupdate data -->

                            <!-- NUPTK field (readonly) -->
                            <div class="form-group">
                                <label for="nuptk">NUPTK</label>
                                <input type="text" name="nuptk" class="form-control"
                                    value="{{ old('nuptk', $lecturer->nuptk) }}">
                                @error('nuptk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- NIDN field -->
                            <div class="form-group">
                                <label for="nidn">NIDN</label>
                                <input type="text" name="nidn" class="form-control"
                                    value="{{ old('nidn', $lecturer->nidn) }}">
                                @error('nidn')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- NIK field -->
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" class="form-control"
                                    value="{{ old('nik', $lecturer->nik) }}">
                                @error('nik')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gender field -->
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="Laki-laki"
                                        {{ old('gender', $lecturer->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="Perempuan"
                                        {{ old('gender', $lecturer->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Name field -->
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $lecturer->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Active Status field -->
                            <div class="form-group">
                                <label for="active_status_id">Status Aktif</label>
                                <select name="active_status_id" class="form-control">
                                    @foreach ($activeStatuses as $status)
                                        <option value="{{ $status->id }}"
                                            {{ old('active_status_id', $lecturer->active_status_id) == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}</option>
                                    @endforeach
                                </select>
                                @error('active_status_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Birth Date field -->
                            <div class="form-group">
                                <label for="birth_date">Tanggal Lahir</label>
                                <input type="date" name="birth_date" class="form-control"
                                    value="{{ old('birth_date', $lecturer->birth_date) }}" required>
                                @error('birth_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Birth Place field -->
                            <div class="form-group">
                                <label for="birth_place">Tempat Lahir</label>
                                <input type="text" name="birth_place" class="form-control"
                                    value="{{ old('birth_place', $lecturer->birth_place) }}" required>
                                @error('birth_place')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mother's Name field -->
                            <div class="form-group">
                                <label for="mothers_name">Nama Ibu</label>
                                <input type="text" name="mothers_name" class="form-control"
                                    value="{{ old('mothers_name', $lecturer->mothers_name) }}" required>
                                @error('mothers_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mariage Status field -->
                            <div class="form-group">
                                <label for="mariage_status">Status Pernikahan</label>
                                <select name="mariage_status" class="form-control">
                                    <option value="belum kawin"
                                        {{ old('mariage_status', $lecturer->mariage_status) == 'belum kawin' ? 'selected' : '' }}>
                                        Belum Kawin</option>
                                    <option value="kawin"
                                        {{ old('mariage_status', $lecturer->mariage_status) == 'kawin' ? 'selected' : '' }}>
                                        Kawin</option>
                                    <option value="cerai hidup"
                                        {{ old('mariage_status', $lecturer->mariage_status) == 'cerai hidup' ? 'selected' : '' }}>
                                        Cerai Hidup</option>
                                    <option value="cerai mati"
                                        {{ old('mariage_status', $lecturer->mariage_status) == 'cerai mati' ? 'selected' : '' }}>
                                        Cerai Mati</option>
                                </select>
                                @error('mariage_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Employee Level field -->
                            <div class="form-group">
                                <label for="employee_level_id">Level Pegawai</label>
                                <select name="employee_level_id" class="form-control">
                                    @foreach ($employeeLevels as $level)
                                        <option value="{{ $level->id }}"
                                            {{ old('employee_level_id', $lecturer->employee_level_id) == $level->id ? 'selected' : '' }}>
                                            {{ $level->name }}</option>
                                    @endforeach
                                </select>
                                @error('employee_level_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Level Education field -->
                            <div class="form-group">
                                <label for="level_education">Level Pendidikan</label>
                                <select name="level_education" class="form-control">
                                    <option value="S1"
                                        {{ old('level_education', $lecturer->level_education) == 'S1' ? 'selected' : '' }}>
                                        S1</option>
                                    <option value="S2"
                                        {{ old('level_education', $lecturer->level_education) == 'S2' ? 'selected' : '' }}>
                                        S2</option>
                                    <option value="S3"
                                        {{ old('level_education', $lecturer->level_education) == 'S3' ? 'selected' : '' }}>
                                        S3</option>
                                </select>
                                @error('level_education')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Number field -->
                            <div class="form-group">
                                <label for="phone_number">No Telepon</label>
                                <input type="text" name="phone_number" class="form-control"
                                    value="{{ old('phone_number', $lecturer->phone_number) }}">
                                @error('phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email field -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $lecturer->email) }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Assign Letter Number field -->
                            <div class="form-group">
                                <label for="assign_letter_number">No Surat Tugas</label>
                                <input type="text" name="assign_letter_number" class="form-control"
                                    value="{{ old('assign_letter_number', $lecturer->assign_letter_number) }}">
                                @error('assign_letter_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Assign Letter Date field -->
                            <div class="form-group">
                                <label for="assign_letter_date">Tanggal Surat Tugas</label>
                                <input type="date" name="assign_letter_date" class="form-control"
                                    value="{{ old('assign_letter_date', $lecturer->assign_letter_date) }}">
                                @error('assign_letter_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Assign Letter TMT field -->
                            <div class="form-group">
                                <label for="assign_letter_tmt">Tanggal TMT Surat Tugas</label>
                                <input type="date" name="assign_letter_tmt" class="form-control"
                                    value="{{ old('assign_letter_tmt', $lecturer->assign_letter_tmt) }}">
                                @error('assign_letter_tmt')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Exit Date field -->
                            <div class="form-group">
                                <label for="exit_date">Tanggal Keluar</label>
                                <input type="date" name="exit_date" class="form-control"
                                    value="{{ old('exit_date', $lecturer->exit_date) }}">
                                @error('exit_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- prodi --}}
                            <div class="form-group mt-2">
                                <label for="prodi_id">Prodi</label>
                                <select name="prodi_id" id="prodi_id" class="form-control" required>
                                    <option value="" disabled>Pilih Prodi</option>
                                    @foreach ($prodiList as $p)
                                        <option value="{{ $p->id_prodi }}"
                                            {{ old('prodi_id', $lecturer->prodi_id ?? '') == $p->id_prodi ? 'selected' : '' }}>
                                            {{ $p->nama_prodi }} <!-- Nama prodi diambil dari tabel all_prodi -->
                                        </option>
                                    @endforeach
                                </select>
                                @error('prodi_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Submit button -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
