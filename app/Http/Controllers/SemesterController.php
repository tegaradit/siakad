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

    public function create()
    {
        return view('pages.admin.semester.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'semester_id' => 'required|string|max:6|unique:semester,semester_id',
            'name' => 'required|string|max:20',
            'smt' => 'required|integer|in:1,2,3',
            'is_active' => 'boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Semester::create($request->all());

        return redirect()->route('semester.index')->with('success', 'Semester created successfully.');
    }

    public function edit($id)
    {
        $semester = Semester::findOrFail($id);
        return view('semester.edit', compact('semester'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'semester_id' => 'required|string|max:6|exists:semester,semester_id',
            'name' => 'required|string|max:20',
            'smt' => 'required|integer|in:1,2,3',
            'is_active' => 'boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $semester = Semester::findOrFail($id);
        $semester->update($request->all());

        return redirect()->route('semester.index')->with('success', 'Semester updated successfully.');
    }

    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return redirect()->route('semester.index')->with('success', 'Semester deleted successfully.');
    }
}
