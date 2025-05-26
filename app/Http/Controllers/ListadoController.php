<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListadoController extends Controller
{
    public function index()
    {
        $rutaArchivo = public_path('documentos/listadoestudiantes.xlsx');
        if (!file_exists($rutaArchivo)) {
    dd("El archivo no existe en: $rutaArchivo");
} else {
    dd("Archivo existe y se lee desde: $rutaArchivo");
}
        
        $documento = \PhpOffice\PhpSpreadsheet\IOFactory::load($rutaArchivo);
$hoja = $documento->getActiveSheet();
$todasLasFilas = $hoja->toArray();

dd($todasLasFilas);

        // Encabezados están en fila 5 (índice 4)
        $encabezados = $todasLasFilas[4];

        // Datos desde fila 6 en adelante (índice 5+)
        $datos = array_slice($todasLasFilas, 5);

            // Limitamos a las primeras 20 filas para que no sea mucho
            $datosMostrar = array_slice($datos, 0, 20);

        return view('funcionarios.listado', [
    'encabezados' => $encabezados,
    'datosMostrar' => $datosMostrar
]);
    }
}
