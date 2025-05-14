<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\FuncionariosImport;
use App\Models\Funcionario;
use Maatwebsite\Excel\Facades\Excel;

class FuncionarioController extends Controller
{
    public function formImportar()
    {
        return view('funcionarios.importar');
    }

    public function importar(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new FuncionariosImport, $request->file('archivo'));

        return redirect()->back()->with('success', '¡Funcionarios importados correctamente!');
    }
}

