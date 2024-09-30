<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Curriculum;
use App\Models\CurriculumCourse;
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
                    // Menyimpan data kursus
                    $editUrl = route('curriculum_course.edit', [$course->curriculum_id, $course->id]);
                    $deleteForm = '<form id="delete-form-' . $course->id . '" onsubmit="event.preventDefault(); confirmDelete(\'' . $course->id . '\');" action="' . route('curriculum_course.destroy', [$course->curriculum_id, $course->id]) . '" method="POST">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '<a href="' . $editUrl . '" class="btn btn-warning btn-sm edit ms-1 m-0" title="Edit"><i class="fas fa-pencil-alt"></i> Edit</a>'
                        . '<button type="submit" class="btn btn-danger btn-sm delete ms-1"><i class="fas fa-trash-alt"></i> Hapus</button></form>';
                    return $deleteForm;
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
        $courses = Course::all(); // Assuming courses can be selected from a list
        return view('pages.admin.curriculum_course.form', compact('curriculum', 'courses'));
    }

    // Store a new course in the curriculum
    public function store(Request $request, $curriculum_id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'sks_mk' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        $course = new CurriculumCourse();
        $course->curriculum_id = $curriculum_id;
        $course->course_id = $request->course_id;
        $course->sks_mk = $request->sks_mk;
        // Set other fields
        $course->save();

        return redirect()->route('curriculum_course.index', $curriculum_id)->with('success', 'Course added successfully.');    
    }

    // Show the form to edit an existing course
    public function edit($curriculum_id, $id)
    {
        $curriculum = Curriculum::findOrFail($curriculum_id);
        $course = CurriculumCourse::findOrFail($id);
        $courses = Course::all();
        return view('pages.admin.curriculum_course.form', compact('curriculum', 'course', 'courses'));
    }

    // Update an existing course
    public function update(Request $request, $curriculum_id, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'sks_mk' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        $course = CurriculumCourse::findOrFail($id);
        $course->course_id = $request->course_id;
        $course->sks_mk = $request->sks_mk;
        // Set other fields
        $course->save();

        return redirect()->route('curriculum_course.index', $curriculum_id)->with('success', 'Course updated successfully.');    
    }

    // Delete an existing course
    public function destroy($curriculum_id, $id)
    {
        $course = CurriculumCourse::findOrFail($id);
        $course->delete();

        return redirect()->route('curriculum_course.index', $curriculum_id)->with('success', 'Course deleted successfully.');
    }
}
