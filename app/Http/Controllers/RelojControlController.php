<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\MarcaAsistencia;
use Carbon\Carbon;
use PDF;


class RelojControlController extends Controller
{
    public function vistaMarcar()
    {
        $funcionarios = Funcionario::all();
        return view('reloj.marcar', compact('funcionarios'));
    }

    public function marcar(Request $request)
    {
        $request->validate([
            'funcionario_id' => 'required|exists:funcionarios,id',
            'tipo' => 'required|in:entrada,salida',
        ]);

        $funcionario = Funcionario::find($request->funcionario_id);

        MarcaAsistencia::create([
            'funcionario_id' => $funcionario->id,
            'tipo' => $request->tipo,
            'fecha_hora' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Marca registrada correctamente');
    }

    public function estadoFuncionarios()
    {
        $hoy = Carbon::now()->toDateString();

        $activos = Funcionario::whereHas('marcaAsistencias', function ($query) use ($hoy) {
            $query->whereDate('fecha_hora', $hoy);
        })->get();

        $inactivos = Funcionario::whereDoesntHave('marcaAsistencias', function ($query) use ($hoy) {
            $query->whereDate('fecha_hora', $hoy);
        })->get();

        return view('reloj.estado', compact('activos', 'inactivos'));
    }

    public function estadoDiario()
    {
        $hoy = Carbon::now()->toDateString();

        $activos = Funcionario::whereHas('marcaAsistencias', function ($query) use ($hoy) {
            $query->whereDate('fecha_hora', $hoy);
        })->get();

        $inactivos = Funcionario::whereDoesntHave('marcaAsistencias', function ($query) use ($hoy) {
            $query->whereDate('fecha_hora', $hoy);
        })->get();

        return view('reloj.estado', compact('activos', 'inactivos'));
    }

    public function verReporte(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio') 
            ? Carbon::parse($request->input('fecha_inicio')) 
            : Carbon::now()->startOfMonth();

        $fechaFin = $request->input('fecha_fin') 
            ? Carbon::parse($request->input('fecha_fin')) 
            : Carbon::now()->endOfMonth();

        $marcas = MarcaAsistencia::with('funcionario')
            ->whereBetween('fecha_hora', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()])
            ->orderBy('fecha_hora', 'asc')
            ->get();

        return view('reporte.asistencia', compact('marcas', 'fechaInicio', 'fechaFin'));
    }

    public function exportarReportePDF(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio') 
            ? Carbon::parse($request->input('fecha_inicio')) 
            : Carbon::now()->startOfMonth();

        $fechaFin = $request->input('fecha_fin') 
            ? Carbon::parse($request->input('fecha_fin')) 
            : Carbon::now()->endOfMonth();

        $marcas = MarcaAsistencia::with('funcionario')
            ->whereBetween('fecha_hora', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()])
            ->orderBy('fecha_hora', 'asc')
            ->get();

        $pdf = PDF::loadView('reporte.pdf', compact('marcas', 'fechaInicio', 'fechaFin'));

        return $pdf->download('reporte_asistencia.pdf');
    }

    public function exportarTodosReportes()
{
    // Obtener todas las marcas de asistencia
    $marcas = MarcaAsistencia::with('funcionario')
        ->orderBy('fecha_hora', 'asc')
        ->get();

    // Crear el PDF
    $pdf = PDF::loadView('reporte.pdf', compact('marcas', 'fechaInicio', 'fechaFin'))
        ->setPaper('a4', 'landscape');

    // Descargar el archivo PDF
    return $pdf->download('reporte_asistencia_completo.pdf');

    
}
    public function reporteHorasTrabajadas(Request $request)
{
    $fechaInicio = $request->input('fecha_inicio') 
        ? Carbon::parse($request->input('fecha_inicio')) 
        : Carbon::now()->startOfMonth();

    $fechaFin = $request->input('fecha_fin') 
        ? Carbon::parse($request->input('fecha_fin')) 
        : Carbon::now()->endOfMonth();

    $funcionarios = Funcionario::with(['marcaAsistencias' => function($query) use ($fechaInicio, $fechaFin) {
        $query->whereBetween('fecha_hora', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()])
              ->orderBy('fecha_hora');
    }])->get();

    $resumen = [];

    foreach ($funcionarios as $funcionario) {
        $horasTrabajadas = 0;
        $marcas = $funcionario->marcaAsistencias;

        for ($i = 0; $i < $marcas->count(); $i++) {
            if ($marcas[$i]->tipo == 'entrada' && isset($marcas[$i + 1]) && $marcas[$i + 1]->tipo == 'salida') {
                $entrada = Carbon::parse($marcas[$i]->fecha_hora);
                $salida = Carbon::parse($marcas[$i + 1]->fecha_hora);
                $horasTrabajadas += $entrada->diffInMinutes($salida) / 60;
                $i++; // saltar la siguiente marca porque ya fue usada como salida
            }
        }

        $resumen[] = [
            'funcionario' => $funcionario->nombre,
            'horas_trabajadas' => round($horasTrabajadas, 2)
        ];
    }

    return view('reporte.horas', compact('resumen', 'fechaInicio', 'fechaFin'));
}
use Barryvdh\DomPDF\Facade\Pdf; // Asegúrate de tener esta línea arriba

public function exportarHorasPDF(Request $request)
{
    $fechaInicio = $request->input('fecha_inicio') 
        ? Carbon::parse($request->input('fecha_inicio')) 
        : Carbon::now()->startOfMonth();

    $fechaFin = $request->input('fecha_fin') 
        ? Carbon::parse($request->input('fecha_fin')) 
        : Carbon::now()->endOfMonth();

    $funcionarios = Funcionario::with(['marcaAsistencias' => function($query) use ($fechaInicio, $fechaFin) {
        $query->whereBetween('fecha_hora', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()])
              ->orderBy('fecha_hora');
    }])->get();

    $resumen = [];

    foreach ($funcionarios as $funcionario) {
        $horasTrabajadas = 0;
        $marcas = $funcionario->marcaAsistencias;

        for ($i = 0; $i < $marcas->count(); $i++) {
            if ($marcas[$i]->tipo == 'entrada' && isset($marcas[$i + 1]) && $marcas[$i + 1]->tipo == 'salida') {
                $entrada = Carbon::parse($marcas[$i]->fecha_hora);
                $salida = Carbon::parse($marcas[$i + 1]->fecha_hora);
                $horasTrabajadas += $entrada->diffInMinutes($salida) / 60;
                $i++;
            }
        }

        $resumen[] = [
            'funcionario' => $funcionario->nombre,
            'horas_trabajadas' => round($horasTrabajadas, 2)
        ];
    }

    $pdf = Pdf::loadView('reporte.horas_pdf', compact('resumen', 'fechaInicio', 'fechaFin'));
    return $pdf->download('reporte_horas_trabajadas.pdf');
}

}
