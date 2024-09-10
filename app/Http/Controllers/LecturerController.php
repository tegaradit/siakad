<?php

namespace App\Http\Controllers;

use App\Models\Active_status;
use App\Models\Employee_level;
use App\Models\Lecturer;
use App\Models\Prodi;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::all(); // Ambil semua data dosen
        return view('pages.admin.lecturer.index', compact('lecturers')); // Kirim data ke view
    }

    // Show the form for creating a new lecturer
    public function create()
    {
        $activeStatuses = Active_status::all();
        $employeeLevels = Employee_level::all();
        $prodiList = Prodi::all();
        return view('pages.admin.lecturer.form', compact('activeStatuses', 'employeeLevels', 'prodiList'));
    }

    // Store a newly created lecturer in the database
    public function store(Request $request)
    {
        $request->validate([
            'nuptk' => 'required|string|max:16|unique:lecturer,nuptk',
            'nidn' => 'nullable|string|max:10',
            'nik' => 'nullable|string|max:16',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'name' => 'required|string|max:200',
            'active_status_id' => 'required|exists:active_status,id',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:100',
            'mothers_name' => 'required|string|max:200',
            'mariage_status' => 'required|in:belum kawin,kawin,cerai hidup,cerai mati',
            'employee_level_id' => 'required|exists:employee_level,id',
            'level_education' => 'required|in:S1,S2,S3',
            'phone_number' => 'nullable|string|max:13',
            'email' => 'nullable|email|max:255',
            'assign_letter_number' => 'nullable|string|max:30',
            'assign_letter_date' => 'nullable|date',
            'assign_letter_tmt' => 'nullable|date',
            'exit_date' => 'nullable|date',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        Lecturer::create($request->all());

        return redirect()->route('lecturer.index')->with('success', 'Lecturer created successfully.');
    }

    // Show the form for editing the specified lecturer
    public function edit($nuptk)
    {
        $lecturer = Lecturer::where('nuptk', $nuptk)->firstOrFail();
        $activeStatuses = Active_status::all();
        $employeeLevels = Employee_level::all();
        $prodiList = Prodi::all();

        return view('pages.admin.lecturer.form_edit', compact('lecturer', 'activeStatuses', 'employeeLevels', 'prodiList'));
    }

    // Update the specified lecturer in the database
    public function update(Request $request, $nuptk)
    {
        $request->validate([
            'nuptk' => 'required|string|max:16|exists:lecturer,nuptk',
            'nidn' => 'nullable|string|max:10',
            'nik' => 'nullable|string|max:16',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'name' => 'required|string|max:200',
            'active_status_id' => 'required|exists:active_status,id',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:100',
            'mothers_name' => 'required|string|max:200',
            'mariage_status' => 'required|in:belum kawin,kawin,cerai hidup,cerai mati',
            'employee_level_id' => 'required|exists:employee_level,id',
            'level_education' => 'required|in:S1,S2,S3',
            'phone_number' => 'nullable|string|max:13',
            'email' => 'nullable|email|max:255',
            'assign_letter_number' => 'nullable|string|max:30',
            'assign_letter_date' => 'nullable|date',
            'assign_letter_tmt' => 'nullable|date',
            'exit_date' => 'nullable|date',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        // Cari lecturer berdasarkan nuptk
        $lecturer = Lecturer::findOrFail($nuptk);

        // Update data lecturer dengan data dari request
        $lecturer->update($request->all());

        // Redirect ke halaman index setelah update berhasil
        return redirect()->route('lecturer.index')->with('success', 'Lecturer updated successfully.');
    }

    // Remove the specified lecturer from the database
    public function destroy( $nuptk)
    {
        $lecturer = Lecturer::where('nuptk', $nuptk)->firstOrFail();
        $lecturer->delete();

        return redirect()->route('lecturer.index')->with('success', 'Lecturer deleted successfully.');
    }
}