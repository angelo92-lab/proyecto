<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClimaController extends Controller
{
    public function mostrarClima()
    {
        $respuesta = Http::get('URL_DE_LA_API_DEL_CLIMA');
        $datosClima = $respuesta->json();

        return view('clima', compact('datosClima'));
    }
}

