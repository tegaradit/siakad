<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuildingsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LectureSettingController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TAllProdiController;
use App\Http\Controllers\TSatuanPendidikanController;
use App\Http\Controllers\UserController;
use App\Models\Lecturer;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/login', [UserController::class, 'action'])->name('login');

//admin
Route::get('/admin', [AdminController::class, 'index'])->name('dashboard.admin');
Route::resource('admin/setting_perkuliahan', LectureSettingController::class);
//admin/buildings(gedung)
Route::get('/admin/buildings', [BuildingsController::class, 'index'])->name('buildings.index');
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
//lecturesetting
Route::resource('lecture-setting', LectureSettingController::class);
// admin/semester
Route::get('/admin/semester', [SemesterController::class, 'index'])->name('semester.index');
Route::get('/admin/semester/create', [SemesterController::class, 'create'])->name('semester.create');
Route::post('/admin/semester', [SemesterController::class, 'store'])->name('semester.store');
Route::get('/admin/semester/{semester_id}/edit', [SemesterController::class, 'edit'])->name('semester.edit');
Route::put('/admin/semester/{semester_id}', [SemesterController::class, 'update'])->name('semester.update');
Route::delete('/admin/semester/{semester_id}', [SemesterController::class, 'destroy'])->name('semester.destroy');

//dosen 
Route::get('/dosen',[DosenController::class, 'index'] )->name('dahboard.dosen');
//All Prodi
Route::get('/admin/all_prodi', [TAllProdiController::class, 'index']);
Route::get('/admin/all_prodi/data', [TAllProdiController::class, 'getAllProdiData'])->name('all_prodi.data');
//Educational Unit
Route::get('/admin/educational_unit', [TSatuanPendidikanController::class, 'index']);
Route::get('/admin/educational_unit/data', [TSatuanPendidikanController::class, 'getEducationalUnitData'])->name('educational_unit.data');
//room
Route::get('/admin/room',[RoomController::class, 'index'])->name('room.index');
Route::get('admin/room/create', [RoomController::class, 'create'])->name('room.create');
Route::post('admin/room/store', [RoomController::class, 'store'])->name('room.store');
Route::get('/admin/room/{id}/edit', [RoomController::class, 'edit'])->name('room.edit');
Route::put('/admin/room/{id}', [RoomController::class, 'update'])->name('room.update');
Route::delete('/admin/room/{id}', [RoomController::class, 'destroy'])->name('room.destroy');

// Prodi
Route::get('/admin/prodi', [ProdiController::class, 'index'])->name('prodi');
Route::get('/admin/prodi/data', [ProdiController::class, 'getProdiData'])->name('prodi.data');
//lecturer
Route::get('/admin/lecturer',[LecturerController::class, 'index'])->name('lecturer.index');
Route::get('admin/lecturer/create', [LecturerController::class, 'create'])->name('lecturer.create');
Route::post('admin/lecturer/store', [LecturerController::class, 'store'])->name('lecturer.store');
Route::get('/admin/lecturer/{id}/edit', [LecturerController::class, 'edit'])->name('lecturer.edit');
Route::put('/admin/lecturer/{id}', [LecturerController::class, 'update'])->name('lecturer.update');
Route::delete('/admin/lecturer/{id}', [LecturerController::class, 'destroy'])->name('lecturer.destroy');