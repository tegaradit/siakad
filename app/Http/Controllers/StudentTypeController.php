<?php

namespace App\Http\Controllers;

use App\Models\student_type;
use App\Models\StudentType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentTypeController extends Controller
{
    public function index()
    {
        return view('pages.admin.student_type.index'); // Ganti dengan path view yang sesuai
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $studentTypes = student_type::query();

            return DataTables::of($studentTypes)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a href="#" class="btn btn-warning btn-sm edit" data-id="' . $data->id . '" data-name="' . $data->name . '" data-bs-toggle="modal" data-bs-target="#editStudentTypeModal"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <form id="delete-form-' . $data->id . '" 
                                  onsubmit="event.preventDefault(); confirmDelete(' . $data->id . ');" 
                                  action="' . route('student-type.destroy', $data->id) . '" 
                                  method="POST" style="display:inline-block; margin: 0;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>';
                })
                ->make(true);
        }

        return abort(404);
    }

    // public function create()
    // {
    //     return view('pages.admin.student_type.form'); // Ganti dengan path view yang sesuai
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        student_type::create($validated);

        return redirect()->route('student-type.index');
    }

    public function edit($id)
    {
        $studentType = student_type::findOrFail($id);
        return response()->json($studentType);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        $studentType = student_type::findOrFail($id);
        $studentType->update($validated);

        return redirect()->route('student-type.index');
    }

    public function destroy($id)
    {
        $studentType = student_type::findOrFail($id);
        $studentType->delete();

        return redirect()->route('student-type.index');
    }
}
