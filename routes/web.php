<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DataregisterController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);



Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');


Route::controller(RegisterController::class)->group(function () {
  Route::get('/', 'form')->name('data-register');
  Route::post('/regis/{kode}', 'save');
});
  Route::get('/bus', [TripController::class, 'bus'])->name('bus'); //request diluar login

Route::controller(TripController::class)->middleware('auth')->group(function () {
  Route::get('/trip', 'index')->name('trip');
  Route::post('/trip/simpan', 'save');
  Route::delete('/trip/hapus/{id}', 'delete');
  Route::get('/trip/tambah', 'input');
});

Route::controller(DataregisterController::class)->middleware('auth')->group(function () {
 Route::get('/datareg', 'index')->name('datareg');
 Route::get('/datareg/edit/{id}', 'edit');
 Route::put('/datareg/update/{id}', 'update');
 Route::delete('/datareg/hapus/{id}', 'delete');
 Route::get('/datareg/hapus/foto/{id}', 'hapusfoto');
 Route::get('/datareg/hapus/surat/{id}', 'hapusurat');
 Route::get('/datareg/detail/{id_reg}', 'detail');
});

// Route::get('/qrcode', function () {
//     return view('qrcode.index');
// })->name('qrcode');


Route::controller(AbsensiController::class)->middleware('auth')->group(function () {
Route::get('/qrcode/', 'qrcode')->name('qrcode');
Route::get('/absensi', 'index')->name('absensi');
Route::get('/absen1/{id_reg}', 'absen1');
Route::get('/absen2/{id_reg}', 'absen2');
Route::get('/absen3/{id_reg}', 'absen3');
Route::get('/absen4/{id_reg}', 'absen4');
Route::get('/absen5/{id_reg}', 'absen5');
Route::get('/absen6/{id_reg}', 'absen6');
Route::get('/absen7/{id_reg}', 'absen7');
Route::get('/absen8/{id_reg}', 'absen8');
Route::get('/enkripsi', 'enkripsi');
Route::get('/qrgen', 'qrgen');
Route::get('/absensi/idcard', 'idcard');
Route::get('/absensi/cardpdf/{kode}/{bus}/', 'cardpdf');

});

Route::controller(Controller::class)->middleware('auth')->group(function () {
Route::get('/user/', 'indexs')->name('user');
});