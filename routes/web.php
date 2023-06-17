<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LopController;
use App\Http\Controllers\AlokasiMitraController;
use App\Http\Controllers\SurveyRabController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/lop', [LopController::class, 'index'])->name('lop.list');
Route::get('/lop/add/{permintaan_id}', [LopController::class, 'formAddLop'])->name('lop.formAdd');
Route::post('/lop/add', [LopController::class, 'storeLop'])->name('lop.store');
Route::patch('/lop/edit/{id}', [LopController::class, 'patch'])->name('lop.patch');
Route::delete('/lop/delete/{id}', [LopController::class, 'delete'])->name('lop.delete');
// Survey RAB Routes
Route::get('/surveyRab/{lop_id}', [LopController::class, 'surveyRabForm'])->name('lop.formSurvey');
Route::post('/surveyRab/store', [LopController::class, 'storeSurveyRabForm'])->name('lop.storeFormSurvey');
// Alokasi Mitra Routes
Route::get('/alokasiMitra/{lop_id}', [LopController::class, 'alokasiMitraForm'])->name('lop.formAlokasiMitra');
Route::post('/alokasiMitra/store', [LopController::class, 'storeAlokasiMitraForm'])->name('lop.storeAlokasiMitra');

Route::get('/permintaan', [PermintaanController::class, 'index'])->name('permintaan.list');
Route::get('/permintaan/add', [PermintaanController::class, 'formAddPermintaan'])->name('permintaan.formAdd');
Route::post('/permintaan/add', [PermintaanController::class, 'store'])->name('permintaan.store');
Route::get('/permintaan/edit/id', [PermintaanController::class, 'formEditPermintaan'])->name('permintaan.formEdit');
Route::patch('/permintaan/edit/{id}', [PermintaanController::class, 'patch'])->name('permintaan.patch');
Route::delete('/permintaan/delete{id}', [PermintaanController::class, 'delete'])->name('permintaan.delete');

Route::get('/profile', function () {
    return view('profile', [ 
        "pages" => "Profile",
        "category" => "Profile",
        "name" => "Admin"
    ]);
});

Route::get('/alokasi-mitra', function () {
    return view('alokasi-mitra', [ 
        "pages" => "Alokasi Mitra",
        "category" => "Alokasi Mitra",
        "name" => "Admin"
    ]);
});

Route::get('/buat-permintaan', function () {
    return view('buat-permintaan', [ 
        "pages" => "Buat Permintaan",
        "category" => "Buat Permintaan",
        "name" => "Admin"
    ]);
});

Route::get('/create-project', function () {
    return view('create-project', [ 
        "pages" => "Create Project",
        "category" => "Create Project",
        "name" => "Admin"
    ]);
});

Route::get('/golive-odp', function () {
    return view('golive-odp', [ 
        "pages" => "Golive Odp",
        "category" => "Golive Odp",
        "name" => "Admin"
    ]);
});

Route::get('/konstruksi', function () {
    return view('konstruksi', [ 
        "pages" => "Konstruksi",
        "category" => "Konstruksi",
        "name" => "Admin"
    ]);
});

Route::get('/sign-up', function () {
    return view('sign-up', [ 
        "pages" => "Sign Up",
        "category" => "Sign Up",
        "name" => "Admin"
    ]);
});

Route::get('/survey-rab-ondesk', function () {
    return view('survey-rab-ondesk', [ 
        "pages" => "Survey RAB Ondesk",
        "category" => "Survey RAB Ondesk",
        "name" => "Admin"
    ]);
});

