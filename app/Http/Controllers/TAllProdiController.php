<?php

namespace App\Http\Controllers;

use App\Models\All_prodi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TAllProdiController extends Controller
{
    /**
     * Menampilkan halaman index All Prodi.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.all_prodi.index');
    }

    /**
     * Mengambil data All Prodi untuk DataTables melalui permintaan AJAX.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function getAllProdiData(Request $request)
    {
        // Mengecek apakah request yang masuk adalah AJAX
        if ($request->ajax()) {
            // Mengambil data dari tabel all_prodi
            $allProdi = All_prodi::select([
                'id_prodi',
                'id_pt',
                'kode_prodi',
                'nama_prodi',
                'status',
                'id_jenjang_pendidikan'
            ]);

            // Mengembalikan data dalam format yang kompatibel dengan DataTables
            return DataTables::of($allProdi)->make(true);
        }

        // Jika bukan permintaan AJAX, kembalikan error 403 Unauthorized
        return abort(403, 'Unauthorized action.');
    }
}