<?php

namespace App\Http\Controllers;

use App\Models\Periode_pmb;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PeriodePmbController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pmbPeriod = Periode_pmb::get();
            return DataTables::of($pmbPeriod)
                ->addColumn('action', function ($row) {
                    $editUrl = route('periode_pmb.edit', $row->id);
                    $deleteUrl = route('periode_pmb.destroy', $row->id);
    
                    // <a href="' . $editUrl . '" class="btn btn-outline-warning btn-sm edit" title="Edit">
                    //     <i class="fas fa-pencil-alt"></i>
                    // </a>
                    // <i class="fas fa-trash-alt"></i>
                    if($row->status != 0) return '<form id="delete-form-' . $row->id . '" onsubmit="event.preventDefault(); confirmDelete(' . $row->id . ');" action="' . $deleteUrl . '" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn icon icon-left btn-outline-danger btn-sm delete" title="Delete">
                                    Tutup
                                </button>
                            </form>';
                })
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'buka' : 'tutup';
                })
                ->make(true);
        }

        return view('pages.admin.periode_pmb.index');
    }

    public function generatePeriod()
    {
        function getCurrentSemester()
        {
            $today = new DateTime();
            $tahun = $today->format('Y');
            $bulan = $today->format('m');

            if ($bulan >= 1 && $bulan <= 6) {
                $semester = 1; 
            } else {
                $semester = 2;
            }

            $semester_id = $tahun . $semester;

            return [$semester_id, $tahun, $semester];
        }

        function _generatePeriod ($semester_id, $tahun) {

            [$_semester_id, $_tahun, $semester] = getCurrentSemester();
            $periode_penerimaan = array();
    
            // Periode 1: SNBP
            $periode_penerimaan[] = array(
                "semester_id" => $_semester_id,
                "period_number" => 1,
                "start_date" => new DateTime("$_tahun-01-14"),
                "end_date" => new DateTime("$_tahun-02-28"),
                "status" => 1 // Buka
            );
    
            // Periode 2: SNBT
            $periode_penerimaan[] = array(
                "semester_id" => $_semester_id,
                "period_number" => 2,
                "start_date" => new DateTime("$_tahun-03-23"),
                "end_date" => new DateTime("$_tahun-06-23"),
                "status" => 1 // Buka
            );
    
            // Periode 3: Jalur Mandiri
            $periode_penerimaan[] = array(
                "semester_id" => $_semester_id,
                "period_number" => 3,
                "start_date" => new DateTime("$_tahun-06-25"),
                "end_date" => new DateTime("$_tahun-08-31"),
                "status" => 1 // Buka
            );

            $today = new DateTime();
            foreach ($periode_penerimaan as &$periode) {
                if ($today > $periode['end_date']) {
                    $periode['status'] = 0; // Tutup
                } else {
                    $periode['status'] = 1; // Buka
                }
            }
        }


        Periode_pmb::insert(_generatePeriod());
        return redirect()->back();
    }
}
