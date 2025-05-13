<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\FuncionariosImport;
use Maatwebsite\Excel\Facades\Excel;

class FuncionarioController extends Controller
{
    // Mostrar el formulario para subir el archivo Excel
    public function showImportForm()
    {
        return view('importar-funcionarios');
    }

    // Procesar el archivo Excel y hacer la importación
    public function import(Request $request)
{
    // Validar que se haya subido un archivo
    $request->validate([
        'file' => 'required|mimes:xlsx,xls',
    ]);

    try {
        // Importar el archivo
        Excel::import(new FuncionariosImport, $request->file('file'));

        // Redirigir con un mensaje de éxito
        return redirect()->route('funcionarios.import.form')->with('success', 'Funcionarios importados con éxito.');
    } catch (\Exception $e) {
        // Capturar cualquier error y mostrarlo
        return redirect()->route('funcionarios.import.form')->with('error', 'Hubo un error al importar el archivo: ' . $e->getMessage());
    }
}
}


