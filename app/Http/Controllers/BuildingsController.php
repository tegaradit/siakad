<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class BuildingsController extends Controller
{
    public function index(){
        // $datas = Building::latest()->paginate(10);
        return view('pages.admin.buildings.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $buildings = Building::query();

            return DataTables::of($buildings)
            ->addColumn('action', function ($row) {
                return '<a href="'.route('buildings.edit', $row->id).'" class="btn btn-warning btn-sm edit m-0"><i class="fas fa-pencil-alt"></i> Edit
                        </a>
                        <form id="delete-form-' . $row->id . '" 
                              onsubmit="event.preventDefault(); confirmDelete(' . $row->id . ');" 
                              action="' . route('buildings.destroy', $row->id) . '" 
                              method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm delete m-0"><i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return abort(404);
    }

    public function create()
    {
        $menu = 'data';
        $submenu = 'buildings';
        return view('pages.admin.buildings.form', compact('menu','submenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:buildings,code',
            'name' => 'required|string|max:100',
        ]);

        Building::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
        ]);

        return redirect()->route('buildings.index')->with('success', 'Building added successfully.');
    }

    public function edit($id)
    {
        $building = Building::findOrFail($id);
        return view('pages.admin.buildings.form_edit', compact('building'));
    }

    // Update the specified building in storage   
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|unique:buildings,code,' . $id,
            'name' => 'required|string',
        ]);

        $building = Building::findOrFail($id);
        
        $building->update($request->all());
        return redirect()->route('buildings.index')->with('success', 'Building updated successfully');
    }

    public function destroy($id)
    {
        $building = Building::findOrFail($id);
        $building->delete();

        return redirect()->route('buildings.index')->with('success', 'Building deleted successfully');
    }
}
