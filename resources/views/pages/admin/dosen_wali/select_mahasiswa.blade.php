@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pilih Mahasiswa</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered dt-responsive nowrap w-100"
                                        id="datatable-mahasiswa">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Aksi</th>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#datatable-mahasiswa').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dosen_wali.select_mahasiswa', $lecture_id_input) }}', // Pastikan route ini benar
                columns: [{
                        data: null,
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1; // Nomor otomatis
                        }
                    },
                    {
                        data: 'nipd', // Sesuaikan dengan field di database
                        name: 'nipd'
                    },
                    {
                        data: 'nm_pd', // Sesuaikan dengan field di database
                        name: 'nm_pd'
                    },
                    {
                        data: 'action', // Pastikan action sudah dikirim dengan benar dari server
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
        </script>
        <script>
    function setMahasiswa(mahasiswa_id) {
        // Ambil lecture_id dari URL atau elemen tersembunyi (hidden input)
        var lecture_id = '{{ $lecture_id_input }}'; // Pastikan kamu mendapatkan lecture_id di blade

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            url: "{{ route('dosen_wali.set_mahasiswa') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                mahasiswa_id: mahasiswa_id,
                lecture_id: lecture_id
            },
            success: function(response) {
                // Jika sukses, tampilkan pesan dan pindah ke halaman index
                alert(response.message);
                window.location.href = "{{ route('dosen_wali.index', $lecture_id_input) }}";
            },
            error: function(xhr) {
                // Jika ada error, tampilkan pesan error
                alert(xhr.responseJSON.error);
            }
        });
    }
    var lecture_id = '{{ $lecture_id_input }}';
    console.log(lecture_id);
</script>
@endsection
