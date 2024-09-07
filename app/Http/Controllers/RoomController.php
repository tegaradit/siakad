<?php

namespace App\Http\Controllers;
use App\Models\room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {   
         $rooms = Room::with('building')->get(); 
         return view('pages.admin.room.index', compact('rooms'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = 'data';
        $submenu = 'room';
        return view('pages.admin.room.form', compact('menu','submenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Validasi input
        $request->validate([
            'code' => 'required|string|max:10|unique:rooms,code',
            'name' => 'required|string|max:100',
            'floor_position' => 'required|integer|min:1',
            'building_id' => 'required|exists:buildings,id', // Pastikan tabel 'buildings' ada
            'capacity' => 'required|integer|min:1',
        ]);

        // Simpan data room ke database
        Room::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'floor_position' => $request->input('floor_position'),
            'building_id' => $request->input('building_id'),
            'capacity' => $request->input('capacity'),
        ]);

        // Redirect atau kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('room.index')->with('success', 'Room has been created successfully.');
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}