@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📂 Archivos en: {{ $carpeta }}</h2>

    <ul class="list-group">
        @forelse ($archivos as $archivo)
            <li class="list-group-item">
                <a href="{{ asset("planificaciones/$nivel/$carpeta/$archivo") }}" target="_blank">
                    📄 {{ $archivo }}
                </a>
            </li>
        @empty
            <li class="list-group-item text-muted">No hay archivos en esta carpeta.</li>
        @endforelse
    </ul>
</div>
@endsection
