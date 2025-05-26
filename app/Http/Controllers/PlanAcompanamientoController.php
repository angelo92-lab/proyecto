<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;

class PlanAcompanamientoController extends Controller
{
    public function index()
    {
        $rutaArchivo = public_path('documents/listadoplan.xlsx');

        if (!file_exists($rutaArchivo)) {
            abort(404, "Archivo no encontrado en: $rutaArchivo");
        }

        $spreadsheet = IOFactory::load($rutaArchivo);
        $sheet = $spreadsheet->getActiveSheet();

        $filas = [];
        $inicioDatos = 2;
        $ultimaFila = $sheet->getHighestRow();

        for ($fila = $inicioDatos; $fila <= $ultimaFila; $fila++) {
            $filas[] = [
                'nro' => $sheet->getCell('A' . $fila)->getValue(),
                'curso' => $sheet->getCell('B' . $fila)->getValue(),
                'nombre' => $sheet->getCell('C' . $fila)->getValue(),
                'procedencia' => $sheet->getCell('D' . $fila)->getValue(),
                'asignatura' => $sheet->getCell('E' . $fila)->getValue(),
                'asistencia' => $sheet->getCell('F' . $fila)->getValue(),
                'acompanamiento' => $sheet->getCell('G' . $fila)->getValue(),
            ];
        }

        $encabezados = [
            $sheet->getCell('A1')->getValue(),
            $sheet->getCell('B1')->getValue(),
            $sheet->getCell('C1')->getValue(),
            $sheet->getCell('D1')->getValue(),
            $sheet->getCell('E1')->getValue(),
            $sheet->getCell('F1')->getValue(),
            $sheet->getCell('G1')->getValue(),
        ];

        return view('funcionarios.plan_acompanamiento', compact('filas', 'encabezados'));
    }
}
