<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;

class ListadoController extends Controller
{
    public function index()
{
    $rutaArchivo = public_path('documentos/estudiantes21mayo.xlsx');

    if (!file_exists($rutaArchivo)) {
        abort(404, "Archivo no encontrado en: $rutaArchivo");
    }

    $spreadsheet = IOFactory::load($rutaArchivo);
    $sheet = $spreadsheet->getActiveSheet();

    $filas = [];
    $inicioDatos = 6;  // Datos desde fila 6 (porque encabezados en fila 5)

    // Columnas que quieres mostrar: ajusta según tus columnas en Excel (A=1, B=2, etc)
    // Ejemplo asumiendo: 
    // A = N°
    // B = NOMBRE ESTUDIANTE
    // C = DESFILE
    // D = BANDA
    // E = LUGAR QUE PROVIENES
    // F = ASISTE

    $ultimaFila = $sheet->getHighestRow();

    for ($fila = $inicioDatos; $fila <= $ultimaFila; $fila++) {
        $nro = $sheet->getCell('A'.$fila)->getValue();
        $nombre = $sheet->getCell('B'.$fila)->getValue();
        $desfile = $sheet->getCell('C'.$fila)->getValue();
        $banda = $sheet->getCell('D'.$fila)->getValue();
        $lugar = $sheet->getCell('E'.$fila)->getValue();
        $asiste = $sheet->getCell('F'.$fila)->getValue();

        // Evitar filas vacías (puedes ajustar esta condición)
        if ($nro === null && $nombre === null) {
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

    // También puedes obtener encabezados de la fila 5 si quieres
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