<?php

namespace App\Http\Controllers;

use App\Models\All_prodi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TAllProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return view('pages.admin.all_prodi.index');
    }

    public function getAllProdiData()
    {
        $allProdi = All_prodi::select(['id_prodi', 'id_pt', 'kode_prodi', 'nama_prodi', 'status', 'id_jenjang_pendidikan']);
        return DataTables::of($allProdi)->make(true);
    }
}