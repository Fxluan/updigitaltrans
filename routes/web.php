<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// admin
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('admin/pengajuan', [App\Http\Controllers\admin\MitraController::class, 'pengajuanMitra'])->name('admin.pengajuan')->middleware('is_admin');
Route::get('admin/detailpengajuan/{id}/{mitra}', [App\Http\Controllers\admin\MitraController::class, 'detailPengajuanMitra'])->name('admin.detailpengajuan')->middleware('is_admin');
Route::get('admin/kontakkami', [App\Http\Controllers\KontakKamiController::class, 'kontakkamiAdmin'])->name('admin.kontakkami')->middleware('is_admin');

// admin driver
Route::get('admin/driver', [App\Http\Controllers\admin\MitraController::class, 'driverView'])->name('admin.driver')->middleware('is_admin');
Route::get('admin/detaildriver/{id}', [App\Http\Controllers\admin\MitraController::class, 'driverDetail'])->middleware('is_admin');
Route::post('admin/verifikasidrive', [App\Http\Controllers\admin\MitraController::class, 'driverVerification'])->name('admin.verifikasidrive')->middleware('is_admin');

// admin merchant
Route::get('admin/merchant', [App\Http\Controllers\admin\MitraController::class, 'merchantView'])->name('admin.merchant')->middleware('is_admin');
Route::get('admin/detailmerchant/{id}', [App\Http\Controllers\admin\MitraController::class, 'merchantDetail'])->name('admin.detailmerchant')->middleware('is_admin');
Route::post('admin/verifikasimerchant', [App\Http\Controllers\admin\MitraController::class, 'merchantVerification'])->name('admin.verifikasimerchant')->middleware('is_admin');

// User
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\user\UserController::class, 'index'])->name('profile');
Route::get('/kontakkami', [App\Http\Controllers\KontakKamiController::class, 'kontakkamiUser'])->name('kontakkami');

// user driver
Route::get('/mitradriver', [App\Http\Controllers\user\MitraDriverController::class, 'index'])->name('mitradriver');
Route::get('/daftarbike', [App\Http\Controllers\user\MitraDriverController::class, 'registerMotocycle'])->name('daftarbike');
Route::get('/daftarcar', [App\Http\Controllers\user\MitraDriverController::class, 'registerCar'])->name('daftarcar');
Route::post('/storedrive', [App\Http\Controllers\user\MitraDriverController::class, 'store'])->name('storedrive');

// user merchant
Route::get('/mitramerchant', [App\Http\Controllers\user\MitraMerchantController::class, 'index'])->name('mitramerchant');
Route::get('/daftarfood', [App\Http\Controllers\user\MitraMerchantController::class, 'registerFood'])->name('daftarfood');
Route::get('/daftarmart', [App\Http\Controllers\user\MitraMerchantController::class, 'registerMart'])->name('daftarmart');
Route::post('/storemerchant', [App\Http\Controllers\user\MitraMerchantController::class, 'store'])->name('storemerchant');
