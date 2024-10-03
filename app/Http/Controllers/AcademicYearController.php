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
                    return '
                        <a href="' . route('tahun-akademik.edit', $data->id) . '" class="btn btn-warning btn-sm edit"><i class="fas fa-pencil-alt"></i> Edit
                        </a>
                        <form id="delete-form-' . $data->id . '" 
                              onsubmit="event.preventDefault(); confirmDelete(' . $data->id . ');" 
                              action="' . route('tahun-akademik.destroy', $data->id) . '" 
                              method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn icon icon-left btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i> Hapus</button>
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
        // Validasi input
        $request->validate([
            'id' => 'required|string|size:4',
            'name' => 'required|string|min:3|max:10',
            'date_range' => 'required', // Validasi untuk date_range
        ]);

        // Pisahkan start_date dan end_date dari date_range
        $dates = explode(' to ', $request->input('date_range'));

        // Ubah request untuk menambahkan start_date dan end_date
        $request->merge([
            'start_date' => $dates[0],
            'end_date' => $dates[1],
        ]);

        // Menyimpan data yang telah divalidasi
        Academic_year::create([
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        return redirect()->route('tahun-akademik.index')->with('success', 'Tahun Akademik berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $academicYear = Academic_year::findOrFail($id);
        return view('pages.admin.academic_year.form_edit', compact('academicYear'));
    }

    public function update(Request $request, $id)
    {
        $academicYear = Academic_year::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'id' => 'required|string|size:4|unique:academic_years,id,' . $academicYear->id,
            'name' => 'required|string|min:3|max:10',
            'date_range' => 'required', // Tambahkan validasi untuk date_range
        ]);

        // Pisahkan start_date dan end_date dari date_range
        $dates = explode(' to ', $request->input('date_range'));

        // Ubah request untuk menambahkan start_date dan end_date
        $request->merge([
            'start_date' => $dates[0],
            'end_date' => $dates[1],
        ]);

        // Validasi tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Update data tahun akademik
        $academicYear->update([
            'id' => $validated['id'],
            'name' => $validated['name'],
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        return redirect()->route('tahun-akademik.index')->with('success', 'Tahun Akademik berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $academicYear = Academic_year::findOrFail($id);
        $academicYear->delete();

        return redirect()->route('tahun-akademik.index')->with('success', 'Data berhasil dihapus.');
    }
}
