<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\Education_level;
use App\Models\Prodi;
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
            $datas = Curriculum::with(['prodi', 'education_level', 'semester'])->get();
            
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $editUrl = route('curriculum.edit', $row->curriculum_id);
                    $deleteForm = '<form id="delete-form-' . $row->curriculum_id . '" onsubmit="event.preventDefault(); confirmDelete(\'' . $row->curriculum_id . '\');" action="'.route('curriculum.destroy', $row->curriculum_id).'" method="POST">'
                                .csrf_field()
                                .method_field('DELETE')
                                .'<a href="' . $editUrl . '" class="btn btn-outline-warning btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a>'
                                .'<button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button></form>';
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
        $prodi = Prodi::all(); // Assuming Prodi is a model
        $educationLevels = Education_level::all();
        $semesters = Semester::all();
        return view('pages.admin.curriculum.form', compact('prodi', 'educationLevels', 'semesters'));
    }

    public function searchEducationLevel (Request $request) {
        $search = $request->query('nm_jenj_didik') != '' ? $request->query('nm_jenj_didik') : 'null';
        return $request->ajax() ? Prodi::where('nm_jenj_didik', 'like', "%$search%")->get() : abort(404);
    }

    // Store a newly created resource in storage
    public function store(Request $request)
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

        // Generate UUID for curriculum_id
        $validatedData['curriculum_id'] = (string) Str::uuid();

        Curriculum::create($validatedData);

        return redirect()->route('curriculum.index')->with('success', 'Curriculum created successfully.');
    }

    // Show the form for editing the specified resource
    public function edit($curriculum_id)
    {
        $curriculum = Curriculum::findOrFail($curriculum_id); // Correct variable name
        $prodi = Prodi::all();
        $educationLevels = Education_level::all();
        $semesters = Semester::all();

        return view('pages.admin.curriculum.form', compact('curriculum', 'prodi', 'educationLevels', 'semesters'));
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

        $curriculum = Curriculum::findOrFail($curriculum_id); // Correct variable name
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
