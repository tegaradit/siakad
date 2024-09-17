<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProdiController extends Controller
{
    public function index(Request $request)
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
                    'prodi.stat_prodi AS status'
                ])
                ->join('ruangan_jurusan', 'prodi.id_jur', '=', 'ruangan_jurusan.id_jur')
                ->join('education_level', 'prodi.id_jenj_didik', '=', 'education_level.id_jenj_didik')
                ->get();

            return DataTables::of($prodi)
                ->editColumn('status', function ($row) use ($statusName) {
                    return $statusName[$row->status];
                })
                ->editColumn('kode', function ($row) {
                    return $row->kode ?? '--belum di set--';
                })
                ->make(true);
        }

        return view('pages.admin.prodi.index');
    }

}
