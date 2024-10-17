<?php

namespace App\Http\Controllers;

use App\Models\activity_type;
use App\Models\ActivityType;
use App\Models\AktivitasMahasiswa;
use App\Models\Semester;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AktivitasMahasiswaController extends Controller
{
    public function index()
    {
        $menu = 'datas';
        $submenu = 'aktivitas-mahasiswa';

        $datas = AktivitasMahasiswa::with(['activityType', 'semester', 'mahasiswaPt'])
            ->orderBy('id', 'asc')
            ->paginate(5);

        return view('pages.admin.aktivitas_mahasiswa.index', compact('datas', 'menu', 'submenu'));
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $aktivitas = AktivitasMahasiswa::with(['mahasiswaPt', 'semester', 'activityType'])
                ->select('aktivitas_mahasiswas.*');

            return DataTables::of($aktivitas)
                ->editColumn('id_reg_pd', function ($row) {
                    return $row->mahasiswaPt ? $row->mahasiswaPt->nipd : 'N/A';
                })
                ->editColumn('semester_id', function ($row) {
                    return $row->semester ? $row->semester->name : 'N/A';
                })
                ->editColumn('activity_type_id', function ($row) {
                    return $row->activityType ? $row->activityType->name : 'N/A';
                })


                ->addColumn('action', function ($data) {
                    return '<a href="' . route('aktivitas-mahasiswa.edit', $data->id) . '" class="btn btn-warning btn-sm edit"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <form id="delete-form-' . $data->id . '" 
                              onsubmit="event.preventDefault(); confirmDelete(' . $data->id . ');" 
                              action="' . route('aktivitas-mahasiswa.destroy', $data->id) . '" 
                              method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn icon icon-left btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i> Hapus</button>
                        </form>';
                })
                ->addIndexColumn() 
                ->make(true);
        }

        return abort(404);
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_reg_pd' => 'required|exists:mahasiswa_pt,id_reg_pd',
            'semester_id' => 'required|exists:semester,semester_id',
            'title' => 'required|string',
            'location' => 'nullable|string|max:80',
            'sk_number' => 'nullable|string|max:20',
            'sk_date' => 'required|date',
            'description' => 'nullable|string',
            'activity_type_id' => 'required|exists:activity_types,id',
        ]);

        AktivitasMahasiswa::create([
            'id_reg_pd' => $request->id_reg_pd,
            'semester_id' => $request->semester_id,
            'title' => $request->title,
            'location' => $request->location,
            'sk_number' => $request->sk_number,
            'sk_date' => $request->sk_date,
            'description' => $request->description,
            'activity_type_id' => $request->activity_type_id,
        ]);

        return redirect()->route('admin.aktivitas-mahasiswa.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function create()
    {
        $menu = 'datas';
        $submenu = 'aktivitas_mahasiswa';

        // Ambil semester yang aktif
        $semesters = Semester::where('is_active', 1)->get();
        $active_semester = Semester::where('is_active', 1)->first();

        $activity_types = activity_type::all();

        return view('pages.admin.aktivitas_mahasiswa.form', compact('activity_types', 'semesters', 'active_semester', 'menu', 'submenu'));
    }

    public function edit($id)
    {
        $menu = 'datas';
        $submenu = 'aktivitas_mahasiswa';

        // Ambil data aktivitas mahasiswa berdasarkan ID
        $data = AktivitasMahasiswa::findOrFail($id);

        // Mengambil activity types yang tersedia
        $activityTypes = activity_type::all();

        return view('pages.admin.aktivitas_mahasiswa.form_edit', compact('data', 'activityTypes', 'menu', 'submenu'));
    }
}
