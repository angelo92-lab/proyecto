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
                    'nombres' => $student->Nombres,
                    'rut' => $student->Run,
                    'digito_ver' => $student->digito_ver,
                    'celular' => $student->Celular,
                    'curso' => $student->Curso,
                    'almorzo' => $hadLunch ? 'Sí' : 'No',
                ];
            }

            return view('reportes', [
                'courses' => DB::table('colegio20252')->select('Curso')->distinct()->orderBy('Curso')->pluck('Curso'),
                'reportData' => $reportData,
                'reportType' => 'course',
                'selectedCurso' => $curso,
                'selectedDate' => $date,
                'dateFilterType' => $dateFilterType,
            ]);
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

            return view('reportes', [
                'courses' => DB::table('colegio20252')->select('Curso')->distinct()->orderBy('Curso')->pluck('Curso'),
                'reportType' => 'student',
                'student' => $student,
                'lunchCount' => $count,
                'selectedMonth' => $month,
                'studentName' => $studentName,
            ]);
        }

        return redirect()->back()->with('error', 'Tipo de reporte no válido.');
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
                    'nombres' => $student->Nombres,
                    'rut' => $student->Run,
                    'digito_ver' => $student->digito_ver,
                    'celular' => $student->Celular,
                    'curso' => $student->Curso,
                    'almorzo' => $hadLunch ? 'Sí' : 'No',
                ];
            }

            $pdf = PDF::loadView('pdf.reporte_curso', ['reportData' => $reportData, 'curso' => $curso, 'date' => $date]);
            return $pdf->download('reporte_curso.pdf');
        }

        return redirect()->back()->with('error', 'Tipo de reporte no válido para PDF.');
    }
}
