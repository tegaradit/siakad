<?php

namespace App\Http\Controllers;

use App\Models\All_prodi;
use App\Models\Prodi;
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
            $allProdi = All_prodi::with(['university', 'education_level']);
            // Mengambil data dari tabel all_prodi
            $allProdi = All_prodi::select([
                'id_prodi',
                'id_university',
                'kode_prodi',
                'nama_prodi',
                'status',
                'id_jenjang_pendidikan'
            ]);

            // Mengembalikan data dalam format yang kompatibel dengan DataTables
            return DataTables::of($allProdi)
             ->addColumn('nama_pt', function ($allProdi) {
                return $allProdi->university->nama_pt ?? '-'; // Pastikan nama_pt ada di tabel university
                
            })
            ->addColumn('nm_jenj_didik', function ($allProdi) {
                return $allProdi->education_level->nm_jenj_didik ?? '-'; // Pastikan nm_jenj_didik ada
            })
            ->make(true);
        }

        // Jika bukan permintaan AJAX, kembalikan error 403 Unauthorized
        return abort(403, 'Unauthorized action.');
    }
}