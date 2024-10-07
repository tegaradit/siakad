<?php

namespace App\Http\Controllers;

use App\Models\All_prodi;
use App\Models\Course;
use App\Models\Course_group;
use App\Models\Course_type;
use App\Models\Education_level;
use App\Models\IdentitasPt;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $currentIdSp = IdentitasPt::first()->current_id_sp;

            // Filter berdasarkan all_prodi yang sesuai dengan current_id_sp dan status 'A'
            $courses = Course::whereHas('all_prodi', function ($query) use ($currentIdSp) {
                $query->where('id_sp', $currentIdSp)
                    ->where('status', 'A');
            })
                ->with(['all_prodi', 'course_type']) // Hanya memuat relasi all_prodi dan course_type
                ->get();

            return DataTables::of($courses)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('course.edit', $row->id);
                    $viewUrl = route('course.show', $row->id);

                    $deleteForm = '<form id="delete-form-' . $row->id . '" onsubmit="event.preventDefault(); confirmDelete(\'' . $row->id . '\');" action="' . route('course.destroy', $row->id) . '" method="POST">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '<a href="' . $viewUrl . '" class="btn btn-info btn-sm info ms-1 m-0" title="Info"><i class="fas fa-eye"></i> Detail</a>'
                        . '<a href="' . $editUrl . '" class="btn btn-warning btn-sm edit ms-1 m-0" title="Edit"><i class="fas fa-pencil-alt"></i> Edit</a>'
                        . '<button type="submit" class="btn btn-danger btn-sm delete ms-1 m-0"><i class="fas fa-trash-alt"></i> Hapus</button></form>';
                    return $deleteForm;
                })
                ->make(true);
        }

        return view('pages.admin.course.index');
    }

    public function show($id)
    {
        // Find the course by ID or fail with 404 if not found
        $course = Course::with(['all_prodi', 'education_level', 'course_group', 'course_type'])->findOrFail($id);

        // Return the view with course details
        return view('pages.admin.course.show', compact('course'));
    }

    public function create()
    {
        // $education_levels = Education_level::all();
        $group = Course_group::all();
        $type = Course_type::all();

        // Fetch all prodi where status is 'A' and id_sp matches the current_id_sp
        $prodi = All_prodi::where('status', 'A')
            ->where('id_sp', IdentitasPt::first()->current_id_sp)
            ->get();

        // dd($group, $type); // Check what data is being passed

        return view('pages.admin.course.form', compact('prodi', 'group', 'type', 'prodi'));
    }

    public function getEducationLevel($prodi_id)
    {
        $prodi = All_prodi::find($prodi_id);

        // Ensure that the Prodi exists
        if (!$prodi) {
            return response()->json(['error' => 'Prodi not found'], 404);
        }

        // Find the associated education level using the id_jenj_didik from Prodi
        $educationLevel = Education_level::where('id_jenj_didik', $prodi->id_jenj_didik)->first();

        // Ensure that the Education Level exists
        if (!$educationLevel) {
            return response()->json(['error' => 'Education Level not found'], 404);
        }

        return response()->json([
            'id_jenj_didik' => $educationLevel->id_jenj_didik,
            'nm_jenj_didik' => $educationLevel->nm_jenj_didik // Return the name as well
        ]);
    }


    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'prodi_id' => 'required|exists:all_prodi,id_prodi',
            'education_level_id' => 'required|exists:education_level,id_jenj_didik',
            'code' => 'required|max:10|unique:course,code',
            'name' => 'required|max:200',
            'group_id' => 'required|exists:course_group,id',
            'type_id' => 'required|exists:course_type,id',
            'sks_mk' => 'required|integer',
            'sks_tm' => 'required|integer',
            'sks_pr' => 'required|integer',
            'sks_pl' => 'required|integer',
            'sks_sim' => 'required|integer',
            'status' => 'required|in:Active,Deleted,Non-Active',
            'is_sap' => 'required|boolean',
            'is_silabus' => 'required|boolean',
            'is_teaching_material' => 'required|boolean',
            'is_praktikum' => 'required|boolean',
            'course_range' => ['required', 'regex:/^\d{4}-\d{2}-\d{2}\s+to\s+\d{4}-\d{2}-\d{2}$/']
        ]);

        // Memisahkan tanggal mulai dan tanggal akhir dari rentang tanggal
        [$startDate, $endDate] = explode(' to ', $validatedData['course_range']);

        // Simpan data ke database
        Course::create([
            'prodi_id' => $validatedData['prodi_id'],
            'education_level_id' => $validatedData['education_level_id'],
            'code' => $validatedData['code'],
            'name' => $validatedData['name'],
            'group_id' => $validatedData['group_id'],
            'type_id' => $validatedData['type_id'],
            'sks_mk' => $validatedData['sks_mk'],
            'sks_tm' => $validatedData['sks_tm'],
            'sks_pr' => $validatedData['sks_pr'],
            'sks_pl' => $validatedData['sks_pl'],
            'sks_sim' => $validatedData['sks_sim'],
            'status' => $validatedData['status'],
            'is_sap' => $validatedData['is_sap'],
            'is_silabus' => $validatedData['is_silabus'],
            'is_teaching_material' => $validatedData['is_teaching_material'],
            'is_praktikum' => $validatedData['is_praktikum'],
            'effective_start_date' => $startDate,
            'effective_end_date' => $endDate
        ]);

        // Redirect ke halaman course.index dengan pesan sukses
        return redirect()->route('course.index')->with('success', 'Data Mata Kuliah Berhasil Ditambahkan.');
    }


    public function edit($id)
    {
        $course = Course::findOrFail($id); // Retrieve the course or fail with 404
        // $education_levels = Education_level::all();
        $group = Course_group::all();
        $type = Course_type::all();

        $identitas_pt = IdentitasPt::first();
        $current_id_sp = $identitas_pt->current_id_sp;

        $prodi = All_prodi::where('id_sp', $current_id_sp)
            ->where('status', 'A')
            ->get();

        // Prepare course_range as 'start_date to end_date'
        $course_range = $course->effective_start_date . ' to ' . $course->effective_end_date;


        return view('pages.admin.course.form_edit', compact('course', 'prodi', 'group', 'type', 'course_range'));
    }


    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id); // Retrieve the course or fail with 404

        // Validate input
        $validatedData = $request->validate([
            'prodi_id' => 'required|exists:all_prodi,id_prodi',
            'education_level_id' => 'required|exists:education_level,id_jenj_didik',
            'code' => 'required|max:10|unique:course,code,' . $course->id,
            'name' => 'required|max:200',
            'group_id' => 'required|exists:course_group,id',
            'type_id' => 'required|exists:course_type,id',
            'sks_mk' => 'required|integer',
            'sks_tm' => 'required|integer',
            'sks_pr' => 'required|integer',
            'sks_pl' => 'required|integer',
            'sks_sim' => 'required|integer',
            'status' => 'required|in:Active,Deleted,Non-Active',
            'is_sap' => 'required|boolean',
            'is_silabus' => 'required|boolean',
            'is_teaching_material' => 'required|boolean',
            'is_praktikum' => 'required|boolean',
            'course_range' => ['required', 'regex:/^\d{4}-\d{2}-\d{2}\s+to\s+\d{4}-\d{2}-\d{2}$/']
        ]);

        // Split the course range into start and end dates
        [$startDate, $endDate] = explode(' to ', $validatedData['course_range']);

        // Update the course data
        $course->update([
            'prodi_id' => $validatedData['prodi_id'],
            'education_level_id' => $validatedData['education_level_id'],
            'code' => $validatedData['code'],
            'name' => $validatedData['name'],
            'group_id' => $validatedData['group_id'],
            'type_id' => $validatedData['type_id'],
            'sks_mk' => $validatedData['sks_mk'],
            'sks_tm' => $validatedData['sks_tm'],
            'sks_pr' => $validatedData['sks_pr'],
            'sks_pl' => $validatedData['sks_pl'],
            'sks_sim' => $validatedData['sks_sim'],
            'status' => $validatedData['status'],
            'is_sap' => $validatedData['is_sap'],
            'is_silabus' => $validatedData['is_silabus'],
            'is_teaching_material' => $validatedData['is_teaching_material'],
            'is_praktikum' => $validatedData['is_praktikum'],
            'effective_start_date' => $startDate,
            'effective_end_date' => $endDate
        ]);

        // Redirect to the course index with success message
        return redirect()->route('course.index')->with('success', 'Data Mata Kuliah Berhasil Diperbarui.');
    }


    public function destroy($id)
    {
        // Cari data mata kuliah berdasarkan ID
        $course = Course::findOrFail($id);

        // Hapus data mata kuliah
        $course->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('course.index')->with('success', 'Data Mata Kuliah Berhasil di Hapus.');
    }
}
