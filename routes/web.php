<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventoController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Calendar routes
Route::get('/evento', [EventoController::class, 'index'])->name('evento');
Route::post('/evento/agregar', [EventoController::class, 'store'])->name('evento.agregar');

Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar.index');
