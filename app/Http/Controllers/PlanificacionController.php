<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class PlanificacionController extends Controller
{
    public function index()
    {
        return view('funcionarios.utp.planificaciones.index');
    }

    public function basica()
    {
        $ruta = public_path('planificaciones/basica');
        $carpetas = collect(File::directories($ruta))->map(fn($dir) => basename($dir));
        return view('utp.planificaciones.basica', compact('carpetas'));
    }


    public function media()
    {
        $ruta = public_path('planificaciones/media');
        $carpetas = collect(File::directories($ruta))->map(fn($dir) => basename($dir));
        return view('utp.planificaciones.media', compact('carpetas'));
    }
}


