<?php

namespace App\Http\Controllers;

use App\Models\All_prodi;
use App\Models\Educational_unit;
use App\Models\IdentitasPt;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        $current_identity = IdentitasPt::get(['current_id_sp']);
        $current_university = Educational_unit::where('id_sp', '=', $current_identity[0]->current_id_sp)->get()[0];
        
        if ($request->ajax()) {
            $prodi = All_prodi::leftJoin('education_level', 'all_prodi.id_jenj_didik', '=', 'education_level.id_jenj_didik')
                ->where('id_sp', '=', $current_identity[0]->current_id_sp)
                ->get([
                    'kode_prodi AS kode',
                    'nama_prodi AS nama',
                    'status',
                    'education_level.nm_jenj_didik'
                ]);
            $statusName = [
                "A" => "Aktif", 
                "H" => "Tutup", 
                "B" => "Pembinaan", 
                "N" => "Non Aktif", 
                "K" => "Keluar"
            ];

            return DataTables::of($prodi)
                ->editColumn('status', function ($row) use ($statusName) {
                    return $statusName[$row->status];
                })
                ->editColumn('kode', function ($row) {
                    return $row->kode ?? '--belum di set--';
                })
                ->make(true);
        }

        return view('pages.admin.prodi.index')->with(compact('current_university'));
    }

}
