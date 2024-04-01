<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\pencapaianController;
use App\Http\Controllers\registerController;
use Illuminate\Support\Facades\Route;

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
Route::post('/pencapaians/{pencapaian}/update',[pencapaianController::class,'update'])->name('pencapaian.update');
Route::delete('pencapaians/{id}', [pencapaianController::class, 'delete'])->name('pencapaian.delete');

Route::post('/submit/{pencapaian}/user',[pencapaianController::class,'submit_user'])->name('pencapaian.submit.user');
Route::post('/submit/{pencapaian}/admin',[pencapaianController::class,'submit_admin'])->name('pencapaian.submit.admin');
