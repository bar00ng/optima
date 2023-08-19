<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\LopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KonstruksiController;
use App\Http\Controllers\GoLiveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SdiController;

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/profile/{user_id}', [ProfileController::class, 'patch'])->name('profile.patch');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/lop/{id_permintaan?}', [LopController::class, 'index'])->name('lop.list');
});

Route::group(['middleware' => ['auth', 'role:optima|sdi']], function() {
    Route::get('/goLive/{lop_id}',[GoLiveController::class, 'index'])->name('lop.go-live');
    Route::post('/goLive/{lop_id}',[GoLiveController::class, 'store'])->name('lop.go-live.store');
});

Route::group(['middleware' => ['auth', 'role:optima|mitra']], function() {
    Route::post('/konstruksi/{lop_id}',[KonstruksiController::class, 'store'])->name('lop.konstruksi.store');

    Route::get('/konstruksi/{lop_id}',[KonstruksiController::class, 'index'])->name('lop.konstruksi');
});

Route::group(['middleware' => ['auth', 'role:optima|mitra|sdi']], function() {
    Route::get('/surveyRab/{lop_id}', [LopController::class, 'surveyRabForm'])->name('lop.formSurvey');
    Route::post('/surveyRab/store', [LopController::class, 'storeSurveyRabForm'])->name('lop.storeFormSurvey');
});

Route::group(['middleware' => ['auth', 'role:optima']], function() {
    Route::patch('/surveyRab/{approved}/{lop_id}', [LopController::class, 'aprroveRab'])->name('lop.approveRab');

    Route::patch('/konstruksi/selesai-fisik/approve-evidence/{detail_id}', [KonstruksiController::class, 'approveEvidence'])->name('lop.konstruksi.approve.evidence');
    Route::patch('/konstruksi/selesai-fisik/reject-evidence/{detail_id}', [KonstruksiController::class, 'rejectEvidence'])->name('lop.konstruksi.reject.evidence');

    Route::get('/mitra', [MitraController::class, 'index'])->name('mitra.list');
    Route::get('/mitra/add', [MitraController::class, 'formAddMitra'])->name('mitra.formAdd');
    Route::post('/mitra/add', [MitraController::class, 'storeMitra'])->name('mitra.store');
    Route::get('/mitra/edit/{id}', [MitraController::class, 'formEditMitra'])->name('mitra.edit');
    Route::patch('/mitra/edit/{id}', [MitraController::class, 'patchMitra'])->name('mitra.patch');
    Route::delete('/mitra/delete/{id}', [MitraController::class, 'delete'])->name('mitra.delete');

    Route::get('/sdi', [SdiController::class, 'index'])->name('sdi.list');
    Route::get('/sdi/add', [SdiController::class, 'formAddSdi'])->name('sdi.formAdd');
    Route::post('/sdi/add', [SdiController::class, 'storeSdi'])->name('sdi.store');
    Route::get('/sdi/edit/{id}', [SdiController::class, 'formEditSdi'])->name('sdi.edit');
    Route::patch('/sdi/edit/{id}', [SdiController::class, 'patchSdi'])->name('sdi.patch');
    Route::delete('/sdi/delete/{id}', [SdiController::class, 'delete'])->name('sdi.delete');

    Route::get('/report-permintaan', [PermintaanController::class, 'createReport'])->name('permintaan.create.report');
    Route::get('/report-lop', [LopController::class, 'createReport'])->name('lop.create.report');

    Route::patch('/konstruksi/persiapan/{isApproved}/{persiapan_id}', [KonstruksiController::class, 'markPersiapanAsDone'])->name('lop.konstruksi.done.persiapan');
    Route::patch('/konstruksi/instalasi/{isApproved}/{instalasi_id}', [KonstruksiController::class, 'markInstalasiAsDone'])->name('lop.konstruksi.done.instalasi');
    Route::patch('/konstruksi/selesaiFisik/{isApproved}/{selesai_fisik_id}', [KonstruksiController::class, 'markSelesaiAsDone'])->name('lop.konstruksi.done.selesaiFisik');

    Route::patch('/goLive/validasi/{lop_id}', [GoLiveController::class, 'markValidasiAsDone'])->name('lop.go-live.validasi.done');
    Route::patch('/goLive/konfirmasiMitra/{lop_id}', [GoLiveController::class, 'markKonfirmasiMitraAsDone'])->name('lop.go-live.konfirmasiMitra.done');
    Route::patch('/goLive/connectivity/{lop_id}', [GoLiveController::class, 'markConnectivityAsDone'])->name('lop.go-live.connectivity.done');
    Route::patch('/goLive/odp/{lop_id}', [GoLiveController::class, 'markOdpAsDone'])->name('lop.go-live.odp.done');
});

Route::group(['middleware' => ['auth', 'role:admin|optima']], function() {
    Route::get('/permintaan', [PermintaanController::class, 'index'])->name('permintaan.list');
    Route::get('/permintaan/add', [PermintaanController::class, 'formAddPermintaan'])->name('permintaan.formAdd');
    Route::post('/permintaan/add', [PermintaanController::class, 'store'])->name('permintaan.store');
    Route::get('/permintaan/edit/id', [PermintaanController::class, 'formEditPermintaan'])->name('permintaan.formEdit');
    Route::patch('/permintaan/edit/{id}', [PermintaanController::class, 'patch'])->name('permintaan.patch');
    Route::delete('/permintaan/delete{id}', [PermintaanController::class, 'delete'])->name('permintaan.delete');

    Route::get('/lop/add/{permintaan_id}', [LopController::class, 'formAddLop'])->name('lop.formAdd');
    Route::post('/lop/add/{toAlokasiMitra?}', [LopController::class, 'storeLop'])->name('lop.store');
    Route::patch('/lop/edit/{id}', [LopController::class, 'patch'])->name('lop.patch');

    Route::get('/alokasiMitra/{lop_id}', [LopController::class, 'alokasiMitraForm'])->name('lop.formAlokasiMitra');
    Route::post('/alokasiMitra/store', [LopController::class, 'storeAlokasiMitraForm'])->name('lop.storeAlokasiMitra');
});

Route::middleware('redirectIfAuthenticated')->group(function (){
    Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

