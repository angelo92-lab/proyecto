<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

use App\Http\Controllers\AnotacionController;

Route::get('agregaranotacion', [AnotacionController::class, 'index'])->name('anotacion.index');
Route::post('agregaranotacion', [AnotacionController::class, 'store'])->name('anotacion.store');

use App\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('cerrarsesion', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\AlumnoController;

Route::get('alumnoscasino', [AlumnoController::class, 'index'])->name('alumnos.index');

use App\Http\Controllers\AnotacionesController;

Route::get('anotaciones', [AnotacionesController::class, 'index'])->name('anotaciones.index');

use App\Http\Controllers\MarcarAlmuerzoController;

Route::get('marcaralmuerzo', [MarcarAlmuerzoController::class, 'index'])->name('marcaralmuerzo.index');
Route::post('marcaralmuerzo', [MarcarAlmuerzoController::class, 'store'])->name('marcaralmuerzo.store');


use App\Http\Controllers\ReportsController;

    Route::get('/reports', [ReportsController::class, 'index'])->name('reportes.index');
    Route::post('/reports/generate', [ReportsController::class, 'generate'])->name('reports.generate');
    Route::post('/reports/export-csv', [ReportsController::class, 'exportCsv'])->name('reports.exportCsv');
    Route::post('/reports/export-pdf', [ReportsController::class, 'exportPdf'])->name('reports.exportPdf');

