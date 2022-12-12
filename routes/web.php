<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return view('auth.login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\CuestionarioClima::class, 'datosDashboardClima'])->name('home');


//Manejo de funcionarios
Route::get('/listaFuncionarios', [App\Http\Controllers\MatriculaController::class, 'index'])->name('listaFuncionarios');
Route::get('/registrar/funcionario/{id}', [App\Http\Controllers\MatriculaController::class, 'registrar_funcionario'])->name('registrarFuncionario');
Route::get('/crear/funcionario', [App\Http\Controllers\MatriculaController::class, 'crear_funcionario'])->name('crearFuncionario');
Route::post('/guardar/funcionario/', [App\Http\Controllers\MatriculaController::class, 'guardar_funcionario'])->name('guardarNuevoFuncionario');

//Pasarela
Route::get('autenticacion/moodle', [App\Http\Controllers\CuestionarioClima::class, 'pasarelaMoodle'])->name('pasarelaMoodle');
Route::post('cuestionario/clima', [App\Http\Controllers\CuestionarioClima::class, 'verificarFuncionarioMoodle'])->name('verificarFuncionarioMoodle');

//Instrumento - Cuestionario de Clima
Route::get('/cuestionario-de-clima', [App\Http\Controllers\CuestionarioClima::class, 'index'])->name('cuestionarioClima');
Route::post('/guardar/cuestionario/clima', [App\Http\Controllers\CuestionarioClima::class, 'guardarCuestionarioClima'])->name('guardarCuestionarioClima');
Route::get('/finalizar/cuestionario/clima/{id}', [App\Http\Controllers\CuestionarioClima::class, 'cuestionarioFinalizado'])->name('cuestionarioFinalizado');
Route::get('/traerRespuestas/cuestionario/clima', [App\Http\Controllers\CuestionarioClima::class, 'traerRespuestas'])->name('traerRespuestas');
Route::get('/estudio/clima/intervencion/{id}', [App\Http\Controllers\CuestionarioClima::class, 'vistaEstudio'])->name('vistaEstudio');

//Intervenciones
Route::get('/intervenciones', [App\Http\Controllers\IntervencionController::class, 'index'])->name('listaIntervenciones');
Route::get('/intervenciones/crear', [App\Http\Controllers\IntervencionController::class, 'crearIntervencion'])->name('crearIntervencion');
Route::post('/intervenciones/registrar', [App\Http\Controllers\IntervencionController::class, 'registrarIntervencion'])->name('registrarIntervencion');
Route::get('/intervenciones/finalizar/{id}', [App\Http\Controllers\IntervencionController::class, 'finalizarIntervencion'])->name('finalizarIntervencion');


//Estudio
Route::get('/estudio/clima/intervencion', [App\Http\Controllers\EstudioController::class, 'index'])->name('listarEstudios');
