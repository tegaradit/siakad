<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuildingsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LectureSettingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TAllProdiController;
use App\Http\Controllers\TSatuanPendidikanController;
use App\Http\Controllers\UserController;
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