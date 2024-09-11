<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $datas = Semester::all();
        return view('pages.admin.semester.index', compact('datas'));
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
