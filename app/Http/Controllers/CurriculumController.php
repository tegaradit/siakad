<?php

namespace App\Http\Controllers;

use App\Models\All_prodi;
use App\Models\Curriculum;
use App\Models\Education_level;
use App\Models\IdentitasPt;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // For UUID generation
use Yajra\DataTables\DataTables;

class CurriculumController extends Controller
{
    // Display a listing of the resource
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $currentIdSp = IdentitasPt::first()->current_id_sp;

            $datas = Curriculum::whereHas('all_prodi', function ($query) use ($currentIdSp){
                $query->where('id_sp' , $currentIdSp)
                ->where('status', 'A');
            })->with(['all_prodi','education_level','semester'])->get();
            // $datas = Curriculum::with(['all_prodi', 'education_level', 'semester'])->get();

            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('curriculum.edit', $row->curriculum_id);
                    // Ganti URL info agar mengarah ke data CurriculumCourse
                    $infoUrl = route('curriculum_course.index', ['curriculum_id' => $row->curriculum_id]);

                    $deleteForm = '<form id="delete-form-' . $row->curriculum_id . '" onsubmit="event.preventDefault(); confirmDelete(\'' . $row->curriculum_id . '\');" action="' . route('curriculum.destroy', $row->curriculum_id) . '" method="POST">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '<a href="' . $editUrl . '" class="btn btn-warning btn-sm edit m-0" title="Edit"><i class="fas fa-pencil-alt"></i> Edit</a>'
                        . '<a href="' . $infoUrl . '" class="btn btn-info btn-sm info ms-1 m-0" title="Info"><i class="fas fa-search"></i> Info</a>' // Add the Info button
                        . '<button type="submit" class="btn btn-danger btn-sm delete ms-1 m-0"><i class="fas fa-trash-alt"></i> Hapus</button></form>';
                    return $deleteForm;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.curriculum.index');
    }

    public function create()
    {
        $allProdi = DB::table('all_prodi')
            ->where('status', 'A')
            ->where('id_sp', DB::table('identitas_pt')->value('current_id_sp'))
            ->get();

        $semesters = DB::table('semester')->where('is_active', 1)->get();
        $activeSemester = $semesters->first(); // Get the first active semester

        return view('pages.admin.curriculum.form', [
            'allProdi' => $allProdi,
            'semesters' => $semesters,
            'activeSemester' => $activeSemester,
        ]);
    }

    public function show() {}

    public function store(Request $request)
    {
        // return $request->all();
        $validated = $request->validate([
            'prodi_id' => 'required|string|max:40',
            'name' => 'required|string|max:200',
            'normal_semester_number' => 'required|numeric',
            'pass_credit_number' => 'required|numeric',
            'mandatory_credit_number' => 'required|numeric',
            'choice_credit_number' => 'required|numeric',
            'semester_id' => 'required|string|max:6',
        ]);

        // return $validated;

        $curriculum = new Curriculum();
        $curriculum->curriculum_id = Str::uuid();
        $curriculum->prodi_id = $request->prodi_id;
        $curriculum->education_level_id = DB::table('education_level')
            ->where('id_jenj_didik', DB::table('all_prodi')->where('id_prodi', $request->prodi_id)->value('id_jenj_didik'))
            ->value('id_jenj_didik');
        $curriculum->semester_id = $request->semester_id;
        $curriculum->name = $request->name;
        $curriculum->normal_semester_number = $request->normal_semester_number;
        $curriculum->pass_credit_number = $request->pass_credit_number;
        $curriculum->mandatory_credit_number = $request->mandatory_credit_number;
        $curriculum->choice_credit_number = $request->choice_credit_number;
        $curriculum->save();

        return redirect()->route('curriculum.index')->with('success', 'Data Semester Berhasil Ditambahkan.');
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $curriculum = Curriculum::findOrFail($id);

        $allProdi = DB::table('all_prodi')
            ->where('status', 'A')
            ->where('id_sp', DB::table('identitas_pt')->value('current_id_sp'))
            ->get();

        $semesters = DB::table('semester')->where('is_active', 1)->get();
        $activeSemester = $semesters->first(); // Get the first active semester

        return view('pages.admin.curriculum.form', [
            'curriculum' => $curriculum,
            'allProdi' => $allProdi,
            'semesters' => $semesters,
            'activeSemester' => $activeSemester,
        ]);
    }

    // Update the specified resource in storage
    public function update(Request $request, $curriculum_id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'prodi_id' => 'required|string|max:40',
            'name' => 'required|string|max:200',
            'normal_semester_number' => 'required|numeric',
            'pass_credit_number' => 'required|numeric',
            'mandatory_credit_number' => 'required|numeric',
            'choice_credit_number' => 'required|numeric',
            'semester_id' => 'required|string|max:6',
        ]);

        // Find the curriculum entry that we want to update
        $curriculum = Curriculum::findOrFail($curriculum_id);

        // Update the curriculum properties
        $curriculum->prodi_id = $request->prodi_id;
        $curriculum->education_level_id = DB::table('education_level')
            ->where('id_jenj_didik', DB::table('all_prodi')->where('id_prodi', $request->prodi_id)->value('id_jenj_didik'))
            ->value('id_jenj_didik');
        $curriculum->semester_id = $request->semester_id;
        $curriculum->name = $request->name;
        $curriculum->normal_semester_number = $request->normal_semester_number;
        $curriculum->pass_credit_number = $request->pass_credit_number;
        $curriculum->mandatory_credit_number = $request->mandatory_credit_number;
        $curriculum->choice_credit_number = $request->choice_credit_number;

        // Save the changes to the database
        $curriculum->save();

        // Redirect to the curriculum index with a success message
        return redirect()->route('curriculum.index')->with('success', 'Data Kurikulum Berhasil Diperbarui.');
    }


    // Remove the specified resource from storage
    public function destroy($curriculum_id)
    {
        $curriculum = Curriculum::findOrFail($curriculum_id); // Correct variable name
        $curriculum->delete();

        return redirect()->route('curriculum.index')->with('success', 'Data Kurikulum Berhasil di Hapus.');
    }
}