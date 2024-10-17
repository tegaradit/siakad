<?php

namespace App\Http\Controllers;

use App\Models\dosen_wali;
use App\Models\DosenWali; 
use App\Models\Lecturer;
use App\Models\MahasiswaPt;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class DosenWaliController extends Controller
{
    public function index(Request $request, string $lecture_id_input)
    {
        $menu = 'data';
        $submenu = 'lecturer';
        $lecturer = Lecturer::findOrFail($lecture_id_input);

        if ($request->ajax()) {
            $dosenWalis = dosen_wali::with(['lecturer', 'mahasiswaPt', 'mahasiswa'])
                ->where('lecture_id', $lecture_id_input)
                ->get();

            return DataTables::of($dosenWalis)
                ->addIndexColumn()
                ->addColumn('action', function ($dosenWali) {
                    $deleteForm = '<form id="delete-form-' . $dosenWali->id . '" onsubmit="event.preventDefault(); confirmDelete(\'' . $dosenWali->id . '\');" action="' . route('dosen_wali.destroy', $dosenWali->id) . '" method="POST">'
                        . csrf_field()
                        . method_field('DELETE')
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
        return view('pages.admin.dosen_wali.index', compact('lecturer', 'menu', 'submenu', 'lecture_id_input')); // Mengirimkan $lecturer ke view
    }

    public function selectMahasiswa(Request $request, string $lecture_id_input)
    {
        $menu = 'data';
        $submenu = 'lecturer';

        if ($request->ajax()) {
            // Ambil semua mahasiswa yang sudah terdaftar di dosen_wali untuk lecture_id yang diberikan
            $assignedMahasiswaIds = dosen_wali::where('lecture_id', $lecture_id_input)
                ->pluck('id_pd')
                ->toArray();

            // Ambil mahasiswa yang belum terdaftar sebagai dosen wali
            $mahasiswa = MahasiswaPt::select('mahasiswa_pt.nipd', 'mahasiswa.id_pd', 'mahasiswa.nm_pd')
            ->join('mahasiswa', 'mahasiswa_pt.id_pd', '=', 'mahasiswa.id_pd')
            ->whereNotIn('mahasiswa.id_pd', $assignedMahasiswaIds) // Mengecualikan mahasiswa yang sudah ada di dosen_wali
                ->get();

            return DataTables::of($mahasiswa)
                ->addIndexColumn()
                ->addColumn('action', function ($mahasiswa) {
                    return '<button class="btn btn-primary btn-sm" onclick="setMahasiswa(\'' . $mahasiswa->id_pd . '\')">Set</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.dosen_wali.select_mahasiswa', compact('lecture_id_input', 'menu', 'submenu'));
    }



    public function setMahasiswa(Request $request)
    {
        try {
            $request->validate([
                'mahasiswa_id' => 'required|exists:mahasiswa_pt,id_pd',
                'lecture_id' => 'required|exists:lecturer,id',
            ]);
            // Simpan data dosen wali
            $dosenWali = new dosen_wali();
            $dosenWali->id_pd = $request->input('mahasiswa_id');
            $dosenWali->lecture_id = $request->input('lecture_id');
            $dosenWali->save();

            return response()->json(['success' => 'Mahasiswa berhasil ditetapkan sebagai Dosen Wali!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()], 500);
        }
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string',
            'nama' => 'required|string',
            'lecture_id' => 'required|exists:lecturer,id',
        ]);
        $id_pd = MahasiswaPt::where('nipd', $request->nim)->value('id_pd');
        if (!$id_pd) {
            return redirect()->back()->with('error', 'NIPD tidak ditemukan.');
        }
        
        $exists = dosen_wali::where('id_pd', $id_pd)
        ->where('lecture_id', $request->lecture_id)
        ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Mahasiswa ini sudah memiliki Dosen Wali yang sama.');
        }

        dosen_wali::create([
            'lecture_id' => $request->lecture_id,
            'id_pd' => $id_pd
        ]);

        Log::info('Dosen Wali berhasil ditambahkan.', ['id_pd' => $id_pd]);
        return redirect()->route('dosen_wali.index', $request->lecture_id)->with('success', 'Dosen Wali berhasil ditambahkan.');
    }

    public function getNama($nim)
    {
        $mahasiswa = DB::table('mahasiswa_pt')
            ->join('mahasiswa', 'mahasiswa_pt.id_pd', '=', 'mahasiswa.id_pd')
            ->where('mahasiswa_pt.nipd', $nim)
            ->select('mahasiswa.nm_pd')
            ->first();

        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
        }

        return response()->json(['nama' => $mahasiswa->nm_pd]);
    }
    public function destroy($id)
    {
        $dosenWali = dosen_wali::findOrFail($id);
        $lecture_id_input = $dosenWali->lecture_id;
        $dosenWali->delete();

        return redirect()->route('dosen_wali.index',['lecture_id_input' => $lecture_id_input])->with('succes', 'Data Dosen Wali berhasil di hapus');
    }
}