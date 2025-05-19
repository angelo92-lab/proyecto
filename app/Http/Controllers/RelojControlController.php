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
        'rut' => 'required',
        'tipo' => 'required|in:entrada,salida',
    ]);

    $rutIngresado = preg_replace('/[^0-9kK]/', '', $request->input('rut'));
    $funcionario = Funcionario::where('rut', $rutIngresado)->first();

    if (!$funcionario) {
        return response()->json(['success' => false, 'message' => 'Funcionario no encontrado'], 404);
    }

    MarcaAsistencia::create([
        'funcionario_id' => $funcionario->id,
        'tipo' => $request->tipo,
        'fecha_hora' => now(),
    ]);

    return response()->json(['success' => true]);
}

    // Función para ver el estado de los funcionarios (activos e inactivos)
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

    
public function verReporte(Request $request)
{
    $fechaInicio = $request->input('fecha_inicio');
    $fechaFin = $request->input('fecha_fin');

    // Convertir a objetos Carbon si vienen como string
    if (!$fechaInicio instanceof Carbon) {
        $fechaInicio = $fechaInicio ? Carbon::parse($fechaInicio) : Carbon::now()->startOfMonth();
    }

    if (!$fechaFin instanceof Carbon) {
        $fechaFin = $fechaFin ? Carbon::parse($fechaFin) : Carbon::now()->endOfMonth();
    }

    $marcas = MarcaAsistencia::with('funcionario')
        ->whereBetween('fecha_hora', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()])
        ->orderBy('fecha_hora', 'asc')
        ->get();

    return view('reporte.asistencia', compact('marcas', 'fechaInicio', 'fechaFin'));
}


    // Función para exportar reporte de asistencia a PDF
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

        // Formateamos los RUTs para que aparezcan con puntos y guion
        foreach ($marcas as $marca) {
            $marca->funcionario->rut = $this->formatearRut($marca->funcionario->rut);
        }

        // Generando el PDF
        $pdf = Pdf::loadView('reporte.pdf', compact('marcas', 'fechaInicio', 'fechaFin'));

        // Descarga el PDF generado
        return $pdf->download('reporte_asistencia.pdf');
    }

    // Función para exportar reporte de horas trabajadas a PDF
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

        // Formateamos los RUTs para que aparezcan con puntos y guion
        foreach ($resumen as $key => $value) {
            $resumen[$key]['rut'] = $this->formatearRut($value['funcionario']->rut);
        }

        $pdf = Pdf::loadView('reporte.horas_pdf', compact('resumen', 'fechaInicio', 'fechaFin'));
        return $pdf->download('reporte_horas_trabajadas.pdf');
    }

    // Función para exportar reporte detallado mensual a PDF
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

                $dias[] = [
                    'dia' => $dia,
                    'asistio' => $asistio,
                    'horas' => round($horas, 2)
                ];
            }

            $reporte[] = [
                'nombre' => $funcionario->nombre,
                'rut' => $this->formatearRut($funcionario->rut),
                'dias' => $dias,
            ];
        }

        // Generamos el PDF
        $pdf = Pdf::loadView('reporte.detalle_mensual', compact('reporte', 'fechaInicio', 'fechaFin'));
        return $pdf->download('reporte_detalle_mensual.pdf');
    }

    // Función para formatear el RUT con puntos y guion
    private function formatearRut($rut)
    {
        // Elimina los caracteres que no sean números ni la letra del RUT
        $rut = preg_replace('/[^0-9kK]/', '', $rut);

        // Separa el número del RUT y el dígito verificador
        $cuerpoRut = substr($rut, 0, -1);  // El número del RUT
        $dv = substr($rut, -1);  // El dígito verificador

        // Agrega puntos y guion
        $rutFormateado = number_format($cuerpoRut, 0, '', '.');  // Añade los puntos
        $rutFormateado .= '-' . strtoupper($dv);  // Añade el guion y el dígito verificador

        return $rutFormateado;
    }

    public function reporteHorasTrabajadas(Request $request)
{
    // Obtener las fechas de inicio y fin del formulario, o usar las fechas por defecto
    $fechaInicio = $request->input('fecha_inicio') ? Carbon::parse($request->input('fecha_inicio')) : Carbon::now()->startOfMonth();
    $fechaFin = $request->input('fecha_fin') ? Carbon::parse($request->input('fecha_fin')) : Carbon::now()->endOfMonth();

    // Obtener los funcionarios con las marcas de asistencia entre las fechas seleccionadas
    $funcionarios = Funcionario::with(['marcaAsistencias' => function ($query) use ($fechaInicio, $fechaFin) {
        $query->whereBetween('fecha_hora', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()]);
    }])->get();

    // Resumen de horas trabajadas
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
            'horas_trabajadas' => round($horasTrabajadas, 2),
        ];
    }

    // Pasamos las variables a la vista
    return view('reporte.horas', compact('resumen', 'fechaInicio', 'fechaFin'));
}

}
