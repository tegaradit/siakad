@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="wrapper">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Detail Dosen</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="javascript: void(0);">Data Perkuliahan</a>
                                        </li>
                                        <li class="breadcrumb-item active">Detail Dosen</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Detail Dosen</h4>
                                    <p class="card-title-desc">Informasi detail dosen berikut.</p>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>NUPTK</th>
                                                <td>{{ $lecturer->nuptk }}</td>
                                            </tr>
                                            <tr>
                                                <th>NIDN</th>
                                                <td>{{ $lecturer->nidn }}</td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td>{{ $lecturer->nik }}</td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td>{{ $lecturer->gender }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td>{{ $lecturer->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status Aktif</th>
                                                <td>{{ $lecturer->ActiveStatus->name ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Lahir</th>
                                                <td>{{ $lecturer->birth_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tempat Lahir</th>
                                                <td>{{ $lecturer->birth_place }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Ibu</th>
                                                <td>{{ $lecturer->mothers_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status Pernikahan</th>
                                                <td>{{ $lecturer->mariage_status }}</td>
                                            </tr>
                                            <tr>
                                                <th>Level Pegawai</th>
                                                <td>{{ $lecturer->employee_level->name ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Level Pendidikan</th>
                                                <td>{{ $lecturer->level_education }}</td>
                                            </tr>
                                            <tr>
                                                <th>No Telepon</th>
                                                <td>{{ $lecturer->phone_number }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $lecturer->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>No Surat Tugas</th>
                                                <td>{{ $lecturer->assign_letter_number }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Surat Tugas</th>
                                                <td>{{ $lecturer->assign_letter_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal TMT Surat Tugas</th>
                                                <td>{{ $lecturer->assign_letter_tmt }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Keluar</th>
                                                <td>{{ $lecturer->exit_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Prodi</th>
                                                <td>{{ $lecturer->all_prodi->nama_prodi ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="{{ route('lecturer.index') }}" class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
