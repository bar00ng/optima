<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KonstruksiController;
use App\Http\Controllers\GoLiveController;
use App\Http\Controllers\ProfileController;

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
Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/lop/{id_permintaan?}', [LopController::class, 'index'])->name('lop.list');
    Route::get('/lop/add/{permintaan_id}', [LopController::class, 'formAddLop'])->name('lop.formAdd');
    Route::post('/lop/add/{toAlokasiMitra?}', [LopController::class, 'storeLop'])->name('lop.store');
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

    Route::get('/konstruksi/{lop_id}',[KonstruksiController::class, 'index'])->name('konstruksi');
    Route::post('/konstruksi/{lop_id}',[KonstruksiController::class, 'store'])->name('konstruksi.store');
    Route::get('/goLive/{lop_id}',[GoLiveController::class, 'index'])->name('go-live');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/profile/{user_id}', [ProfileController::class, 'patch'])->name('profile.patch');
});

Route::middleware('redirectIfAuthenticated')->group(function (){
    Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/sign-up', [AuthController::class, 'formSignUp'])->name('signup.form');
    Route::post('/sign-up', [AuthController::class, 'register'])->name('signup.process');
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

