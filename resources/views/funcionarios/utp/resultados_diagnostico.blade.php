@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">📘 Resultados DIA - Diagnóstico 2025</h1>

    <p class="mb-4">
        Aquí encontrarás los resultados generales y por curso, actualizados automáticamente según los archivos disponibles.
    </p>

    <h4>📄 Archivos Generales</h4>
    @if($archivosGenerales->isEmpty())
        <p class="text-muted">No hay archivos generales disponibles.</p>
    @else
        <ul class="list-group mb-4">
            @foreach ($archivosGenerales as $archivo)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    📄 {{ $archivo }}
                    <a href="{{ asset('documentos/utp/resultados_diagnostico/' . $archivo) }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
                </li>
            @endforeach
        </ul>
    @endif

   <h3 class="text-xl font-semibold mt-6 mb-2">📁 Carpetas por Curso</h3>
@if(count($carpetas) > 0)
    <div class="space-y-4">
        @foreach($carpetas as $carpeta)
            <div class="border p-4 rounded shadow">
                <h4 class="text-lg font-bold text-gray-800">{{ $carpeta['nombre'] }}</h4>
                @if(count($carpeta['archivos']) > 0)
                    <ul class="list-disc ml-5 mt-2 space-y-1">
                        @foreach($carpeta['archivos'] as $archivo)
                            <li>
                                <a href="{{ asset('documentos/utp/resultados_diagnostico/' . $carpeta['nombre'] . '/' . $archivo) }}"
                                   target="_blank"
                                   class="text-blue-600 hover:underline">
                                    📎 {{ $archivo }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-gray-500 mt-1">Esta carpeta aún no tiene archivos.</p>
                @endif
            </div>
        @endforeach
    </div>
@else
    <p>No hay carpetas con resultados aún.</p>
@endif
