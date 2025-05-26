<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ListadoController extends Controller
{
    public function index()
    {
        $rutaArchivo = public_path('documentos/listadoestudiante.xlsx');

        if (!file_exists($rutaArchivo)) {
            abort(404, "Archivo no encontrado en: $rutaArchivo");
        }

        $spreadsheet = IOFactory::load($rutaArchivo);
        $sheet = $spreadsheet->getActiveSheet();

        $filas = [];
        $inicioDatos = 6; // Datos desde fila 6 (encabezados en la 5)
        $ultimaFila = $sheet->getHighestRow();

        for ($fila = $inicioDatos; $fila <= $ultimaFila; $fila++) {
            $nro = $sheet->getCell('A' . $fila)->getValue();
            $nombre = $sheet->getCell('B' . $fila)->getValue();
            $desfile = $sheet->getCell('C' . $fila)->getValue();
            $banda = $sheet->getCell('D' . $fila)->getValue();
            $lugar = $sheet->getCell('E' . $fila)->getValue();
            $asiste = $sheet->getCell('F' . $fila)->getValue();

            // Evitar filas completamente vacías
            if ($nro === null && $nombre === null && $desfile === null) {
                continue;
            }

            $filas[] = [
                'nro' => $nro,
                'nombre' => $nombre,
                'desfile' => $desfile,
                'banda' => $banda,
                'lugar' => $lugar,
                'asiste' => $asiste,
            ];
        }

        // Leer encabezados desde la fila 5
        $encabezados = [
            $sheet->getCell('A5')->getValue(),
            $sheet->getCell('B5')->getValue(),
            $sheet->getCell('C5')->getValue(),
            $sheet->getCell('D5')->getValue(),
            $sheet->getCell('E5')->getValue(),
            $sheet->getCell('F5')->getValue(),
        ];

        return view('funcionarios.listado', compact('filas', 'encabezados'));
    }
}
    