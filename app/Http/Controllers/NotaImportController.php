<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\NotasImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class NotaImportController extends Controller
{
    /**
     * Mostrar el formulario para subir el Excel.
     */
    public function form()
    {
        return view('notas.importar');   // Blade: resources/views/notas/importar.blade.php
    }

    /**
     * Procesar el archivo y cargar las notas.
     */
    public function store(Request $request)
    {
        // 1. Validar que venga un Excel
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,xls',
        ]);

        // 2. Importar dentro de una transacción
        DB::transaction(function () use ($request) {
            Excel::import(new NotasImport, $request->file('archivo'));
        });

        // 3. Volver con mensaje de éxito
        return back()->with('success', 'Notas importadas correctamente');
    }
}
