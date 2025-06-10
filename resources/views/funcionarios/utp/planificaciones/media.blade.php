@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('utp.index') }}">UTP</a></li>
    <li class="breadcrumb-item"><a href="{{ route('planificaciones.index') }}">Planificaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Educación Básica</li>
  </ol>
</nav>

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
        <a href="{{ route('utp.index') }}" class="btn btn-secondary mt-4">
    ⬅️ Volver a Unidad Técnico Pedagógica
    @endif
</div>
@endsection
