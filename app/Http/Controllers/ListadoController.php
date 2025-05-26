<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ListadoController extends Controller
{
    public function index()
    {
        $rutaArchivo = public_path('documentos/listadoestudiantes.xlsx');
        $documento = IOFactory::load($rutaArchivo);
        $hoja = $documento->getActiveSheet();
        $todasLasFilas = $hoja->toArray();

        // Encabezados en fila 5 → índice 4
        $encabezados = $todasLasFilas[4];

        // Datos desde fila 6 → índice 5 en adelante
        $datos = array_slice($todasLasFilas, 5);

        return view('funcionarios.listado', compact('encabezados', 'datos'));
    }
}

