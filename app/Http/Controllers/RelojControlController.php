<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\MarcaAsistencia;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


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
    $marcas = MarcaAsistencia::with('funcionario')
        ->orderBy('fecha_hora', 'asc')
        ->get();

    $fechaInicio = $marcas->first()?->fecha_hora ?? Carbon::now();
    $fechaFin = $marcas->last()?->fecha_hora ?? Carbon::now();

    $pdf = PDF::loadView('reporte.pdf', compact('marcas', 'fechaInicio', 'fechaFin'))
        ->setPaper('a4', 'landscape');

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

public function exportarDetalleMensualPDF(Request $request)
{
    $fechaInicio = $request->input('fecha_inicio') 
        ? Carbon::parse($request->input('fecha_inicio'))->startOfMonth()
        : Carbon::now()->startOfMonth();

    $fechaFin = $request->input('fecha_fin') 
        ? Carbon::parse($request->input('fecha_fin'))->endOfMonth()
        : Carbon::now()->endOfMonth();

    $diasDelMes = collect();
    $periodo = new \DatePeriod($fechaInicio, new \DateInterval('P1D'), $fechaFin->copy()->addDay());
    foreach ($periodo as $fecha) {
        $diasDelMes->push($fecha->format('Y-m-d'));
    }

    $funcionarios = Funcionario::with(['marcaAsistencias' => function($query) use ($fechaInicio, $fechaFin) {
        $query->whereBetween('fecha_hora', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()]);
    }])->get();

    $reporte = [];

    foreach ($funcionarios as $funcionario) {
        $dias = [];

        foreach ($diasDelMes as $dia) {
            $marcasDelDia = $funcionario->marcaAsistencias->filter(function ($marca) use ($dia) {
                return Carbon::parse($marca->fecha_hora)->format('Y-m-d') === $dia;
            });

            $asistio = $marcasDelDia->isNotEmpty();

            $horas = 0;
            $marcasOrdenadas = $marcasDelDia->sortBy('fecha_hora')->values();

            for ($i = 0; $i < $marcasOrdenadas->count(); $i++) {
                if (
                    $marcasOrdenadas[$i]->tipo == 'entrada' &&
                    isset($marcasOrdenadas[$i + 1]) &&
                    $marcasOrdenadas[$i + 1]->tipo == 'salida'
                ) {
                    $entrada = Carbon::parse($marcasOrdenadas[$i]->fecha_hora);
                    $salida = Carbon::parse($marcasOrdenadas[$i + 1]->fecha_hora);
                    $horas += $entrada->diffInMinutes($salida) / 60;
                    $i++;
                }
            }

            $dias[$dia] = [
                'asistio' => $asistio,
                'horas' => round($horas, 2)
            ];
        }

        $reporte[] = [
            'nombre' => $funcionario->nombre,
            'dias' => $dias,
        ];
    }

    $pdf = Pdf::loadView('reporte.detalle_mensual', [
        'reporte' => $reporte,
        'diasDelMes' => $diasDelMes,
        'fechaInicio' => $fechaInicio,
        'fechaFin' => $fechaFin
    ])->setPaper('a4', 'landscape');

    return $pdf->download('reporte_detalle_mensual.pdf');
}


}
