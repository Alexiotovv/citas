<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\TestsController;
use App\Http\Controllers\ResultadosController;
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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/especialidades', [SpecialtyController::class, 'index']);
    Route::get('/especialidades/create', [SpecialtyController::class, 'create'])->name('create.specialty');
    Route::get('/especialidades/{specialty}/edit', [SpecialtyController::class, 'edit']);
    Route::post('/especialidades', [SpecialtyController::class, 'sendData']);
    Route::put('/especialidades/{specialty}', [SpecialtyController::class, 'update']);
    Route::delete('/especialidades/{specialty}', [SpecialtyController::class, 'destroy']);

    //Ruta de Medicos
    Route::resource('medicos','App\Http\Controllers\Admin\DoctorController');

    //Ruta de Pacientes
    Route::resource('pacientes','App\Http\Controllers\Admin\PatientController');
    Route::get('/pacientes', [PatientController::class, 'index'])->name('patients.index');

    //Ruta de Reportes
    Route::get('/reportes/citas/line', [App\Http\Controllers\Admin\ChartController::class, 'appointments']);
    Route::get('/reportes/doctors/column', [App\Http\Controllers\Admin\ChartController::class, 'doctors']);
    Route::get('/reportes/doctors/column/data', [App\Http\Controllers\Admin\ChartController::class, 'doctorsJason']);
});

//Rutas Pruebas
Route::middleware(['auth'])->group(function () {
    Route::get('/pruebas/index/{cita_id}', [TestsController::class, 'index'])->name('pruebas.index');
    Route::post('/pruebas/store/', [TestsController::class, 'store'])->name('pruebas.store');
    Route::get('/pruebas/destroy/{test_id}', [TestsController::class, 'destroy'])->name('pruebas.destroy');
    Route::get('/pruebas/edit/{test_id}', [TestsController::class, 'edit'])->name('pruebas.edit');
    Route::post('/pruebas/update/', [TestsController::class, 'update'])->name('pruebas.update');

    //Resultados
    Route::post('/resultados/store/', [ResultadosController::class, 'store'])->name('resultados.store');
    Route::get('/resultados/destroy/{resultado_id}', [ResultadosController::class, 'destroy'])->name('resultados.destroy');
    Route::get('/resultados/edit/{resultado_id}', [ResultadosController::class, 'edit'])->name('resultados.edit');
    Route::post('/resultados/update/', [ResultadosController::class, 'update'])->name('resultados.update');
});




//Rutas de Medicos
Route::middleware(['auth', 'doctor'])->group(function ()
{
    Route::get('/horario', [App\Http\Controllers\Doctor\HorarioController::class, 'edit']);
    Route::post('/horario', [App\Http\Controllers\Doctor\HorarioController::class, 'store']);
});

//Rutas de Pacientes
Route::middleware('auth')->group(function()
{
    Route::get('/reservarcitas/create', [App\Http\Controllers\AppointmentController::class, 'create']);
    Route::post('/reservarcitas', [App\Http\Controllers\AppointmentController::class, 'store']);
    Route::get('/miscitas', [App\Http\Controllers\AppointmentController::class, 'index']);
    Route::get('/miscitas/{appointments}', [App\Http\Controllers\AppointmentController::class, 'show']);
    Route::post('/miscitas/{appointments}/cancel', [App\Http\Controllers\AppointmentController::class, 'cancel']);
    Route::post('/miscitas/{appointments}/confirm', [App\Http\Controllers\AppointmentController::class, 'confirm']);

    Route::get('/miscitas/{appointments}/cancel', [App\Http\Controllers\AppointmentController::class, 'formCancel']);
    //Json
    Route::get('/especialidades/{specialty}/medicos', [App\Http\Controllers\Api\SpecialtyController::class, 'doctors']);
    Route::get('/horario/horas', [App\Http\Controllers\Api\HorarioController::class, 'hours']);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




