@extends('layouts.home-layout')

@section('home-content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                {{-- Start page title --}}
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Detail Mata Kuliah</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('course.index') }}">Mata Kuliah</a>
                                    </li>
                                    <li class="breadcrumb-item active">Detail</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End page title --}}

                <!-- Display course details -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Detail Mata Kuliah</h4>
                                <p class="card-title-desc">Informasi lengkap tentang mata kuliah yang dipilih.</p>
                            </div>
                            <div class="card-body">
                                {{-- Prodi --}}
                                <div class="form-group">
                                    <label for="prodi">Prodi</label>
                                    <input type="text" id="prodi" class="form-control"
                                        value="{{ $course->all_prodi->nama_prodi }}" readonly>
                                </div>

                                {{-- Education Level --}}
                                <div class="form-group">
                                    <label for="education_level">Education Level</label>
                                    <input type="text" id="education_level" class="form-control"
                                        value="{{ $course->education_level->nm_jenj_didik }}" readonly>
                                </div>

                                {{-- Course Code --}}
                                <div class="form-group">
                                    <label for="code">Course Code</label>
                                    <input type="text" id="code" class="form-control" value="{{ $course->code }}"
                                        readonly>
                                </div>

                                {{-- Course Name --}}
                                <div class="form-group">
                                    <label for="name">Course Name</label>
                                    <input type="text" id="name" class="form-control" value="{{ $course->name }}"
                                        readonly>
                                </div>

                                {{-- Course Group --}}
                                <div class="form-group">
                                    <label for="group">Course Group</label>
                                    <input type="text" id="group" class="form-control"
                                        value="{{ $course->course_group->name }}" readonly>
                                </div>

                                {{-- Course Type --}}
                                <div class="form-group">
                                    <label for="type">Course Type</label>
                                    <input type="text" id="type" class="form-control"
                                        value="{{ $course->course_type->name }}" readonly>
                                </div>

                                {{-- SKS Fields --}}
                                <div class="form-group">
                                    <label for="sks_mk">SKS MK</label>
                                    <input type="text" id="sks_mk" class="form-control" value="{{ $course->sks_mk }}"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label for="sks_tm">SKS TM</label>
                                    <input type="text" id="sks_tm" class="form-control" value="{{ $course->sks_tm }}"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label for="sks_pr">SKS PR</label>
                                    <input type="text" id="sks_pr" class="form-control" value="{{ $course->sks_pr }}"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label for="sks_pl">SKS PL</label>
                                    <input type="text" id="sks_pl" class="form-control" value="{{ $course->sks_pl }}"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label for="sks_sim">SKS SIM</label>
                                    <input type="text" id="sks_sim" class="form-control"
                                        value="{{ $course->sks_sim }}" readonly>
                                </div>

                                {{-- Status --}}
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" id="status" class="form-control" value="{{ $course->status }}"
                                        readonly>
                                </div>

                                {{-- Boolean Fields --}}
                                <div class="form-group">
                                    <label for="is_sap">Is SAP?</label>
                                    <input type="text" id="is_sap" class="form-control"
                                        value="{{ $course->is_sap ? 'Yes' : 'No' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="is_silabus">Is Silabus?</label>
                                    <input type="text" id="is_silabus" class="form-control"
                                        value="{{ $course->is_silabus ? 'Yes' : 'No' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="is_teaching_material">Is Teaching Material?</label>
                                    <input type="text" id="is_teaching_material" class="form-control"
                                        value="{{ $course->is_teaching_material ? 'Yes' : 'No' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="is_praktikum">Is Praktikum?</label>
                                    <input type="text" id="is_praktikum" class="form-control"
                                        value="{{ $course->is_praktikum ? 'Yes' : 'No' }}" readonly>
                                </div>

                                {{-- Effective Dates --}}
                                <div class="form-group">
                                    <label for="effective_start_date">Effective Start Date</label>
                                    <input type="text" id="effective_start_date" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($course->effective_start_date)->format('d-m-Y') }}"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label for="effective_end_date">Effective End Date</label>
                                    <input type="text" id="effective_end_date" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($course->effective_end_date)->format('d-m-Y') }}"
                                        readonly>
                                </div>

                                {{-- Back Button --}}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary mt-3">
                                        <a href="{{ route('course.index') }}" style="color: white">Kembali</a>
                                    </button>
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
@endsection
