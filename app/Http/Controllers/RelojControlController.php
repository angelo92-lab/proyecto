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

    // ✅ NUEVO MÉTODO: Mostrar funcionarios activos e inactivos hoy
    public function estadoFuncionarios()
    {
        $hoy = Carbon::now()->toDateString();

        $activos = Funcionario::whereHas('marcaAsistencias', function ($query) use ($hoy) {
            $query->whereDate('fecha_hora', $hoy);
        })->get();

        $inactivos = Funcionario::whereDoesntHave('marcaAsistencias', function ($query) use ($hoy) {
            $query->whereDate('fecha_hora', $hoy);
        })->get();

        return view('reloj.estado', compact('activos', 'inactivos'));
    }
}
