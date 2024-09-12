<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SemesterController extends Controller
{
    public function index()
    {
        // $datas = Semester::all();
        return view('pages.admin.semester.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $semester = Semester::query();

            return DataTables::of($semester)
            ->addColumn('action', function ($row) {
                return '<a href="'.route('semester.edit', $row->semester_id).'" class="btn btn-outline-warning btn-sm edit" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form id="delete-form-' . $row->semester_id . '" 
                              onsubmit="event.preventDefault(); confirmDelete(' . $row->semester_id . ');" 
                              action="' . route('semester.destroy', $row->semester_id) . '" 
                              method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn icon icon-left btn-outline-danger btn-sm delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return abort(404);
    }

    // Display the form to create a new semester
    public function create()
    {
        // Return the form view for creating a new semester
        return view('pages.admin.semester.form');
    }

    // Store the new semester in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'semester_id' => 'required|string|max:6|unique:semester,semester_id',
            'name' => 'required|string|max:20',
            'smt' => 'required|integer|in:1,2,3',
            'is_active' => 'required|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Create a new semester entry
        Semester::create([
            'semester_id' => $request->semester_id,
            'name' => $request->name,
            'smt' => $request->smt,
            'is_active' => $request->is_active,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Redirect to the index page with success message
        return redirect()->route('semester.index')->with('success', 'Semester created successfully.');
    }

    // Display the form to edit an existing semester
    public function edit($semester_id)
    {
        // Find the semester by its ID
        $semester = Semester::findOrFail($semester_id);

        // Return the form view for editing the semester, passing the existing data
        return view('pages.admin.semester.form', compact('semester'));
    }

    // Update the semester in the database
    public function update(Request $request, $semester_id)
    {
        // Validate the incoming request data
        $request->validate([
            'semester_id' => 'required|string|max:6|exists:semester,semester_id',
            'name' => 'required|string|max:20',
            'smt' => 'required|integer|in:1,2,3',
            'is_active' => 'required|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Find the semester by its ID
        $semester = Semester::findOrFail($semester_id);

        // Update the semester data
        $semester->update([
            'name' => $request->name,
            'smt' => $request->smt,
            'is_active' => $request->is_active,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Redirect to the index page with success message
        return redirect()->route('semester.index')->with('success', 'Semester updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy($semester_id)
    {
        $semester = Semester::findOrFail($semester_id); // Correct variable name
        $semester->delete();

        return redirect()->route('semester.index')->with('success', 'Curriculum deleted successfully.');
    }
}
