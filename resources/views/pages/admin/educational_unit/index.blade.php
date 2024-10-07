@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="wrapper">
                    <!-- Sidebar -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18"></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="javascript: void(0);">Data Umum</a>
                                        </li>
                                        <li class="breadcrumb-item active">Satuan Pendidikan</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Data Satuan Pendidikan</h4>
                                    <p class="card-title-desc">Berikut adalah daftar seluruh satuan pendidikan.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>ID Satuan Pendidikan</th>
                                                    <th>Nama Lembaga</th>
                                                    <th>NSS</th>
                                                    <th>NPSN</th>
                                                    <th>Nama Singkat</th>
                                                    <th>Jalan</th>
                                                    <th>RT</th>
                                                    <th>RW</th>
                                                    <th>Nama Dusun</th>
                                                    <th>Desa/Kelurahan</th>   
                                                    <th>Kode POS</th>
                                                    <th>Lintang</th>
                                                    <th>Bujur</th>
                                                    <th>No Telp</th>
                                                    <th>No Fax</th>
                                                    <th>Email</th>
                                                    <th>Website</th>
                                                    <th>Status Satuan Pendidikan</th>
                                                    <th>Surat Keputusan Pendidrian</th>
                                                    <th>Tanggal Surat Keputusan Pendirian</th>
                                                    <th>Tanggal Berdiri</th>
                                                    <th>Surat Keputusan Izin Operasi</th>
                                                    <th>Tanggal Surat Keputusan Izin Operasi</th>
                                                    <th>No Rekening</th>
                                                    <th>Nama Bank</th>
                                                    <th>Unit Cabang</th>
                                                    <th>Nama Rekening</th>
                                                    <th>A mbs</th>
                                                    <th>Luas Tanah Milik</th>
                                                    <th>Luas Tanah Bukan Milik</th>
                                                    <th>A LPTK</th>
                                                    <th>Kode Registrasi</th>
                                                    <th>NPWP</th>
                                                    <th>No NPWP</th>
                                                    <th>Flag</th>
                                                    <th>ID Pembina</th>
                                                    <th>ID Blob</th>
                                                    <th>ID Status Milik</th>
                                                    <th>ID Wil</th>
                                                    <th>ID KK</th>
                                                    <th>ID BP</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
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
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('educational_unit.data') }}",
                columns: [
                    {
                        data: 'id_sp',
                        name: 'id_sp'
                    },
                    {
                        data: 'nm_lemb',
                        name: 'nm_lemb'
                    },
                    {
                        data: 'nss',
                        name: 'nss'
                    },
                    {
                        data: 'npsn',
                        name: 'npsn'
                    },
                    {
                        data: 'nm_singkat',
                        name: 'nm_singkat'
                    },
                    {
                        data: 'jln',
                        name: 'jln'
                    },
                    {
                        data: 'rt',
                        name: 'rt'
                    },
                    {
                        data: 'rw',
                        name: 'rw'
                    },
                    {
                        data: 'nm_dsn',
                        name: 'nm_dsn'
                    },
                    {
                        data: 'ds_kel',
                        name: 'ds_kel'
                    },
                    {
                        data: 'kode_pos',
                        name: 'kode_pos'
                    },
                    {
                        data: 'lintang',
                        name: 'lintang'
                    },
                    {
                        data: 'bujur',
                        name: 'bujur'
                    },
                    {
                        data: 'no_tel',
                        name: 'no_tel'
                    },
                    {
                        data: 'no_fax',
                        name: 'no_fax'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'website',
                        name: 'website'
                    },
                    {
                        data: 'stat_sp',
                        name: 'stat_sp'
                    },
                    {
                        data: 'sk_pendirian_sp',
                        name: 'sk_pendirian_sp'
                    },
                    {
                        data: 'tgl_sk_pendirian_sp',
                        name: 'tgl_sk_pendirian_sp'
                    },
                    {
                        data: 'tgl_berdiri',
                        name: 'tgl_berdiri'
                    },
                    {
                        data: 'sk_izin_operasi',
                        name: 'sk_izin_operasi'
                    },
                    {
                        data: 'tgl_sk_izin_operasi',
                        name: 'tgl_sk_izin_operasi'
                    },
                    {
                        data: 'no_rek',
                        name: 'no_rek'
                    },
                    {
                        data: 'nm_bank',
                        name: 'nm_bank'
                    },
                    {
                        data: 'unit_cabang',
                        name: 'unit_cabang'
                    },
                    {
                        data: 'nm_rek',
                        name: 'nm_rek'
                    },
                    {
                        data: 'a_mbs',
                        name: 'a_mbs'
                    },
                    {
                        data: 'luas_tanah_milik',
                        name: 'luas_tanah_milik'
                    },
                    {
                        data: 'luas_tanah_bukan_milik',
                        name: 'luas_tanah_bukan_milik'
                    },
                    {
                        data: 'a_lptk',
                        name: 'a_lptk'
                    },
                    {
                        data: 'kode_reg',
                        name: 'kode_reg'
                    },
                    {
                        data: 'npwp',
                        name: 'npwp'
                    },
                    {
                        data: 'nm_wp',
                        name: 'nm_wp'
                    },
                    {
                        data: 'flag',
                        name: 'flag'
                    },
                    {
                        data: 'id_pembina',
                        name: 'id_pembina'
                    },
                    {
                        data: 'id_blob',
                        name: 'id_blob'
                    },
                    {
                        data: 'id_stat_milik',
                        name: 'id_stat_milik'
                    },
                    {
                        data: 'id_wil',
                        name: 'id_wil'
                    },
                    {
                        data: 'id_kk',
                        name: 'id_kk'
                    },
                    {
                        data: 'id_bp',
                        name: 'id_bp'
                    }
                ]
            });
        });
    </script>
@endsection
