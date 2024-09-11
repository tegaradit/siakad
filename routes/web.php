<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', function () {
    return view('pages.welcome');
});
Route::post('/login', [UserController::class, 'action'])->name('login');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

//admin
Route::get('/admin', [AdminController::class, 'index'])->name('dashboard.admin');

//dosen 
Route::get('/dosen',[DosenController::class, 'index'] )->name('dahboard.dosen');

