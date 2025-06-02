@extends('layouts.app') <!-- O el layout que estés usando -->

@section('content')
<div class="container">
    <h2>Detalle de Matrícula</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Datos del Estudiante</h5>
            <p><strong>Nombre:</strong> {{ $matricula->nombres }} {{ $matricula->ap_paterno }} {{ $matricula->ap_materno }}</p>
            <p><strong>RUN:</strong> {{ $matricula->run }}-{{ $matricula->dv }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $matricula->fecha_nacimiento }}</p>
            <p><strong>Curso al que postula:</strong> {{ $matricula->desc_grado }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Datos del Padre</h5>
            <p><strong>Nombre:</strong> {{ $matricula->padre_nombre }}</p>
            <p><strong>RUN:</strong> {{ $matricula->padre_run }}</p>
            <p><strong>Ocupación:</strong> {{ $matricula->padre_ocupacion }}</p>
        </div>
    </div>

    <!-- Repite para madre, tutor legal, apoderado, vivienda, emergencia, etc. -->

    <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection