<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class PlanificacionController extends Controller
{
    public function index()
    {
        return view('funcionarios.utp.planificaciones.index');
    }

    public function basica()
    {
        $ruta = public_path('planificaciones/basica');

        if (!File::exists($ruta)) {
            abort(404, "La carpeta no existe: $ruta");
        }

        $carpetas = collect(File::directories($ruta))->map(fn($dir) => basename($dir));
        return view('funcionarios.utp.planificaciones.basica', compact('carpetas'));
    }

    public function media()
    {
        $ruta = public_path('planificaciones/media');

        if (!File::exists($ruta)) {
            abort(404, "La carpeta no existe: $ruta");
        }

        $carpetas = collect(File::directories($ruta))->map(fn($dir) => basename($dir));
        return view('funcionarios.utp.planificaciones.media', compact('carpetas'));
    }
}

