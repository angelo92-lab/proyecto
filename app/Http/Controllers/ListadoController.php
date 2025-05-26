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
        $datos = $hoja->toArray();

        return view('funcionarios.listado', compact('datos'));
    }
}
