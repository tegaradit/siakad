<?php

namespace App\Http\Controllers;

use App\Models\Lecture_setting;
use App\Models\LectureSetting; // Sesuaikan nama model
use Illuminate\Http\Request;

class LectureSettingController extends Controller
{
    public function index()
    {
        $menu = 'lecture_setting';
        $submenu = 'lecture_setting';
        // Mengurutkan data berdasarkan ID secara ascending dan paginate
        $datas = lecture_setting::orderBy('id', 'asc')->paginate(5);

        return view('pages.admin.lecture_setting.index', compact('datas', 'menu', 'submenu'));
    }
}
