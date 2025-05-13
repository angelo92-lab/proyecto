@extends('layouts.app')

@section('title', 'Agregar Anotación')

@section('content')
<nav aria-label="breadcrumb" class="mb-4">
  <ol class="breadcrumb bg-light px-3 py-2 rounded shadow-sm">
    <li class="breadcrumb-item"><a href="{{ url('anotaciones') }}">📄 Anotaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">✏️ Agregar Anotación</li>
  </ol>
</nav>

<h1 class="mb-4 text-center text-primary fw-bold display-6">✏️ Agregar Anotación</h1>

<div class="mb-3 text-end">
    <a href="{{ url('anotaciones') }}" class="btn btn-outline-secondary shadow-sm">← Volver al Listado</a>
</div>

@if ($mensaje == '1')
    <div class="alert alert-success text-center message-fade shadow-sm fw-semibold">
        ✅ ¡Anotación guardada correctamente!
    </div>
@elseif ($mensaje == '0')
    <div class="alert alert-danger text-center message-fade shadow-sm fw-semibold">
        ❌ Error al guardar la anotación.
    </div>
@endif

<form method="get" action="{{ route('anotacion.index') }}" class="row g-3 mb-5 bg-white rounded p-4 shadow-sm" id="buscarForm">
    <div class="col-md-8">
        <label for="nombres" class="form-label fw-semibold">👤 Buscar alumno por nombre:</label>
        <input type="text" id="nombres" name="nombres" class="form-control" placeholder="Ej: Juan" value="{{ old('nombres', $nombreBuscado) }}">
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100" id="buscarBtn">
            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            🔍 Buscar
        </button>
    </div>
</form>

@if ($alumno)
    <div class="card shadow-sm p-4 mb-4 border-0">
        <h4 class="text-success fw-bold mb-3">📘 Datos del Alumno</h4>
        <ul class="list-group list-group-flush mb-3">
            <li class="list-group-item"><strong>Nombre:</strong> {{ $alumno->Nombres }}</li>
            <li class="list-group-item"><strong>Apellido Paterno:</strong> {{ $alumno->{'Apellido Paterno'} }}</li>
            <li class="list-group-item"><strong>RUT:</strong> {{ $alumno->Run }}</li>
            <li class="list-group-item"><strong>Celular:</strong> {{ $alumno->Celular }}</li>
            <li class="list-group-item"><strong>Fecha Nacimiento:</strong> {{ $alumno->{'Fecha Nacimiento'} }}</li>
            <li class="list-group-item"><strong>Dirección:</strong> {{ $alumno->Dirección }}</li>
            <li class="list-group-item"><strong>Comuna Residencia:</strong> {{ $alumno->{'Comuna Residencia'} }}</li>
        </ul>

        <form method="post" action="{{ route('anotacion.store') }}" id="anotacionForm">
            @csrf
            <input type="hidden" name="rut" value="{{ $alumno->Run }}">
            <input type="hidden" name="nombres" value="{{ $nombreBuscado }}">
            <div class="mb-3">
                <label for="anotacion" class="form-label fw-semibold">📝 Escribir anotación:</label>
                <textarea name="anotacion" id="anotacion" rows="5" class="form-control" required placeholder="Escribe aquí la observación..."></textarea>
            </div>
            <button type="submit" class="btn btn-success" id="guardarBtn">
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                💾 Guardar Anotación
            </button>
        </form>
    </div>
@elseif($nombreBuscado)
    <div class="alert alert-warning text-center message-fade shadow-sm fw-semibold">
        ⚠️ No se encontró ningún alumno con ese nombre.
    </div>
@endif

<style>
body {
    background: linear-gradient(to right, #f0f4ff, #e8fce8);
}

.message-fade {
    animation: fadeOut 7s ease-out forwards;
}
@keyframes fadeOut {
    0%, 85% {opacity: 1;}
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
