<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class AcompanamientoDocenteController extends Controller
{
    public function index()
    {
        $ruta = public_path('acompanamiento_docente');

        $archivos = collect(File::files($ruta))->map(fn($file) => basename($file));
        $carpetas = collect(File::directories($ruta))->map(function ($dir) {
            return [
                'nombre' => basename($dir),
                'archivos' => collect(File::files($dir))->map(fn($file) => basename($file)),
                'ruta' => basename($dir),
            ];
        });

        return view('funcionarios.acompanamiento.index', compact('archivos', 'carpetas'));
    }
}

