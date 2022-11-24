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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Manejo de funcionarios
Route::get('/listaFuncionarios', [App\Http\Controllers\MatriculaController::class, 'index'])->name('listaFuncionarios');
Route::get('/registrar/funcionario/{id}', [App\Http\Controllers\MatriculaController::class, 'registrar_funcionario'])->name('registrarFuncionario');
Route::get('/crear/funcionario', [App\Http\Controllers\MatriculaController::class, 'crear_funcionario'])->name('crearFuncionario');
Route::post('/guardar/funcionario/', [App\Http\Controllers\MatriculaController::class, 'guardar_funcionario'])->name('guardarNuevoFuncionario');

//Instrumento - Cuestionario de Clima
Route::get('/cuestionario-de-clima', [App\Http\Controllers\CuestionarioClima::class, 'index'])->name('cuestionarioClima');
Route::post('/guardar/cuestionario/clima', [App\Http\Controllers\CuestionarioClima::class, 'guardarCuestionarioClima'])->name('guardarCuestionarioClima');
Route::get('/traerRespuestas/cuestionario/clima', [App\Http\Controllers\CuestionarioClima::class, 'traerRespuestas'])->name('traerRespuestas');
Route::get('/estudio/clima', [App\Http\Controllers\CuestionarioClima::class, 'vistaEstudio'])->name('vistaEstudio');