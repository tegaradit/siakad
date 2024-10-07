<?php

namespace App\Http\Controllers;

use App\Models\Course_curriculum;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelasKuliahController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Course_curriculum::with(['course', 'curriculum'])->get();
            return DataTables::of($data)
                ->addColumn('course', function ($row) {
                    return $row->course->code ?? 'N/A';
                })
                ->addColumn('curriculum', function($row)
                {
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

        return view('pages.admin.kelas_kuliah.index');
    }
    public function create()
    {
        // Kembalikan view untuk form pembuatan kelas kuliah
        return view('pages.admin.kelas_kuliah.create');
    }
    public function store(Request $request)
    {
        // Validasi dan simpan data kelas kuliah
    }
}
