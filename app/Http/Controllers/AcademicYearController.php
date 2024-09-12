<?php

namespace App\Http\Controllers;

use App\Models\Academic_year;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AcademicYearController extends Controller
{
    public function index()
    {
        return view('pages.admin.academic_year.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $academicYears = Academic_year::query();

            return DataTables::of($academicYears)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('tahun-akademik.edit', $data->id) . '" class="btn btn-outline-warning btn-sm edit"><i class="fas fa-pencil-alt"></i></a>
                    <form id="delete-form-' . $data->id . '" 
                              onsubmit="event.preventDefault(); confirmDelete(' . $data->id . ');" 
                              action="' . route('tahun-akademik.destroy', $data->id) . '" 
                              method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn icon icon-left btn-outline-danger btn-sm delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>';
                })
                ->make(true);
        }

        return abort(404);
    }

    public function create()
    {
        return view('pages.admin.academic_year.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|size:4', // ID harus 4 karakter
            'name' => 'required|string|min:3|max:10', // Nama harus antara 3-10 karakter
            'start_date' => 'required|date', // Tanggal mulai harus format tanggal
            'end_date' => 'required|date|after_or_equal:start_date', // Tanggal selesai harus setelah atau sama dengan tanggal mulai
        ]);

        $academicYear = new Academic_year();
        $academicYear->id = $validated['id'];
        $academicYear->name = $validated['name'];
        $academicYear->start_date = $validated['start_date'];
        $academicYear->end_date = $validated['end_date'];
        $academicYear->save();

        return redirect()->route('tahun-akademik.index')->with('success', 'Tahun Akademik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $academicYear = Academic_year::findOrFail($id);
        return view('pages.admin.academic_year.form_edit', compact('academicYear'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id' => 'required|string|size:4',
            'name' => 'required|string|min:3|max:10',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $academicYear = Academic_year::findOrFail($id);
        $academicYear->id = $validated['id'];
        $academicYear->name = $validated['name'];
        $academicYear->start_date = $validated['start_date'];
        $academicYear->end_date = $validated['end_date'];
        $academicYear->save();

        return redirect()->route('tahun-akademik.index')->with('success', 'Tahun Akademik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $academicYear = Academic_year::findOrFail($id);
        $academicYear->delete();

        return redirect()->route('tahun-akademik.index')->with('success', 'Data berhasil dihapus.');
    }
}
