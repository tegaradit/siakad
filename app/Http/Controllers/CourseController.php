<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Course_group;
use App\Models\Course_type;
use App\Models\Education_level;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(){
        // $user = Auth::user();
        $menu = 'course';
        $submenu = 'course';

        // Mengambil data mata kuliah dengan relasi yang diperlukan
        $datas = Course::with(['t_prodi', 'education_level', 'course_group', 'course_type'])->latest()->paginate(10);

        // Mengirim data ke view
        return view('pages.admin.course.index', compact('datas'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        $education_levels = Education_level::all();
        $group = Course_group::all();
        $type = Course_type::all();

        // dd($group, $type); // Check what data is being passed

        return view('pages.admin.course.form', compact('prodis', 'education_levels', 'group', 'type'));
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'prodi_id' => 'required|uuid|exists:prodi,id',
            'education_level_id' => 'required|integer|exists:education_level,id_jenj_didik',
            'code' => 'required|string|max:10|unique:course,code',
            'name' => 'required|string|max:200',
            'group_id' => 'required|integer|exists:course_group,id',
            'type_id' => 'required|integer|exists:course_type,id',
            'sks_mk' => 'required|integer',
            'sks_tm' => 'required|integer',
            'sks_pr' => 'required|integer',
            'sks_pl' => 'required|integer',
            'sks_sim' => 'required|integer',
            'status' => 'required|in:Active,Deleted,Non-Active',
            'is_sap' => 'boolean',
            'is_silabus' => 'boolean',
            'is_teaching_material' => 'boolean',
            'is_praktikum' => 'boolean',
            'effective_start_date' => 'required|date',
            'effective_end_date' => 'required|date|after_or_equal:effective_start_date',
        ]);

        // Create a new Course instance and store it
        Course::create([
            'prodi_id' => $request->prodi_id,
            'education_level_id' => $request->education_level_id,
            'code' => $request->code,
            'name' => $request->name,
            'group_id' => $request->group_id,
            'type_id' => $request->type_id,
            'sks_mk' => $request->sks_mk,
            'sks_tm' => $request->sks_tm,
            'sks_pr' => $request->sks_pr,
            'sks_pl' => $request->sks_pl,
            'sks_sim' => $request->sks_sim,
            'status' => $request->status,
            'is_sap' => $request->has('is_sap') ? 1 : 0,
            'is_silabus' => $request->has('is_silabus') ? 1 : 0,
            'is_teaching_material' => $request->has('is_teaching_material') ? 1 : 0,
            'is_praktikum' => $request->has('is_praktikum') ? 1 : 0,
            'effective_start_date' => $request->effective_start_date,
            'effective_end_date' => $request->effective_end_date,
        ]);

        // Redirect or return response
        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    public function edit($id)
    {
        // Ambil data mata kuliah berdasarkan ID
        $course = Course::findOrFail($id);

        // Ambil data yang diperlukan untuk dropdown
        $prodis = Prodi::all();
        $education_levels = Education_level::all();
        $group = Course_group::all();
        $type = Course_type::all();

        // Tampilkan formulir edit dengan data mata kuliah dan data dropdown
        return view('pages.admin.course.form_edit', compact('course', 'prodis', 'education_levels', 'group', 'type'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'prodi_id' => 'required|uuid|exists:prodi,id',
            'education_level_id' => 'required|integer|exists:education_level,id_jenj_didik',
            'code' => [
                'required',
                'string',
                'max:10',
                Rule::unique('course', 'code')->ignore($id), // Ignore unique constraint for current record
            ],
            'name' => 'required|string|max:200',
            'group_id' => 'required|integer|exists:course_group,id',
            'type_id' => 'required|integer|exists:course_type,id',
            'sks_mk' => 'required|integer',
            'sks_tm' => 'required|integer',
            'sks_pr' => 'required|integer',
            'sks_pl' => 'required|integer',
            'sks_sim' => 'required|integer',
            'status' => 'required|in:Active,Deleted,Non-Active',
            'is_sap' => 'boolean',
            'is_silabus' => 'boolean',
            'is_teaching_material' => 'boolean',
            'is_praktikum' => 'boolean',
            'effective_start_date' => 'required|date',
            'effective_end_date' => 'required|date|after_or_equal:effective_start_date',
        ]);

        // Cari data mata kuliah berdasarkan ID
        $course = Course::findOrFail($id);

        // Update data mata kuliah dengan data yang diterima
        $course->update($request->only([
            'prodi_id',
            'education_level_id',
            'code',
            'name',
            'group_id',
            'type_id',
            'sks_mk',
            'sks_tm',
            'sks_pr',
            'sks_pl',
            'sks_sim',
            'status',
            'is_sap',
            'is_silabus',
            'is_teaching_material',
            'is_praktikum',
            'effective_start_date',
            'effective_end_date'
        ]));

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('course.index')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari data mata kuliah berdasarkan ID
        $course = Course::findOrFail($id);

        // Hapus data mata kuliah
        $course->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('course.index')->with('success', 'Mata Kuliah berhasil dihapus.');
    }

}
