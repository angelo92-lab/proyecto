<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\MarcaAsistencia;
use Carbon\Carbon;

class RelojControlController extends Controller
{
    public function vistaMarcar()
    {
        $funcionarios = Funcionario::all();
        return view('reloj.marcar', compact('funcionarios'));
    }

    public function marcar(Request $request)
    {
        $request->validate([
            'funcionario_id' => 'required|exists:funcionarios,id',
            'tipo' => 'required|in:entrada,salida',
        ]);

        MarcaAsistencia::create([
            'funcionario_id' => $request->funcionario_id,
            'tipo' => $request->tipo,
            'fecha_hora' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Marca registrada correctamente');
    }
}

