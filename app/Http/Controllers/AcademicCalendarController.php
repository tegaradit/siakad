<?php

namespace App\Http\Controllers;

use App\Models\Academic_calendar;
use App\Models\Calendar_type;
use App\Models\Semester;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AcademicCalendarController extends Controller
{
    public function index()
    {
        $datas = Academic_calendar::with(['semester', 'calendar_type'])->orderBy('id', 'asc')->paginate(5);
        return view('pages.admin.akademik_kalender.index', compact('datas'));
    }



    public function create()
    {
        $calendar_types = Calendar_type::all(); // Memanggil all() pada model Calendar_type
        $semesters = Semester::all(); // Memanggil all() pada model Semester
        return view('pages.admin.akademik_kalender.form', compact('calendar_types', 'semesters'));
    }

    // AcademicCalendarController.php
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $academic_calendar = Academic_calendar::with(['semester', 'calendar_type'])->get();

            return DataTables::of($academic_calendar)
                ->addIndexColumn()
                ->addColumn('semester_id', function ($data) {
                    return $data->semester ? $data->semester->name : 'N/A';
                })
                ->addColumn('calendar_type_id', function ($data) {
                    return $data->calendar_type ? $data->calendar_type->name : 'N/A';
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('kalender-akademik.edit', $data->id) . '" class="btn btn-outline-warning btn-sm edit"><i class="fas fa-pencil-alt"></i></a>
                        <form id="delete-form-' . $data->id . '" 
                              onsubmit="event.preventDefault(); confirmDelete(' . $data->id . ');" 
                              action="' . route('kalender-akademik.destroy', $data->id) . '" 
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


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'date_range' => 'required',
            'description' => 'required|string',
            'semester_id' => 'required|exists:semester,semester_id|max:6',
            'calendar_type_id' => 'required|exists:calendar_types,id',
        ]);

        // Pisahkan start_date dan end_date dari date_range
        $dates = explode(' to ', $request->input('date_range'));

        // Ubah request untuk menambahkan start_date dan end_date
        $request->merge([
            'start_date' => $dates[0],
            'end_date' => $dates[1],
        ]);

        // Debug hasil input
        // dd($request->all()); // Menampilkan hasil debug di layar

        // Simpan data ke dalam database
        Academic_calendar::create([
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'description' => $request->input('description'),
            'semester_id' => $request->input('semester_id'),
            'calendar_type_id' => $request->input('calendar_type_id'),
        ]);

        return redirect()->route('kalender-akademik.index')->with('success', 'Data berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'date_range' => 'required',
            'description' => 'required|string',
            'semester_id' => 'required|exists:semester,semester_id|max:6',
            'calendar_type_id' => 'required|exists:calendar_types,id',
        ]);

        $dates = explode(' - ', $request->input('date_range'));

        $data = Academic_calendar::findOrFail($id);
        $data->update([
            'start_date' => $dates[0],
            'end_date' => $dates[1],
            'description' => $request->input('description'),
            'semester_id' => $request->input('semester_id'),
            'calendar_type_id' => $request->input('calendar_type_id'),
        ]);

        return redirect()->route('kalender-akademik.index')->with('success', 'Data berhasil diperbarui.');
    }


    public function edit($id)
    {
        $data = Academic_calendar::findOrFail($id);
        $calendar_types = Calendar_type::all();
        $semesters = Semester::all();

        if ($calendar_types->isEmpty() || $semesters->isEmpty()) {
            return redirect()->back()->with('warning', 'Data tidak lengkap.');
        }

        return view('pages.admin.akademik_kalender.form', compact('data', 'calendar_types', 'semesters'));
    }

    public function destroy($id)
    {
        $data = Academic_calendar::findOrFail($id);
        $data->delete();

        return redirect()->route('kalender-akademik.index')->with('success', 'Data berhasil dihapus.');
    }
    //

}
