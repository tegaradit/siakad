<?php

namespace App\Http\Controllers;

use App\Models\Lecture_setting;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LectureSettingController extends Controller
{
    // Menampilkan daftar data setting perkuliahan
    public function index()
    {
        $menu = 'lecture_setting';
        $submenu = 'lecture_setting';

        // Menggabungkan eager loading 'prodi' dengan pagination
        $datas = Lecture_setting::with('prodi')->orderBy('id', 'asc')->paginate(5);

        return view('pages.admin.lecture_setting.index', compact('datas', 'menu', 'submenu'));
    }


    // Menampilkan form untuk menambah data baru
    public function create()
    {
        $prodis = Prodi::all();
        return view('pages.admin.lecture_setting.form', compact('prodis'));
    }

    // Menyimpan data setting perkuliahan baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required|exists:prodi,id|unique:lecture_settings,prodi_id',
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
            $lectureSettings = Lecture_setting::with('prodi')->get();
            \Log::info('Data: ', $lectureSettings->toArray()); // Untuk debug

            return DataTables::of($lectureSettings)
                ->addIndexColumn()
                ->addColumn('prodi_name', function ($data) {
                    return $data->prodi ? $data->prodi->nama_prodi : 'N/A';
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('lecture-setting.edit', $data->id) . '" class="btn btn-outline-warning btn-sm edit"><i class="fas fa-pencil-alt"></i></a>
                    <form id="delete-form-' . $data->id . '" 
                              onsubmit="event.preventDefault(); confirmDelete(' . $data->id . ');" 
                              action="' . route('lecture-setting.destroy', $data->id) . '" 
                              method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn icon icon-left btn-outline-danger btn-sm delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                 </form>';
                })
                ->make(true);
        }

        return abort(404);
    }


    public function edit($id)
    {
        $data = Lecture_setting::findOrFail($id);
        $prodis = Prodi::all(); // Ambil data prodi untuk dropdown
        return view('pages.admin.lecture_setting.form_edit', compact('data', 'prodis'));
    }

    // Mengupdate data setting perkuliahan yang sudah ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'prodi_id' => 'required|exists:prodi,id|unique:lecture_settings,prodi_id,' . $id,
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

    // Menghapus data setting perkuliahan berdasarkan id
    public function destroy($id)
    {
        $data = Lecture_setting::findOrFail($id);
        $data->delete();

        return redirect()->route('lecture-setting.index')->with('success', 'Data berhasil dihapus');
    }
}
