<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ListadoController extends Controller
{
    public function index()
{
    $rutaArchivo = public_path('documentos/listado_21_mayo.xlsx');
    $documento = \PhpOffice\PhpSpreadsheet\IOFactory::load($rutaArchivo);
    $hoja = $documento->getActiveSheet();
    $todasLasFilas = $hoja->toArray();

    // Solo imprimir primeras 20 filas para no saturar el log
    $primerasFilas = array_slice($todasLasFilas, 0, 20);

    \Log::info('Primeras 20 filas del Excel:', $primerasFilas);

    // Asumiendo que encabezados están en fila 5 (index 4)
    $encabezados = $todasLasFilas[4]; 
    $datos = array_slice($todasLasFilas, 5);

    return view('funcionarios.listado', compact('encabezados', 'datos'));
}

}

