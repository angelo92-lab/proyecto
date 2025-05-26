<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ListadoController extends Controller
{
    public function index()
    {
        $path = public_path('documentos/listadoestudiantes.xlsx');

        if (!file_exists($path)) {
            return view('listado', ['alumnos' => [], 'error' => 'El archivo no fue encontrado.']);
        }

        $data = Excel::toArray([], $path);
        $alumnos = $data[0]; // primera hoja del Excel

        return view('funcionarios.listado', compact('alumnos'));
    }
}
