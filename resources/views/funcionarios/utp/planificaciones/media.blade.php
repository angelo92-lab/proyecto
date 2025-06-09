@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📘 Primera Unidad - Educación Media</h2>

    @if($carpetas->isEmpty())
        <p class="text-muted">No hay carpetas disponibles por el momento.</p>
    @else
        <div class="list-group">
            @foreach ($carpetas as $carpeta)
    <li class="list-group-item">
        <a href="{{ route('planificaciones.archivos', ['nivel' => 'media', 'carpeta' => urlencode($carpeta)]) }}">
            📁 {{ $carpeta }}
        </a>
    </li>
@endforeach

        </div>
    @endif
</div>
@endsection
