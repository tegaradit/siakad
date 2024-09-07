<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        // $user = Auth::user();
        $menu = 'course';
        $submenu = 'course';
        $datas = Course::latest()->paginate(10);
        return view('pages.admin.course.index', compact('menu','submenu','datas'));
    }
}
