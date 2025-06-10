@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">👩‍🏫 Acompañamiento Docente</h2>

    <h4>📄 Archivos principales:</h4>
    <ul class="list-group mb-4">
        @forelse ($archivos as $archivo)
            <li class="list-group-item">
                <a href="{{ asset('acompanamiento_docente/' . $archivo) }}" target="_blank">
                    {{ $archivo }}
                </a>
            </li>
        @empty
            <li class="list-group-item text-muted">No hay archivos disponibles.</li>
        @endforelse
    </ul>

    <h4>📁 Carpetas adicionales:</h4>
    @forelse ($carpetas as $carpeta)
        <div class="mb-4">
            <h5>📁 {{ $carpeta['nombre'] }}</h5>
            <ul class="list-group">
                @forelse ($carpeta['archivos'] as $archivo)
                    <li class="list-group-item">
                        <a href="{{ asset('acompanamiento_docente/' . $carpeta['ruta'] . '/' . $archivo) }}" target="_blank">
                            {{ $archivo }}
                        </a>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No hay archivos en esta carpeta.</li>
                @endforelse
            </ul>
        </div>
    @empty
        <p class="text-muted">No hay carpetas adicionales.</p>
    @endforelse
</div>
@endsection
