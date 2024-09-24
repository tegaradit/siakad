<?php

use App\Http\Controllers\AcademicCalendarController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuildingsController;
use App\Http\Controllers\CalendarTypeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\IdentitasPTController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LectureSettingController;
use App\Http\Controllers\PeriodePmbController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TAllProdiController;
use App\Http\Controllers\TSatuanPendidikanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.welcome');
})->name('login.page');
Route::post('/login', [UserController::class, 'action'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

//user



Route::get('/users', [UserController::class, 'users'])->name('users.index');
Route::get('/users/data', [UserController::class, 'getUsers'])->name('users.getUsers');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Tambah user
Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Simpan user
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');



//admin
Route::get('/admin', [AdminController::class, 'index'])->name('dashboard.admin');
Route::resource('admin/setting_perkuliahan', LectureSettingController::class);
//admin/identitas_pt
Route::get('admin/identitas-pt', [IdentitasPTController::class, 'index'])->name("identitas-pt.index");
Route::post('/identitas-pt/update/{npsn}', [IdentitasPTController::class, 'update']);


//admin/buildings(gedung)
Route::get('/admin/buildings', [BuildingsController::class, 'index'])->name('buildings.index');
Route::get('/buildings/data', [BuildingsController::class, 'data'])->name('buildings.data');
Route::get('/admin/buildings/create', [BuildingsController::class, 'create'])->name('buildings.create');
Route::post('/admin/buildings', [BuildingsController::class, 'store'])->name('buildings.store');
Route::get('/admin/buildings/{id}/edit', [BuildingsController::class, 'edit'])->name('buildings.edit');
Route::put('/admin/buildings/{id}', [BuildingsController::class, 'update'])->name('buildings.update');
Route::delete('/admin/buildings/{id}', [BuildingsController::class, 'destroy'])->name('buildings.destroy');
//admin/course(matakuliah)
Route::get('/admin/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/admin/course/create', [CourseController::class, 'create'])->name('course.create');
Route::post('/admin/course', [CourseController::class, 'store'])->name('course.store');
Route::get('/admin/course/{id}/edit', [CourseController::class, 'edit'])->name('course.edit');
Route::put('/admin/course/{id}', [CourseController::class, 'update'])->name('course.update');
Route::delete('/admin/course/{id}', [CourseController::class, 'destroy'])->name('course.destroy');
Route::get('/admin/course/{id}', [CourseController::class, 'show'])->name('course.show');
// admin/semester
Route::get('/admin/semester', [SemesterController::class, 'index'])->name('semester.index');
Route::get('/semester/data', [SemesterController::class, 'data'])->name('semester.data');
Route::get('/admin/semester/create', [SemesterController::class, 'create'])->name('semester.create');
Route::post('/admin/semester', [SemesterController::class, 'store'])->name('semester.store');
Route::get('/admin/semester/{semester_id}/edit', [SemesterController::class, 'edit'])->name('semester.edit');
Route::put('/admin/semester/{semester_id}', [SemesterController::class, 'update'])->name('semester.update');
Route::delete('/admin/semester/{semester_id}', [SemesterController::class, 'destroy'])->name('semester.destroy');
//admin/curriculum(kurikulum)
Route::resource('/admin/curriculum', CurriculumController::class);
//search education level
Route::get('/curriculum/search_ed_lev', [CurriculumController::class, 'searchEdLevel'])->name('curriculum.search_ed_lev');
//lecturesetting
Route::get('/lecture-setting/data', [LectureSettingController::class, 'data'])->name('lecture-setting.data');
Route::resource('/admin/lecture-setting', LectureSettingController::class);
//tipe kalender
Route::get('/calendar-type/data', [CalendarTypeController::class, 'data'])->name('calendar-type.data');
Route::resource('/admin/calendar-type', CalendarTypeController::class);
//kalender akademik
Route::resource('/admin/kalender-akademik', AcademicCalendarController::class);
Route::get('/kalender-akademik/data', [AcademicCalendarController::class, 'data'])->name('kalender-akademik.data');
//akademik year
Route::resource('/admin/tahun-akademik', AcademicYearController::class);
Route::get('/tahun-akademik/data', [AcademicYearController::class, 'data'])->name('tahun-akademik.data');


//dosen 
Route::get('/dosen',[DosenController::class, 'index'] )->name('dahboard.dosen');
//All Prodi
Route::get('/admin/all_prodi', [TAllProdiController::class, 'index'])->name('all_prodi.index');
Route::get('/admin/all_prodi/data', [TAllProdiController::class, 'getAllProdiData'])->name('all_prodi.data');
//Educational Unit
Route::get('/admin/educational_unit', [TSatuanPendidikanController::class, 'index'])->name('educational_unit.index');
Route::get('/admin/educational_unit/data', [TSatuanPendidikanController::class, 'getEducationalUnitData'])->name('educational_unit.data');
//room
Route::get('/admin/room',[RoomController::class, 'index'])->name('room.index');
Route::get('admin/room/create', [RoomController::class, 'create'])->name('room.create');
Route::post('admin/room/store', [RoomController::class, 'store'])->name('room.store');
Route::get('/admin/room/{id}/edit', [RoomController::class, 'edit'])->name('room.edit');
Route::put('/admin/room/{id}', [RoomController::class, 'update'])->name('room.update');
Route::delete('/admin/room/{id}', [RoomController::class, 'destroy'])->name('room.destroy');
Route::get('/room/data', [RoomController::class, 'data'])->name('room.data');

// Prodi
Route::get('/admin/prodi', [ProdiController::class, 'index'])->name('prodi');
//lecturer
Route::get('/admin/lecturer',[LecturerController::class, 'index'])->name('lecturer.index');
Route::get('admin/lecturer/create', [LecturerController::class, 'create'])->name('lecturer.create');
Route::post('admin/lecturer/store', [LecturerController::class, 'store'])->name('lecturer.store');
Route::get('/admin/lecturer/{id}/edit', [LecturerController::class, 'edit'])->name('lecturer.edit');
Route::put('/admin/lecturer/{id}', [LecturerController::class, 'update'])->name('lecturer.update');
Route::delete('/admin/lecturer/{id}', [LecturerController::class, 'destroy'])->name('lecturer.destroy');
Route::get('/admin/lecturer/{id}', [LecturerController::class, 'show'])->name('lecturer.show');

// Periode PMB
Route::get('/admin/periode_pmb', [PeriodePmbController::class, 'index'])->name('periode_pmb.index');
//search semester
Route::get('/admin/periode_pmb/search_semester', [PeriodePmbController::class, 'searchSemester'])->name('periode_pmb.search_semester');

Route::get('/admin/periode_pmb/create', [PeriodePmbController::class, 'create'])->name('periode_pmb.create');
Route::post('/admin/periode_pmb/store', [PeriodePmbController::class, 'store'])->name('periode_pmb.store');

Route::get('/admin/periode_pmb/edit/{id}', [PeriodePmbController::class, 'edit'])->name('periode_pmb.edit');
Route::put('/admin/periode_pmb/update/{id}', [PeriodePmbController::class, 'update'])->name('periode_pmb.update');

Route::delete('/admin/periode_pmb/delete/{id}', [PeriodePmbController::class, 'destroy'])->name('periode_pmb.destroy');


Route::get('/lecturer/data', [LecturerController::class, 'data'])->name('lecturer.data');