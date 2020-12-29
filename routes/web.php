<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\KtpController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\PasalController;
use App\Http\Controllers\Dashboard\PetugasController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PelanggaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'verified'], function() {
    Route::group(['middleware' => 'admin'], function() {

        //USER ROUTE START
        Route::get('/dashboard/users/action/{notify}', [UserController::class, 'index'])->name('UsersIndexNotify');

        Route::get('/dashboard/users', [UserController::class, 'index'])->name('UsersIndex');

        Route::get('/dashboard/users/adduser', [UserController::class, 'create'])->name('UsersCreate');

        Route::post('/dashboard/users/store', [UserController::class, 'store'])->name('UsersStore');

        Route::get('/dashboard/user/edit/{id}', [UserController::class, 'edit'])->name('UserEdit');

        Route::put('/dashboard/user/update/{id}/{id_petugas}', [UserController::class, 'update'])->name('UserUpdate');

        Route::delete('/dashboard/user/delete/{id}', [UserController::class, 'destroy'])->name('UserDelete');

        Route::get('/dashboard/logs', [UserController::class, 'Logs'])->name('UsersLogs');

        //PASAL ROUTE START
        Route::get('/dashboard/pasal', [PasalController::class, 'index'])->name('PasalIndex');

        Route::get('/dashboard/pasal/create', [PasalController::class, 'create'])->name('PasalCreate');

        Route::post('/dashboard/pasal/store', [PasalController::class, 'store'])->name('PasalStore');

        Route::get('/dashboard/pasal/edit/{id}', [PasalController::class, 'edit'])->name('PasalEdit');

        Route::put('/dashboard/pasal/update/{id}', [PasalController::class, 'update'])->name('PasalUpdate');

        Route::delete('/dashboard/pasal/delete/{id}', [PasalController::class, 'destroy'])->name('PasalDelete');

    });
    //KTP ROUTE START
    Route::get('/dashboard/petugas', [PetugasController::class, 'index'])->name('PetugasIndex');

    Route::get('/dashboard/ktp', [KtpController::class, 'index'])->name('KtpIndex');

    Route::get('/dashboard/ktp/create', [KtpController::class, 'create'])->name('KtpCreate');

    Route::post('/dashboard/ktp/store', [KtpController::class, 'store'])->name('KtpStore');

    Route::get('/dashboard/ktp/edit/{id}', [KtpController::class, 'edit'])->name('KtpEdit');

    Route::put('/dashboard/ktp/update/{id}', [KtpController::class, 'update'])->name('KtpUpdate');

    Route::delete('/dashboard/ktp/delete/{id}', [KtpController::class, 'destroy'])->name('KtpDelete');

    //ROUTE START DAHSBOARD
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard/nothaveaccess', [DashboardController::class, 'NotHaveAccess']);

    Route::get('/home', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('DashboardIndex');

    Route::get('/dashboard/pelanggaran/detailpelanggaranitem/{id}', [DashboardController::class, 'DetailPelanggaranItem'])->name('DetailPelanggaranItem');

    Route::post('/dashboard/pelanggaran/caripelanggaranarchive/', [DashboardController::class, 'CariPelanggaranArchive'])->name('CariPelanggaranArchive');

    Route::get('/dashboard/pelanggaran/caripelanggaranarchivebynik/{nik}', [DashboardController::class, 'CariPelanggaranArchiveByNik'])->name('CariPelanggaranArchiveByNik');

    //PELANGGARAN ROUTE START
    Route::get('/dashboard/pelanggaran', [PelanggaranController::class, 'index'])->name('PelanggranIndex');

    Route::post('/dashboard/pelanggaran/caripelanggaran', [PelanggaranController::class, 'CariPelanggaran'])->name('CariPelanggaran');

    Route::get('/dashboard/pelanggaran/CariPelanggaranValidate/{nik}', [PelanggaranController::class, 'CariPelanggaranValidate'])->name('CariPelanggaranValidate');

    Route::post('/dashboard/pelanggaran/store', [PelanggaranController::class, 'store'])->name('PelanggaranStore');

    Route::get('/dashboard/pelanggaran/uploadbuktipelanggaran/{pelanggaran_id}', [PelanggaranController::class, 'UploadBuktiPelanggaran'])->name('UploadBuktiPelanggaran');

    Route::get('/dashboard/pelanggaran/UploadBuktiPelanggaranNotif/{pelanggaran_id}/{notif}', [PelanggaranController::class, 'UploadBuktiPelanggaranNotif'])->name('UploadBuktiPelanggaranNotif');

    Route::post('/dashboard/pelanggaran/uploadbuktipelanggaranstore', [PelanggaranController::class, 'UploadBuktiPelanggaranstore'])->name('uploadbuktipelanggaranstore');

    Route::get('/dashboard/pelanggaran/finishpelanggaran/{id}', [PelanggaranController::class, 'FinishPelanggaran'])->name('FinishPelanggaran');

    Route::post('/dashboard/pelanggaran/finishpelanggaranstore/', [PelanggaranController::class, 'FinishPelanggaranStore'])->name('FinishPelanggaranStore');

    Route::get('/dashboard/pelanggaran/detailpelanggaran/{nik}', [PelanggaranController::class, 'DetailPelanggaran'])->name('DetailPelanggaran');

    Route::post('/dashboard/pelanggaran/tilangpelanggar', [PelanggaranController::class, 'TilangPelanggar'])->name('TilangPelanggar');

    Route::get('/dashboard/pelanggaran/successtilang/{nik}/{pelanggaran_id}', [PelanggaranController::class, 'SuccessTilang'])->name('SuccessTilang');

});



// CLEAR
//Clear Cache facade value:
Route::get('/cache-clear', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});
//Clear Config cache:
Route::get('/config-clear', function() {
    $exitCode = Artisan::call('config:clear');
    return '<h1>Clear Config cleared</h1>';
});
//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});
//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});



//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});
//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});
//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

