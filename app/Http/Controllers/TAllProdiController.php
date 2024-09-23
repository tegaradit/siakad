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
                'nama_prodi',
                'smt_mulai',
                'kode_prodi',
                'nm_prodi_english',
                'email',
                'website',
                'singkatan',
                'tgl_berdiri',
                'sk_selenggara',
                'tgl_sk_selenggara',
                'tmt_sk_selenggara',
                'tst_sk_selenggara',
                'kpst_pd',
                'sks_lulus',
                'gelar_lulusan',
                'status',
                'polesei_nilai',
                'a_kependidikan',
                'sistem_ajar',
                'luas_lab',
                'kapasitas_prak_satu_shift',
                'jml_mhs_pengguna',
                'jml_jam_penggunaan',
                'jml_prodi_pengguna',
                'jml_modul_prak_sendiri',
                'jml_modul_prak_lain',
                'fungsi_selain_prak',
                'penggunaan_lab',
                'id_sp',
                'id_jenj_didik',
                'id_jns_sms',
                'id_fungsi_lab',
                'id_kel_usaha',
                'id_blob',
                'id_wil',
                'id_jur',
                'id_fakultas',
                'id_induk_sms',
                'kode',
                'max_sks1'
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