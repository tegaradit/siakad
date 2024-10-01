<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu" style="width: 30rem">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('dashboard.admin') }}">
                        <i data-feather="home"></i>
                        <span data-key="dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">Sistem Akademik</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="database"></i>
                        <span data-key="t-apps">Data Umum</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="/admin/identitas-pt">
                                <span data-key="t-identitas-pt">Identitas PT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('educational_unit.index') }}">
                                <span data-key="t-daftar-pt">Daftar PT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('all_prodi.index') }}">
                                <span data-key="t-daftar-prodi">Daftar Program Studi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('prodi') }}">
                                <span data-key="t-prodi-pt">Program Studi PT</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('buildings.index') }}">
                                <span data-key="t-gedung">Gedung</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('room.index') }}">
                                <span data-key="t-ruangan">Ruangan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}">
                                <span data-key="t-pengguna">Pengguna</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register-type.index') }}">
                                <span data-key="t-pengguna">Tipe Register</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('student-type.index') }}">
                                <span data-key="t-pengguna">Jenis Mahasiswa</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="clipboard"></i>
                        <span data-key="t-components">Data Perkuliahan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('periode_pmb.index') }}">
                                <span data-key="t-pmb">PMB</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tahun-akademik.index') }}">
                                <span data-key="t-tahun-akademik">Tahun Akademik</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('semester.index') }}">
                                <span data-key="t-semester">Semester</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lecture-setting.index') }}">
                                <span data-key="t-setting-perkuliahan">Setting Perkuliahan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('calendar-type.index') }}">
                                <span data-key="t-tipe-kalender">Tipe Kalender</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kalender-akademik.index') }}">
                                <span data-key="t-kalender-akademik">Kalender Akademik</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lecturer.index') }}">
                                <span data-key="t-dosen">Dosen</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('course.index') }}">
                                <span data-key="t-mata-kuliah">Mata Kuliah</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('curriculum.index') }}">
                                <span data-key="t-kurikulum">Kurikulum</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-mahasiswa">Mahasiswa</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="check-circle"></i>
                        <span data-key="t-edom">EDOM</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="index.html">
                                {{-- <i data-feather="align-justify"></i> --}}
                                <span data-key="t-kelompok-komponen">Kelompok Komponen</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-komponen-penilaian">Komponen Penilaian</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-penilaian">Penilaian</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="calendar"></i>
                        <span data-key="t-edom">Penjadwalan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="index.html">
                                <span data-key="t-kelompok-komponen">Waktu Perkuliahan</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-komponen-penilaian">Jadwal Kuliah</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-penilaian">Jadwal Ujian</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="mail"></i>
                        <span data-key="t-transaksi-perkuliahan">Transaksi Perkuliahan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="index.html">
                                <span data-key="t-kelas-perkuliahan">Kelas Perkuliahan</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-perwalian-krs">Perwalian/KRS</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-aktivitas-kuliah-mahasiswa">Aktivitas Kuliah Mahasiswa</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-aktivitas-mahasiswa">Aktivitas Mahasiswa</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-khs">KHS</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-transkrip">Transkrip</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-daftar-lulus-do">Daftar Mahasiswa Lulus/DO</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-pelaksanaan-wisuda">Pelaksanaan Wisuda</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-pendaftaran-wisuda">Pendaftaran Wisuda</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="server"></i>
                        <span data-key="t-dashboard">Feeder</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Kurikulum</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Mahasiswa</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Kelas Kuliah</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Dosen Ajar</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">KRS</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Nilai Perkuliahan</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">AKM</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Nilai Transfer</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Histori Pendidikan</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Kelulusan</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Tabel</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Setting User</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="archive"></i>
                        <span data-key="t-dashboard">Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Pencapaian Nilai MK</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Rekap UTS</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Rekap UAS</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Rekap Registrasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <span data-key="t-dashboard">Rekap Perwalian</span>
                            </a>
                        </li>
                    </ul>
                </li>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentUrl = window.location.href;

        // Cari elemen sidebar lecturer
        var lecturerSidebar = document.getElementById("lecturer-sidebar");

        // Cek jika URL mengandung '/admin/lecturer'
        if (currentUrl.includes('/admin/lecturer')) {
            lecturerSidebar.classList.add("active");
        }
    });
</script>
