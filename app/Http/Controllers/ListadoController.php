<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ListadoController extends Controller
{
    public function index()
{
    $path = public_path('documentos/listadoestudiantes.xlsx');

    // Leer el archivo y convertirlo a un array
    $data = Excel::toArray([], $path)[0]; // Solo la primera hoja

    return view('funcionarios.listado', compact('data'));
}
}
