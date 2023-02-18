<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SociosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Route::get('/socios', function () {
//     $sociosController = App::make('App\Http\Controllers\SociosController');
//     return $sociosController->callAction('index', []);
// })->name('socios.index'); 
// ESTO ES IGUAL A
// Route::get('/socios', [SociosController::class, 'index'])->name('socios.index');

Route::get('/socios', [SociosController::class, 'index'])->name('socios.index');
Route::get('/socios/{id}/edit', [SociosController::class, 'edit'])->name('socios.edit');
Route::put('/socios/{id}', [SociosController::class, 'update'])->name('socios.update');
Route::delete('/socios/{id}', [SociosController::class, 'destroy'])->name('socios.destroy');
