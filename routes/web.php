<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SpecialtyController;
// use App\Http\Controllers\Admin\ChartController;
// use App\Http\Controllers\Doctor\HorarioController;
// use App\Http\Controllers\AppointmentController;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    //Rutas Especialidades
    Route::get('/especialidades', [SpecialtyController::class, 'index']);


    Route::get('/especialidades/create', [SpecialtyController::class, 'create'])->name('create.specialty');
    Route::get('/especialidades/{specialty}/edit', [SpecialtyController::class, 'edit']);
    Route::post('/especialidades', [SpecialtyController::class, 'sendData']);
    Route::put('/especialidades/{specialty}', [SpecialtyController::class, 'update']);
    Route::delete('/especialidades/{specialty}', [SpecialtyController::class, 'destroy']);

    //Rutas Médicos
    Route::resource('medicos', 'App\Http\Controllers\Admin\DoctorController');

    //Rutas Pacientes
    Route::resource('pacientes', 'App\Http\Controllers\Admin\PatientController');

    //Rutas Reportes
    Route::get('/reportes/citas/line', [App\Http\Controllers\Admin\ChartController::class, 'appointments']);
    Route::get('/reportes/doctors/column', [App\Http\Controllers\Admin\ChartController::class, 'doctors']);

    Route::get('/reportes/doctors/column/data', [App\Http\Controllers\Admin\ChartController::class, 'doctorsJson']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/horario/{id_doctor}', [App\Http\Controllers\Doctor\HorarioController::class, 'edit']);
    Route::post('/horario', [App\Http\Controllers\Doctor\HorarioController::class, 'store']);

});

Route::middleware('auth')->group(function(){
   
    Route::get('/reservarcitas/create', [App\Http\Controllers\AppointmentController::class, 'create'])->name('create.cita');
    Route::post('/reservarcitas', [App\Http\Controllers\AppointmentController::class, 'store']);
    Route::get('/miscitas', [App\Http\Controllers\AppointmentController::class, 'index']);
    Route::get('/miscitas/{appointment}', [App\Http\Controllers\AppointmentController::class, 'show']);
    Route::post('/miscitas/{appointment}/cancel', [App\Http\Controllers\AppointmentController::class, 'cancel']);
    Route::post('/miscitas/{appointment}/confirm', [App\Http\Controllers\AppointmentController::class, 'confirm']);

    Route::get('/miscitas/{appointment}/cancel', [App\Http\Controllers\AppointmentController::class, 'formCancel']);
    
    //JSON
    Route::get('/especialidades/{specialty}/medicos', [App\Http\Controllers\Api\SpecialtyController::class, 'doctors']);
    Route::get('/horario/horas', [App\Http\Controllers\Api\HorarioController::class, 'hours']); 

});
