<?php

namespace App\Http\Controllers;

use App\Models\Calendar_type;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTable;
use Yajra\DataTables\Facades\DataTables;

class CalendarTypeController extends Controller
{
    public function index()
    {
        $datas = Calendar_type::orderBy('name', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate();
        return view('pages.admin.type_calendar.index', compact('datas'));
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $calendarType = Calendar_type::query();

            return DataTables::of($calendarType)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('calendar-type.edit', $data->id) . '" class="btn btn-warning btn-sm edit m-0"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <form id="delete-form-' . $data->id . '" 
                                  onsubmit="event.preventDefault(); confirmDelete(' . $data->id . ');" 
                                  action="' . route('calendar-type.destroy', $data->id) . '" 
                                  method="POST" style="display:inline-block; margin: 0;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm delete m-0"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>';
                })

                ->make(true);
        }

        return abort(404);
    }

    public function create()
    {
        return view('pages.admin.type_calendar.form');
    }

    public function store(Request $request)
    {
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