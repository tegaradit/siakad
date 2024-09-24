<?php 
namespace App\Http\Controllers;

use App\Models\Educational_unit;
use App\Models\IdentitasPt;
use Illuminate\Http\Request;

class IdentitasPTController extends Controller
{
    // Menampilkan data identitas perguruan tinggi berdasarkan NPSN
    public function index(Request $request)
    {
        // $npsn = IdentitasPt::findOrFile
        $educationalUnit = Educational_unit::rightJoin('identitas_pt' ,'id_sp','=', 'current_id_sp')->get()[0];
        // return $educationalUnit; 
        if (!$educationalUnit) {
            return view('pages.admin.identitas_pt.index')->with('error', 'Educational unit not found');
        }

        return view('pages.admin.identitas_pt.index', compact('educationalUnit'));
    }

    // Update data perguruan tinggi
    public function update(Request $request)
    {
        // return $request->all();
        $validateData = $request->validate([
            'npsn' => 'required|string|size:6', 
        ]);
        $educationalUnit = Educational_unit::where('npsn', '=', $validateData['npsn'])->get()[0];
        if (!$educationalUnit) {
            return response()->json([
                'message' => 'Educational unit not found'
            ], 404);
        }
    
        // Validate the request data
        // Prepare the data for updating
        // $updateData = $request->except('npsn');
        IdentitasPt::findOrFail(1)
        ->update([
        "current_npsn" => $educationalUnit->npsn,
        "current_id_sp"=>$educationalUnit->id_sp,
    ]);
    
    
        return redirect()->back();
    }
    
}
