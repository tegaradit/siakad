<?php

namespace App\Http\Controllers;

use App\Models\Calendar_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CalendarTypeController extends Controller
{
    public function index()
    {
        $datas = Calendar_type::orderBy('name', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate();
        return view('pages.admin.type_calendar.index', compact('datas'));
    }



    public function create()
    {
        return view('pages.admin.type_calendar.form');
    }

    public function store(Request $request)
    {
        // Cek semua data yang dikirim dari form
        // dd($request->all());

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        $calendarType = new Calendar_type();
        $calendarType->name = $validated['name'];
        $calendarType->save();

        return redirect()->route('calendar-type.index')->with('success', 'Tipe Kalender berhasil ditambahkan.');
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        $calendarType = Calendar_type::findOrFail($id);
        $calendarType->name = $validated['name'];
        $calendarType->save();

        return redirect()->route('calendar-type.index')->with('success', 'Tipe Kalender berhasil diperbarui.');
    }


    public function edit($id)
    {
        $calendarType = Calendar_type::findOrFail($id);
        return view('pages.admin.type_calendar.form_edit', compact('calendarType'));
    }

    public function destroy($id)
    {
        $calendarType = Calendar_type::findOrFail($id);
        $calendarType->delete();

        return redirect()->route('calendar-type.index')->with('success', 'Data berhasil dihapus.');
    }
}
