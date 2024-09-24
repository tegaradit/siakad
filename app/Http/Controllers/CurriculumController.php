<?php

namespace App\Http\Controllers;

use App\Models\All_prodi;
use App\Models\Curriculum;
use App\Models\Education_level;
use App\Models\IdentitasPt;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // For UUID generation
use Yajra\DataTables\DataTables;

class CurriculumController extends Controller
{
    // Display a listing of the resource
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $datas = Curriculum::with(['all_prodi', 'education_level', 'semester'])->get();
    
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('curriculum.edit', $row->curriculum_id);
                    $deleteForm = '<form id="delete-form-' . $row->curriculum_id . '" onsubmit="event.preventDefault(); confirmDelete(\'' . $row->curriculum_id . '\');" action="' . route('curriculum.destroy', $row->curriculum_id) . '" method="POST">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '<a href="' . $editUrl . '" class="btn btn-warning btn-sm edit m-0" title="Edit"><i class="fas fa-pencil-alt"></i> Edit</a>'
                        . '<button type="submit" class="btn btn-danger btn-sm delete ms-2 m-0"><i class="fas fa-trash-alt"></i> Hapus</button></form>';
                    return $deleteForm;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('pages.admin.curriculum.index');
    }
    

    // Show the form for creating a new resource
    public function create()
    {
        $educationLevels = Education_level::all();
        $semesters = Semester::all();

        // Mendapatkan current_id_sp dari tabel identitas_pt
        $identitas_pt = IdentitasPt::first(); // Sesuaikan query untuk mendapatkan data identitas_pt
        $current_id_sp = $identitas_pt->current_id_sp;

        // Query untuk mendapatkan all_prodi yang memiliki id_sp sama dan status Aktif
        $prodi = All_prodi::where('id_sp', $current_id_sp)
            ->where('status', 'A') // 'A' adalah untuk status Aktif
            ->get();

        return view('pages.admin.curriculum.form', compact('prodi', 'educationLevels', 'semesters', 'identitas_pt', 'current_id_sp'));
    }

    // Search for education levels
    public function searchEdLevel(Request $request)
    {
        $searchTerm = $request->query('nm_jenj_didik');
        $educationLevels = Education_level::where('nm_jenj_didik', 'LIKE', "%{$searchTerm}%")->get();

        return $educationLevels;
    }

    public function show() {}

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // return $request->all();
        $validatedData = $request->validate([
            'prodi_id' => 'required|uuid',
            'education_level_id' => 'required|integer',
            'semester_id' => 'required|string|min:5|max:6',
            'name' => 'required|string|max:200',
            'normal_semester_number' => 'required|integer',
            'pass_credit_number' => 'required|integer',
            'mandatory_credit_number' => 'required|integer',
            'choice_credit_number' => 'required|integer',
        ]);

        // Generate UUID for curriculum_id
        $validatedData['curriculum_id'] = (string) Str::uuid();

        Curriculum::create($validatedData);

        return redirect()->route('curriculum.index')->with('success', 'Curriculum created successfully.');
    }

    // Show the form for editing the specified resource
    public function edit($curriculum_id)
    {
        $educationLevels = Education_level::all();
        $semesters = Semester::all();

        // Mendapatkan current_id_sp dari tabel identitas_pt
        $identitas_pt = IdentitasPt::first(); // Sesuaikan query untuk mendapatkan data identitas_pt
        $current_id_sp = $identitas_pt->current_id_sp;

        // Query untuk mendapatkan all_prodi yang memiliki id_sp sama dan status Aktif
        $prodi = All_prodi::where('id_sp', $current_id_sp)
            ->where('status', 'A') // 'A' adalah untuk status Aktif
            ->get();

        // Ambil data curriculum yang ingin diedit
        $curriculum = Curriculum::findOrFail($curriculum_id);

        return view('pages.admin.curriculum.form', compact('prodi', 'educationLevels', 'semesters', 'curriculum'));
    }


    // Update the specified resource in storage
    public function update(Request $request, $curriculum_id)
    {
        $validatedData = $request->validate([
            'prodi_id' => 'required|uuid',
            'education_level_id' => 'required|integer',
            'semester_id' => 'required|string|min:5|max:6',
            'name' => 'required|string|max:200',
            'normal_semester_number' => 'required|integer',
            'pass_credit_number' => 'required|integer',
            'mandatory_credit_number' => 'required|integer',
            'choice_credit_number' => 'required|integer',
        ]);

        // Ambil data curriculum yang ingin di-update
        $curriculum = Curriculum::findOrFail($curriculum_id);

        // Update data curriculum dengan data yang telah divalidasi
        $curriculum->update($validatedData);

        return redirect()->route('curriculum.index')->with('success', 'Curriculum updated successfully.');
    }


    // Remove the specified resource from storage
    public function destroy($curriculum_id)
    {
        $curriculum = Curriculum::findOrFail($curriculum_id); // Correct variable name
        $curriculum->delete();

        return redirect()->route('curriculum.index')->with('success', 'Curriculum deleted successfully.');
    }
}
