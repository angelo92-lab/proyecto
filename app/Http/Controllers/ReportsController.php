<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PDF;
use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index()
    {
        $courses = DB::table('colegio20252')->select('Curso')->distinct()->orderBy('Curso')->pluck('Curso');
        return view('reportes', compact('courses'));
    }

    public function generate(Request $request)
    {
        // Obtener el tipo de reporte desde la solicitud
        $reportType = $request->input('report_type');

        if ($reportType == 'course') {
            // Validación de los campos de curso
            $validated = $request->validate([
                'curso' => 'required|string',
                'date_filter_type' => 'required|in:day,month',
                'date' => 'required|date',
            ]);

            $curso = $validated['curso'];
            $dateFilterType = $validated['date_filter_type'];
            $date = $validated['date'];

            // Calcular el rango de fechas basado en el tipo de filtro
            $dateStart = $dateFilterType == 'day' ? $date : date('Y-m-01', strtotime($date));
            $dateEnd = $dateFilterType == 'day' ? $date : date('Y-m-t', strtotime($date));

            // Obtener los estudiantes del curso
            $students = DB::table('colegio20252')
                ->where('Curso', $curso)
                ->select('Run', 'Nombres', DB::raw('`Digito Ver` as digito_ver'), 'Celular', 'Curso')
                ->orderBy('Nombres')
                ->get();

            $ruts = $students->pluck('Run');

            // Obtener los almuerzos de los estudiantes en el rango de fechas
            $lunchRecords = DB::table('almuerzos')
                ->whereIn('rut_alumno', $ruts)
                ->whereBetween('fecha', [$dateStart, $dateEnd])
                ->get()
                ->groupBy('rut_alumno');

            // Preparar los datos para el reporte
            $reportData = [];
            foreach ($students as $student) {
                $hadLunch = isset($lunchRecords[$student->Run]) && $lunchRecords[$student->Run]->contains('almorzo', 1);
                $reportData[] = [
                    'nombres' => $student->Nombres,
                    'rut' => $student->Run,
                    'digito_ver' => $student->digito_ver,
                    'celular' => $student->Celular,
                    'curso' => $student->Curso,
                    'almorzo' => $hadLunch ? 'Sí' : 'No',
                ];
            }

            // Generar el PDF
            $pdf = PDF::loadView('pdf.reporte_curso', [
                'reportData' => $reportData,
                'curso' => $curso,
                'date' => $date,
                'dateFilterType' => $dateFilterType,
            ])->setPaper('a4', 'landscape');

            // Descargar el PDF
            return $pdf->download('reporte_curso.pdf');
        }

        if ($reportType == 'student') {
            // Validación de los campos de alumno
            $validated = $request->validate([
                'student_name' => 'required|string',
                'month' => 'required|date_format:Y-m',
            ]);

            $studentName = $validated['student_name'];
            $month = $validated['month'];

            // Buscar el estudiante por nombre
            $student = DB::table('colegio20252')
                ->where('Nombres', 'like', "%$studentName%")
                ->first();

            if (!$student) {
                return back()->with('error', 'Estudiante no encontrado');
            }

            // Obtener el registro de almuerzos del estudiante
            $lunchRecords = DB::table('almuerzos')
                ->where('rut_alumno', $student->Run)
                ->whereMonth('fecha', '=', date('m', strtotime($month)))
                ->whereYear('fecha', '=', date('Y', strtotime($month)))
                ->get();

            // Preparar los datos para el reporte
            $reportData = [
                'student' => $student,
                'lunchRecords' => $lunchRecords,
            ];

            // Generar el PDF
            $pdf = PDF::loadView('pdf.reporte_alumno', [
                'reportData' => $reportData,
                'student' => $student,
                'month' => $month,
            ])->setPaper('a4', 'landscape');

            // Descargar el PDF
            return $pdf->download('reporte_alumno.pdf');
        }

        // Si no se ha seleccionado un tipo de reporte válido
        return back()->with('error', 'Seleccione un tipo de reporte válido');
    }

    public function exportCsv(Request $request)
    {
        $type = $request->input('report_type');

        if ($type == 'course') {
            $curso = $request->input('curso');
            $dateFilterType = $request->input('date_filter_type');
            $date = $request->input('date');

            $dateStart = $dateFilterType == 'day' ? $date : date('Y-m-01', strtotime($date));
            $dateEnd = $dateFilterType == 'day' ? $date : date('Y-m-t', strtotime($date));

            $students = DB::table('colegio20252')
                ->where('Curso', $curso)
                ->select('Run', 'Nombres', DB::raw('`Digito Ver` as digito_ver'), 'Celular', 'Curso')
                ->orderBy('Nombres')
                ->get();

            $ruts = $students->pluck('Run');

            $lunchRecords = DB::table('almuerzos')
                ->whereIn('rut_alumno', $ruts)
                ->whereBetween('fecha', [$dateStart, $dateEnd])
                ->get()
                ->groupBy('rut_alumno');

            $reportData = [];

            foreach ($students as $student) {
                $hadLunch = isset($lunchRecords[$student->Run]) && $lunchRecords[$student->Run]->contains('almorzo', 1);
                $reportData[] = [
                    'Nombres' => $student->Nombres,
                    'RUT' => $student->Run,
                    'Dígito Verificador' => $student->digito_ver,
                    'Celular' => $student->Celular,
                    'Curso' => $student->Curso,
                    'Almorzó' => $hadLunch ? 'Sí' : 'No',
                ];
            }

            $filename = "reporte_curso_{$curso}_" . str_replace('-', '_', $date) . ".csv";

            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename={$filename}",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ];

            $callback = function () use ($reportData) {
                $file = fopen('php://output', 'w');
                fputcsv($file, array_keys($reportData[0]));
                foreach ($reportData as $row) {
                    fputcsv($file, $row);
                }
                fclose($file);
            };

            return Response::stream($callback, 200, $headers);
        }

        elseif ($type == 'student') {
            $studentName = $request->input('student_name');
            $month = $request->input('month');

            $student = DB::table('colegio20252')
                ->where('Nombres', 'like', "%$studentName%")
                ->first();

            if (!$student) {
                return redirect()->back()->with('error', 'Alumno no encontrado.');
            }

            $dateStart = date('Y-m-01', strtotime($month));
            $dateEnd = date('Y-m-t', strtotime($month));

            $count = DB::table('almuerzos')
                ->where('rut_alumno', $student->Run)
                ->whereBetween('fecha', [$dateStart, $dateEnd])
                ->where(function ($q) {
                    $q->where('almorzo', true)->orWhere('almorzo', 1);
                })
                ->count();

            $filename = "reporte_alumno_{$student->Nombres}_" . str_replace('-', '_', $month) . ".csv";

            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename={$filename}",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ];

            $callback = function () use ($student, $count, $month) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['Alumno', 'Mes', 'Cantidad de veces almorzó']);
                fputcsv($file, [$student->Nombres, $month, $count]);
                fclose($file);
            };

            return Response::stream($callback, 200, $headers);
        }

        return back()->with('error', 'Tipo de reporte no válido');
    }

   public function exportPdf(Request $request)
{
    $type = $request->input('report_type');

    if ($type == 'course') {
        $curso = $request->input('curso');
        $dateFilterType = $request->input('date_filter_type');
        $date = $request->input('date');

        // Calcular fechas de inicio y fin
        $dateStart = $dateFilterType == 'day' ? $date : date('Y-m-01', strtotime($date));
        $dateEnd = $dateFilterType == 'day' ? $date : date('Y-m-t', strtotime($date));

        // Generar lista de días
        $startDate = new DateTime($dateStart);
        $endDate = new DateTime($dateEnd);
        $endDate->modify('+1 day'); // incluir último día
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($startDate, $interval, $endDate);
        $days = iterator_to_array($period); // array de DateTime

        // Obtener estudiantes
        $students = DB::table('colegio20252')
            ->where('Curso', $curso)
            ->select('Run', 'Nombres', DB::raw('`Digito Ver` as digito_ver'), 'Celular', 'Curso')
            ->orderBy('Nombres')
            ->get();

        $ruts = $students->pluck('Run');

        // Obtener almuerzos
        $lunches = DB::table('almuerzos')
            ->whereIn('rut_alumno', $ruts)
            ->whereBetween('fecha', [$dateStart, $dateEnd])
            ->get();

        // Mapear almuerzos por rut y fecha
        $lunchMap = [];
        foreach ($lunches as $lunch) {
            $lunchMap[$lunch->rut_alumno][$lunch->fecha] = true;
        }

        // Preparar datos para la vista
        $reportData = [];
        foreach ($students as $student) {
            // Asegurar que el estudiante tenga datos válidos
            if (!$student->Nombres || !$student->Run) {
                continue; // omitir si falta info clave
            }

            $row = [
                'Nombres' => $student->Nombres,
                'RUT' => $student->Run,
                'DigitoVer' => $student->digito_ver,
                'Celular' => $student->Celular,
                'Curso' => $student->Curso,
                'Dias' => []
            ];

            foreach ($days as $day) {
                $fecha = $day->format('Y-m-d');
                $row['Dias'][$fecha] = isset($lunchMap[$student->Run][$fecha]) ? '✓' : '✗';
            }

            $reportData[] = $row;
        }

// Generar el reporte
dd($reportData); // Esto te permitirá ver cómo es la estructura de los datos

$pdf = PDF::loadView('pdf.reporte_curso', [
    'reportData' => $reportData,
    'curso' => $curso,
    'date' => $date,
    'dateFilterType' => $dateFilterType,
    'days' => $days,
])->setPaper('a4', 'landscape');

return $pdf->download('reporte_curso.pdf');
    }



        if ($type == 'student') {
            $studentName = $request->input('student_name');
            $month = $request->input('month');

            $student = DB::table('colegio20252')
                ->where('Nombres', 'like', "%$studentName%")
                ->first();

            if (!$student) {
                return back()->with('error', 'Estudiante no encontrado');
            }

            $lunchRecords = DB::table('almuerzos')
                ->where('rut_alumno', $student->Run)
                ->whereMonth('fecha', '=', date('m', strtotime($month)))
                ->whereYear('fecha', '=', date('Y', strtotime($month)))
                ->get();

            $reportData = [
                'student' => $student,
                'lunchRecords' => $lunchRecords,
            ];

            $pdf = PDF::loadView('pdf.reporte_alumno', [
                'reportData' => $reportData,
                'student' => $student,
                'month' => $month,
            ])->setPaper('a4', 'landscape');

            return $pdf->download('reporte_alumno.pdf');
        }

        return back()->with('error', 'Tipo de reporte no válido');
    }
}
