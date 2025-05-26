<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;

class ListadoController extends Controller
{
    public function index()
    {
        $rutaArchivo = public_path('documentos/estudiantes21mayo.xlsx');

        // Cargar el archivo Excel
        $documento = IOFactory::load($rutaArchivo);

        // Obtener la hoja activa
        $hoja = $documento->getActiveSheet();

        // Convertir la hoja en un arreglo (cada fila es un arreglo de celdas)
        $filas = $hoja->toArray();

        // Aquí decides a partir de qué fila mostrar (por ejemplo fila 5 para encabezados)
        // pero si quieres mostrar todo, lo pasamos directamente a la vista.

        return view('funcionarios.listado', compact('filas'));
    }
}
