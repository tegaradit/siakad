<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Curriculum;
use App\Models\CurriculumCourse;
use App\Models\IdentitasPt;
use App\Models\Semester;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CourseCurriculumController extends Controller
{
    // Display the list of courses for a curriculum
    public function index($curriculum_id)
    {
        $curriculum = Curriculum::findOrFail($curriculum_id); // Fetch the curriculum
    
        if (request()->ajax()) {
            // Fetch curriculum courses
            $courses = CurriculumCourse::where('curriculum_id', $curriculum_id)
                ->with(['curriculum', 'course']) // Eager load relations
                ->get();
    
            return DataTables::of($courses)
                ->addIndexColumn()
                ->addColumn('action', function ($course) {
                    // Membuat URL untuk detail berdasarkan course_id
                    $detailUrl = route('kuliah_kelas.index', [$course->curriculum_id, $course->course_id]);
                    
                    // Membuat URL untuk edit dan delete
                    $editUrl = route('curriculum_course.edit', [$course->curriculum_id, $course->id]);
                    $deleteForm = '<form id="delete-form-' . $course->id . '" onsubmit="event.preventDefault(); confirmDelete(\'' . $course->id . '\');" action="' . route('curriculum_course.destroy', [$course->curriculum_id, $course->id]) . '" method="POST">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '<a href="' . $editUrl . '" class="btn btn-warning btn-sm edit ms-1 m-0" title="Edit"><i class="fas fa-pencil-alt"></i> Edit</a>'
                        . '<button type="submit" class="btn btn-danger btn-sm delete ms-1"><i class="fas fa-trash-alt"></i> Hapus</button></form>';
                    
                    // Menambahkan tombol untuk detail yang mengarah ke course_id yang diklik
                    $detailButton = '<a href="' . $detailUrl . '" class="btn btn-info btn-sm m-0" title="Detail"><i class="fas fa-info-circle"></i> Detail</a>';
                    
                    return $detailButton . $deleteForm;
                })
                ->addColumn('course_name', function ($course) {
                    return $course->course ? $course->course->name : '-';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        // Pass the curriculum to the view
        return view('pages.admin.curriculum_course.index', compact('curriculum'));
    }
    

    // Show the form to create a new course
    public function create($curriculum_id)
    {
        $curriculum = Curriculum::findOrFail($curriculum_id);
        $semester = Semester::findOrFail($curriculum->semester_id);
        return view('pages.admin.curriculum_course.form', compact('curriculum', 'semester'));
    }

    // Get courses for Select2
    public function searchCourse(Request $request, $curriculum_id)
    {
        // Ambil query term dari Select2
        $search = $request->query('term', ''); // 'term' adalah nama parameter default yang dikirim oleh Select2

        // Ambil current_id_sp dari IdentitasPt (sesuaikan ini sesuai dengan struktur database Anda)
        $current_id_sp = IdentitasPt::first()->current_id_sp;

        // Lakukan pencarian berdasarkan 'code' dan filter by all_prodi.id_sp dan all_prodi.status
        $courses = Course::whereHas('all_prodi', function ($query) use ($current_id_sp) {
            $query->where('id_sp', $current_id_sp)
                ->where('status', 'A');
        })
            ->where('code', 'like', "%$search%") // Filter by 'code' from search term
            ->select('id', 'code', 'name') // Pilih kolom yang diperlukan saja
            ->get();

        // Return response dalam format yang diminta oleh Select2
        return response()->json($courses->map(function ($course) {
            return [
                'id' => $course->id, // Value untuk input
                'text' => $course->code . ' - ' . $course->name, // Text yang ditampilkan
            ];
        }));
    }

    // Store a new course in the curriculum
    public function store(Request $request, $curriculum_id)
    {
        $request->validate([
            'course_id' => 'required|exists:course,id', // Pastikan course_id ada di tabel course
            'smt' => 'required|integer|min:1|max:8', // Misalnya, semester harus antara 1 dan 8
            'sks_mk' => 'required|integer|min:1', // SKS MK harus lebih dari 0
            'sks_tm' => 'nullable|integer|min:0', // SKS TM bisa kosong atau minimal 0
            'sks_pr' => 'nullable|integer|min:0', // SKS PR bisa kosong atau minimal 0
            'sks_pl' => 'nullable|integer|min:0', // SKS PL bisa kosong atau minimal 0
            'sks_sim' => 'nullable|integer|min:0', // SKS SIM bisa kosong atau minimal 0
            'is_mandatory' => 'required|boolean', // is_mandatory harus ada dan merupakan boolean
        ]);

        $course = new CurriculumCourse();
        $course->curriculum_id = $curriculum_id;
        $course->course_id = $request->course_id;
        $course->smt = $request->smt;
        $course->sks_mk = $request->sks_mk;
        $course->sks_tm = $request->sks_tm;
        $course->sks_pr = $request->sks_pr;
        $course->sks_pl = $request->sks_pl;
        $course->sks_sim = $request->sks_sim;
        $course->is_mandatory = $request->is_mandatory;
        $course->save();

        return redirect()->route('curriculum_course.index', $curriculum_id)->with('success', 'Data Matakuliah Kurikulum Berhasil Ditambahkan.');
    }

    // Show the form to edit an existing course
    public function edit($curriculum_id, $id)
    {
        $curriculum = Curriculum::findOrFail($curriculum_id);
        $course = CurriculumCourse::findOrFail($id);
        $semester = Semester::findOrFail($curriculum->semester_id);
        $courses = Course::where("id", "=", $course->course_id)->get();
        return view('pages.admin.curriculum_course.form', compact('curriculum', 'course', 'semester', 'courses'));
    }

    // Update an existing course
    public function update(Request $request, $curriculum_id, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:course,id', // Pastikan course_id ada di tabel course
            'smt' => 'required|integer|min:1|max:8', // Misalnya, semester harus antara 1 dan 8
            'sks_mk' => 'required|integer|min:1', // SKS MK harus lebih dari 0
            'sks_tm' => 'nullable|integer|min:0', // SKS TM bisa kosong atau minimal 0
            'sks_pr' => 'nullable|integer|min:0', // SKS PR bisa kosong atau minimal 0
            'sks_pl' => 'nullable|integer|min:0', // SKS PL bisa kosong atau minimal 0
            'sks_sim' => 'nullable|integer|min:0', // SKS SIM bisa kosong atau minimal 0
            'is_mandatory' => 'required|boolean', // is_mandatory harus ada dan merupakan boolean
        ]);

        $course = CurriculumCourse::findOrFail($id);
        $course->curriculum_id = $curriculum_id;
        $course->course_id = $request->course_id;
        $course->smt = $request->smt;
        $course->sks_mk = $request->sks_mk;
        $course->sks_tm = $request->sks_tm;
        $course->sks_pr = $request->sks_pr;
        $course->sks_pl = $request->sks_pl;
        $course->sks_sim = $request->sks_sim;
        $course->is_mandatory = $request->is_mandatory;
        $course->save();

        return redirect()->route('curriculum_course.index', $curriculum_id)->with('success', 'Data Matakuliah Kurikulum Berhasil Diperbaharui.');
    }

    // Delete an existing course
    public function destroy($curriculum_id, $id)
    {
        $course = CurriculumCourse::findOrFail($id);
        $course->delete();

        return redirect()->route('curriculum_course.index', $curriculum_id)->with('success', 'Data Matakuliah Kurikulum Berhasil di Hapus.');
    }
}
