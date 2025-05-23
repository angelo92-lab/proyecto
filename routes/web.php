<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\AnotacionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AnotacionesController;
use App\Http\Controllers\MarcarAlmuerzoController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ClimaController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\RelojControlController;
use App\Http\Controllers\FuncionarioPortalController;
use App\Http\Controllers\NotaImportController;
use App\Http\Controllers\PlanAcompanamientoController;
use App\Http\Controllers\UserController;

// Ruta pública principal
Route::get('/', function () {
    return view('index');
});

// Rutas anotaciones
Route::get('agregaranotacion', [AnotacionController::class, 'index'])->name('anotacion.index');
Route::post('agregaranotacion', [AnotacionController::class, 'store'])->name('anotacion.store');

// Rutas autenticación
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('cerrarsesion', [AuthController::class, 'logout'])->name('logout');

// Rutas alumnos y anotaciones
Route::get('alumnoscasino', [AlumnoController::class, 'index'])->name('alumnos.index');
Route::get('anotaciones', [AnotacionesController::class, 'index'])->name('anotaciones.index');

// Rutas marcar almuerzo
Route::get('marcaralmuerzo', [MarcarAlmuerzoController::class, 'index'])->name('marcaralmuerzo.index');
Route::post('marcaralmuerzo', [MarcarAlmuerzoController::class, 'store'])->name('marcaralmuerzo.store');

// Rutas reportes
Route::get('/reportes', [ReportsController::class, 'index'])->name('reportes.index');
Route::post('/reports/generate', [ReportsController::class, 'generate'])->name('reports.generate');
Route::post('/reports/export-csv', [ReportsController::class, 'exportCsv'])->name('reports.exportCsv');
Route::post('/reports/export-pdf', [ReportsController::class, 'exportPdf'])->name('reports.exportPdf');

// Clima
Route::get('/tiempo', [ClimaController::class, 'showTemperature'])->name('clima');

// Funcionario importación
Route::get('/importar-funcionarios', [FuncionarioController::class, 'formImportar']);
Route::post('/importar-funcionarios', [FuncionarioController::class, 'importar']);

// Reloj control
Route::get('/marcar', [RelojControlController::class, 'vistaMarcar'])->name('vistaMarcar');
Route::post('/reloj-control', [RelojControlController::class, 'marcar']);
Route::get('/reloj/estado', [RelojControlController::class, 'estadoFuncionarios'])->name('reloj.estado');

// Buscar funcionario
Route::get('/buscar-funcionario/{rut}', [FuncionarioController::class, 'buscarFuncionario']);

// Reportes asistencia y horas
Route::get('/reporte-asistencia', [RelojControlController::class, 'verReporte'])->name('reporte.asistencia');
Route::post('/reporte/exportar', [RelojControlController::class, 'exportarReportePDF'])->name('reporte.exportar');
Route::get('/reporte/exportar/todos', [RelojControlController::class, 'exportarTodosReportes'])->name('reporte.exportar.todos');
Route::get('/reporte/horas', [RelojControlController::class, 'reporteHorasTrabajadas'])->name('reporte.horas');
Route::get('/reporte/horas/pdf', [RelojControlController::class, 'exportarHorasPDF'])->name('reporte.horas.pdf');
Route::get('/reporte/funcionarios/detalle-mensual', [RelojControlController::class, 'exportarDetalleMensualPDF'])->name('funcionarios.reporte.detalle_mensual');

// Rutas que requieren autenticación y middleware para verificar funcionario
Route::middleware(['auth', 'verificarfuncionario'])->group(function () {

    // Portal funcionarios y notas (exclusivo para funcionarios)
    Route::get('/portal-funcionarios', [FuncionarioPortalController::class, 'index'])->name('portal.funcionarios');
    Route::get('/notas', [FuncionarioPortalController::class, 'verNotas'])->name('notas.alumnos');
    Route::get('/notas/nt1', [FuncionarioPortalController::class, 'notasNT1'])->name('notas.nt1');
    Route::get('/notas/nt2', [FuncionarioPortalController::class, 'notasNT2'])->name('notas.nt2');
    Route::get('/notas/media', [FuncionarioPortalController::class, 'notasMedia'])->name('notas.media');
});

