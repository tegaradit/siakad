<?php

namespace App\Http\Controllers;

use App\Models\Educational_unit;
use Illuminate\Http\Request;

class IdentitasPTController extends Controller
{
    public function index(Request $request)
    {
        $npsn = $request->input('npsn', '053025');
        $educationalUnit = Educational_unit::where('npsn', $npsn)->first();

        if (!$educationalUnit) {
            return view('pages.admin.identitas_pt.index')->with('error', 'Educational unit not found');
        }

        return view('pages.admin.identitas_pt.index', compact('educationalUnit'));
    }

    public function update(Request $request, $npsn)
    {
        $educationalUnit = Educational_unit::where('npsn', $npsn)->first();
    
        if (!$educationalUnit) {
            return response()->json([
                'message' => 'Educational unit not found'
            ], 404);
        }
    
        // Validate the request data
        $request->validate([
            'npsn' => 'required|string|size:8', // Ensure this is in your validation rules
            // Other validation rules
        ]);
    
        // Prepare the data for updating
        $updateData = $request->except('npsn');
    
        // Update the educational unit
        $educationalUnit->update($updateData);
    
        return response()->json([
            'message' => 'Educational unit updated successfully',
            'data' => $educationalUnit
        ]);
    }
    
}
