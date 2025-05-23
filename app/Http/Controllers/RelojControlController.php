<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\MarcaAsistencia;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class RelojControlController extends Controller
{
    // Vista para marcar entrada o salida
    public function vistaMarcar()
    {
        $funcionarios = Funcionario::all();
        return view('reloj.marcar', compact('funcionarios'));
    }

    // Método para registrar entrada o salida
   public function marcar(Request $request)
{
    $request->validate([
        'rut' => 'required',
    ]);

    $rutIngresado = preg_replace('/[^0-9kK]/', '', $request->input('rut'));
    $funcionario = Funcionario::where('rut', $rutIngresado)->first();

    if (!$funcionario) {
        return back()->with('error', 'Funcionario no encontrado.');
    }

    // Hora actual
    $ahora = Carbon::now();

    // Rango para ENTRADA: 06:00 - 12:00 (inclusive)
    $inicioEntrada = Carbon::createFromTime(6, 0);
    $finEntrada = Carbon::createFromTime(12, 0, 0); // Hasta exactamente las 12:00:00

    // Rango para SALIDA: 12:01 - 20:00 (inclusive)
    $inicioSalida = Carbon::createFromTime(12, 1, 0);
    $finSalida = Carbon::createFromTime(20, 0, 0);

    if ($ahora->betweenIncluded($inicioEntrada, $finEntrada)) {
        $tipo = 'entrada';
    } elseif ($ahora->betweenIncluded($inicioSalida, $finSalida)) {
        $tipo = 'salida';
    } else {
        return back()->with('error', 'Fuera del horario permitido para marcar.');
    }

    MarcaAsistencia::create([
        'funcionario_id' => $funcionario->id,
        'tipo' => $tipo,
        'fecha_hora' => $ahora,
    ]);

    return back()->with('success', "Marca registrada como $tipo para {$funcionario->nombre}");
}

    // Método para mostrar el estado de los funcionarios (activos e inactivos)
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

    // Método para ver reporte de asistencia en un rango de fechas
    public function verReporte(Request $request)
    {
        // Obtener las fechas de inicio y fin o usar las fechas por defecto
        $fechaInicio = $request->input('fecha_inicio') ? Carbon::parse($request->input('fecha_inicio')) : Carbon::now()->startOfMonth();
        $fechaFin = $request->input('fecha_fin') ? Carbon::parse($request->input('fecha_fin')) : Carbon::now()->endOfMonth();

        $marcas = MarcaAsistencia::with('funcionario')
            ->whereBetween('fecha_hora', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()])
            ->orderBy('fecha_hora', 'asc')
            ->get();

        return view('reporte.asistencia', compact('marcas', 'fechaInicio', 'fechaFin'));
    }

    // Método para exportar el reporte de asistencia a PDF
    public function exportarReportePDF(Request $request)
    {
        // Obtener las fechas de inicio y fin o usar las fechas por defecto
        $fechaInicio = $request->input('fecha_inicio') ? Carbon::parse($request->input('fecha_inicio')) : Carbon::now()->startOfMonth();
        $fechaFin = $request->input('fecha_fin') ? Carbon::parse($request->input('fecha_fin')) : Carbon::now()->endOfMonth();

        // Obtener las marcas de asistencia en el rango de fechas
        $marcas = MarcaAsistencia::with('funcionario')
            ->whereBetween('fecha_hora', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()])
            ->orderBy('fecha_hora', 'asc')
            ->get();

        // Formatear los RUTs de los funcionarios
        foreach ($marcas as $marca) {
            $marca->funcionario->rut = $this->formatearRut($marca->funcionario->rut);
        }

        // Generar el PDF
        $pdf = Pdf::loadView('reporte.pdf', compact('marcas', 'fechaInicio', 'fechaFin'));

        // Descargar el PDF generado
        return $pdf->download('reporte_asistencia.pdf');
    }

    // Método para exportar reporte de horas trabajadas a PDF
    public function exportarHorasPDF(Request $request)
    {
        // Obtener las fechas de inicio y fin o usar las fechas por defecto
        $fechaInicio = $request->input('fecha_inicio') ? Carbon::parse($request->input('fecha_inicio')) : Carbon::now()->startOfMonth();
        $fechaFin = $request->input('fecha_fin') ? Carbon::parse($request->input('fecha_fin')) : Carbon::now()->endOfMonth();

        // Obtener los funcionarios y sus marcas de asistencia
        $funcionarios = Funcionario::with(['marcaAsistencias' => function ($query) use ($fechaInicio, $fechaFin) {
            $query->whereBetween('fecha_hora', [$fechaInicio->startOfDay(), $fechaFin->endOfDay()])
                  ->orderBy('fecha_hora');
        }])->get();

        $resumen = [];

        // Calcular las horas trabajadas de cada funcionario
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

        // Generar el PDF
        $pdf = Pdf::loadView('reporte.horas_pdf', compact('resumen', 'fechaInicio', 'fechaFin'));

        // Descargar el PDF generado
        return $pdf->download('reporte_horas_trabajadas.pdf');
    }

    // Función para formatear el RUT con puntos y guion
    private function formatearRut($rut)
    {
        // Eliminar caracteres no numéricos ni la letra del RUT
        $rut = preg_replace('/[^0-9kK]/', '', $rut);

        // Separar el número del RUT y el dígito verificador
        $cuerpoRut = substr($rut, 0, -1);  // El número del RUT
        $dv = substr($rut, -1);  // El dígito verificador

        // Agregar puntos y guion
        $rutFormateado = number_format($cuerpoRut, 0, '', '.');  // Añadir puntos
        $rutFormateado .= '-' . strtoupper($dv);  // Añadir el guion y el dígito verificador

        return $rutFormateado;
    }

    // Método para reporte de horas trabajadas
    public function reporteHorasTrabajadas(Request $request)
    {
        // Obtener fechas o usar las fechas por defecto
        $fechaInicio = $request->input('fecha_inicio') ? Carbon::parse($request->input('fecha_inicio')) : Carbon::now()->startOfMonth();
        $fechaFin = $request->input('fecha_fin') ? Carbon::parse($request->input('fecha_fin')) : Carbon::now()->endOfMonth();

        // Obtener los funcionarios y sus marcas de asistencia
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
