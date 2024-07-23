<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MasterdataController;
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
  Route::get('/school', [MasterdataController::class, 'school'])->name('school'); //request diluar login

Route::controller(MasterdataController::class)->middleware('auth')->group(function () {
  Route::get('/masterdata', 'index')->name('masterdata');
  Route::post('/school/simpan', 'save');
  Route::delete('/masterdata/hapus/{id}', 'delete');
  Route::get('/masterdata/tambah', 'input');
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
Route::get('/absensi/{id_reg}', 'absen');
Route::get('/enkripsi', 'enkripsi');
Route::get('/qrgen', 'qrgen');

});
