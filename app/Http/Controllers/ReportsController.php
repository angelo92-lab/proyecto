<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PDF; // Para generar PDF (requiere barryvdh/laravel-dompdf)

class ReportsController extends Controller
{
    
    public function index()
    {
        // Traer cursos distintos para llenar dropdown
        $courses = DB::table('colegio20252')->select('curso')->distinct()->orderBy('curso')->pluck('curso');
        return view('reportes', compact('courses'));
    }

    public function generate(Request $request)
    {
        $type = $request->input('report_type');

        if ($type == 'course') {
            $curso = $request->input('curso');
            $dateFilterType = $request->input('date_filter_type'); // 'day' o 'month'
            $date = $request->input('date');

            if ($dateFilterType == 'day') {
                $dateStart = $date;
                $dateEnd = $date;
            } else {
                $dateStart = date('Y-m-01', strtotime($date));
                $dateEnd = date('Y-m-t', strtotime($date));
            }

            $students = DB::table('colegio20252')
                ->where('curso', $curso)
                ->select('id', 'nombres', 'rut', 'digito ver', 'celular', 'curso')
                ->orderBy('nombres')
                ->get();

            $studentIds = $students->pluck('id');

            $lunchRecords = DB::table('almuerzos')
                ->whereIn('estudiante_id', $studentIds)
                ->whereBetween('fecha', [$dateStart, $dateEnd])
                ->get()
                ->groupBy('estudiante_id');

            $reportData = [];

            foreach ($students as $student) {
                $hadLunch = false;
                if (isset($lunchRecords[$student->id])) {
                    $hadLunch = $lunchRecords[$student->id]->contains(function ($record) {
                        return (bool)$record->almorzo === true || $record->almorzo == 1;
                    });
                }
                $reportData[] = [
                    'nombres' => $student->nombre,
                    'rut' => $student->rut,
                    'digito ver' => $student->digitoverificador,
                    'celular' => $student->celular,
                    'curso' => $student->curso,
                    'almorzo' => $hadLunch ? 'Sí' : 'No',
                ];
            }

            return view('reportes', [
                'courses' => DB::table('colegio20252')->select('curso')->distinct()->orderBy('curso')->pluck('curso'),
                'reportData' => $reportData,
                'reportType' => 'course',
                'selectedCurso' => $curso,
                'selectedDate' => $date,
                'dateFilterType' => $dateFilterType,
            ]);
        } elseif ($type == 'student') {
            $studentName = $request->input('student_name');
            $month = $request->input('month');

            $student = DB::table('colegio20252')->where('nombres', 'like', "%$studentName%")->first();

            if (!$student) {
                return redirect()->back()->with('error', 'Alumno no encontrado.');
            }

            $dateStart = date('Y-m-01', strtotime($month));
            $dateEnd = date('Y-m-t', strtotime($month));

            $count = DB::table('almuerzos')
                ->where('rut', $student->run)
                ->whereBetween('fecha', [$dateStart, $dateEnd])
                ->where(function ($query) {
                    $query->where('almorzo', true)->orWhere('almorzo', 1);
                })
                ->count();

            return view('reportes', [
                'courses' => DB::table('colegio20252')->select('curso')->distinct()->orderBy('curso')->pluck('curso'),
                'reportType' => 'student',
                'student' => $student,
                'lunchCount' => $count,
                'selectedMonth' => $month,
                'studentName' => $studentName,
            ]);
        } else {
            return redirect()->back()->with('error', 'Tipo de reporte no válido.');
        }
    }

