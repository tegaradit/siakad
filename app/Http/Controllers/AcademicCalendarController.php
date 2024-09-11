<?php

namespace App\Http\Controllers;

use App\Models\Academic_calendar;
use App\Models\Calendar_type;
use App\Models\Semester;
use Illuminate\Http\Request;

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



    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string',
            'semester_id' => 'required|exists:semester,semester_id|max:6',
            'calendar_type_id' => 'required|exists:calendar_types,id',
        ]);

        Academic_calendar::create($request->all());

        return redirect()->route('kalender-akademik.index')->with('success', 'Data berhasil ditambahkan.');
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string',
            'semester_id' => 'required|exists:semester,semester_id|max:6',
            'calendar_type_id' => 'required|exists:calendar_types,id',
        ]);

        $data = Academic_calendar::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('kalender-akademik.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Academic_calendar::findOrFail($id);
        $data->delete();

        return redirect()->route('kalender-akademik.index')->with('success', 'Data berhasil dihapus.');
    }
    //

}
