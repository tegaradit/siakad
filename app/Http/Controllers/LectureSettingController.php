<?php

namespace App\Http\Controllers;

use App\Models\All_prodi;
use App\Models\IdentitasPt;
use App\Models\Lecture_setting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LectureSettingController extends Controller
{
    public function index()
    {
        $menu = 'lecture_setting';
        $submenu = 'lecture_setting';

        $datas = Lecture_setting::with('all_prodi')->orderBy('id', 'asc')->paginate(5);

        return view('pages.admin.lecture_setting.index', compact('datas', 'menu', 'submenu'));
    }

    public function create()
    {
        // Mendapatkan current_id_sp dari IdentitasPt
        $current_id_sp = IdentitasPt::first()->current_id_sp;

        // Mengambil prodi yang sesuai dengan current_id_sp dan status A (Aktif)
        $prodis = All_prodi::where('id_sp', $current_id_sp)
            ->where('status', 'A')
            ->get();

        return view('pages.admin.lecture_setting.form', compact('prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required|exists:all_prodi,id_prodi|unique:lecture_settings,prodi_id',
            'max_number_of_meets' => 'required|integer',
            'min_number_of_presence' => 'required|integer',
            'is_prodi' => 'required|boolean',
        ]);

        Lecture_setting::create([
            'prodi_id' => $request->prodi_id,
            'max_number_of_meets' => $request->max_number_of_meets,
            'min_number_of_presence' => $request->min_number_of_presence,
            'is_prodi' => $request->is_prodi,
        ]);

        return redirect()->route('lecture-setting.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $lectureSettings = Lecture_setting::with('all_prodi')->get();

            return DataTables::of($lectureSettings)
                ->addIndexColumn()
                ->addColumn('prodi_name', function ($data) {
                    return $data->all_prodi ? $data->all_prodi->nama_prodi : 'N/A';
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('lecture-setting.edit', $data->id) . '" class="btn btn-warning btn-sm edit"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <form id="delete-form-' . $data->id . '" 
                              onsubmit="event.preventDefault(); confirmDelete(' . $data->id . ');" 
                              action="' . route('lecture-setting.destroy', $data->id) . '" 
                              method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn icon icon-left btn-danger btn-sm delete"><i class="fas fa-trash-alt"></i> Hapus</button>
                 </form>';
                })
                ->make(true);
        }

        return abort(404);
    }

    public function edit($id)
    {
        // Ambil data setting perkuliahan berdasarkan ID
        $data = Lecture_setting::findOrFail($id);

        // Mendapatkan current_id_sp dari IdentitasPt
        $current_id_sp = IdentitasPt::first()->current_id_sp;

        // Mengambil prodi yang sesuai dengan current_id_sp dan status A (Aktif)
        $prodis = All_prodi::where('id_sp', $current_id_sp)
            ->where('status', 'A')
            ->get();

        return view('pages.admin.lecture_setting.form_edit', compact('data', 'prodis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'prodi_id' => 'required|exists:all_prodi,id_prodi|unique:lecture_settings,prodi_id,' . $id,
            'max_number_of_meets' => 'required|integer',
            'min_number_of_presence' => 'required|integer',
            'is_prodi' => 'required|boolean',
        ]);

        $data = Lecture_setting::findOrFail($id);

        $data->update([
            'prodi_id' => $request->prodi_id,
            'max_number_of_meets' => $request->max_number_of_meets,
            'min_number_of_presence' => $request->min_number_of_presence,
            'is_prodi' => $request->is_prodi,
        ]);

        return redirect()->route('lecture-setting.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = Lecture_setting::findOrFail($id);
        $data->delete();

        return redirect()->route('lecture-setting.index')->with('success', 'Data berhasil dihapus');
    }
}
