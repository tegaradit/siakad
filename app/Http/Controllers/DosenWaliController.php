<?php

namespace App\Http\Controllers;

use App\Models\dosen_wali;
use App\Models\DosenWali; // Model DosenWali dengan PascalCase
use App\Models\Lecturer;
use App\Models\MahasiswaPt;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DosenWaliController extends Controller
{
    public function index(Request $request, string $lecture_id_input)
    {
        $lecturer = Lecturer::findOrFail($lecture_id_input);
        
        if ($request->ajax()) {
            $dosenWalis = dosen_wali::with(['lecturer', 'mahasiswaPt', 'mahasiswa'])
                ->where('lecture_id', $lecture_id_input)
                ->get();

            return DataTables::of($dosenWalis)
                ->addIndexColumn()
                ->addColumn('action', function ($dosenWali) {
                    $editUrl = route('dosen_wali.edit', $dosenWali->id);
                    $deleteForm = '<form id="delete-form-' . $dosenWali->id . '" onsubmit="event.preventDefault(); confirmDelete(\'' . $dosenWali->id . '\');" action="' . route('dosen_wali.destroy', $dosenWali->id) . '" method="POST">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '<a href="' . $editUrl . '" class="btn btn-warning btn-sm edit ms-1 m-0" title="Edit"><i class="fas fa-pencil-alt"></i> Edit</a>'
                        . '<button type="submit" class="btn btn-danger btn-sm delete ms-1"><i class="fas fa-trash-alt"></i> Hapus</button></form>';
                    return $deleteForm;
                })
                ->addColumn('nim', function ($dosenWali) {
                    return $dosenWali->mahasiswaPt ? $dosenWali->mahasiswaPt->nipd : '-';
                })
                ->addColumn('nama', function ($dosenWali) {
                    return $dosenWali->mahasiswa ? $dosenWali->mahasiswa->nm_pd : '-';
                }) 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.dosen_wali.index', compact('lecturer', 'lecture_id_input')); // Mengirimkan $lecturer ke view
    }

    public function selectMahasiswa(Request $request, string $lecture_id_input)
    {
        if (request()->ajax()) {
            $mahasiswa = MahasiswaPt::select('mahasiswa_pt.nipd', 'mahasiswa.id_pd', 'mahasiswa.nm_pd')
                ->join('mahasiswa', 'mahasiswa_pt.id_pd', '=', 'mahasiswa.id_pd')
                ->get();

            return DataTables::of($mahasiswa)
                ->addIndexColumn()
                ->addColumn('action', function ($mahasiswa) {
                    return '<button class="btn btn-primary btn-sm" onclick="setMahasiswa(\'' . $mahasiswa->id_pd . '\')">Set</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.dosen_wali.select_mahasiswa', compact('lecture_id_input'));
    }


    public function setMahasiswa(Request $request)
    {
        try {
            // Validasi input mahasiswa_id dan lecture_id
            $request->validate([
                'mahasiswa_id' => 'required|exists:mahasiswa_pt,id_pd',
                'lecture_id' => 'required|exists:lecturer,id',
            ]);

            // Simpan data dosen wali
            $dosenWali = new dosen_wali(); 
            $dosenWali->id_pd = $request->input('mahasiswa_id'); // ID mahasiswa
            $dosenWali->lecture_id = $request->input('lecture_id');
            $dosenWali->save();

            return response()->json(['message' => 'Mahasiswa berhasil ditetapkan sebagai Dosen Wali!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()], 500);
        }
    }
}