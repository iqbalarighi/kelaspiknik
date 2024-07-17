<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
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
  Route::post('/regis', 'save')->name('regis');
});

Route::controller(MasterdataController::class)->middleware('auth')->group(function () {
  Route::get('/masterdata', 'index')->name('masterdata');
});
  Route::get('/school', [MasterdataController::class, 'school'])->name('school');
  Route::post('/school/simpan', [MasterdataController::class, 'save']);

Route::get('/tambah-sekolah', function () {
    return view('masterdata.inputsekolah');
})->name('tambah-sekolah');

 Route::get('/datareg', [DataregisterController::class, 'index'])->name('datareg');
