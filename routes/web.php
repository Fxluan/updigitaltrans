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
Route::get('admin/registrasidriver', [App\Http\Controllers\admin\MitraController::class, 'driverView'])->name('admin.driver')->middleware('is_admin');
Route::get('admin/detaildriver/{id}', [App\Http\Controllers\admin\MitraController::class, 'driverDetail'])->middleware('is_admin');
Route::post('admin/verifikasidrive', [App\Http\Controllers\admin\MitraController::class, 'driverVerification'])->name('admin.verifikasidrive')->middleware('is_admin');
Route::get('admin/registrasimerchant', [App\Http\Controllers\admin\MitraController::class, 'merchantView'])->name('admin.merchant')->middleware('is_admin');
Route::get('admin/detailmerchant', [App\Http\Controllers\admin\MitraController::class, 'merchantDetail'])->name('admin.detailmerchant')->middleware('is_admin');

// User
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\user\UserController::class, 'index'])->name('profile');
Route::get('/kontakkami', [App\Http\Controllers\user\KontakKamiController::class, 'index'])->name('kontakkami');

// Driver
Route::get('/mitradriver', [App\Http\Controllers\user\MitraDriverController::class, 'index'])->name('mitradriver');
Route::get('/daftarbike', [App\Http\Controllers\user\MitraDriverController::class, 'registerMotocycle'])->name('daftarbike');
Route::get('/daftarcar', [App\Http\Controllers\user\MitraDriverController::class, 'registerCar'])->name('daftarcar');
Route::post('/storedrive', [App\Http\Controllers\user\MitraDriverController::class, 'store'])->name('storedrive');


// Merchant
Route::get('/mitramerchant', [App\Http\Controllers\user\MitraMerchantController::class, 'index'])->name('mitramerchant');
Route::get('/daftarfood', [App\Http\Controllers\user\MitraMerchantController::class, 'registerFood'])->name('daftarfood');
Route::get('/daftarmart', [App\Http\Controllers\user\MitraMerchantController::class, 'registerMart'])->name('daftarmart');
Route::post('/storemerchant', [App\Http\Controllers\user\MitraMerchantController::class, 'store'])->name('storemerchant');
