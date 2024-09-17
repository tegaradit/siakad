@extends('layouts.home-layout')

@section('home-content')
<style>
    .radio-group input {
        margin-right: 5px; /* Atur jarak antara input dan label */
    }

    .radio-group label {
        margin-right: 15px; /* Atur jarak antar kelompok radio */
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Tambah Mata Kuliah</h4>

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
                                    <select name="prodi_id" id="prodi-selector" class="form-control" required>
                                        <option value="" selected>Pilih...</option>
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
                                        <option value="">Pilih...</option>
                                        @foreach($group as $gro)
                                            <option value="{{ $gro->id }}">{{ $gro->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Course Type --}}
                                <div class="form-group">
                                    <label for="type_id">Course Type</label>
                                    <select name="type_id" id="type_id" class="form-control" required>
                                        <option value="">Pilih...</option>
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
                                    <select name="status"  class="form-control" required>
                                        <option value="">Pilih...</option>
                                        <option value="Active">Active</option>
                                        <option value="Deleted">Deleted</option>
                                        <option value="Non-Active">Non-Active</option>
                                    </select>
                                </div>                                

                                {{-- Boolean Fields --}}
                                <div class="form-group">
                                    <label for="is_sap">Is SAP?</label>
                                    <div class="radio-group">
                                        <input type="radio" class="form-check-input" name="is_sap" value="1" id="is_sap_yes" required>
                                        <label class="form-check-label" for="is_sap_yes">Yes</label>
                                  
                                        <input type="radio" class="form-check-input" name="is_sap" value="0" id="is_sap_no" required>
                                        <label class="form-check-label" for="is_sap_no">No</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="is_silabus">Is Silabus?</label>
                                    <div class="radio-group">
                                        <input type="radio" class="form-check-input" name="is_silabus" value="1" id="is_silabus_yes" required>
                                        <label class="form-check-label" for="is_silabus_yes">Yes</label>
                                
                                        <input type="radio" class="form-check-input" name="is_silabus" value="0" id="is_silabus_no" required>
                                        <label class="form-check-label" for="is_silabus_no">No</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="is_teaching_material">Is Teaching Material?</label>
                                    <div class="radio-group">
                                        <input type="radio" class="form-check-input" name="is_teaching_material" value="1" id="is_teaching_material_yes" required>
                                        <label class="form-check-label" for="is_teaching_material_yes">Yes</label>
                                
                                        <input type="radio" class="form-check-input" name="is_teaching_material" value="0" id="is_teaching_material_no" required>
                                        <label class="form-check-label" for="is_teaching_material_no">No</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="is_praktikum">Is Praktikum?</label>
                                    <div class="radio-group">
                                        <input type="radio" class="form-check-input" name="is_praktikum" value="1" id="is_praktikum_yes" required>
                                        <label class="form-check-label" for="is_praktikum_yes">Yes</label>
                                
                                        <input type="radio" class="form-check-input" name="is_praktikum" value="0" id="is_praktikum_no" required>
                                        <label class="form-check-label" for="is_praktikum_no">No</label>
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
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Form -->
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $("#prodi-selector").select2({
        ajax: {
            delay: 250,
            url: '{{ url('/') }}/admin/course/search_prodi',
            data (params) {
                var query = {
                    nama_prodi: params.term,
                }
                return query;
            },
            processResults (data) {
                return {
                    results: data.map(item => ({
                        id: item.id,  // The value for the option
                        text: `${item.nama_prodi}`  // The displayed text
                    }))
                }
            }
        },
        minimumInputLength: 1,
        templateResult (res) {
            return res.text
        }
    })
</script>

@endsection
