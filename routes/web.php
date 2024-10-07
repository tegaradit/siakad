<?php

use App\Http\Controllers\AcademicCalendarController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuildingsController;
use App\Http\Controllers\CalendarTypeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseCurriculumController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\IdentitasPTController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LectureSettingController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PeriodePmbController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TAllProdiController;
use App\Http\Controllers\TSatuanPendidikanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentTypeController;
use App\Http\Controllers\KelasKuliahController;
use App\Http\Controllers\RegisterTypeController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.welcome');
})->name('login.page');
Route::post('/login', [UserController::class, 'action'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware(Authenticate::class);

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware(Authenticate::class);
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(Authenticate::class);

//user



Route::get('/users', [UserController::class, 'users'])->name('users.index')->middleware(Authenticate::class);
Route::get('/users/data', [UserController::class, 'getUsers'])->name('users.getUsers')->middleware(Authenticate::class);
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware(Authenticate::class); // Tambah user
Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware(Authenticate::class); // Simpan user
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware(Authenticate::class);
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update')->middleware(Authenticate::class);
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(Authenticate::class);



//admin
Route::get('/admin', [AdminController::class, 'index'])->name('dashboard.admin')->middleware(Authenticate::class);
Route::resource('admin/setting_perkuliahan', LectureSettingController::class)->middleware(Authenticate::class);
//admin/identitas_pt
Route::get('admin/identitas-pt', [IdentitasPTController::class, 'index'])->name("identitas-pt.index")->middleware(Authenticate::class);
Route::post('/identitas-pt/update/', [IdentitasPTController::class, 'update'])->name("identitas-pt.update")->middleware(Authenticate::class);


//admin/buildings(gedung)
Route::get('/admin/buildings', [BuildingsController::class, 'index'])->name('buildings.index')->middleware(Authenticate::class);
Route::get('/buildings/data', [BuildingsController::class, 'data'])->name('buildings.data')->middleware(Authenticate::class);
Route::get('/admin/buildings/create', [BuildingsController::class, 'create'])->name('buildings.create')->middleware(Authenticate::class);
Route::post('/admin/buildings', [BuildingsController::class, 'store'])->name('buildings.store')->middleware(Authenticate::class);
Route::get('/admin/buildings/{id}/edit', [BuildingsController::class, 'edit'])->name('buildings.edit')->middleware(Authenticate::class);
Route::put('/admin/buildings/{id}', [BuildingsController::class, 'update'])->name('buildings.update')->middleware(Authenticate::class);
Route::delete('/admin/buildings/{id}', [BuildingsController::class, 'destroy'])->name('buildings.destroy')->middleware(Authenticate::class);
//admin/course(matakuliah)
Route::get('/admin/course', [CourseController::class, 'index'])->name('course.index')->middleware(Authenticate::class);
Route::get('/admin/course/create', [CourseController::class, 'create'])->name('course.create')->middleware(Authenticate::class);
Route::get('/get-education-level/{prodi_id}', [CourseController::class, 'getEducationLevel']);
Route::post('/admin/course', [CourseController::class, 'store'])->name('course.store')->middleware(Authenticate::class);
Route::get('/admin/course/{id}/edit', [CourseController::class, 'edit'])->name('course.edit')->middleware(Authenticate::class);
Route::put('/admin/course/{id}', [CourseController::class, 'update'])->name('course.update')->middleware(Authenticate::class);
Route::delete('/admin/course/{id}', [CourseController::class, 'destroy'])->name('course.destroy')->middleware(Authenticate::class);
Route::get('/admin/course/{id}', [CourseController::class, 'show'])->name('course.show')->middleware(Authenticate::class);
// admin/semester
Route::get('/admin/semester', [SemesterController::class, 'index'])->name('semester.index');
Route::get('/semester/data', [SemesterController::class, 'data'])->name('semester.data');
Route::post('/semester/change-status/{id}', [SemesterController::class, 'changeStatus'])->name('semester.changeStatus');
Route::get('/admin/semester/create', [SemesterController::class, 'create'])->name('semester.create');
Route::post('/admin/semester', [SemesterController::class, 'store'])->name('semester.store');
Route::get('/admin/semester/{semester_id}/edit', [SemesterController::class, 'edit'])->name('semester.edit');
Route::put('/admin/semester/{semester_id}', [SemesterController::class, 'update'])->name('semester.update');
Route::delete('/admin/semester/{semester_id}', [SemesterController::class, 'destroy'])->name('semester.destroy');
//admin/curriculum(kurikulum)
Route::resource('/admin/curriculum', CurriculumController::class)->middleware(Authenticate::class);
Route::get('/api/get-education-level/{prodiId}', function ($prodiId) {
    $educationLevel = DB::table('education_level')
        ->where('id_jenj_didik', DB::table('all_prodi')->where('id_prodi', $prodiId)->value('id_jenj_didik'))
        ->select('id_jenj_didik', 'nm_jenj_didik') // Select the id and name
        ->first();

    return response()->json(['education_level_id' => $educationLevel->id_jenj_didik, 'education_level_name' => $educationLevel->nm_jenj_didik]);
});
// Routes for Curriculum Courses
Route::prefix('admin/curriculum/detail/{curriculum_id}')->group(function () {
    Route::get('/', [CourseCurriculumController::class, 'index'])->name('curriculum_course.index');
    Route::get('/create', [CourseCurriculumController::class, 'create'])->name('curriculum_course.create');
    Route::post('/', [CourseCurriculumController::class, 'store'])->name('curriculum_course.store');
    Route::get('/{id}/edit', [CourseCurriculumController::class, 'edit'])->name('curriculum_course.edit');
    Route::put('/{id}', [CourseCurriculumController::class, 'update'])->name('curriculum_course.update');
    Route::delete('/{id}', [CourseCurriculumController::class, 'destroy'])->name('curriculum_course.destroy');
    
});

// Route untuk pencarian course tetap di luar
Route::get('/admin/curriculum/{curriculum_id}/search_course', [CourseCurriculumController::class, 'searchCourse'])->name('curriculum_course.search_course');

//lecturesetting
Route::get('/lecture-setting/data', [LectureSettingController::class, 'data'])->name('lecture-setting.data')->middleware(Authenticate::class);
Route::resource('/admin/lecture-setting', LectureSettingController::class)->middleware(Authenticate::class);
//tipe kalender
Route::get('/calendar-type/data', [CalendarTypeController::class, 'data'])->name('calendar-type.data')->middleware(Authenticate::class);
Route::resource('/admin/calendar-type', CalendarTypeController::class)->middleware(Authenticate::class);
//kalender akademik
Route::resource('/admin/kalender-akademik', AcademicCalendarController::class)->middleware(Authenticate::class);
Route::get('/kalender-akademik/data', [AcademicCalendarController::class, 'data'])->name('kalender-akademik.data')->middleware(Authenticate::class);
//akademik year
Route::resource('/admin/tahun-akademik', AcademicYearController::class)->middleware(Authenticate::class);
Route::get('/tahun-akademik/data', [AcademicYearController::class, 'data'])->name('tahun-akademik.data')->middleware(Authenticate::class);
//studentType
Route::get('/student-type/data', [StudentTypeController::class, 'data'])->name('student-type.data')->middleware(Authenticate::class);
Route::resource('/admin/student-type', StudentTypeController::class)->middleware(Authenticate::class);
//studentType
Route::get('/register-type/data', [RegisterTypeController::class, 'data'])->name('register-type.data')->middleware(Authenticate::class);
Route::resource('/admin/register-type', RegisterTypeController::class)->middleware(Authenticate::class);



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
Route::get('/check-email', [LecturerController::class, 'checkEmail'])->name('check.email');

// Periode PMB
Route::get('/admin/periode_pmb', [PeriodePmbController::class, 'index'])->name('periode_pmb.index');
//search semester
Route::get('/admin/periode_pmb/search_semester', [PeriodePmbController::class, 'searchSemester'])->name('periode_pmb.search_semester');

Route::get('/admin/periode_pmb/create', [PeriodePmbController::class, 'create'])->name('periode_pmb.create');
Route::post('/admin/periode_pmb/store', [PeriodePmbController::class, 'store'])->name('periode_pmb.store');
Route::get('/admin/periode_pmb/anotherIsOpen', [PeriodePmbController::class, 'anotherIsOpen'])->name('anotherIsOpen');

Route::get('/admin/periode_pmb/edit/{id}', [PeriodePmbController::class, 'edit'])->name('periode_pmb.edit');
Route::put('/admin/periode_pmb/update/{id}', [PeriodePmbController::class, 'update'])->name('periode_pmb.update');
Route::put('/admin/periode_pmb/toggleStatus', [PeriodePmbController::class, 'toggleStatus'])->name('periode_pmb.toggle_status');

Route::delete('/admin/periode_pmb/delete/{id}', [PeriodePmbController::class, 'destroy'])->name('periode_pmb.destroy');


// Mahasiswa
Route::get('/admin/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/admin/mahasiswa/tambah', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/admin/mahasiswa/search', [MahasiswaController::class, 'searchMahasiswa'])->name('mahasiswa.search');
Route::post('/admin/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/admin/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/admin/mahasiswa/edit/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/admin/mahasiswa/delete/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

Route::get('/lecturer/data', [LecturerController::class, 'data'])->name('lecturer.data');



Route::get('admin/curriculum/kelas_kuliah/{curriculum_id}/{course_id}', [KelasKuliahController::class, 'index'])->name('kelas_kuliah.index');
Route::get('admin/curriculum/kelas_kuliah/create/{curriculum_id}/{course_id}', [KelasKuliahController::class, 'create'])->name('kelas_kuliah.create');
Route::post('admin/curriculum/kelas_kuliah/store/{curriculum_id}/{course_id}', [KelasKuliahController::class, 'store'])->name('kelas_kuliah.store');




