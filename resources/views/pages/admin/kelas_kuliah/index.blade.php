@extends('layouts.home-layout')

@section('home-content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Kelas Perkuliahan</h4>

                            <!-- Filter Section -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="filter_prodi" class="form-label">Program Studi</label>
                                    <select id="filter_prodi" class="form-select">
                                        <option value="">:: Pilih Program Studi ::</option>
                                        @foreach($programs as $program)
                                            <option value="{{ $program->prodi_id }}">{{ $program->prodi_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="filter_semester" class="form-label">Tahun Ajaran</label>
                                    <select id="filter_semester" class="form-select">
                                        <option value="">:: Pilih Tahun Ajaran ::</option>
                                        @foreach($semesters as $semester)
                                            <option value="{{ $semester->semester_id }}">{{ $semester->semester_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Data Table -->
                            <table class="table table-bordered table-striped" id="kelasKuliahTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode MK</th>
                                        <th>Nama MK</th>
                                        <th>Kelas</th>
                                        <th>NIDN</th>
                                        <th>Dosen Pengajar</th>
                                        <th>Asisten Dosen</th>
                                        <th>Kuota</th>
                                        <th>Peserta Kelas</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for adding lecturer -->
        <div class="modal fade" id="addLecturerModal" tabindex="-1" aria-labelledby="addLecturerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLecturerModalLabel">Tambah Dosen Pengajar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addLecturerForm">
                            <div class="mb-3">
                                <label for="lecturer_id" class="form-label">Nama Dosen</label>
                                <select class="form-select" id="lecturer_id" required>
                                    <option value="">:: Pilih Dosen ::</option>
                                    @foreach($lecturers as $lecturer)
                                        <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" id="class_id" value="">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTable Initialization and Event Handling -->
        <script>
            $(document).ready(function() {
                var table = $('#kelasKuliahTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('kelas_kuliah.index') }}",
                        data: function(d) {
                            d.prodi_id = $('#filter_prodi').val();
                            d.semester_id = $('#filter_semester').val();
                        }
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'course_id', name: 'course_id' },
                        { data: 'nama_kelas', name: 'nama_kelas' },
                        { data: 'sks_mk', name: 'sks_mk' },
                        { data: 'nidn', name: 'nidn' },
                        {
                            data: 'dosen_pengajar',
                            name: 'dosen_pengajar',
                            orderable: false,
                            searchable: false,
                            render: function() {
                                return '<button class="btn btn-primary add-lecturer-btn"><i class="fa fa-plus"></i></button>';
                            }
                        },
                        { data: 'asisten_dosen', name: 'asisten_dosen' },
                        { data: 'quota', name: 'quota' },
                        { data: 'peserta_kelas', name: 'peserta_kelas', orderable: false, searchable: false },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                // Event to apply filters and refresh the table
                $('#filter_prodi, #filter_semester').change(function() {
                    table.draw();
                });

                // Show modal on "+" button click
                $(document).on('click', '.add-lecturer-btn', function() {
                    var classId = $(this).closest('tr').find('td').eq(0).text(); // Assuming ID is in the first column
                    $('#class_id').val(classId);
                    $('#addLecturerModal').modal('show');
                });

                // Handle form submission
                $('#addLecturerForm').on('submit', function(e) {
                    e.preventDefault();
                    var lecturerId = $('#lecturer_id').val(); // Get the selected lecturer's ID
                    var classId = $('#class_id').val();

                    // AJAX call to save the lecturer
                    $.ajax({
                        url: "{{ route('lecturer.store') }}", // Replace with your route
                        method: 'POST',
                        data: {
                            lecturer_id: lecturerId, // Send lecturer ID
                            class_id: classId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#addLecturerModal').modal('hide');
                            table.draw(); // Refresh the table
                            alert(response.message); // Optional: Show success message
                        },
                        error: function(xhr) {
                            alert('Error: ' + xhr.responseJSON.message); // Handle errors
                        }
                    });
                });
            });
        </script>
    </div>
</div>
@endsection
