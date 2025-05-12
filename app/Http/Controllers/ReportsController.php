<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PDF;
use DateTime;
use DatePeriod;
use DateInterval;

class ReportsController extends Controller
{
    public function index()
    {
        $courses = DB::table('colegio20252')
            ->select('Curso')
            ->distinct()
            ->orderBy('Curso')
            ->pluck('Curso');

        return view('reportes', compact('courses'));
    }

    // Utilidad para calcular rango de fechas
    private function getDateRange($type, $date)
    {
        if ($type === 'day') {
            return [$date, $date];
        }

        $start = date('Y-m-01', strtotime($date));
        $end = date('Y-m-t', strtotime($date));
        return [$start, $end];
    }

    // Utilidad para obtener estudiantes y almuerzos
    private function getStudentsAndLunches($curso, $dateStart, $dateEnd)
    {
        $students = DB::table('colegio20252')
            ->where('Curso', $curso)
            ->select('Run', 'Nombres', DB::raw('`Digito Ver` as digito_ver'), 'Celular', 'Curso')
            ->orderBy('Nombres')
            ->get();

        $ruts = $students->pluck('Run');

        $lunches = DB::table('almuerzos')
            ->whereIn('rut_alumno', $ruts)
            ->whereBetween('fecha', [$dateStart, $dateEnd])
            ->get();

        return [$students, $lunches];
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

        // Generar días del mes si el filtro es 'month'
        $days = [];
        if ($dateFilterType == 'month') {
            $startDate = new DateTime($dateStart);
            $endDate = new DateTime($dateEnd);
            $endDate->modify('+1 day'); // Incluir el último día
            $interval = new DateInterval('P1D');
            $period = new DatePeriod($startDate, $interval, $endDate);
            $days = iterator_to_array($period); // Array de DateTime
        }

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
            'days' => $days, // Agregado para incluir los días
        ])->setPaper('a4', 'landscape');

        // Descargar el PDF
        return $pdf->download('reporte_curso.pdf');
    }

    // Si no se ha seleccionado un tipo de reporte válido
    return back()->with('error', 'Seleccione un tipo de reporte válido');
}


    public function exportCsv(Request $request)
    {
        $type = $request->input('report_type');

        if ($type === 'course') {
            $curso = $request->input('curso');
            $dateFilterType = $request->input('date_filter_type');
            $date = $request->input('date');

            [$dateStart, $dateEnd] = $this->getDateRange($dateFilterType, $date);
            [$students, $lunches] = $this->getStudentsAndLunches($curso, $dateStart, $dateEnd);

            $grouped = $lunches->groupBy('rut_alumno');

            $data = $students->map(function ($student) use ($grouped) {
                $hadLunch = isset($grouped[$student->Run]) && $grouped[$student->Run]->contains('almorzo', 1);
                return [
                    'Nombres' => $student->Nombres,
                    'RUT' => $student->Run,
                    'Dígito Verificador' => $student->digito_ver,
                    'Celular' => $student->Celular,
                    'Curso' => $student->Curso,
                    'Almorzó' => $hadLunch ? 'Sí' : 'No',
                ];
            });

            $filename = "reporte_curso_{$curso}_" . str_replace('-', '_', $date) . ".csv";

            return Response::stream(function () use ($data) {
                $file = fopen('php://output', 'w');
                fputcsv($file, array_keys($data[0]));
                foreach ($data as $row) {
                    fputcsv($file, $row);
                }
                fclose($file);
            }, 200, [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename={$filename}",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ]);
        }

        if ($type === 'student') {
            $studentName = $request->input('student_name');
            $month = $request->input('month');

            $student = DB::table('colegio20252')
                ->where('Nombres', 'like', "%$studentName%")
                ->first();

            if (!$student) {
                return redirect()->back()->with('error', 'Alumno no encontrado.');
            }

            $start = date('Y-m-01', strtotime($month));
            $end = date('Y-m-t', strtotime($month));

            $count = DB::table('almuerzos')
                ->where('rut_alumno', $student->Run)
                ->whereBetween('fecha', [$start, $end])
                ->where(function ($q) {
                    $q->where('almorzo', true)->orWhere('almorzo', 1);
                })
                ->count();

            $filename = "reporte_alumno_{$student->Nombres}_" . str_replace('-', '_', $month) . ".csv";

            return Response::stream(function () use ($student, $count, $month) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['Alumno', 'Mes', 'Cantidad de veces almorzó']);
                fputcsv($file, [$student->Nombres, $month, $count]);
                fclose($file);
            }, 200, [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename={$filename}",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ]);
        }

        return back()->with('error', 'Tipo de reporte no válido');
    }

    public function exportPdf(Request $request)
{
    $type = $request->input('report_type');

    if ($type === 'course') {
        $curso = $request->input('curso');
        $dateFilterType = $request->input('date_filter_type');
        $date = $request->input('date');

        [$dateStart, $dateEnd] = $this->getDateRange($dateFilterType, $date);

        $days = $this->getDaysInRange($dateStart, $dateEnd);

        [$students, $lunches] = $this->getStudentsAndLunches($curso, $dateStart, $dateEnd);

        $reportData = $this->generateCourseReportData($students, $lunches, $days);

        if (empty($reportData)) {
            return back()->with('error', 'No hay datos disponibles para el curso seleccionado en el rango de fechas.');
        }

        $pdf = PDF::loadView('pdf.reporte_curso', [
            'reportData' => $reportData,
            'curso' => $curso,
            'date' => $date,
            'dateFilterType' => $dateFilterType,
            'days' => $days,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('reporte_curso.pdf');
    }

    if ($type === 'student') {
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
            ->whereMonth('fecha', date('m', strtotime($month)))
            ->whereYear('fecha', date('Y', strtotime($month)))
            ->get();

        $pdf = PDF::loadView('pdf.reporte_alumno', [
            'reportData' => ['student' => $student, 'lunchRecords' => $lunchRecords],
            'student' => $student,
            'month' => $month,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('reporte_alumno.pdf');
    }

    return back()->with('error', 'Tipo de reporte no válido');
}

private function getDaysInRange($dateStart, $dateEnd)
{
    $startDate = new DateTime($dateStart);
    $endDate = new DateTime($dateEnd);
    $endDate->modify('+1 day');
    $interval = new DateInterval('P1D');
    return iterator_to_array(new DatePeriod($startDate, $interval, $endDate));
}

private function generateCourseReportData($students, $lunches, $days)
{
    $lunchMap = [];
    foreach ($lunches as $lunch) {
        $lunchMap[$lunch->rut_alumno][$lunch->fecha] = true;
    }

    $reportData = [];
    foreach ($students as $student) {
        if (!$student->Nombres || !$student->Run) continue;

        $row = [
            'Nombres' => $student->Nombres,
            'RUT' => $student->Run,
            'DigitoVer' => $student->digito_ver,
            'Celular' => $student->Celular,
            'Curso' => $student->Curso,
            'Dias' => [],
        ];

        foreach ($days as $day) {
            $fecha = $day->format('Y-m-d');
            $row['Dias'][$fecha] = isset($lunchMap[$student->Run][$fecha]) ? '✓' : '✗';
        }

        $reportData[] = $row;
    }

    return $reportData;
}
}
