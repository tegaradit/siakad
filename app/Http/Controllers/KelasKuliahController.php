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
        $prodiId = $request->input('prodi_id');
        $semesterId = $request->input('semester_id');
        $query = KelasKuliah::leftjoin('dosen_mengajar','kelas_kuliah.id', '=','dosen_mengajar.class_id')
            ->leftjoin('lecturer', 'dosen_mengajar.lecture_id', '=', 'lecturer.id')->leftjoin('course','kelas_kuliah.course_id', '=', 'course.id');
        // $query = KelasKuliah::all();
        // dd($query);
        // return $query;
        
        if ($prodiId) {
            $query->where('prodi_id', $prodiId);
        }
        if ($semesterId) {
            $query->where('semester_id', $semesterId);
        }
        $query = $query->get();
        // return $query;
        if ($request->ajax()) {
            return DataTables::of($query)
                ->addColumn('dosen_pengajar', function ($row) {
                    return '<button class="btn btn-primary add-dosen" data-id="' . $row->id . '"><i class="fa fa-plus"></i> Tambah Dosen</button>';
                })
                ->addColumn('peserta_kelas', function ($row) {
                    return '<span class="badge badge-success">' . $row->quota . ' Peserta</span>'; // Menampilkan jumlah kuota sebagai peserta
                })
                ->addColumn('actions', function ($row) {
                    return '<button class="btn btn-info view-btn" data-id="' . $row->id . '"><i class="fa fa-eye"></i> Lihat</button>
                            <button class="btn btn-warning edit-btn" data-id="' . $row->id . '"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger delete-btn" data-id="' . $row->id . '"><i class="fa fa-trash"></i> Hapus</button>';
                })
                ->rawColumns(['dosen_pengajar', 'peserta_kelas', 'actions']) // Pastikan kolom ini dianggap sebagai HTML, bukan teks biasa
                ->make(true);
        }
        $programs = KelasKuliah::join('all_prodi','kelas_kuliah.prodi_id','=','all_prodi.id_prodi')->get(['all_prodi.id_prodi', 'all_prodi.nama_prodi']);
        $semesters = KelasKuliah::join('semester', 'kelas_kuliah.semester_id', '=', 'semester.semester_id')->get(['semester.semester_id', 'semester.name']);
        $lecturers = Lecturer::all(); 
        return view('pages.admin.kelas_kuliah.index', compact('programs', 'semesters', 'lecturers'));
    }
    public function storeLecturer(Request $request)
    {
        $request->validate([
            'lecture_id' => 'required|integer|exists:lecturers,id',
            'class_id' => 'required|integer|exists:kelas_kuliah,id',
        ]);
        dosenMengajar::create([
            'lecture_id' => $request->lecture_id,
            'class_id' => $request->class_id,
        ]);
        return response()->json(['message' => 'Dosen pengajar berhasil ditambahkan.']);
    }
    public function edit($id)
    {
        $kelasKuliah = KelasKuliah::find($id);
        if (!$kelasKuliah) {
            return response()->json(['message' => 'Kelas tidak ditemukan.'], 404);
        }

        return response()->json($kelasKuliah);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'prodi_id' => 'required',
            'semester_id' => 'required',
            'course_id' => 'required',
            'nama_kelas' => 'required',
            'jenis_kelas' => 'required',
            'bobot' => 'required|numeric',
            'quota' => 'required|numeric',
        ]);

        $kelasKuliah = KelasKuliah::findOrFail($id);

        $kelasKuliah->update([
            'prodi_id' => $request->input('prodi_id'),
            'semester_id' => $request->input('semester_id'),
            'course_id' => $request->input('course_id'),
            'nama_kelas' => $request->input('nama_kelas'),
            'jenis_kelas' => $request->input('jenis_kelas'),
            'bobot' => $request->input('bobot'),
            'quota' => $request->input('quota'),
        ]);

        return redirect()->route('kelas_kuliah.index')->with('success', 'Kelas Kuliah updated successfully.');
    }
    public function getGuru(Request $request)
    {
        $query = Lecturer::query();
    
        if ($request->ajax()) {
            return DataTables::of($query)
                ->make(true);
        }
    
        return response()->json(['message' => 'Request must be AJAX.'], 400);
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
