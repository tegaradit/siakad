<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>
        SIAKAD | Sistem Informasi Akademik
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href={{ asset('minia/assets/images/favicon.ico') }} />

    <!-- choices css -->
    <link href={{ asset('minia/assets/libs/choices.js/public/assets/styles/choices.min.css') }} rel="stylesheet"
        type="text/css" />

    <!-- color picker css -->
    <link rel="stylesheet" href={{ asset('minia/assets/libs/@simonwep/pickr/themes/classic.min.css') }} />
    <!-- 'classic' theme -->
    <link rel="stylesheet" href={{ asset('minia/assets/libs/@simonwep/pickr/themes/monolith.min.css') }} />
    <!-- 'monolith' theme -->
    <link rel="stylesheet" href={{ asset('minia/assets/libs/@simonwep/pickr/themes/nano.min.css') }} />
    <!-- 'nano' theme -->

    <!-- datepicker css -->
    <link rel="stylesheet" href={{ asset('minia/assets/libs/flatpickr/flatpickr.min.css') }} />

    <!-- preloader css -->
    <link rel="stylesheet" href={{ asset('minia/assets/css/preloader.min.css') }} type="text/css" />

    <!-- Bootstrap Css -->
    <link href={{ asset('minia/assets/css/bootstrap.min.css') }} id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href={{ asset('minia/assets/css/icons.min.css') }} rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href={{ asset('minia/assets/css/app.min.css') }} id="app-style" rel="stylesheet" type="text/css" />

    {{-- Datatables css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>

<body>
    @yield('root-content')

    <!-- JAVASCRIPT -->
    <script src={{ asset('minia/assets/libs/jquery/jquery.min.js') }}></script>
    <script src={{ asset('minia/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('minia/assets/libs/metismenu/metisMenu.min.js') }}></script>
    <script src={{ asset('minia/assets/libs/simplebar/simplebar.min.js') }}></script>
    <script src={{ asset('minia/assets/libs/node-waves/waves.min.js') }}></script>
    <script src={{ asset('minia/assets/libs/feather-icons/feather.min.js') }}></script>

    <!-- sidebar -->
    <script>
        @if (isset($menu) && $menu == 'data')
            $('#data-umum').addClass('mm-show');
            @if (isset($submenu) && $submenu == 'buildings')
                $('#gedung').addClass('active');
                $('#list-gedung').addClass('mm-active');
            @elseif (isset($submenu) && $submenu == 'academic-year')
                $('#t-akademik').addClass('active');
                $('#list-t-akademik').addClass('mm-active');
            @elseif (isset($submenu) && $submenu == 'course')
                $('#matakuliah').addClass('active');
                $('#list-matakuliah').addClass('mm-active');
            @elseif (isset($submenu) && $submenu == 'curriculum')
                $('#kurikulum').addClass('active');
                $('#list-kurikulum').addClass('mm-active');
            @elseif (isset($submenu) && $submenu == 'lecturer')
                $('#perkuliahan').addClass('active');
                $('#list-perkuliahan').addClass('mm-active');
            @elseif (isset($submenu) && $submenu == 'mahasiswa')
                $('#ma-hasiswa').addClass('active');
                $('#list-ma-hasiswa').addClass('mm-active');
            @elseif (isset($submenu) && $submenu == 'periode-pmb')
                $('#periode-pmb').addClass('active');
                $('#list-periode-pmb').addClass('mm-active');
            @elseif (isset($submenu) && $submenu == 'room')
                $('#ruangan').addClass('active');
                $('#list-ruangan').addClass('mm-active');
            @elseif (isset($submenu) && $submenu == 'semester')
                $('#sem').addClass('active');
                $('#list-sem').addClass('mm-active');
            @elseif (isset($submenu) && $submenu == 'user')
                $('#pengguna').addClass('active');
                $('#list-pengguna').addClass('mm-active');
            @endif
        @elseif (isset($menu) && $menu == 'datas')
            $('#data-umum').addClass('mm-show');
            @if (isset($submenu) && $submenu == 'kalender-akademik')
                $('#k-akademik').addClass('active');
                $('#list-k-akademik').addClass('mm-active');
            @elseif (isset($submenu) && $submenu == 'calendar-type')
                $('#t-kalender').addClass('active');
                $('#list-t-kalender').addClass('mm-active');
            @elseif (isset($submenu) && $submenu == 'lecture_setting')
                $('#s-perkuliahan').addClass('active');
                $('#list-s-perkuliahan').addClass('mm-active');
            @endif
        @endif
    </script>

    <!-- pace js -->
    <script src={{ asset('minia/assets/libs/pace-js/pace.min.js') }}></script>

    <!-- choices js -->
    <script src={{ asset('minia/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}></script>

    <!-- color picker js -->
    <script src={{ asset('minia/assets/libs/@simonwep/pickr/pickr.min.js') }}></script>
    <script src={{ asset('minia/assets/libs/@simonwep/pickr/pickr.es5.min.js') }}></script>

    <!-- datepicker js -->
    <script src={{ asset('minia/assets/libs/flatpickr/flatpickr.min.js') }}></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- init js -->
    <script src={{ asset('minia/assets/js/pages/form-advanced.init.js') }}></script>

    <script src={{ asset('minia/assets/js/app.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/feather-icons"></script>

</body>

</html>
