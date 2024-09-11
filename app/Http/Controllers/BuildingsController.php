<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingsController extends Controller
{
    public function index(){
        // $user = Auth::user();
        $menu = 'buildings';
        $submenu = 'buildings';
        $datas = Building::latest()->paginate(10);
        return view('pages.admin.buildings.index', compact('menu','submenu','datas'));
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
            'code' => ['required', 'regex:/^G\d{1,10}$/', 'unique:buildings,code'],
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
