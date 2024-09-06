<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingsController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('pages.admin.buildings.index');
    }
}
