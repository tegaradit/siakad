<?php

namespace App\Http\Controllers;

use App\Models\KelasKuliah;
use Illuminate\Http\Request;

class KelasKuliahController extends Controller
{
    public function index()
    {
        $kelas_kuliahs = KelasKuliah::all();
        return view('kelas_kuliah.index', compact('kelas_kuliahs'));
    }

    public function create()
    {
        return view('kelas_kuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required',
            'semester_id' => 'required',
            'nama_kelas' => 'required|max:50',
            'sks_mk' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'course_id' => 'required',
            // Add validations for other fields
        ]);

        KelasKuliah::create($request->all());
        return redirect()->route('kelas-kuliah.index')->with('success', 'Kelas created successfully.');
    }

    public function edit(KelasKuliah $kelas_kuliah)
    {
        return view('kelas_kuliah.edit', compact('kelas_kuliah'));
    }

    public function update(Request $request, KelasKuliah $kelas_kuliah)
    {
        $request->validate([
            'prodi_id' => 'required',
            'semester_id' => 'required',
            'nama_kelas' => 'required|max:50',
            'sks_mk' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'course_id' => 'required',
            // Add validations for other fields
        ]);

        $kelas_kuliah->update($request->all());
        return redirect()->route('kelas-kuliah.index')->with('success', 'Kelas updated successfully.');
    }

    public function destroy(KelasKuliah $kelas_kuliah)
    {
        $kelas_kuliah->delete();
        return redirect()->route('kelas-kuliah.index')->with('success', 'Kelas deleted successfully.');
    }
}
