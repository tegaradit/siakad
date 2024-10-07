<?php

namespace App\Http\Controllers;

use App\Models\Course_curriculum;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelasKuliahController extends Controller
{
    public function index(Request $request, $curriculum_id, $course_id)
    {
        if ($request->ajax()) {
            // Query dengan filter berdasarkan curriculum_id dan course_id
            $query = Course_curriculum::with(['course', 'curriculum'])
                ->where('curriculum_id', $curriculum_id)
                ->where('course_id', $course_id);
            
            $data = $query->get();
    
            return DataTables::of($data)
                ->addColumn('course', function ($row) {
                    return $row->course->code ?? 'N/A';
                })
                ->addColumn('curriculum', function($row) {
                    return $row->curriculum->name ?? 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('users.edit', $row->id) . '" class="btn btn-primary btn-sm edit m-0"><i class="fas fa-pencil-alt"></i> buat kelas </a>';
                    $btn .= '<a href="' . route('users.edit', $row->id) . '" class="btn btn-warning btn-sm edit m-0"><i class="fas fa-pencil-alt"></i> Edit </a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm delete m-0"><i class="fas fa-trash-alt"></i>Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('pages.admin.kelas_kuliah.index', compact('curriculum_id', 'course_id'));
    }
    
    
    public function create(Request $request)
    {
        // Bisa kirim curriculum_id dan course_id jika diperlukan di form
        return view('pages.admin.kelas_kuliah.create', [
            'curriculum_id' => $request->curriculum_id,
            'course_id' => $request->course_id
        ]);
    }
    
    public function store(Request $request)
    {
        // Validasi dan simpan data kelas kuliah
    }
}
