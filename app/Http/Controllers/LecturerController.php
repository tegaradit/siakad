<?php

namespace App\Http\Controllers;

use App\Models\Active_status;
use App\Models\Employee_level;
use App\Models\Lecturer;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LecturerController extends Controller
{
    // public function index()
    // {
    //     $lecturers = Lecturer::all(); // Ambil semua data dosen
    //     return view('pages.admin.lecturer.index', compact('lecturers')); // Kirim data ke view
    // }
    
  public function index()
    {
        // Kirimkan view tanpa data karena DataTables akan meng-handle data secara AJAX
        return view('pages.admin.lecturer.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $lecturer = Lecturer::query();

            return DataTables::of($lecturer)
                ->addIndexColumn() // Menambahkan kolom index secara otomatis
                ->addColumn('action', function ($data) {
                    // Mengembalikan HTML untuk kolom aksi, misalnya tombol edit
                    return '<a href="' . route('lecturer.edit', $data->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                })
                ->make(true);
        }

        return abort(404);
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
            'nidn' => 'nullable|string|max:10|unique:lecturer,nidn',
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
    public function edit($id)
    {
        $lecturer = Lecturer::findOrFail($id); // Menggunakan id sebagai primary key
        $activeStatuses = Active_status::all();
        $employeeLevels = Employee_level::all();
        $prodiList = Prodi::all();

        return view('pages.admin.lecturer.form_edit', compact('lecturer', 'activeStatuses', 'employeeLevels', 'prodiList'));
    }

    // Update the specified lecturer in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nuptk' => 'required|string|max:16|unique:lecturer,nuptk,' . $id, // NUPTK unik, tetapi boleh null, dan abaikan dosen yang sedang diupdate
            'nidn' => 'nullable|string|max:10|unique:lecturer,nidn,' . $id,
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

        // Cari lecturer berdasarkan id
        $lecturer = Lecturer::findOrFail($id);

        // Update data lecturer dengan data dari request
        $lecturer->update($request->all());

        // Redirect ke halaman index setelah update berhasil
        return redirect()->route('lecturer.index')->with('success', 'Lecturer updated successfully.');
    }

    // Remove the specified lecturer from the database
    public function destroy($id)
    {
        $lecturer = Lecturer::findOrFail($id); // Menggunakan id untuk pencarian
        $lecturer->delete();

        return redirect()->route('lecturer.index')->with('success', 'Lecturer deleted successfully.');
    }
}