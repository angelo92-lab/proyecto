<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClimaController extends Controller
{
    public function showTemperature()
    {
        // Coordenadas de tu ciudad, reemplaza con la latitud y longitud correctas
        $latitude = -30.69833;  
        $longitude = -70.95778;

        
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

            return view('clima', compact('temperature', 'windSpeed'));
        } else {
            return view('clima')->with('error', 'No se pudo obtener el clima');
        }
    }
}
