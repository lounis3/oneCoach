<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\HomeJugadorController;
use App\Http\Controllers\EntrenadorController;
use App\Http\Controllers\HomeEntrenadorController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\HomePartidoController;
use App\Http\Controllers\ArbitroController;
use App\Http\Controllers\HomeArbitroController;
use App\Http\Controllers\HomeMedicoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\HomeEstadisticaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\HomeConsultaController;

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

Route::get('/homeJugador', [HomeJugadorController::class, 'index'])->name('homeJugador');
Route::resource('/jugadores', JugadorController::class);

Route::get('/homeEntrenador', [HomeEntrenadorController::class, 'index'])->name('homeEntrenador');
Route::resource('/entrenadores', EntrenadorController::class);

Route::get('homePartido', [HomePartidoController::class, 'index'])->name('homePartido');
Route::resource('/partidos', PartidoController::class);

Route::get('/homeArbitro', [HomeArbitroController::class, 'index'])->name('homeArbitro');
Route::resource('/arbitros', ArbitroController::class);

Route::get('/homeMedico', [HomeMedicoController::class, 'index'])->name('homeMedico');
Route::resource('/medicos', MedicoController::class);

Route::get('/homeEstadistica', [HomeEstadisticaController::class, 'index'])->name('homeEstadistica');
Route::resource('/estadisticas', EstadisticaController::class);

Route::get('/homeConsulta', [HomeConsultaController::class, 'index'])->name('homeConsulta');
Route::resource('/consultas', ConsultaController::class);
