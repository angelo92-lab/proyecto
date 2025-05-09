@extends('layouts.app')

@section('title', 'Agregar Anotación')

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('anotaciones') }}">Anotaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar Anotación</li>
  </ol>
</nav>

<h1 class="mb-4">Agregar Anotación</h1>

<div class="mb-3">
    <a href="{{ url('anotaciones') }}" class="btn btn-secondary">Volver al Listado</a>
</div>

@if ($mensaje == '1')
    <div class="alert alert-success text-center message-fade">¡Anotación guardada correctamente!</div>
@elseif ($mensaje == '0')
    <div class="alert alert-danger text-center message-fade">Error al guardar la anotación.</div>
@endif

<form method="get" action="{{ route('anotacion.index') }}" class="row g-3 mb-4" id="buscarForm">
    <div class="col-md-8">
        <label for="nombres" class="form-label">Buscar alumno por nombre:</label>
        <input type="text" id="nombres" name="nombres" class="form-control" placeholder="Ej: Juan" value="{{ old('nombres', $nombreBuscado) }}">
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100" id="buscarBtn">
            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            Buscar
        </button>
    </div>
</form>

@if ($alumno)
    <div class="card p-4 mb-4 shadow-sm">
        <h5>Datos del Alumno</h5>
        <p><strong>Nombre:</strong> {{ $alumno->Nombres }}</p>
        <p><strong>Apellido Paterno:</strong> {{ $alumno->{'Apellido Paterno'} }}</p>
        <p><strong>RUT:</strong> {{ $alumno->Run }}</p>
        <p><strong>Celular:</strong> {{ $alumno->Celular }}</p>
        <p><strong>Fecha Nacimiento:</strong> {{ $alumno->{'Fecha Nacimiento'} }}</p>
        <p><strong>Dirección:</strong> {{ $alumno->Direccion }}</p> <!-- Nueva línea para Dirección -->
        <p><strong>Comuna Residencia:</strong> {{ $alumno->Comuna Residencia }}</p> <!-- Nueva línea para Comuna Residencia -->

        <form method="post" action="{{ route('anotacion.store') }}" id="anotacionForm">
            @csrf
            <input type="hidden" name="rut" value="{{ $alumno->Run }}">
            <input type="hidden" name="nombres" value="{{ $nombreBuscado }}">
            <div class="mb-3">
                <label for="anotacion" class="form-label">Escribir anotación:</label>
                <textarea name="anotacion" id="anotacion" rows="5" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-success" id="guardarBtn">
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                Guardar Anotación
            </button>
        </form>
    </div>
@elseif($nombreBuscado)
    <div class="alert alert-warning text-center message-fade">No se encontró ningún alumno con ese nombre.</div>
@endif

<style>
.message-fade {
    animation: fadeOut 6s forwards;
}
@keyframes fadeOut {
    0%, 80% {opacity: 1;}
    100% {opacity: 0;}
}
</style>

<script>
document.getElementById('buscarForm').addEventListener('submit', function(){
    const btn = document.getElementById('buscarBtn');
    const spinner = btn.querySelector('.spinner-border');
    btn.disabled = true;
    spinner.classList.remove('d-none');
});

document.getElementById('anotacionForm')?.addEventListener('submit', function(){
    const btn = document.getElementById('guardarBtn');
    const spinner = btn.querySelector('.spinner-border');
    btn.disabled = true;
    spinner.classList.remove('d-none');
});
</script>
@endsection