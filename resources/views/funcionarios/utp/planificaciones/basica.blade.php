@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('utp.index') }}">UTP</a></li>
        <li class="breadcrumb-item"><a href="{{ route('planificaciones.index') }}">Planificaciones</a></li>
        <li class="breadcrumb-item active" aria-current="page">Educación Básica</li>
      </ol>
    </nav>

    <h2 class="titulo-principal">📘 Primera Unidad - Educación Básica</h2>


    @if($carpetas->isEmpty())
        <p class="text-muted">No hay carpetas disponibles por el momento.</p>
    @else
        <div class="list-group">
           @foreach ($carpetas as $carpeta)
            <li class="list-group-item">
                <a href="{{ route('planificaciones.archivos', ['nivel' => 'basica', 'carpeta' => urlencode($carpeta)]) }}">
                    📁 {{ $carpeta }}
                </a>
            </li>
           @endforeach
        </div>
    @endif

    <!-- Botón Volver -->
    <a href="{{ route('utp.index') }}" class="btn btn-secondary mt-4">
        ⬅️ Volver a Unidad Técnico Pedagógica
    </a>
</div>
@endsection
