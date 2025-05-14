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

    Route::get('/reportes', [ReportsController::class, 'index'])->name('reportes.index');
    Route::post('/reports/generate', [ReportsController::class, 'generate'])->name('reports.generate');
    Route::post('/reports/export-csv', [ReportsController::class, 'exportCsv'])->name('reports.exportCsv');
    Route::post('/reports/export-pdf', [ReportsController::class, 'exportPdf'])->name('reports.exportPdf'); 


   use App\Http\Controllers\ClimaController;

   Route::get('/tiempo', [ClimaController::class, 'showTemperature'])->name('clima');
       
use App\Http\Controllers\FuncionarioController;

Route::get('/importar-funcionarios', [FuncionarioController::class, 'formImportar']);
Route::post('/importar-funcionarios', [FuncionarioController::class, 'importar']);

use App\Http\Controllers\RelojControlController;

Route::get('/reloj-control', [RelojControlController::class, 'vistaMarcar']);
Route::post('/reloj-control', [RelojControlController::class, 'marcar']);

Route::get('/reloj/estado', [RelojControlController::class, 'estadoFuncionarios'])->name('reloj.estado');
 


use App\Models\Funcionario;


Route::get('/buscar-funcionario/{rut}', function ($rut) {
    $funcionario = Funcionario::where('rut', $rut)->first();

    if ($funcionario) {
        return response()->json(['success' => true, 'funcionario' => $funcionario]);
    } else {
        return response()->json(['success' => false]);
    }
});

Route::get('/reporte-asistencia', [RelojControlController::class, 'verReporte'])->name('reporte.asistencia');
Route::post('/reporte/exportar', [RelojControlController::class, 'exportarReportePDF'])->name('reporte.exportar');
Route::get('/reporte/exportar/todos', [RelojControlController::class, 'exportarTodosReportes'])->name('reporte.exportar.todos');


