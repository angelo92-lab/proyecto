@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalle de Matrícula</h2>

    <!-- DATOS DEL ESTUDIANTE -->
    <div class="card mb-3">
        <div class="card-body">
            <h5>Datos del Estudiante</h5>
            <p><strong>Nombre:</strong> {{ $matricula->nombres }} {{ $matricula->ap_paterno }} {{ $matricula->ap_materno }}</p>
            <p><strong>RUN:</strong> {{ $matricula->run }}-{{ $matricula->dv }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $matricula->fecha_nacimiento }}</p>
            <p><strong>Curso al que postula:</strong> {{ $matricula->desc_grado }}</p>
        </div>
    </div>

    <!-- DATOS DEL PADRE -->
    <div class="card mb-3">
        <div class="card-body">
            <h5>Datos del Padre</h5>
            <p><strong>Nombre:</strong> {{ $matricula->padre_nombre }}</p>
            <p><strong>RUN:</strong> {{ $matricula->padre_run }}</p>
            <p><strong>Ocupación:</strong> {{ $matricula->padre_ocupacion }}</p>
        </div>
    </div>

    <!-- DATOS DE LA MADRE -->
    <div class="card mb-3">
        <div class="card-body">
            <h5>Datos de la Madre</h5>
            <p><strong>Nombre:</strong> {{ $matricula->madre_nombre }}</p>
            <p><strong>RUN:</strong> {{ $matricula->madre_run }}</p>
            <p><strong>Ocupación:</strong> {{ $matricula->madre_ocupacion }}</p>
        </div>
    </div>

    <!-- DATOS DEL TUTOR LEGAL -->
    <div class="card mb-3">
        <div class="card-body">
            <h5>Tutor Legal</h5>
            <p><strong>Nombre:</strong> {{ $matricula->tutor_nombre }}</p>
            <p><strong>RUN:</strong> {{ $matricula->tutor_run }}</p>
            <p><strong>Parentesco:</strong> {{ $matricula->tutor_parentesco }}</p>
        </div>
    </div>

    <!-- DATOS DE CON QUIÉN VIVE -->
    <div class="card mb-3">
        <div class="card-body">
            <h5>Con quién vive el estudiante</h5>
            <p><strong>Nombre:</strong> {{ $matricula->vive_nombre }}</p>
            <p><strong>RUN:</strong> {{ $matricula->vive_run }}</p>
            <p><strong>Parentesco:</strong> {{ $matricula->vive_parentesco }}</p>
        </div>
    </div>

    <!-- DATOS DE LA VIVIENDA -->
    <div class="card mb-3">
        <div class="card-body">
            <h5>Datos de la Vivienda</h5>
            <p><strong>Dirección:</strong> {{ $matricula->direccion }}</p>
            <p><strong>Comuna:</strong> {{ $matricula->comuna }}</p>
            <p><strong>Teléfono:</strong> {{ $matricula->telefono }}</p>
        </div>
    </div>

    <!-- DATOS DEL APODERADO -->
    <div class="card mb-3">
        <div class="card-body">
            <h5>Apoderado</h5>
            <p><strong>Nombre:</strong> {{ $matricula->apoderado_nombre }}</p>
            <p><strong>RUN:</strong> {{ $matricula->apoderado_run }}</p>
            <p><strong>Parentesco:</strong> {{ $matricula->apoderado_parentesco }}</p>
            <p><strong>Teléfono:</strong> {{ $matricula->apoderado_telefono }}</p>
            <p><strong>Correo:</strong> {{ $matricula->apoderado_email }}</p>
        </div>
    </div>

    <!-- DATOS DE EMERGENCIA -->
    <div class="card mb-3">
        <div class="card-body">
            <h5>Contacto de Emergencia</h5>
            <p><strong>Nombre:</strong> {{ $matricula->emergencia_nombre }}</p>
            <p><strong>Parentesco:</strong> {{ $matricula->emergencia_parentesco }}</p>
            <p><strong>Teléfono:</strong> {{ $matricula->emergencia_telefono }}</p>
        </div>
    </div>

    <!-- RESPONSABLE DEL LLENADO -->
    <div class="card mb-3">
        <div class="card-body">
            <h5>Responsable del llenado</h5>
            <p><strong>Nombre:</strong> {{ $matricula->responsable_nombre }}</p>
            <p><strong>Parentesco:</strong> {{ $matricula->responsable_parentesco }}</p>
            <p><strong>Fecha de llenado:</strong> {{ $matricula->fecha_lleno }}</p>
        </div>
    </div>

    <!-- BOTÓN VOLVER -->
    <a href="{{ route('matricula.reportes') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
