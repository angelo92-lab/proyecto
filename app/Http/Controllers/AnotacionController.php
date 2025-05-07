<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnotacionController extends Controller
{
    public function index(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (!session()->has('usuario_id')) {
            return redirect('login');
        }

        $alumno = null;
        $nombreBuscado = $request->input('nombres', '');
        $mensaje = $request->input('guardado', '');

        if ($nombreBuscado) {
            $alumno = DB::table('colegio20252')
                ->where('Nombres', 'like', "%$nombreBuscado%")
                ->first();
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

            return redirect()->route('anotacion.index', ['nombres' => $request->input('nombres'), 'guardado' => 1]);
        } else {
            return redirect()->route('anotacion.index', ['nombres' => $request->input('nombres'), 'guardado' => 0]);
        }
    }
}