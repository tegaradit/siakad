<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu" style="width: 30rem">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-menu">Data Umum</li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Identitas PT</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Daftar PT</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Daftar Program Studi</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Program Studi PT</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('buildings.index') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Gedung</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('room.index')}}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Ruangan</span>
                    </a> 
                </li>

                <li>
                    <a href="{{ route('users.index') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Pengguna</span>
                    </a>
                </li>

                {{-- <li>
                     <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Apps</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li>
                           <a href="apps-calendar.html">
                              <span data-key="t-calendar">Calendar</span>
                           </a>
                        </li>

                        <li>
                           <a href="apps-chat.html">
                              <span data-key="t-chat">Chat</span>
                           </a>
                        </li>

                        <li>
                           <a href="javascript: void(0);" class="has-arrow">
                              <span data-key="t-email">Email</span>
                           </a>
                           <ul class="sub-menu" aria-expanded="false">
                              <li>
                                 <a href="apps-email-inbox.html" data-key="t-inbox">Inbox</a>
                              </li>
                              <li>
                                 <a href="apps-email-read.html" data-key="t-read-email">Read Email</a>
                              </li>
                           </ul>
                        </li>
                        <li>
                           <a href="javascript: void(0);" class="has-arrow">
                              <span data-key="t-invoices">Invoices</span>
                           </a>
                           <ul class="sub-menu" aria-expanded="false">
                              <li>
                                 <a href="apps-invoices-list.html" data-key="t-invoice-list">Invoice List</a>
                              </li>
                              <li>
                                 <a href="apps-invoices-detail.html" data-key="t-invoice-detail">Invoice Detail</a>
                              </li>
                           </ul>
                        </li>
                        <li>
                           <a href="javascript: void(0);" class="has-arrow">
                              <span data-key="t-contacts">Contacts</span>
                           </a>
                           <ul class="sub-menu" aria-expanded="false">
                              <li>
                                 <a href="apps-contacts-grid.html" data-key="t-user-grid">User Grid</a>
                              </li>
                              <li>
                                 <a href="apps-contacts-list.html" data-key="t-user-list">User List</a>
                              </li>
                              <li>
                                 <a href="apps-contacts-profile.html" data-key="t-profile">Profile</a>
                              </li>
                           </ul>
                        </li>
                        <li>
                           <a href="javascript: void(0);" class="">
                              <span data-key="t-blog">Blog</span>
                              <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">New</span>
                           </a>
                           <ul class="sub-menu" aria-expanded="false">
                              <li>
                                 <a href="apps-blog-grid.html" data-key="t-blog-grid">Blog Grid</a>
                              </li>
                              <li>
                                 <a href="apps-blog-list.html" data-key="t-blog-list">Blog List</a>
                              </li>
                              <li>
                                 <a href="apps-blog-detail.html" data-key="t-blog-details">Blog Details</a>
                              </li>
                           </ul>
                        </li>
                     </ul>
                  </li> --}}

                <li class="menu-title mt-2" data-key="t-components">Data Perkuliahan</li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">PMB</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Tahun Akademik</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('semester.index') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Semester</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Setting Perkuliahan</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Kalender Akademik</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dosen</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('course.index') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Mata Kuliah</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('curriculum.index') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Kurikulum</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Mahasiswa</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">EDOM</li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Kelompok Komponen</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Komponen Penilaian</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Penilaian</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">Penjadwalan</li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Waktu Perkuliahan</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Jadwal Kuliah</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Jadwal Ujian</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">Transaksi Perkuliahan</li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Kelas Perkuliahan</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Perwalian/KRS</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Aktivitas Kuliah Mahasiswa</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Aktivitas Mahasiswa</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">KHS</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Transkrip</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Daftar Mahasiswa Lulus/DO</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Pelaksanaan Wisuda</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Pendaftaran Wisuda</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">Feeder</li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Kurikulum</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Mahasiswa</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Kelas Kuliah</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dosen Ajar</span>
                    </a>
                </li>
                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">KRS</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Nilai Perkuliahan</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">AKM</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Nilai Transfer</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Histori Pendidikan</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Kelulusan</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Tabel</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Setting User</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">Report</li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Pencapaian Nilai MK</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Rekap UTS</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Rekap UAS</span>
                    </a>
                </li>

                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Rekap Registrasi</span>
                    </a>
                </li>
                <li>
                    <a href="index.html">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Rekap Perwalian</span>
                    </a>
                </li>
        </div>
        <!-- Sidebar -->
    </div>
</div>
