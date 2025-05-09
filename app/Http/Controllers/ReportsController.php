<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PDF;

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

        return redirect()->back()->with('error', 'Tipo de reporte no válido para exportación.');
    }

    public function exportPdf(Request $request)
{
    $type = $request->input('report_type');

    // Reporte por curso
    if ($type == 'course') {
        $curso = $request->input('curso');
        $dateFilterType = $request->input('date_filter_type');
        $date = $request->input('date');

        $dateStart = $dateFilterType == 'day' ? $date : date('Y-m-01', strtotime($date));
        $dateEnd = $dateFilterType == 'day' ? $date : date('Y-m-t', strtotime($date));

        // Obtener estudiantes del curso
        $students = DB::table('colegio20252')   
            ->where('Curso', $curso)
            ->select('Run', 'Nombres', DB::raw('`Digito Ver` as digito_ver'), 'Celular', 'Curso')
            ->orderBy('Nombres')
            ->get();

        // Obtener almuerzos entre las fechas seleccionadas
        $ruts = $students->pluck('Run');

        $lunchRecords = DB::table('almuerzos')
            ->whereIn('rut_alumno', $ruts)
            ->whereBetween('fecha', [$dateStart, $dateEnd])
            ->get()
            ->groupBy('rut_alumno');

        // Crear listado de días del mes
        $period = new DatePeriod(
            new DateTime($dateStart),
            new DateInterval('P1D'),
            (new DateTime($dateEnd))->modify('+1 day')
        );

        $days = [];
        foreach ($period as $dateObj) {
            $days[] = $dateObj->format('Y-m-d');
        }

        // Construir los datos para el reporte
        $reportData = [];
        foreach ($students as $student) {
            $row = [
                'nombres' => $student->Nombres,
                'rut' => $student->Run,
                'digito_ver' => $student->digito_ver,
                'celular' => $student->Celular,
                'curso' => $student->Curso,
                'dias' => []
            ];

            foreach ($days as $day) {
                // Si el alumno almorzó en este día, marca con ✓, si no con ✗
                $almorzo = isset($lunchRecords[$student->Run]) && $lunchRecords[$student->Run]->contains('fecha', $day) ? '✓' : '✗';
                $row['dias'][$day] = $almorzo;
            }

            $reportData[] = $row;
        }

        // Generar PDF
        $pdf = PDF::loadView('pdf.reporte_curso', [
    'reportData' => $reportData,
    'curso' => $curso,
    'date' => $date,
    'days' => $days,  // Asegúrate de que esta variable se pase correctamente
    'dateFilterType' => $dateFilterType,
    'dateStart' => $dateStart,
    'dateEnd' => $dateEnd,
])->setPaper('a4', 'landscape');

        return $pdf->download('reporte_curso.pdf');
    }

    // Reporte individual por alumno
    elseif ($type == 'student') {
        $studentName = $request->input('student_name');
        $month = $request->input('month');

        $student = DB::table('colegio20252')
            ->where('Nombres', $studentName)
            ->select('Run', 'Nombres', DB::raw('`Digito Ver` as digito_ver'), 'Celular', 'Curso')
            ->first();

        if (!$student) {
            return back()->with('error', 'Alumno no encontrado.');
        }

        $startDate = date('Y-m-01', strtotime($month));
        $endDate = date('Y-m-t', strtotime($month));

        $lunchesByDate = [];

        // Obtener almuerzos por fecha
        $period = new DatePeriod(
            new DateTime($startDate),
            new DateInterval('P1D'),
            (new DateTime($endDate))->modify('+1 day')
        );

        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $hadLunch = DB::table('almuerzos')
                ->where('rut_alumno', $student->Run)
                ->whereDate('fecha', $formattedDate)
                ->where('almorzo', 1)
                ->exists();

            $lunchesByDate[$formattedDate] = $hadLunch ? '✓' : '✗';
        }

        // Generar PDF
        $pdf = PDF::loadView('pdf.reporte_alumno', [
            'student' => $student,
            'month' => $month,
            'lunchesByDate' => $lunchesByDate,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('reporte_alumno.pdf');
    }

    // Reporte individual por alumno
    elseif ($type == 'student') {
        $studentName = $request->input('student_name');
        $month = $request->input('month');

        $student = DB::table('colegio20252')
            ->where('Nombres', $studentName)
            ->select('Run', 'Nombres', DB::raw('`Digito Ver` as digito_ver'), 'Celular', 'Curso')
            ->first();

        if (!$student) {
            return back()->with('error', 'Alumno no encontrado.');
        }

        $startDate = date('Y-m-01', strtotime($month));
        $endDate = date('Y-m-t', strtotime($month));

        $lunchesByDate = [];

        $period = new DatePeriod(
            new DateTime($startDate),
            new DateInterval('P1D'),
            (new DateTime($endDate))->modify('+1 day')
        );

        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $hadLunch = DB::table('almuerzos')
                ->where('rut_alumno', $student->Run)
                ->whereDate('fecha', $formattedDate)
                ->where('almorzo', 1)
                ->exists();

            $lunchesByDate[$formattedDate] = $hadLunch;
        }

        $pdf = PDF::loadView('pdf.reporte_alumno', [
            'student' => $student,
            'month' => $month,
            'lunchesByDate' => $lunchesByDate,
        ])->setPaper('a4', 'portrait');

        
        

        return $pdf->download('reporte_alumno.pdf');
    }

    return redirect()->back()->with('error', 'Tipo de reporte no válido para PDF.');
}



}
