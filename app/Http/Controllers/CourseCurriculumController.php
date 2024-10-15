<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Curriculum;
use App\Models\CurriculumCourse;
use App\Models\IdentitasPt;
use App\Models\Semester;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CourseCurriculumController extends Controller
{
    // // Display the list of courses for a curriculum
    public function index($curriculum_id)
    {
        // Ambil data kurikulum
        $curriculum = Curriculum::findOrFail($curriculum_id);

        if (request()->ajax()) {
            // Ambil kursus kurikulum dengan hitungan kelas
            $courses = CurriculumCourse::where('curriculum_id', $curriculum_id)
                ->with(['curriculum', 'course']) // Eager load relasi
                ->withCount('kelasKuliah') // Menghitung jumlah kelas kuliah terkait
                ->get();

            return DataTables::of($courses)
                ->addIndexColumn()
                ->addColumn('action', function ($course) {
                    // URL Store Class
                    $storeClassUrl = route('kelas_kuliah.storeClass', [$course->course_id]);
                
                    // URL Edit
                    $editUrl = route('curriculum_course.edit', [$course->curriculum_id, $course->id]);
                
                    // Form Hapus
                    $deleteForm = '<form id="delete-form-' . $course->id . '" onsubmit="event.preventDefault(); confirmDelete(\'' . $course->id . '\');" action="' . route('curriculum_course.destroy', [$course->curriculum_id, $course->id]) . '" method="POST">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '<button type="button" class="btn btn-info btn-sm create-class m-0" data-url="' . $storeClassUrl . '"><i class="fa-solid fa-chalkboard-user"></i> Buat Kelas</button>'
                        . '<a href="' . $editUrl . '" class="btn btn-warning btn-sm edit ms-1 m-0" title="Edit"><i class="fas fa-pencil-alt"></i> Edit</a>'
                        . '<button type="submit" class="btn btn-danger btn-sm delete ms-1"><i class="fas fa-trash-alt"></i> Hapus</button></form>';
                
                    return $deleteForm;
                })
                ->addColumn('course_name', function ($course) {
                    return $course->course ? $course->course->name : '-';
                })
                ->addColumn('class_count', function ($course) {
                    return $course->kelas_kuliah_count; // Ini berasal dari withCount('kelasKuliah')
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Kirim data kurikulum ke view
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

    // CurriculumCourseController.php
    public function getCourseSks(Request $request)
    {
        // Ambil course berdasarkan ID yang dipilih
        $course = Course::find($request->course_id);

        // Pastikan course ditemukan
        if ($course) {
            return response()->json([
                'sks_mk' => $course->sks_mk,
                'sks_tm' => $course->sks_tm,
                'sks_pr' => $course->sks_pr,
                'sks_pl' => $course->sks_pl,
                'sks_sim' => $course->sks_sim,
            ]);
        } else {
            return response()->json(['error' => 'Course not found'], 404);
        }
    }

    // Store a new course in the curriculum
    public function store(Request $request, $curriculum_id)
    {
        $request->validate([
            'course_id' => [
                'required',
                'exists:course,id', // Sesuaikan kolom jika nama berbeda
                Rule::unique('curriculum_courses')->where(function ($query) use ($curriculum_id) {
                    return $query->where('curriculum_id', $curriculum_id);
                })
            ],
            'smt' => 'required|integer',
            'sks_mk' => 'required|integer',
            'sks_tm' => 'nullable|integer',
            'sks_pr' => 'nullable|integer',
            'sks_pl' => 'nullable|integer',
            'sks_sim' => 'nullable|integer',
            'is_mandatory' => 'required|boolean',
        ], [
            'course_id.unique' => 'Mata kuliah ini sudah ada di kurikulum.', // Pesan error jika duplikat
            'course_id.exists' => 'Mata kuliah yang dipilih tidak valid.',
        ]);

        // Simpan data ke tabel curriculum_courses jika tidak ada error
        CurriculumCourse::create([
            'curriculum_id' => $curriculum_id,
            'course_id' => $request->input('course_id'),
            'smt' => $request->input('smt'),
            'sks_mk' => $request->input('sks_mk'),
            'sks_tm' => $request->input('sks_tm'),
            'sks_pr' => $request->input('sks_pr'),
            'sks_pl' => $request->input('sks_pl'),
            'sks_sim' => $request->input('sks_sim'),
            'is_mandatory' => $request->input('is_mandatory'),
        ]);

        return redirect()->route('curriculum_course.index', $curriculum_id)->with('success', 'Mata kuliah berhasil ditambahkan ke kurikulum.');
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
