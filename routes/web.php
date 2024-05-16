<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\SinikimasController;
use App\Http\Controllers\pencapaianController;

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

Route::get('/login', function () {
return view('kerangka.master');
});

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware('auth');

Route::post('logout', [loginController::class, 'logout'])->name('logout');

Route::get('/', [loginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/log', [loginController::class, 'login'])->name('login.store');

Route::get('/register', [registerController::class, 'index'])->name('register');
Route::post('/regist', [registerController::class, 'store'])->name('register.store');

//pencapaian
Route::get('/data-pencapaians', [pencapaianController::class, 'pencapaian'])->name('pencapaian.pencapaian');
Route::get('/create-pencapaians', [pencapaianController::class, 'create'])->name('pencapaian.create');
Route::get('/subprogram', [pencapaianController::class, 'subprogram'])->name('pencapaian.subprogram');
Route::post('/pencapaians', [pencapaianController::class, 'store'])->name('pencapaian.store');
Route::get('/pencapaians/{pencapaian}/edit', [pencapaianController::class, 'edit'])->name('pencapaian.edit');
Route::put('/pencapaians/{pencapaian}', [PencapaianController::class, 'update'])->name('pencapaian.update');
Route::get('pencapaians/{pencapaian}/delete', [pencapaianController::class, 'delete'])->name('pencapaian.delete');
Route::get('export-data-pencapaian', [pencapaianController::class, 'exportPencapaian'])->name('pencapaian.export-data-pencapaian');
Route::get('export-data-filter/{tahun}/{keg}/{apbd}', [pencapaianController::class, 'exportPencapaianfilter'])->name('pencapaian.export-data-filter');

Route::post('/submit/{pencapaian}/user',[pencapaianController::class,'submit_user'])->name('pencapaian.submit.user');
Route::post('/submit/{pencapaian}/admin',[pencapaianController::class,'submit_admin'])->name('pencapaian.submit.admin');

//sinikimas
Route::get('/data-sinikimas', [SinikimasController::class, 'sinikimas'])->name('sinikimas.sinikimas');
Route::get('/create-sinikimas', [SinikimasController::class, 'create'])->name('sinikimas.create');
Route::get('/sinikimas/{sinikimas}/edit', [SinikimasController::class, 'edit'])->name('sinikimas.edit');
Route::post('/sinikimas/{sinikimas}/update',[SinikimasController::class,'update'])->name('sinikimas.update');
Route::get('/sinikimas/{sinikimas}/delete', [SinikimasController::class, 'delete'])->name('sinikimas.delete');

Route::get('/subsinikimas', [SinikimasController::class, 'subsinikimas'])->name('sinikimas.subsinikimas');
Route::post('/sinikimas', [SinikimasController::class, 'store'])->name('sinikimas.store');

Route::get('/export', [ExportController::class, 'index'])->name('export.index');
Route::get('/export/data', [ExportController::class, 'export'])->name('export.export');


Route::post('/submit/{sinikimas}/user',[SinikimasController::class,'submit_user'])->name('sinikimas.submit.user');
Route::post('/submit/{sinikimas}/admin',[SinikimasController::class,'submit_admin'])->name('sinikimas.submit.admin');