// Importar notas
Route::get('/notas/importar', [NotaImportController::class, 'form'])->name('notas.importar.form');
Route::post('/notas/importar', [NotaImportController::class, 'store'])->name('notas.importar.store');

// Plan acompañamiento
Route::get('/plan/importar', function () {
    return view('plan.import');
})->name('plan.import.view');

Route::post('/plan/import', [PlanAcompanamientoController::class, 'import'])->name('plan.import');

// Otras secciones públicas o con rutas sin middleware específico
Route::get('/apoyo-psico-social', [App\Http\Controllers\ApoyoPsicoSocialController::class, 'index'])->name('apoyo.index');
Route::get('/capacitaciones', [App\Http\Controllers\CapacitacionesController::class, 'index'])->name('capacitaciones.index');
Route::get('/encuestas', [App\Http\Controllers\EncuestasController::class, 'index'])->name('encuestas.index');
Route::get('/listados', [App\Http\Controllers\ListadosController::class, 'index'])->name('listados.index');
Route::get('/movimiento-financiero-sep', [App\Http\Controllers\MovimientoFinancieroSepController::class, 'index'])->name('sep.index');
Route::get('/planes-normativos', [App\Http\Controllers\PlanesNormativosController::class, 'index'])->name('normativos.index');
Route::get('/unidad-tecnica-pedagogica', [App\Http\Controllers\UnidadTecnicaPedagogicaController::class, 'index'])->name('utp.index');

Route::middleware(['auth', 'verificarfuncionario'])->group(function () {

    // Funcionario: vistas adicionales
    Route::get('/funcionarios/informacion', function () {
        return view('funcionarios.informacion');
    })->name('funcionarios.informacion');

    Route::get('/funcionarios/encuestas', function () {
        return view('funcionarios.encuestas');
    })->name('funcionarios.encuestas');

    Route::get('/funcionarios/planes-normativos', function () {
        return view('funcionarios.planes-normativos');
    })->name('funcionarios.planes-normativos');

    // UTP
    Route::get('/funcionarios/utp', function () {
        return view('funcionarios.utp.index');
    })->name('utp.index');

    Route::get('/funcionarios/utp/formatos', function () {
        return view('funcionarios.utp.formatos');
    })->name('utp.formatos');

    Route::get('/funcionarios/utp/resultados', function () {
        return view('funcionarios.utp.resultados');
    })->name('utp.resultados');

    Route::get('/funcionarios/utp/resultados/parvularia', function () {
        return view('funcionarios.utp.resultados-parvularia');
    })->name('utp.resultados.parvularia');

    Route::get('/funcionarios/utp/lineamientos', function () {
        return view('funcionarios.utp.lineamientos');
    })->name('utp.lineamientos');

    Route::get('/funcionarios/utp/resultados/diagnostico', function () {
        $rutaBase = public_path('documentos/utp/resultados_diagnostico');

        if (!File::exists($rutaBase)) {
            abort(404, "La carpeta de resultados no existe.");
        }

        $archivosGenerales = collect(File::files($rutaBase))
            ->filter(fn($file) => $file->isFile())
            ->map(fn($file) => $file->getBasename())
            ->sort()
            ->values();

        $carpetas = collect(File::directories($rutaBase))
            ->sort()
            ->values()
            ->map(function ($path) {
                $archivos = collect(File::files($path))
                    ->filter(fn($f) => $f->isFile())
                    ->map(fn($f) => $f->getBasename())
                    ->sort()
                    ->values();

                $subcarpetas = collect(File::directories($path))
                    ->sort()
                    ->values()
                    ->map(function ($sub) {
                        return [
                            'nombre' => basename($sub),
                            'archivos' => collect(File::files($sub))
                                ->map(fn($f) => $f->getBasename())
                                ->sort()
                                ->values(),
                        ];
                    });

                return [
                    'nombre' => basename($path),
                    'archivos' => $archivos,
                    'subcarpetas' => $subcarpetas,
                ];
            });

        return view('funcionarios.utp.resultados_diagnostico', compact('archivosGenerales', 'carpetas'));
    })->name('utp.resultados.diagnostico');

});


// Rutas usuarios protegidas por auth
Route::middleware(['auth'])->group(function () {
    Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('usuarios.update');
});
