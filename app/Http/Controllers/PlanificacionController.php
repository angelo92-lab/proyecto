<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PlanificacionController extends Controller
{
    public function index()
    {
        $carpetas = [
            'Primera Unidad Ed. Basica',
            'Primera Unidad Ed. Media',
        ];
        return view('funcionarios.utp.planificaciones.index', compact('carpetas'));
    }

    public function showUnidad($unidad)
    {
        $ruta = public_path("planificaciones/$unidad");
        $subcarpetas = File::directories($ruta);
        $subcarpetas = array_map('basename', $subcarpetas);

        return view('funcionarios.utp.planificaciones.unidad', compact('unidad', 'subcarpetas'));
    }

    public function showSubcarpeta($unidad, $subcarpeta)
    {
        $ruta = public_path("planificaciones/$unidad/$subcarpeta");
        $archivos = File::files($ruta);
        return view('funcionarios.utp.planificaciones.subcarpeta', compact('unidad', 'subcarpeta', 'archivos'));
    }
}


