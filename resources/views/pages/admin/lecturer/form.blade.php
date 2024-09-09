@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Tambah Dosen</h4>
                </div>

                <!-- Form to create a new lecturer -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('lecturer.store') }}" method="POST">
                            @csrf

                            <!-- NUPTK field -->
                            <div class="form-group">
                                <label for="nuptk">NUPTK</label>
                                <input type="text" name="nuptk" class="form-control" value="{{ old('nuptk') }}"
                                    required>
                                @error('nuptk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- NIDN field -->
                            <div class="form-group">
                                <label for="nidn">NIDN</label>
                                <input type="text" name="nidn" class="form-control" value="{{ old('nidn') }}">
                                @error('nidn')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- NIK field -->
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" class="form-control" value="{{ old('nik') }}">
                                @error('nik')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gender field -->
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Active Status ID field -->
                            <div class="form-group">
                                <label for="active_status_id">Active Status</label>
                                <select name="active_status_id" class="form-control" required>
                                    <option value="">Select Status</option>
                                    @foreach ($activeStatuses as $status)
                                        <option value="{{ $status->id }}"
                                            {{ old('active_status_id') == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('active_status_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Birth Date field -->
                            <div class="form-group">
                                <label for="birth_date">Birth Date</label>
                                <input type="date" name="birth_date" class="form-control"
                                    value="{{ old('birth_date') }}" required>
                                @error('birth_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Birth Place field -->
                            <div class="form-group">
                                <label for="birth_place">Birth Place</label>
                                <input type="text" name="birth_place" class="form-control"
                                    value="{{ old('birth_place') }}" required>
                                @error('birth_place')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mother's Name field -->
                            <div class="form-group">
                                <label for="mothers_name">Mother's Name</label>
                                <input type="text" name="mothers_name" class="form-control"
                                    value="{{ old('mothers_name') }}" required>
                                @error('mothers_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Marriage Status field -->
                            <div class="form-group">
                                <label for="mariage_status">Marriage Status</label>
                                <select name="mariage_status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="belum kawin"
                                        {{ old('mariage_status') == 'belum kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                    <option value="kawin" {{ old('mariage_status') == 'kawin' ? 'selected' : '' }}>Kawin
                                    </option>
                                    <option value="cerai hidup"
                                        {{ old('mariage_status') == 'cerai hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="cerai mati"
                                        {{ old('mariage_status') == 'cerai mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                                @error('mariage_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Employee Level ID field -->
                            <div class="form-group">
                                <label for="employee_level_id">Employee Level</label>
                                <select name="employee_level_id" class="form-control" required>
                                    <option value="">Select Level</option>
                                    @foreach ($employeeLevels as $level)
                                        <option value="{{ $level->id }}"
                                            {{ old('employee_level_id') == $level->id ? 'selected' : '' }}>
                                            {{ $level->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_level_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Level of Education field -->
                            <div class="form-group">
                                <label for="level_education">Level of Education</label>
                                <select name="level_education" class="form-control" required>
                                    <option value="">Select Education Level</option>
                                    <option value="S1" {{ old('level_education') == 'S1' ? 'selected' : '' }}>S1
                                    </option>
                                    <option value="S2" {{ old('level_education') == 'S2' ? 'selected' : '' }}>S2
                                    </option>
                                    <option value="S3" {{ old('level_education') == 'S3' ? 'selected' : '' }}>S3
                                    </option>
                                </select>
                                @error('level_education')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Number field -->
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control"
                                    value="{{ old('phone_number') }}">
                                @error('phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email field -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Assign Letter Number field -->
                            <div class="form-group">
                                <label for="assign_letter_number">Assign Letter Number</label>
                                <input type="text" name="assign_letter_number" class="form-control"
                                    value="{{ old('assign_letter_number') }}">
                                @error('assign_letter_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Assign Letter Date field -->
                            <div class="form-group">
                                <label for="assign_letter_date">Assign Letter Date</label>
                                <input type="date" name="assign_letter_date" class="form-control"
                                    value="{{ old('assign_letter_date') }}">
                                @error('assign_letter_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Assign Letter TMT field -->
                            <div class="form-group">
                                <label for="assign_letter_tmt">Assign Letter TMT</label>
                                <input type="date" name="assign_letter_tmt" class="form-control"
                                    value="{{ old('assign_letter_tmt') }}">
                                @error('assign_letter_tmt')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Exit Date field -->
                            <div class="form-group">
                                <label for="exit_date">Exit Date</label>
                                <input type="date" name="exit_date" class="form-control"
                                    value="{{ old('exit_date') }}">
                                @error('exit_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Prodi ID field -->
                            <div class="form-group">
                                <label for="prodi_id">Prodi</label>
                                <select name="prodi_id" class="form-control" required>
                                    <option value="">Select Prodi</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}"
                                            {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                            {{ $prodi->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('prodi_id')
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
@endsection
