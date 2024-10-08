<?php

namespace App\Http\Controllers;

use App\Models\KelasKuliah;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelasKuliahController extends Controller
{
    public function index(Request $request)
    {
        // Get filter values from the request
        $prodiId = $request->input('prodi_id');
        $semesterId = $request->input('semester_id');

        // Build query based on filters
        $query = KelasKuliah::query();

        // Apply filtering based on program and academic year (semester)
        if ($prodiId) {
            $query->where('prodi_id', $prodiId);
        }
        
        if ($semesterId) {
            $query->where('semester_id', $semesterId);
        }

        // Use Yajra DataTables for handling and displaying the data
        if ($request->ajax()) {
            return DataTables::of($query)
                ->addColumn('dosen_pengajar', function($row) {
                    // Add logic for dosen pengajar (lecturer) column if necessary
                    return '<button class="btn btn-primary"><i class="fa fa-plus"></i></button>';
                })
                ->addColumn('peserta_kelas', function($row) {
                    // Logic for displaying the number of students in the class
                    return '<span class="badge badge-success">' . $row->quota . '</span>';
                })
                ->addColumn('actions', function($row) {
                    // Generate action buttons for each row
                    return '<button class="btn btn-info"><i class="fa fa-eye"></i></button>
                            <button class="btn btn-warning"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['dosen_pengajar', 'peserta_kelas', 'actions'])
                ->make(true);
        }

        // Fetch unique programs and academic years for filtering dropdowns
        $programs = KelasKuliah::select('prodi_id')->distinct()->get();
        $semesters = KelasKuliah::select('semester_id')->distinct()->get();

        return view('pages.admin.kelas_kuliah.index', compact('programs', 'semesters'));
    }
}
