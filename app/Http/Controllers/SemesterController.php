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
                    return '<a href="' . route('semester.edit', $row->semester_id) . '" class="btn btn-warning btn-sm edit m-0" title="Edit">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                        <form id="delete-form-' . $row->semester_id . '" 
                              onsubmit="event.preventDefault(); confirmDelete(' . $row->semester_id . ');" 
                              action="' . route('semester.destroy', $row->semester_id) . '" 
                              method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm delete m-0">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return abort(404);
    }

    public function changeStatus($id)
    {
        // Temukan semester yang ingin diubah statusnya
        $semester = Semester::find($id);
        if (!$semester) {
            return response()->json(['success' => false, 'message' => 'Semester tidak ditemukan.']);
        }

        // Jika semester yang diaktifkan, nonaktifkan semua semester lainnya
        if ($semester->is_active == 0) {
            // Nonaktifkan semua semester lainnya
            Semester::where('is_active', 1)->update(['is_active' => 0]);
            // Aktifkan semester ini
            $semester->is_active = 1;
        } else {
            // Jika semester ini aktif, set menjadi nonaktif
            $semester->is_active = 0;
        }

        $semester->save();

        return response()->json(['success' => true]);
    }

    // Display the form to create a new semester
    public function create()
    {
        // Cek apakah ada semester lain yang aktif
        $isAnotherActive = Semester::where('is_active', 1)->exists() ? 1 : 0;

        return view('pages.admin.semester.form', compact('isAnotherActive'));
    }

    // Store the new semester in the database
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'semester_id' => 'required|string|max:6|unique:semester,semester_id',
            'name' => 'required|string|max:20',
            'smt' => 'required|in:1,2,3',
            'is_active' => 'required|boolean',
            'date_range' => 'required',
        ]);

        // Pisahkan start_date dan end_date dari date_range
        $dates = explode(' to ', $request->input('date_range'));

        // Ubah request untuk menambahkan start_date dan end_date
        $request->merge([
            'start_date' => $dates[0],
            'end_date' => $dates[1],
        ]);

        // Jika is_active = 1, set semua semester lain yang aktif menjadi non-aktif
        if ($request->input('is_active') == 1) {
            Semester::where('is_active', 1)->update(['is_active' => 0]);
        }

        // Create the semester record
        Semester::create([
            'semester_id' => $request->input('semester_id'),
            'name' => $request->input('name'),
            'smt' => $request->input('smt'),
            'is_active' => $request->input('is_active'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        // Redirect back to the semester index page with a success message
        return redirect()->route('semester.index')->with('success', 'Data Semester Berhasil Ditambahkan.');
    }

    // Display the form to edit an existing semester
    public function edit($semester_id)
    {
        // Cari semester yang akan diedit berdasarkan ID
        $semester = Semester::findOrFail($semester_id);

        // Cek apakah ada semester lain yang aktif selain semester yang sedang diedit
        $isAnotherActive = Semester::where('is_active', 1)
            ->where('semester_id', '!=', $semester_id) // Selain semester yang sedang diedit
            ->exists() ? 1 : 0;

        // Return view untuk edit, kirim data semester yang ditemukan dan flag isAnotherActive
        return view('pages.admin.semester.form', compact('semester', 'isAnotherActive'));
    }

    // Update the semester in the database
    public function update(Request $request, $id)
    {
        $semester = Semester::findOrFail($id);

        // Validate the input data
        $validated = $request->validate([
            'semester_id' => 'required|string|max:6',
            'name' => 'required|string|max:20',
            'smt' => 'required|integer|in:1,2,3',
            'is_active' => 'required|boolean',
            'date_range' => 'required|string',
        ]);

        // Pisahkan start_date dan end_date dari date_range
        $dates = explode(' to ', $request->input('date_range'));

        // Ubah request untuk menambahkan start_date dan end_date
        $request->merge([
            'start_date' => $dates[0],
            'end_date' => $dates[1],
        ]);

        // Jika is_active = 1, set semua semester lain yang aktif menjadi non-aktif
        if ($request->input('is_active') == 1) {
            Semester::where('is_active', 1)
                ->where('semester_id', '!=', $semester->semester_id) // Hindari semester yang sedang di-update
                ->update(['is_active' => 0]);
        }

        // Update the semester data
        $semester->update([
            'semester_id' => $validated['semester_id'],
            'name' => $validated['name'],
            'smt' => $validated['smt'],
            'is_active' => $validated['is_active'],
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        // Redirect back with success message
        return redirect()->route('semester.index')->with('success', 'Data Semester Berhasil Diperbarui.');
    }


    // Remove the specified resource from storage
    public function destroy($semester_id)
    {
        $semester = Semester::findOrFail($semester_id); // Correct variable name
        $semester->delete();

        return redirect()->route('semester.index')->with('success', 'Data Semester Berhasil di Hapus.');
    }
}
