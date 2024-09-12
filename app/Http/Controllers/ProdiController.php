<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProdiController extends Controller
{
    public function index()
    {
        return view('pages.admin.prodi.index');
    }

    public function getProdiData(Request $request)
    {
        if ($request->ajax()) {
            $prodi = DB::table('prodi')
                ->select([
                    'prodi.id',
                    'prodi.kode',
                    'prodi.nama_prodi',
                    'ruangan_jurusan.nm_jur',
                    'education_level.nm_jenj_didik',
                    'prodi.sks_lulus',
                    'prodi.prodi AS status'
                ])
                ->join('ruangan_jurusan', 'prodi.id_jur', '=', 'ruangan_jurusan.id_jur')
                ->join('education_level', 'prodi.id_jenj_didik', '=', 'education_level.id_jenj_didik')
                ->get();
    
            return DataTables::of($prodi)->make(true);
        }

        return abort(404);
    }
}
