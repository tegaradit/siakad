@extends('layouts.home-layout')

@section('home-content')
<style>
   #select-pt .select2.select2-container.select2-container--default {
      width: 100% !important;
   }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="main-content">
   <div class="page-content">
      <h4>Tambah Data Mahasiswa</h4>
      <form class="container-fluid" action="{{ route('mahasiswa.store') }}" method="post" enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="existing_id_mahasiswa" id="existig_id_mahasiswa">

         <!-- Data Personal -->
         <div class="card mb-4">
            <div class="card-header bg-light-subtle">
               DATA PERSONAL
            </div>
            <div class="card-body">
               <div class="row mb-3">
                  <div class="d-grid col-md-10">
                     <div class="row mb-3">
                        <div class="col-md-6">
                           <label for="npm" class="form-label">NPM</label>
                           <input required type="number" class="form-control" name="nipd" value="{{ old('nipd') }}">
                           @error('nipd') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                           <label for="name" class="form-label">Nama</label>
                           <input required type="text" class="form-control" name="nm_pd" id="inp-nama-mahasiswa"
                              value="{{ old('nm_pd') }}">
                           @error('nm_pd') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                     </div>
                     <div class="row mb-3">
                        <div class="col-md-6">
                           <label for="phone" class="form-label">No. Hp</label>
                           <input required type="number" class="form-control" name="no_hp" id="no-hp"
                              value="{{ old('no_hp') }}">
                           @error('no_hp') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                           <label for="email" class="form-label">Email</label>
                           <input required type="email" class="form-control" name="email" id="email"
                              value="{{ old('email') }}">
                           @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                     </div>
                     <div class="row mb-3">
                        <div class="col-md-6">
                           <label for="studyProgram" class="form-label">Program Studi/Jenjang</label>
                           <select required id="studyProgram" class="form-select" name="id_prodi">
                              <option selected value="">:: Pilih Program Studi ::</option>
                              @foreach ($dataProdi as $prodi)
                                 <option value="{{ $prodi->id_prodi }}" {{ old('id_prodi') == $prodi->id_prodi ? 'selected' : '' }}>
                                    {{ "$prodi->jenjang_pendidikan $prodi->nama_prodi" }}
                                 </option>
                              @endforeach
                           </select>
                           @error('id_prodi') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                     </div>
                  </div>

                  <div class="col-md-2 row-md-2">
                     <div class="d-flex flex-column align-items-center">
                        <img id="img-preview"
                           src="{{ old('foto') ? asset('storage/') : 'https://placehold.co/100x120' }}"
                           style="object-fit: cover" rounded alt="Upload Foto" width="100" height="120">
                        <button id="img-upload-btn" type="button" class="btn btn-info">
                           Upload Foto
                           <input type="file" name="foto" id="img-input" hidden
                              accept="image/png, image/jpg, image/jpeg">
                        </button>
                        <p class="text-center mt-2 bg-warning text-white p-2" style="font-size: 0.7rem;">Upload foto
                           ukuran 4x6cm<br>dengan ukuran max 200 MB</p>
                        @error('foto') <span class="text-danger">{{ $message }}</span> @enderror
                     </div>
                  </div>
               </div>

               <div class="row mb-3">
                  <div class="col-md-3">
                     <label for="registrationType" class="form-label">Jenis Pendaftaran</label>
                     <select required id="registrationType" class="form-select" name="id_jns_daftar">
                        <option value='' selected>:: Pilih Jenis Pendaftaran ::</option>
                        <option value='1' {{ old('id_jns_daftar') == '1' ? 'selected' : '' }}>
                           Peserta didik baru</option>
                        <option value='2' {{ old('id_jns_daftar') == '2' ? 'selected' : '' }}>
                           Pindahan</option>
                        <option value='3' {{ old('id_jns_daftar') == '3' ? 'selected' : '' }}>
                           Naik kelas</option>
                        <option value='4' {{ old('id_jns_daftar') == '4' ? 'selected' : '' }}>
                           Akselerasi</option>
                        <option value='5' {{ old('id_jns_daftar') == '5' ? 'selected' : '' }}>
                           Mengulang</option>
                        <option value='6' {{ old('id_jns_daftar') == '6' ? 'selected' : '' }}>
                           Lanjutan semester</option>
                        <option value='8' {{ old('id_jns_daftar') == '8' ? 'selected' : '' }}>
                           Pindahan Alih Bentuk</option>
                        <option value='11' {{ old('id_jns_daftar') == '11' ? 'selected' : '' }}>Alih
                           Jenjang</option>
                        <option value='12' {{ old('id_jns_daftar') == '12' ? 'selected' : '' }}>Lintas
                           Jalur</option>
                        <option value='13' {{ old('id_jns_daftar') == '13' ? 'selected' : ''
                  }}>Rekognisi Pembelajar
                        </option>
                     </select>
                     @error('id_jns_daftar') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-3">
                     <label for="studentType" class="form-label">Jenis Mahasiswa</label>
                     <select required id="studentType" class="form-select" name="id_jenis_mhs">
                        <option value=''>:: Pilih Jenis Mahasiswa ::</option>
                        @foreach ($dataJenisMahasiswa as $jenisMahasiswa)
                     <option value="{{ $jenisMahasiswa->id }}" {{ old('id_jns_daftar') == $jenisMahasiswa->id ? 'selected' : '' }}>{{ $jenisMahasiswa->name }}</option>
                  @endforeach
                     </select>
                     @error('id_jenis_mhs') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-3">
                     <label for="startSemester" class="form-label">Mulai SMT</label>
                     <input required type="number" class="form-control" id="startSemester" name="mulai_smt"
                        value="{{ old('mulai_smt', $currentSemester != null ? $currentSemester->semester_id : '') }}">
                     @error('mulai_smt') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-3">
                     <label for="semesterStart" class="form-label">Mulai pada Semester</label>
                     <input required type="number" class="form-control" id="mulai-pada-semester" name="mulai_pada_smt"
                        value="{{ old('mulai_pada_smt',$currentSemester != null ? $currentSemester->smt : '') }}">
                     @error('mulai_pada_smt') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>
            </div>
         </div>

         <!-- Lengkapi Data Anda -->
         <div class="card">
            <div class="card-header bg-light-subtle">
               LENGKAPI DATA ANDA
            </div>
            <div class="card-body">
               <div class="row mb-3">
                  <div class="col-md-6">
                     <label for="jalan" class="form-label">Jalan</label>
                     <input required type="text" class="form-control" id="jalan" name="jln" value="{{ old('jln') }}">
                     @error('jln') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="dusun" class="form-label">Dusun</label>
                     <input required type="text" class="form-control" id="dusun" name="nm_dsn"
                        value="{{ old('nm_dsn') }}">
                     @error('nm_dsn') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>

               <div class="row mb-3">
                  <div class="col-md-6">
                     <label for="desa" class="form-label">Desa/Kelurahan</label>
                     <input required type="text" class="form-control" id="desa" name="ds_kel"
                        value="{{ old('ds_kel') }}">
                     @error('ds_kel') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="kecamatan" class="form-label">Kecamatan</label>
                     <select required class="form-control" id="inp-kecamatan" name="id_wil">
                        <option value="{{ old('id_wil') }}" selected></option>
                     </select>
                     @error('id_wil') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-md-1">
                     <label for="rt" class="form-label">RT</label>
                     <input required type="number" class="form-control" id="rt" name="rt" value="{{ old('rt') }}">
                     @error('rt') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-1">
                     <label for="rw" class="form-label">RW</label>
                     <input required type="number" class="form-control" id="rw" name="rw" value="{{ old('rw') }}">
                     @error('rw') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-4">
                     <label for="kodePos" class="form-label">Kode Pos</label>
                     <input required type="number" class="form-control" id="kodePos" name="kode_pos"
                        value="{{ old('kode_pos') }}">
                     @error('kode_pos') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-3">
                     <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                     <input required type="text" class="form-control" id="tempatLahir" name="tmpt_lahir"
                        value="{{ old('tmpt_lahir') }}">
                     @error('tmpt_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-3">
                     <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                     <input required type="date" class="form-control" id="tanggalLahir" name="tgl_lahir"
                        value="{{ old('tgl_lahir') }}">
                     @error('tgl_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>

               <div class="row mb-3">
                  <div class="col-md-3">
                     <label for="nik" class="form-label">NIK</label>
                     <input required type="number" class="form-control" id="nik" name="nik" value="{{ old('nik') }}">
                     @error('nik') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-3">
                     <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                     <select required id="jenisKelamin" class="form-select" name="jk">
                        <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                        <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                     </select>
                     @error('jk') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-2">
                     <label for="golDarah" class="form-label">Gol. Darah</label>
                     <select required id="golDarah" class="form-select" name="id_goldarah">
                        <option value='' selected>:: A/B/O/AB ::</option>
                        <option value='1' {{ old('id_goldarah') == '1' ? 'selected' : '' }}>A
                        </option>
                        <option value='2' {{ old('id_goldarah') == '2' ? 'selected' : '' }}>B
                        </option>
                        <option value='3' {{ old('id_goldarah') == '3' ? 'selected' : '' }}>AB
                        </option>
                        <option value='4' {{ old('id_goldarah') == '4' ? 'selected' : '' }}>O
                        </option>
                     </select>
                     @error('id_goldarah') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-2">
                     <label for="agama" class="form-label">Agama</label>
                     <select required id="agama" class="form-select" name="id_agama">
                        <option value='' selected>:: Pilih Agama ::</option>
                        <option value='1' {{ old('id_agama') == '1' ? 'selected' : '' }}>Islam
                        </option>
                        <option value='2' {{ old('id_agama') == '2' ? 'selected' : '' }}>Kristen
                        </option>
                        <option value='3' {{ old('id_agama') == '3' ? 'selected' : '' }}>Katholik
                        </option>
                        <option value='4' {{ old('id_agama') == '4' ? 'selected' : '' }}>Hindu
                        </option>
                        <option value='5' {{ old('id_agama') == '5' ? 'selected' : '' }}>Budha
                        </option>
                        <option value='6' {{ old('id_agama') == '6' ? 'selected' : '' }}>Konghucu
                        </option>
                        <option value='99' {{ old('id_agama') == '99' ? 'selected' : '' }}>Lainnya
                        </option>
                     </select>
                     @error('id_agama') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-2 d-flex align-items-center">
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="penerimaKPS" name="a_terima_kps" {{ old('a_terima_kps') ? 'checked' : '' }}>
                        <label class="form-check-label" for="penerimaKPS">Penerima KPS</label>
                        @error('a_terima_kps') <span class="text-danger">{{ $message }}</span> @enderror
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="card">
            <div class="card-header bg-light-subtle">
               DATA SEKOLAH ASAL
            </div>
            <div class="card-body">
               <div class="row mb-3">
                  <div class="col-md-6">
                     <label for="asalSekolah" class="form-label">Asal Sekolah</label>
                     <input required type="text" class="form-control" id="asalSekolah" name="asal_sma"
                        value="{{ old('asal_sma') }}">
                     @error('asal_sma') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="jurusanSekolah" class="form-label">Jurusan Sekolah</label>
                     <select required class="form-select" id="jurusanSekolah" name="jurusan_sekolah_asal">
                        <option selected value="">Pilih Jurusan sekolah</option>
                        <option value="IPA" {{ old('jurusan_sekolah_asal') == 'IPA' ? 'selected' : '' }}>IPA</option>
                        <option value="IPS" {{ old('jurusan_sekolah_asal') == 'IPS' ? 'selected' : '' }}>IPS</option>
                        <option value="Lainnya" {{ old('jurusan_sekolah_asal') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                        </option>
                     </select>
                     @error('jurusan_sekolah_asal') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-md-6">
                     <label for="nomorSTTB" class="form-label">Nomor STTB</label>
                     <input required type="number" class="form-control" id="nomorSTTB" name="nomor_sttb"
                        value="{{ old('nomor_sttb') }}">
                     @error('nomor_sttb') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="jenjangSekolah" class="form-label">Jenjang Sekolah</label>
                     <select required class="form-select" id="jenjangSekolah" name="jenjangsekolah">
                        <option value="" selected>Pilih Program Sekolah</option>
                        <option value="SMA" {{ old('jenjangsekolah') == 'SMA' ? 'selected' : '' }}>SMA</option>
                        <option value="SMK" {{ old('jenjangsekolah') == 'SMK' ? 'selected' : '' }}>SMK</option>
                     </select>
                     @error('jenjangsekolah') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-md-6">
                     <label for="NISN" class="form-label">NISN</label>
                     <input required type="number" class="form-control" id="NISN" name="nisn" value="{{ old('nisn') }}">
                     @error('nisn') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="rataNilaiSTTB" class="form-label">Rata Nilai STTB</label>
                     <input required type="text" class="form-control" id="rataNilaiSTTB" name="rata_nilai_sttb"
                        value="{{ old('rata_nilai_sttb') }}">
                     @error('rata_nilai_sttb') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>
            </div>
         </div>

         <div class="card">
            <div class="card-header bg-light-subtle">
               DATA ORANG TUA
            </div>
            <div class="card-body">
               <div class="row mb-3">
                  <div class="col-md-6">
                     <label for="nikAyah" class="form-label">NIK Ayah</label>
                     <input required type="number" class="form-control" id="nikAyah" name="nik_ayah"
                        value="{{ old('nik_ayah') }}">
                     @error('nik_ayah') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="nikIbu" class="form-label">NIK Ibu</label>
                     <input required type="number" class="form-control" id="nikIbu" name="nik_ibu"
                        value="{{ old('nik_ibu') }}">
                     @error('nik_ibu') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-md-6">
                     <label for="namaAyah" class="form-label">Nama Ayah</label>
                     <input required type="text" class="form-control" id="namaAyah" name="nm_ayah"
                        value="{{ old('nm_ayah') }}">
                     @error('nm_ayah') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="namaIbu" class="form-label">Nama Ibu</label>
                     <input required type="text" class="form-control" id="namaIbu" name="nm_ibu_kandung"
                        value="{{ old('nm_ibu_kandung') }}">
                     @error('nm_ibu_kandung') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-md-6">
                     <label for="pekerjaanAyah" class="form-label">Pekerjaan Ayah</label>
                     <select required class="form-select" id="pekerjaanAyah" name="id_pekerjaan_ayah">
                        <option value='' selected>:: Pilih Pekerjaan ::</option>
                        <option value='0' {{ old('id_pekerjaan_ibu') == '0' ? 'selected' : '' }}>Tidak bekerja</option>
                        <option value='1' {{ old('id_pekerjaan_ibu') == '1' ? 'selected' : '' }}>Nelayan</option>
                        <option value='2' {{ old('id_pekerjaan_ibu') == '2' ? 'selected' : '' }}>Petani</option>
                        <option value='3' {{ old('id_pekerjaan_ibu') == '3' ? 'selected' : '' }}>Peternak</option>
                        <option value='4' {{ old('id_pekerjaan_ibu') == '4' ? 'selected' : '' }}>PNS/TNI/Polri</option>
                        <option value='5' {{ old('id_pekerjaan_ibu') == '5' ? 'selected' : '' }}>Karyawan Swasta</option>
                        <option value='6' {{ old('id_pekerjaan_ibu') == '6' ? 'selected' : '' }}>Pedagang Kecil</option>
                        <option value='7' {{ old('id_pekerjaan_ibu') == '7' ? 'selected' : '' }}>Pedagang Besar</option>
                        <option value='8' {{ old('id_pekerjaan_ibu') == '8' ? 'selected' : '' }}>Wiraswasta</option>
                        <option value='9' {{ old('id_pekerjaan_ibu') == '9' ? 'selected' : '' }}>Wirausaha</option>
                        <option value='10' {{ old('id_pekerjaan_ibu') == '10' ? 'selected' : '' }}>Buruh</option>
                        <option value='11' {{ old('id_pekerjaan_ibu') == '11' ? 'selected' : '' }}>Pensiunan</option>
                        <option value='12' {{ old('id_pekerjaan_ibu') == '12' ? 'selected' : '' }}>Sudah Meninggal</option>
                        <option value='13' {{ old('id_pekerjaan_ibu') == '13' ? 'selected' : '' }}>Lainnya</option>
                     </select>
                     @error('id_pekerjaan_ayah') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="pekerjaanIbu" class="form-label">Pekerjaan Ibu</label>
                     <select required class="form-select" id="pekerjaanIbu" name="id_pekerjaan_ibu">
                        <option value='' selected>:: Pilih Pekerjaan ::</option>
                        <option value='0' {{ old('id_pekerjaan_ibu') == '0' ? 'selected' : '' }}>Tidak bekerja</option>
                        <option value='1' {{ old('id_pekerjaan_ibu') == '1' ? 'selected' : '' }}>Nelayan</option>
                        <option value='2' {{ old('id_pekerjaan_ibu') == '2' ? 'selected' : '' }}>Petani</option>
                        <option value='3' {{ old('id_pekerjaan_ibu') == '3' ? 'selected' : '' }}>Peternak</option>
                        <option value='4' {{ old('id_pekerjaan_ibu') == '4' ? 'selected' : '' }}>PNS/TNI/Polri</option>
                        <option value='5' {{ old('id_pekerjaan_ibu') == '5' ? 'selected' : '' }}>Karyawan Swasta</option>
                        <option value='6' {{ old('id_pekerjaan_ibu') == '6' ? 'selected' : '' }}>Pedagang Kecil</option>
                        <option value='7' {{ old('id_pekerjaan_ibu') == '7' ? 'selected' : '' }}>Pedagang Besar</option>
                        <option value='8' {{ old('id_pekerjaan_ibu') == '8' ? 'selected' : '' }}>Wiraswasta</option>
                        <option value='9' {{ old('id_pekerjaan_ibu') == '9' ? 'selected' : '' }}>Wirausaha</option>
                        <option value='10' {{ old('id_pekerjaan_ibu') == '10' ? 'selected' : '' }}>Buruh</option>
                        <option value='11' {{ old('id_pekerjaan_ibu') == '11' ? 'selected' : '' }}>Pensiunan</option>
                        <option value='12' {{ old('id_pekerjaan_ibu') == '12' ? 'selected' : '' }}>Sudah Meninggal</option>
                        <option value='13' {{ old('id_pekerjaan_ibu') == '13' ? 'selected' : '' }}>Lainnya</option>
                     </select>
                     @error('id_pekerjaan_ibu') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>
            </div>
         </div>

         <div class="card" id="advanced-form" style="display: none">
            <div class="card-header bg-light-subtle">
               KHUSUS BAGI CALON MAHASISWA PINDAHAN/MELANJUTKAN
            </div>
            <div class="card-body">
               <div class="row mb-3">
                  <div class="col-md-3" id="select-pt">
                     <label for="inp-id-pt=asal" class="form-label d-block">Nama Perguruan Tinggi Asal</label>
                     <select required class="form-control w-100" id="inp-id-pt-asal" name="id_pt_asal">
                        <option value="{{ old('id_pt_asal') }}" selected></option>
                     </select>
                     @error('id_pt_asal') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-3">
                     <label for="programStudiAsal" class="form-label">Program Studi Asal </label>
                     <select class="form-select" id="programStudiAsal" name="id_prodi_asal">
                        <option value="" selected>:: Pilih Program Studi ::</option>
                        <option value="0">Lainnya</option>
                     </select>
                     @error('id_prodi_asal') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-3">
                     <label for="sksDiakui" class="form-label">SKS diakui </label>
                     <input type="number" class="form-control" id="sksDiakui" name="sks_diakui"
                        value="{{ old('sks_diakui') }}">
                     @error('sks_diakui') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-3">
                     <label for="nomorIjazahAsal" class="form-label">Nomor Ijazah Asal</label>
                     <input type="number" class="form-control" id="nomorIjazahAsal" name="no_seri_ijazah"
                        value="{{ old('no_seri_ijazah') }}">
                     @error('no_seri_ijazah') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>
            </div>
         </div>
         <div class="row mb-3">
            <div class="d-grid gap-2" style="place-content: center;">
               <button type="submit" class="btn btn-warning">Simpan</button>
            </div>
         </div>
      </form>
   </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   //--> syntax for search "pt asal"
   $("#inp-id-pt-asal").select2({
      ajax: {
         delay: 250,
         url: '{{ route('mahasiswa.searchUniversity') }}',
         data(params) {
            var query = {
               universityName: params.term,
            }
            return query;
         },
         processResults(data) {
            return {
               results: data.map(item => ({
                  id: `${item.id_sp}`,  // The value for the option
                  text: item.nm_lemb  // The displayed text
               }))
            }
         }
      },
      minimumInputLength: 3,
      templateResult(res) {
         return res.text
      }
   })

   //--> selec2 for autocomplete kecamatan
   $("#inp-kecamatan").select2({
      ajax: {
         delay: 250,
         url: '{{ url('/') }}/admin/mahasiswa/search_wilayah',
         data(params) {
            var query = {
               nama_wilayah: params.term,
            }
            return query;
         },
         processResults(data) {
            return {
               results: data.map(item => ({
                  id: `${item.id_kecamatan}-${item.id_kabupaten}-${item.id_provinsi}`,  // The value for the option
                  text: item.data  // The displayed text
               }))
            }
         }
      },
      minimumInputLength: 3,
      templateResult(res) {
         return res.text
      }
   })

   //--> syntax for search "prodi" by university name
   const programStudiAsal = document.getElementById('programStudiAsal')
   $('#inp-id-pt-asal').on("select2:close", ev => { 
      const selectedValue = $("#inp-id-pt-asal option:selected").val()
      fetch(`{{ url('/') }}/admin/mahasiswa/searchProdiByUnivName?id_sp=${selectedValue}`)
      .then(res => {
         if (res.status < 400)
            return res.json()
         return null
      })
      .then(data => {
         if (data) {
            if (!data.empty) {
               let options = '<option value="" selected>:: Pilih Program Studi ::</option>'
               data.forEach(item => {
                  options += `<option value="${item.id_prodi}">${item.nama_prodi}</option>`
               })
               options += '<option value="0">Lainnya</option>'
               programStudiAsal.innerHTML = options;
            }
         }
      })
      .catch(err => {
         console.log(err)
      })
   });

   //--> syntax for automatic fill the "Mulai pada Semester" input
   const semesterStart = document.getElementById("mulai-pada-semester");
   document.getElementById('startSemester').addEventListener('blur', ev => {
      semesterStart.value = ev.target.value.charAt(ev.target.value.length - 1)
   })

   //--> syntax for detect registration type
   const advancedForm = document.getElementById('advanced-form')
   const showWhenValue = ['6', '2']
   const regisType = document.getElementById('registrationType')
   regisType.addEventListener('change', ({ target }) => {
      advancedForm.style.display = showWhenValue.includes(target.value) ? 'block' : 'none'
   })
   window.addEventListener('DOMContentLoaded', () => {
      advancedForm.style.display = showWhenValue.includes(regisType.value) ? 'block' : 'none'
   })

   //--> syntax for image preview
   const imgPreview = document.getElementById('img-preview')
   const imgUploadBtn = document.getElementById('img-upload-btn')
   const imgInput = document.getElementById('img-input')

   imgUploadBtn.addEventListener('click', () => imgInput.click())
   imgInput.addEventListener('change', ev => {
      imgPreview.src = URL.createObjectURL(ev.target.files[0])
   })

   //--> syntax for inject the current data "mahasiswa" from user comfimation into the correct input
   let foundedData
   const elementInputTargets = {}
   const idtInputTargets = [
      'no-hp', 'email', 'img-input',
      'jalan', 'dusun', 'desa',
      'inp-kecamatan', 'rt', 'rw',
      'kodePos', 'tempatLahir', 'tanggalLahir',
      'nik', 'jenisKelamin', 'golDarah',
      'agama', 'penerimaKPS', 'asalSekolah',
      'nomorSTTB', 'jenjangSekolah', 'NISN',
      'rataNilaiSTTB', 'nikAyah', 'namaAyah',
      'pekerjaanAyah', 'nikIbu', 'namaIbu',
      'pekerjaanIbu', 'jurusanSekolah'
   ].forEach(id => { elementInputTargets[id] = document.getElementById(id) })

   function fillData(resIndex) {
      if (foundedData) {
         const dataMahasiswa = foundedData[resIndex]
         document.getElementById('existig_id_mahasiswa').value = dataMahasiswa.id_pd

         elementInputTargets['no-hp'].value = dataMahasiswa.no_hp
         elementInputTargets['email'].value = dataMahasiswa.email
         elementInputTargets['jalan'].value = dataMahasiswa.jln
         elementInputTargets['dusun'].value = dataMahasiswa.nm_dsn
         elementInputTargets['desa'].value = dataMahasiswa.ds_kel
         elementInputTargets['inp-kecamatan'].value = dataMahasiswa.id_kecamatan
         elementInputTargets['rt'].value = dataMahasiswa.rt
         elementInputTargets['rw'].value = dataMahasiswa.rw
         elementInputTargets['kodePos'].value = dataMahasiswa.kode_pos
         elementInputTargets['tempatLahir'].value = dataMahasiswa.tmpt_lahir
         elementInputTargets['tanggalLahir'].value = dataMahasiswa.tgl_lahir
         elementInputTargets['nik'].value = dataMahasiswa.nik
         elementInputTargets['jenisKelamin'].value = dataMahasiswa.jk
         elementInputTargets['golDarah'].value = dataMahasiswa.id_goldarah
         elementInputTargets['agama'].value = dataMahasiswa.id_agama
         elementInputTargets['penerimaKPS'].checked = dataMahasiswa.a_terima_kps == "1"
         elementInputTargets['asalSekolah'].value = dataMahasiswa.asal_sma
         elementInputTargets['jurusanSekolah'].value = dataMahasiswa.jurusan_sekolah_asal
         elementInputTargets['nomorSTTB'].value = dataMahasiswa.nomor_sttb
         elementInputTargets['jenjangSekolah'].value = dataMahasiswa.jenjangsekolah
         elementInputTargets['NISN'].value = dataMahasiswa.nisn
         elementInputTargets['rataNilaiSTTB'].value = dataMahasiswa.rata_nilai_sttb
         elementInputTargets['nikAyah'].value = dataMahasiswa.nik_ayah
         elementInputTargets['namaAyah'].value = dataMahasiswa.nm_ayah
         elementInputTargets['pekerjaanAyah'].value = dataMahasiswa.id_pekerjaan_ayah
         elementInputTargets['nikIbu'].value = dataMahasiswa.nik_ibu
         elementInputTargets['namaIbu'].value = dataMahasiswa.nm_ibu_kandung
         elementInputTargets['pekerjaanIbu'].value = dataMahasiswa.id_pekerjaan_ibu

         imgPreview.src = dataMahasiswa.foto ? `{{ Storage::url('') }}` + dataMahasiswa.foto : 'https://placehold.co/100x120'
         swal.close()
      }
   }

   //--> syntax for display details "nama mahasiswa" we'll found
   function displayDetailFound(res) {
      let template = ""
      res.forEach((item, index) => {
         template += `
         <div class="d-flex justify-content-between pb-1 border-bottom border-primary align-items-center">
            <p class="card-title">${item.nm_pd}</p>
            <button onclick="fillData(${index})" class="btn btn-sm btn-outline-primary">Konfirmasi</button>
         </div>
      `
      })

      Swal.fire({
         title: 'Daftar Nama',
         showCancelButton: true,
         showConfirmButton: false,
         cancelButtonColor: '#d33',
         html: template
      })
   }

   //--> syntax for search "nama mahasiswa"
   const inpNamaMahasiswa = document.getElementById('inp-nama-mahasiswa')
   let loading = false
   inpNamaMahasiswa.addEventListener('blur', ev => {
      if (!loading && ev.target.value.length >= 3) {
         loading = true
         fetch(`{{ route('mahasiswa.search') }}`, {
            method: 'post',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ name: ev.target.value.toUpperCase() })
         })
            .then(res => res.json())
            .then(res => {
               if (Array.isArray(res)) {
                  if (res.length > 0) {
                     foundedData = res

                     if ('{{ $errors->any() }}'.length > 0) {
                        const resId = res.findIndex((val) =>
                           val.nm_pd.toLowerCase() == ev.target.value.toLowerCase()
                        )
                        return fillData(resId)
                     }

                     Swal.fire({
                        title: "Anda Merasa Sudah Terdaftar?",
                        text: `Nama Mahasiswa yang mirip dengan "${ev.target.value}" di temukan di sistem, klik Ya untuk melihat detail nya`,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak'
                     }).then((result) => {
                        if (result.isConfirmed) {
                           displayDetailFound(res)
                        }
                     });
                  }
               }
            })
            .finally(() => {
               loading = false
            })
      }
   })

   window.addEventListener('DOMContentLoaded', () => {
      if (inpNamaMahasiswa.value) {
         console.log(inpNamaMahasiswa.value)
         inpNamaMahasiswa.focus()
         inpNamaMahasiswa.blur()
      }
   })
</script>
@endsection