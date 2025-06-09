@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📘 Primera Unidad - Educación Media</h2>

    @if($carpetas->isEmpty())
        <p class="text-muted">No hay carpetas disponibles por el momento.</p>
    @else
        <div class="list-group">
            @foreach($carpetas as $carpeta)
                <a href="{{ url('planificaciones/media/' . $carpeta) }}" class="list-group-item list-group-item-action">
                    📁 {{ $carpeta }}
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
