@extends('layouts.home-layout')

@section('home-content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('course.index') }}">Mata Kuliah</a>
                                </li>
                                <li class="breadcrumb-item active">Tambah</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <!-- Form to create a new course -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Mata Kuliah</h4>
                            <p class="card-title-desc">
                              Isilah form untuk menambah data mata kuliah.
                            </p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('course.store') }}" method="POST">
                                @csrf

                                {{-- Prodi --}}
                                <div class="form-group">
                                    <label for="prodi_id">Prodi</label>
                                    <select name="prodi_id" id="prodi_id" class="form-control" required>
                                        <option value="">Pilih...</option>
                                        @foreach($prodis as $prodi)
                                            <option value="{{ $prodi->id }}">{{ $prodi->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Education Level --}}
                                <div class="form-group">
                                    <label for="education_level_id">Education Level</label>
                                    <select name="education_level_id" id="education_level_id" class="form-control" required>
                                        <option value="">Pilih...</option>
                                        @foreach($education_levels as $level)
                                            <option value="{{ $level->id_jenj_didik }}">{{ $level->nm_jenj_didik }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Course Code --}}
                                <div class="form-group">
                                    <label for="code">Course Code</label>
                                    <input type="text" name="code" id="code" class="form-control" maxlength="10" required>
                                </div>

                                {{-- Course Name --}}
                                <div class="form-group">
                                    <label for="name">Course Name</label>
                                    <input type="text" name="name" id="name" class="form-control" maxlength="200" required>
                                </div>

                                {{-- Course Group --}}
                                <div class="form-group">
                                    <label for="group_id">Course Group</label>
                                    <select name="group_id" id="group_id" class="form-control" required>
                                        @foreach($group as $gro)
                                            <option value="{{ $gro->id }}">{{ $gro->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Course Type --}}
                                <div class="form-group">
                                    <label for="type_id">Course Type</label>
                                    <select name="type_id" id="type_id" class="form-control" required>
                                        @foreach($type as $ty)
                                            <option value="{{ $ty->id }}">{{ $ty->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- SKS Fields --}}
                                <div class="form-group">
                                    <label for="sks_mk">SKS MK</label>
                                    <input type="number" name="sks_mk" id="sks_mk" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="sks_tm">SKS TM</label>
                                    <input type="number" name="sks_tm" id="sks_tm" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="sks_pr">SKS PR</label>
                                    <input type="number" name="sks_pr" id="sks_pr" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="sks_pl">SKS PL</label>
                                    <input type="number" name="sks_pl" id="sks_pl" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="sks_sim">SKS SIM</label>
                                    <input type="number" name="sks_sim" id="sks_sim" class="form-control" required>
                                </div>

                                {{-- Status --}}
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="Active">Active</option>
                                        <option value="Deleted">Deleted</option>
                                        <option value="Non-Active">Non-Active</option>
                                    </select>
                                </div>

                                {{-- Boolean Fields --}}
                                <div class="form-group">
                                    <label for="is_sap">Is SAP?</label>
                                    <div>
                                        <input type="radio" name="is_sap" value="1" id="is_sap_yes">
                                        <label for="is_sap_yes">Yes</label>

                                        <input type="radio" name="is_sap" value="0" id="is_sap_no" checked>
                                        <label for="is_sap_no">No</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="is_silabus">Is Silabus?</label>
                                    <div>
                                        <input type="radio" name="is_silabus" value="1" id="is_silabus_yes">
                                        <label for="is_silabus_yes">Yes</label>

                                        <input type="radio" name="is_silabus" value="0" id="is_silabus_no" checked>
                                        <label for="is_silabus_no">No</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="is_teaching_material">Is Teaching Material?</label>
                                    <div>
                                        <input type="radio" name="is_teaching_material" value="1" id="is_teaching_material_yes">
                                        <label for="is_teaching_material_yes">Yes</label>

                                        <input type="radio" name="is_teaching_material" value="0" id="is_teaching_material_no" checked>
                                        <label for="is_teaching_material_no">No</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="is_praktikum">Is Praktikum?</label>
                                    <div>
                                        <input type="radio" name="is_praktikum" value="1" id="is_praktikum_yes">
                                        <label for="is_praktikum_yes">Yes</label>

                                        <input type="radio" name="is_praktikum" value="0" id="is_praktikum_no" checked>
                                        <label for="is_praktikum_no">No</label>
                                    </div>
                                </div>

                                {{-- Effective Dates --}}
                                <div class="form-group">
                                    <label for="effective_start_date">Effective Start Date</label>
                                    <input type="date" name="effective_start_date" id="effective_start_date" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="effective_end_date">Effective End Date</label>
                                    <input type="date" name="effective_end_date" id="effective_end_date" class="form-control" required>
                                </div>

                                {{-- Submit Button --}}
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection