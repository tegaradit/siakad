<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $statusName = [
                "A" => "Aktif", 
                "H" => "Tutup", 
                "B" => "Pembinaan", 
                "N" => "Non Aktif", 
                "K" => "Keluar"
            ];

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
                ->get()->toArray();

            $fullProdi = array_map(function ($arr) use ( $statusName ) {
                return ['id' => $arr->id, 'kode' => $arr->kode, 'nama_prodi' => $arr->nama_prodi, 'nm_jur' => $arr->nm_jur, 'nm_jenj_didik' => $arr->nm_jenj_didik, 'sks_lulus' => $arr->sks_lulus, 'status' => $statusName[$arr->status]];
            }, $prodi);

    
            return DataTables::of($fullProdi)->make(true);
        }

        return abort(404);
    }
}
