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

    <h4 class="mt-4">📁 Resultados por Curso</h4>
    <div class="row row-cols-1 row-cols-md-2 g-3">
        @foreach ($carpetas as $carpeta)
        <div class="col">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">📁 {{ strtoupper(str_replace('_', ' ', $carpeta['nombre'])) }}</h5>
                    @if($carpeta['archivos']->isEmpty())
                        <p class="text-muted">Sin archivos por ahora.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($carpeta['archivos'] as $archivo)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    📎 {{ $archivo }}
                                    <a href="{{ asset('documentos/utp/resultados_diagnostico/' . $carpeta['nombre'] . '/' . $archivo) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Ver</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
