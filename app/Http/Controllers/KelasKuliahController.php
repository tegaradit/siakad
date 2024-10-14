<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\KelasKuliah;
use Illuminate\Http\Request;
use App\Models\dosenMengajar;
use App\Models\Lecturer;
use App\Models\Semester;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KelasKuliahController extends Controller
{
    public function index(Request $request)
    {
        // Get filter values from the request
        $prodiId = $request->input('prodi_id');
        $semesterId = $request->input('semester_id');

        // Build query based on filters
        $query = KelasKuliah::query();

        // Apply filtering based on program and academic year (semester)
        if ($prodiId) {
            $query->where('prodi_id', $prodiId);
        }

        if ($semesterId) {
            $query->where('semester_id', $semesterId);
        }

        // Use Yajra DataTables for handling and displaying the data
        if ($request->ajax()) {
            return DataTables::of($query)
                ->addColumn('dosen_pengajar', function ($row) {
                    // Add logic for dosen pengajar (lecturer) column if necessary
                    return '<button class="btn btn-primary"><i class="fa fa-plus"></i></button>';
                })
                ->addColumn('peserta_kelas', function ($row) {
                    // Logic for displaying the number of students in the class
                    return '<span class="badge badge-success">' . $row->quota . '</span>';
                })
                ->addColumn('actions', function ($row) {
                    // Generate action buttons for each row
                    return '<button class="btn btn-info"><i class="fa fa-eye"></i></button>
                            <button class="btn btn-warning"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['dosen_pengajar', 'peserta_kelas', 'actions'])
                ->make(true);
        }

        // Fetch unique programs and academic years for filtering dropdowns
        $programs = KelasKuliah::select('prodi_id')->distinct()->get();
        $semesters = KelasKuliah::select('semester_id')->distinct()->get();

        return view('pages.admin.kelas_kuliah.index', compact('programs', 'semesters'));
    }
    public function storeLecturer(Request $request)
    {
        $request->validate([
            'lecture_id' => 'required|integer|exists:lecturers,id', // Assuming there's a lecturers table
            'class_id' => 'required|integer|exists:kelas_kuliah,id', // Ensure class ID exists
        ]);

        // Logic to save the lecturer
        dosenMengajar::create([
            'lecture_id' => $request->lecture_id, // Get lecture_id from the request
            'class_id' => $request->class_id,
            // Add other necessary fields here if needed
        ]);

        return response()->json(['message' => 'Dosen pengajar berhasil ditambahkan.']);
    }
    // Add this method in your KelasKuliahController
    public function getLecturers()
    {
        $lecturers = Lecturer::all(); // Assuming you have a Lecturer model
        return response()->json($lecturers);
    }

    public function storeClass(Request $request, string $course_id)
    {
        // return $request->all();
        // Ambil course berdasarkan course_id
        $course = Course::findOrFail($course_id);

        // Ambil semester yang aktif
        $activeSemester = Semester::where('is_active', '=', '1')->first();

        // Periksa jika semester aktif ada
        if (!$activeSemester) {
            return response()->json(['message' => 'Tidak ada semester yang aktif.'], 400);
        }

        // Pastikan semester_id terisi
        $semesterId = $activeSemester->semester_id;

        // Buat data untuk kelas kuliah
        $kelasKuliahData = [
            'id' => (string) Str::uuid(),
            'course_id' => $course->id,
            'prodi_id' => $course->prodi_id,
            'semester_id' => $semesterId, // Pastikan semester_id tidak null
            'nama_kelas' => substr($course->code, 0, 5), // Nama kelas 5 karakter dari kode mata kuliah
            'sks_mk' => $course->sks_mk,
            'sks_tm' => $course->sks_tm,
            'sks_pr' => $course->sks_pr,
            'sks_lap' => $course->sks_pl,
            'sks_sim' => $course->sks_sim,
            // input 0000-00-00 bukan valid input untuk date
            'start_date' => $course->effective_start_date == '0000-00-00' ? '2000-01-01' : $course->effective_start_date,
            // input 0000-00-00 bukan valid input untuk date
            'end_date' => $course->effective_end_date == '0000-00-00' ? '2000-01-01' : $course->effective_end_date,
            'quota' => 1, // field kie r ulih null
            'pn_presensi' => 1, // field kie r ulih null
            'pn_tugas' => null,
            'pn_uas' => null,
            'max_pertemuan' => 10, // field kie r ulih null
            'min_kehadiran' => 5, // field kie r ulih null
            'enrollment_key' => null,
            'grade_status' => 0,
            'uts_question' => null,
            'uas_question' => null,
            'class_type' => 1, // field kie r ulih null
            'group_class_id' => null,
        ];

        // Simpan kelas kuliah
        try {
            $kelasKuliah = KelasKuliah::create($kelasKuliahData);
            return response()->json(['message' => 'Kelas berhasil dibuat.', 'kelas_kuliah' => $kelasKuliah], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal membuat kelas', 'request' => $request->all(), 'error' => $e->getMessage(), 'active semester' => $activeSemester], 500);
        }
    }
}
