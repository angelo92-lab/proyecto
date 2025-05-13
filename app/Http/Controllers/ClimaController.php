<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClimaController extends Controller
{
    public function showTemperature()
    {
        // Coordenadas de tu ciudad, reemplaza con la latitud y longitud correctas
        $latitude = -30.69;  
        $longitude = -70.95;

        // Llamar a la API de Open-Meteo
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'current_weather' => 'true',
            'temperature_unit' => 'celsius',
        ]);

        if ($response->successful()) {
            $weatherData = $response->json();
            $temperature = $weatherData['current_weather']['temperature'] ?? 'N/A';
            $windSpeed = $weatherData['current_weather']['windspeed'] ?? 'N/A';

            return view('tiempo', compact('temperature', 'windSpeed'));
        } else {
            return view('tiempo')->with('error', 'No se pudo obtener el clima');
        }
    }
}
