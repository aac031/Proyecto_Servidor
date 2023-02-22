<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CentrosController;
use App\Http\Controllers\SociosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TreatmentsController;

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

// Para ver directamente el login al abrir el proyecto
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/socios', [SociosController::class, 'index'])->name('socios.index')->middleware('auth');
Route::get('/socios/nuevo', [SociosController::class, 'create'])->name('socios.create')->middleware('auth');
Route::post('/socios', [SociosController::class, 'store'])->name('socios.store')->middleware('auth');
Route::get('/socios/{id}', [SociosController::class, 'show'])->name('socios.show')->middleware('auth');
Route::get('/socios/{id}/edit', [SociosController::class, 'edit'])->name('socios.edit')->middleware('auth');
Route::put('/socios/{id}', [SociosController::class, 'update'])->name('socios.update')->middleware('auth');
Route::delete('/socios/{id}', [SociosController::class, 'destroy'])->name('socios.destroy')->middleware('auth');

Route::get('/treatments', [TreatmentsController::class, 'getTreatments'])->name('treatments.getTreatments')->middleware('auth');
Route::post('/treatments', [TreatmentsController::class, 'store'])->name('treatments.store')->middleware('auth');

// Route::post('/socios/{id}/treatments', [TreatmentsController::class, 'store'])->name('socios.treatments.store')->middleware('auth');
// Route::delete('/socios/{socio}/treatments/{socioTreatmentId}', [TreatmentsController::class, 'destroy'])->name('socio.treatments.destroy')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::post('/socios/{id}/treatments', [TreatmentsController::class, 'store'])->name('socios.treatments.store');
    Route::delete('/socios/{socio}/treatments/{socioTreatmentId}', [TreatmentsController::class, 'destroy'])->name('socio.treatments.destroy');
});
