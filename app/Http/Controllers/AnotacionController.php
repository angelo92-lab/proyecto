<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AnotacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $alumno = null;
        $nombreBuscado = $request->input('nombres', '');
        $rutBuscado = $request->input('rut', '');
        $mensaje = $request->input('guardado', '');

        // Si viene el RUT desde la URL (por el botón), usarlo como prioridad
        if ($rutBuscado) {
            $alumno = DB::table('colegio20252')
                ->where('Run', $rutBuscado)
                ->first([
                    'Nombres',
                    'Apellido Paterno',
                    'Run',
                    'Celular',
                    'Fecha Nacimiento',
                    'Dirección',
                    'Comuna Residencia',
                ]);
        } elseif ($nombreBuscado) {
            $alumno = DB::table('colegio20252')
                ->where('Nombres', 'like', "%$nombreBuscado%")
                ->first([
                    'Nombres',
                    'Apellido Paterno',
                    'Run',
                    'Celular',
                    'Fecha Nacimiento',
                    'Dirección',
                    'Comuna Residencia',
                ]);
        }

        return view('agregaranotacion', compact('alumno', 'nombreBuscado', 'mensaje'));
    }

    public function store(Request $request)
    {
        $rut = $request->input('rut');
        $anotacion = $request->input('anotacion');

        if ($rut && $anotacion) {
            DB::table('anotaciones')->insert([
                'rut' => $rut,
                'anotacion' => $anotacion,
            ]);

            return redirect()->route('anotacion.index', [
                'nombres' => $request->input('nombres'),
                'guardado' => 1
            ]);
        } else {
            return redirect()->route('anotacion.index', [
                'nombres' => $request->input('nombres'),
                'guardado' => 0
            ]);
        }
    }
}
