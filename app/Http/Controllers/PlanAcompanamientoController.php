<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PlanAcompanamientoController extends Controller
{
    public function index()
    {
        $path = public_path('documentos/listadoplan.xlsx');

        if (!file_exists($path)) {
            abort(404, 'El archivo no existe.');
        }

        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        $encabezados = $data[2]; // Fila 3 (índice 2)
        $filasRaw = array_slice($data, 3); // Desde la fila 4 en adelante

        $filas = [];
        foreach ($filasRaw as $fila) {
            $filas[] = [
                'nro' => $fila[0] ?? '',
                'curso' => $fila[1] ?? '',
                'nombre' => $fila[2] ?? '',
                'procedencia' => $fila[3] ?? '',
                'asignatura' => $fila[4] ?? '',
                'asistencia' => $fila[5] ?? '',
                'acompanamiento' => $fila[6] ?? '',
            ];
        }

        return view('plan_acompanamiento.index', compact('encabezados', 'filas'));
    }
}
