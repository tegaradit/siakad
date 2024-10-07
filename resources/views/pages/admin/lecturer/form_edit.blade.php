@extends('layouts.home-layout')

@section('home-content')
    <style>
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
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18"></h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('lecturer.index') }}">Dosen</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form to edit an existing lecturer -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Dosen</h4>
                                <p class="card-title-desc">
                                    Isilah form untuk mengedit data dosen.
                                </p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('lecturer.update', $lecturer->id) }}" method="POST">

                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{-- <div class="card"> --}}
                                            <!-- NUPTK field (readonly) -->

                                            <div class="form-group form-row">
                                                <label for="nuptk">NUPTK</label>
                                                <input type="text" name="nuptk" class="form-control"
                                                    value="{{ old('nuptk', $lecturer->nuptk) }}">
                                                @error('nuptk')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- NIDN field -->
                                            <div class="form-group form-row">
                                                <label for="nidn">NIDN</label>
                                                <input type="text" name="nidn" class="form-control"
                                                    value="{{ old('nidn', $lecturer->nidn) }}">
                                                @error('nidn')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- NIK field -->
                                            <div class="form-group form-row">
                                                <label for="nik">NIK</label>
                                                <input type="text" name="nik" class="form-control"
                                                    value="{{ old('nik', $lecturer->nik) }}">
                                                @error('nik')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Gender field -->
                                            <div class="form-group form-row">
                                                <label for="gender">Gender</label>
                                                <select name="gender" class="form-control form-select">
                                                    <option value="Laki-laki"
                                                        {{ old('gender', $lecturer->gender) == 'Laki-laki' ? 'selected' : '' }}>
                                                        Laki-laki
                                                    </option>
                                                    <option value="Perempuan"
                                                        {{ old('gender', $lecturer->gender) == 'Perempuan' ? 'selected' : '' }}>
                                                        Perempuan
                                                    </option>
                                                </select>
                                                @error('gender')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Name field -->
                                            <div class="form-group form-row">
                                                <label for="name">Nama</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name', $lecturer->name) }}" required>
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Active Status field -->
                                            <div class="form-group form-row">
                                                <label for="active_status_id">Status Aktif</label>
                                                <select name="active_status_id" class="form-control form-select">
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
                                            <div class="form-group form-row">
                                                <label for="birth_date">Tanggal Lahir</label>
                                                <input type="date" name="birth_date" class="form-control"
                                                    value="{{ old('birth_date', $lecturer->birth_date) }}" required>
                                                @error('birth_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Birth Place field -->
                                            <div class="form-group form-row">
                                                <label for="birth_place">Tempat Lahir</label>
                                                <input type="text" name="birth_place" class="form-control"
                                                    value="{{ old('birth_place', $lecturer->birth_place) }}" required>
                                                @error('birth_place')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Mother's Name field -->
                                            <div class="form-group form-row">
                                                <label for="mothers_name">Nama Ibu</label>
                                                <input type="text" name="mothers_name" class="form-control"
                                                    value="{{ old('mothers_name', $lecturer->mothers_name) }}" required>
                                                @error('mothers_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Mariage Status field -->
                                            <div class="form-group form-row">
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
                                            {{-- </div> --}}
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Employee Level field -->
                                            <div class="form-group form-row">
                                                <label for="employee_level_id">Level Pegawai</label>
                                                <select name="employee_level_id" class="form-control form-select">
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
                                            <div class="form-group form-row">
                                                <label for="level_education">Level Pendidikan</label>
                                                <select name="level_education" class="form-control form-select">
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
                                            <div class="form-group form-row">
                                                <label for="phone_number">No Telepon</label>
                                                <input type="text" id="phone_number" name="phone_number"
                                                    class="form-control"
                                                    value="{{ old('phone_number', $lecturer->phone_number ?? '') }}">
                                                @error('phone_number')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <!-- Email field -->
                                            <div class="form-group form-row">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" class="form-control"
                                                    value="{{ old('email', $lecturer->email ?? '') }}" required>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Assign Letter Number field -->
                                            <div class="form-group form-row">
                                                <label for="assign_letter_number">No Surat Tugas</label>
                                                <input type="text" name="assign_letter_number" class="form-control"
                                                    value="{{ old('assign_letter_number', $lecturer->assign_letter_number) }}">
                                                @error('assign_letter_number')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Assign Letter Date field -->
                                            <div class="form-group form-row">
                                                <label for="assign_letter_date">Tanggal Surat Tugas</label>
                                                <input type="date" name="assign_letter_date" class="form-control"
                                                    value="{{ old('assign_letter_date', $lecturer->assign_letter_date) }}">
                                                @error('assign_letter_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Assign Letter TMT field -->
                                            <div class="form-group form-row">
                                                <label for="assign_letter_tmt">Tanggal TMT Surat Tugas</label>
                                                <input type="date" name="assign_letter_tmt" class="form-control"
                                                    value="{{ old('assign_letter_tmt', $lecturer->assign_letter_tmt) }}">
                                                @error('assign_letter_tmt')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Exit Date field -->
                                            <div class="form-group form-row">
                                                <label for="exit_date">Tanggal Keluar</label>
                                                <input type="date" name="exit_date" class="form-control"
                                                    value="{{ old('exit_date', $lecturer->exit_date) }}">
                                                @error('exit_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- prodi --}}
                                            <div class="form-group form-row mt-2">
                                                <label for="prodi_id">Prodi</label>
                                                <select name="prodi_id" id="prodi_id" class="form-control form-select" required>
                                                    <option value="" disabled>Pilih...</option>
                                                    @foreach ($prodiList as $p)
                                                        <option value="{{ $p->id_prodi }}"
                                                            {{ old('prodi_id', $lecturer->prodi_id ?? '') == $p->id_prodi ? 'selected' : '' }}>
                                                            {{ $p->nama_prodi }}
                                                            <!-- Nama prodi diambil dari tabel all_prodi -->
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('prodi_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Tombol Batal di sebelah kiri -->
                                        <div class="col-md-6 text-left">
                                            <button type="button" class="btn btn-secondary mt-3">Batal</button>
                                        </div>

                                        <!-- Tombol Update dan Tambah Pengguna di sebelah kanan -->
                                        <div class="col-md-6 d-flex justify-content-end ">
                                            <button type="submit" class="btn btn-primary mt-3">Ubah</button>
                                            <button type="button" class="btn btn-info mt-3 ms-3" id="createUserBtn"
                                                style="display: none">Buat
                                                Pengguna</button>
                                        </div>
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


    <!-- Include jQuery dan SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function checkEmailOnLoad() {
            const email = document.getElementById('email').value.trim();
            const createUserBtn = document.getElementById('createUserBtn');

            if (!email) {
                createUserBtn.style.display = 'none';
                Swal.fire({
                    title: 'Dosen belum punya pengguna',
                    text: 'Email masih kosong. Untuk membuat pengguna, email diisi dulu.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            } else {
                createUserBtn.style.display = 'inline-block'; 
            }
        }

        document.addEventListener('DOMContentLoaded', checkEmailOnLoad);

        // Menampilkan tombol "Buat Pengguna" jika email tidak kosong saat pengguna mengetik
        document.getElementById('email').addEventListener('input', function() {
            const email = this.value.trim();
            document.getElementById('createUserBtn').style.display = email ? 'inline-block' : 'none';
        });

        document.getElementById('createUserBtn').addEventListener('click', async function() {
            const email = document.getElementById('email').value.trim();

            // Cek jika email kosong
            if (!email) {
                Swal.fire('Email tidak boleh kosong.');
                return;
            }

            // Tampilkan loading saat memverifikasi
            Swal.fire({
                title: 'Verifikasi email...',
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                // Panggil API untuk mengecek email
                const response = await fetch(`{{ route('check.email') }}?email=${email}`);
                if (!response.ok) throw new Error('Gagal memverifikasi email');

                const data = await response.json();
                Swal.close(); // Tutup loading

                if (data.exists) {
                    return Swal.fire('Email sudah terdaftar. Data berhasil disimpan.');
                } else {
                    Swal.fire({
                        title: 'Email belum terdaftar. Silakan isi email yang valid.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                }
            } catch (error) {
                Swal.fire('Error:', error.message);
            }
        });
    </script>
@endsection
