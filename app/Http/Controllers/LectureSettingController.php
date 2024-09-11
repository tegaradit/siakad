<?php

namespace App\Http\Controllers;

use App\Models\Lecture_setting; // Pastikan penamaan model sesuai dengan standar Laravel
use App\Models\Prodi;
use Illuminate\Http\Request;

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
        // dd($prodis);
        return view('pages.admin.lecture_setting.form', compact('prodis'));
    }

    // Menyimpan data setting perkuliahan baru ke dalam database
    public function store(Request $request)
{
    // Debugging: Tampilkan data yang diterima
    // dd($request->all());

    // Validasi input
    $request->validate([
        'prodi_id' => 'required|exists:prodi,id',
        'max_number_of_meets' => 'required|integer',
        'min_number_of_presence' => 'required|integer',
        'is_prodi' => 'required|boolean',
    ]);

    // Simpan data
    Lecture_setting::create([
        'prodi_id' => $request->prodi_id,
        'max_number_of_meets' => $request->max_number_of_meets,
        'min_number_of_presence' => $request->min_number_of_presence,
        'is_prodi' => $request->is_prodi,
    ]);

    return redirect()->route('lecture-setting.index')->with('success', 'Data berhasil ditambahkan');
}


    // Menampilkan form untuk edit data berdasarkan id
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
            'prodi_id' => 'required|exists:prodi,id', // Pastikan nama tabel dan kolom valid
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
