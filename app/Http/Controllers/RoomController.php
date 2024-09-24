<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\room;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
    // public function index()

    // {   
    //      $rooms = Room::with('building')->get(); 
    //      return view('pages.admin.room.index', compact('rooms'));  
    // }
    public function index()
    {
        // Kirimkan view tanpa data karena DataTables akan meng-handle data secara AJAX
        return view('pages.admin.room.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $room = room::query();

            return DataTables::of($room)
                ->addIndexColumn() // Menambahkan kolom index secara otomatis
                ->addColumn('action', function ($data) {
                    // Mengembalikan HTML untuk kolom aksi, misalnya tombol edit
                    return '
                    <div style="text-align: center;">
                        <a href="'.route('room.edit', $data->id).'" class="btn btn-warning btn-sm edit m-0" style="display: inline-block; margin: 5px;"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <form id="delete-form-' . $data->id . '" 
                            onsubmit="event.preventDefault(); confirmDelete(' . $data->id . ');" 
                            action="' . route('room.destroy', $data->id) . '" 
                            method="POST" style="display:inline-block; margin: 5px;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm delete m-0" style="display: inline-block;"><i class="fas fa-trash-alt"></i> Hapus</button>
                        </form>
                    </div>';
            })
                ->rawColumns(['action'])
                ->make(true);
        }

        return abort(404);
    }

    public function create()
    {
        $menu = 'data';
        $submenu = 'room';

        $buildings = Building::all();
        return view('pages.admin.room.form', compact('menu','submenu','buildings'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:rooms,code',
            'name' => 'required|string|max:100',
            'floor_position' => 'required|integer|min:1',
            'building_id' => 'required|exists:buildings,id',
            'capacity' => 'required|integer|min:1',
        ]);

        Room::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'floor_position' => $request->input('floor_position'),
            'building_id' => $request->input('building_id'),
            'capacity' => $request->input('capacity'),
        ]);

        return redirect()->route('room.index')->with('success', 'Room has been created successfully.');
    }


    public function edit(string $id)
    {
        $room = Room::findOrFail($id);
        $buildings = Building::all();
        return view('pages.admin.room.form_edit', compact('room', 'buildings'));
    }    
    
    public function update(Request $request, string $id)
    {
        $request->validate([
        'code' => 'required|string|max:10|unique:rooms,code,' . $id,
        'name' => 'required|string|max:100',
        'floor_position' => 'required|integer|min:1',
        'building_id' => 'required|exists:buildings,id',
        'capacity' => 'required|integer|min:1',
    ]);

    $room = Room::findOrFail($id);
    $room->update([
        'code' => $request->input('code'),
        'name' => $request->input('name'),
        'floor_position' => $request->input('floor_position'),
        'building_id' => $request->input('building_id'),
        'capacity' => $request->input('capacity'),
    ]);

    return redirect()->route('room.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(string $id)
    {
        $room = room::findOrFail($id);
        $room->delete();

        return redirect()->route('room.index')->with('success', 'Room berhasil dihapus');
        }
}