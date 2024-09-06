<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuildingsController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TAllProdiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/login', [UserController::class, 'action'])->name('login');

//admin
Route::get('/admin', [AdminController::class, 'index'])->name('dashboard.admin');
Route::get('/admin/buildings', [BuildingsController::class, 'index'])->name('buildings.index');

//dosen 
Route::get('/dosen',[DosenController::class, 'index'] )->name('dahboard.dosen');