    public function exportCsv(Request $request)
    {
        $type = $request->input('report_type');

        if ($type == 'course') {
            $curso = $request->input('curso');
            $dateFilterType = $request->input('date_filter_type');
            $date = $request->input('date');

            if ($dateFilterType == 'day') {
                $dateStart = $date;
                $dateEnd = $date;
            } else {
                $dateStart = date('Y-m-01', strtotime($date));
                $dateEnd = date('Y-m-t', strtotime($date));
            }

            $students = DB::table('colegio20252')
                ->where('curso', $curso)
                ->select('id', 'nombres', 'rut', 'digito ver', 'celular', 'curso')
                ->orderBy('nombres')
                ->get();

            $studentIds = $students->pluck('id');

            $lunchRecords = DB::table('almuerzos')
                ->whereIn('estudiante_id', $studentIds)
                ->whereBetween('fecha', [$dateStart, $dateEnd])
                ->get()
                ->groupBy('estudiante_id');

            $reportData = [];

            foreach ($students as $student) {
                $hadLunch = false;
                if (isset($lunchRecords[$student->id])) {
                    $hadLunch = $lunchRecords[$student->id]->contains(function ($record) {
                        return (bool)$record->almorzo === true || $record->almorzo == 1;
                    });
                }
                $reportData[] = [
                    'Nombres' => $student->nombre,
                    'RUT' => $student->rut,
                    'Digito Verificador' => $student->digitoverificador,
                    'Celular' => $student->celular,
                    'Curso' => $student->curso,
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
        } elseif ($type == 'student') {
            $studentName = $request->input('student_name');
            $month = $request->input('month');

            $student = DB::table('colegio20252')->where('nombres', 'like', "%$studentName%")->first();

            if (!$student) {
                return redirect()->back()->with('error', 'Alumno no encontrado.');
            }

            $dateStart = date('Y-m-01', strtotime($month));
            $dateEnd = date('Y-m-t', strtotime($month));

            $count = DB::table('almuerzos')
                ->where('estudiante_id', $student->id)
                ->whereBetween('fecha', [$dateStart, $dateEnd])
                ->where(function ($query) {
                    $query->where('almorzo', true)->orWhere('almorzo', 1);
                })
                ->count();

            $filename = "reporte_alumno_{$student->nombre}_" . str_replace('-', '_', $month) . ".csv";

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
                fputcsv($file, [$student->nombre, $month, $count]);
                fclose($file);
            };

            return Response::stream($callback, 200, $headers);
        } else {
            return redirect()->back()->with('error', 'Tipo de reporte no válido para exportación.');
        }
    }

    public function exportPdf(Request $request)
    {
        $type = $request->input('report_type');
        if ($type == 'course') {
            $curso = $request->input('curso');
            $dateFilterType = $request->input('date_filter_type');
            $date = $request->input('date');

            if ($dateFilterType == 'day') {
                $dateStart = $date;
                $dateEnd = $date;
            } else {
                $dateStart = date('Y-m-01', strtotime($date));
                $dateEnd = date('Y-m-t', strtotime($date));
            }

            $students = DB::table('colegio20252')
                ->where('curso', $curso)
                ->select('id', 'nombres', 'rut', 'digito ver', 'celular', 'curso')
                ->orderBy('nombres')
                ->get();

            $studentIds = $students->pluck('id');

            $lunchRecords = DB::table('almuerzos')
                ->whereIn('estudiante_id', $studentIds)
                ->whereBetween('fecha', [$dateStart, $dateEnd])
                ->get()
                ->groupBy('estudiante_id');

            $reportData = [];

            foreach ($students as $student) {
                $hadLunch = false;
                if (isset($lunchRecords[$student->id])) {
                    $hadLunch = $lunchRecords[$student->id]->contains(function ($record) {
                        return (bool)$record->almorzo === true || $record->almorzo == 1;
                    });
                }
                $reportData[] = [
                    'nombres' => $student->nombre,
                    'rut' => $student->rut,
                    'digito ver' => $student->digitoverificador,
                    'celular' => $student->celular,
                    'curso' => $student->curso,
                    'almorzo' => $hadLunch ? 'Sí' : 'No',
                ];
            }

            $pdf = PDF::loadView('reportes.pdf_course', [
                'reportData' => $reportData,
                'curso' => $curso,
                'date' => $date,
                'dateFilterType' => $dateFilterType,
            ]);

            return $pdf->download("reporte_curso_{$curso}_" . str_replace('-', '_', $date) . ".pdf");
        } elseif ($type == 'student') {
            $studentName = $request->input('student_name');
            $month = $request->input('month');

            $student = DB::table('colegio20252')->where('nombres', 'like', "%$studentName%")->first();

            if (!$student) {
                return redirect()->back()->with('error', 'Alumno no encontrado.');
            }

            $dateStart = date('Y-m-01', strtotime($month));
            $dateEnd = date('Y-m-t', strtotime($month));

            $count = DB::table('almuerzos')
                ->where('estudiante_id', $student->id)
                ->whereBetween('fecha', [$dateStart, $dateEnd])
                ->where(function ($query) {
                    $query->where('almorzo', true)->orWhere('almorzo', 1);
                })
                ->count();

            $pdf = PDF::loadView('reportes.pdf_student', [
                'student' => $student,
                'month' => $month,
                'count' => $count,
            ]);

            return $pdf->download("reporte_alumno_{$student->nombre}_" . str_replace('-', '_', $month) . ".pdf");
        } else {
            return redirect()->back()->with('error', 'Tipo de reporte no válido para exportación.');
        }
    }
}
