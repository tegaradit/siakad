<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Course_group;
use App\Models\Course_type;
use App\Models\Education_level;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    // public function index(){
    //     // $user = Auth::user();
    //     $menu = 'course';
    //     $submenu = 'course';

    //     // Mengambil data mata kuliah dengan relasi yang diperlukan
    //     $datas = Course::with(['prodi', 'education_level', 'course_group', 'course_type'])->latest()->paginate(10);

    //     // Mengirim data ke view
    //     return view('pages.admin.course.index', compact('datas'));
    // }

    public function index()
    {
        if (request()->ajax()) {
            $courses = Course::with(['prodi', 'education_level', 'course_group', 'course_type'])->get();
            return DataTables::of($courses)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('course.edit', $row->id);
                    $deleteUrl = route('course.destroy', $row->id);
                    $viewUrl = route('course.show', $row->id); // URL for the view button

                    return '<form id="delete-form-' . $row->id . '" onsubmit="event.preventDefault(); confirmDelete(' . $row->id . ');" action="' . $deleteUrl . '" method="POST">
                                <a href="' . $viewUrl . '" class="btn btn-outline-info btn-sm view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="' . $editUrl . '" class="btn btn-outline-warning btn-sm edit" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn icon icon-left btn-outline-danger btn-sm delete" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>';
                })
                ->editColumn('is_sap', function ($row) {
                    return $row->is_sap ? 'Yes' : 'No';
                })
                ->editColumn('is_silabus', function ($row) {
                    return $row->is_silabus ? 'Yes' : 'No';
                })
                ->editColumn('is_teaching_material', function ($row) {
                    return $row->is_teaching_material ? 'Yes' : 'No';
                })
                ->editColumn('is_praktikum', function ($row) {
                    return $row->is_praktikum ? 'Yes' : 'No';
                })
                ->editColumn('effective_start_date', function ($row) {
                    return $row->effective_start_date ? \Carbon\Carbon::parse($row->effective_start_date)->format('d/m/Y') : 'N/A';
                })
                ->editColumn('effective_end_date', function ($row) {
                    return $row->effective_end_date ? \Carbon\Carbon::parse($row->effective_end_date)->format('d/m/Y') : 'N/A';
                })
                ->make(true);
        }

        return view('pages.admin.course.index');
    }

    public function show($id)
    {
        // Find the course by ID or fail with 404 if not found
        $course = Course::with(['prodi', 'education_level', 'course_group', 'course_type'])->findOrFail($id);

        // Return the view with course details
        return view('pages.admin.course.show', compact('course'));
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

    public function searchProdi (Request $request) {
        $search = $request->query('nama_prodi') != '' ? $request->query('nama_prodi') : 'null';
        return $request->ajax() ? Prodi::where('nama_prodi', 'like', "%$search%")->get() : abort(404);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'prodi_id' => 'required|exists:prodi,id',
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
            'effective_start_date' => 'required|date',
            'effective_end_date' => 'required|date',
        ]);

        // Simpan data ke database
        Course::create($validatedData);

        // Redirect ke halaman course.index dengan pesan sukses
        return redirect()->route('course.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
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
