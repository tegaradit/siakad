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
        $menu='datas';
        $submenu='kalender-akademik';
        $datas = Academic_calendar::with(['semester', 'calendar_type'])->orderBy('id', 'asc')->paginate(5);
        return view('pages.admin.akademik_kalender.index', compact('datas', 'menu', 'submenu'));
    }



    public function create()
    {
        $menu='datas';
        $submenu='kalender-akademik';
        $calendar_types = Calendar_type::all();
        $semesters = Semester::where('is_active', 1)->get();  // Mengambil hanya semester aktif
        $active_semester = Semester::where('is_active', 1)->first();  // Mengambil semester aktif pertama (jika ada)

        return view('pages.admin.akademik_kalender.form', compact('calendar_types', 'semesters', 'active_semester'));
    }



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
                    return '<a href="' . route('kalender-akademik.edit', $data->id) . '" class="btn btn-warning btn-sm edit"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <form id="delete-form-' . $data->id . '" 
                              onsubmit="event.preventDefault(); confirmDelete(' . $data->id . ');" 
                              action="' . route('kalender-akademik.destroy', $data->id) . '" 
                              method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn icon icon-left btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i> Hapus</button>
                        </form>';
                })
                ->make(true);
        }

        return abort(404);
    }


    public function store(Request $request)
    {
        $request->validate([
            'date_range' => 'required',
            'description' => 'required|string',
            'calendar_type_id' => 'required|exists:calendar_types,id',
        ]);

        // Ambil semester aktif
        $active_semester = Semester::where('is_active', 1)->first();

        if (!$active_semester) {
            return back()->withErrors(['semester_id' => 'Tidak ada semester aktif yang ditemukan.']);
        }

        $dates = explode(' to ', $request->input('date_range'));

        Academic_calendar::create([
            'start_date' => $dates[0],
            'end_date' => $dates[1],
            'description' => $request->input('description'),
            'semester_id' => $active_semester->semester_id, // Isi otomatis dengan semester aktif
            'calendar_type_id' => $request->input('calendar_type_id'),
        ]);

        return redirect()->route('kalender-akademik.index')->with('success', 'Data berhasil ditambahkan.');
    }



    public function update(Request $request, $id)
    {
        // Ambil rentang tanggal
        $date_range = $request->input('date_range');

        $dates = explode(' to ', $date_range);

        if (count($dates) === 2) {
            $start_date = $dates[0];
            $end_date = $dates[1];
        } else {
            return back()->withErrors(['date_range' => 'Format rentang tanggal tidak valid']);
        }

        $request->validate([
            'description' => 'required|string',
            'calendar_type_id' => 'required|exists:calendar_types,id',
        ]);

        $academicCalendar = Academic_calendar::find($id);
        $academicCalendar->start_date = $start_date;
        $academicCalendar->end_date = $end_date;
        $academicCalendar->description = $request->input('description');
        $academicCalendar->calendar_type_id = $request->input('calendar_type_id');
        $academicCalendar->save();

        return redirect()->route('kalender-akademik.index')->with('success', 'Data berhasil diupdate');
    }




    public function edit($id)
    {
        $menu='datas';
        $submenu='kalender-akademik';

        $data = Academic_calendar::findOrFail($id);
        $calendar_types = Calendar_type::all();
        $semesters = Semester::where('is_active', 1)->get();  // Mengambil hanya semester aktif
        $active_semester = Semester::where('is_active', 1)->first();  // Mengambil semester aktif pertama (jika ada)

        return view('pages.admin.akademik_kalender.form', compact('data', 'calendar_types', 'semesters', 'active_semester'));
    }




    public function destroy($id)
    {
        $data = Academic_calendar::findOrFail($id);
        $data->delete();

        return redirect()->route('kalender-akademik.index')->with('success', 'Data berhasil dihapus.');
    }
    //

}
