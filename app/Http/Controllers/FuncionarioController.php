<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\FuncionariosImport;
use App\Models\Funcionario;
use Maatwebsite\Excel\Facades\Excel;

class FuncionarioController extends Controller
{
    // Función para mostrar el formulario de importación
    public function formImportar()
    {
        return view('funcionarios.importar');
    }

    // Función para importar funcionarios desde un archivo Excel
    public function importar(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:xlsx,csv,xls'
        ]);

        // Importar los funcionarios
        Excel::import(new FuncionariosImport, $request->file('archivo'));

        return redirect()->back()->with('success', '¡Funcionarios importados correctamente!');
    }

    // Función para buscar un funcionario por RUT
    public function buscarFuncionario($rut)
    {
        $funcionario = Funcionario::where('rut', $rut)->first();

        // Si el funcionario se encuentra, se devuelve el éxito y los datos del funcionario
        if ($funcionario) {
            return response()->json(['success' => true, 'funcionario' => $funcionario]);
        } else {
            // Si no se encuentra, se devuelve el error con un mensaje
            return response()->json(['success' => false, 'message' => 'Funcionario no encontrado.']);
        }
    }
}
