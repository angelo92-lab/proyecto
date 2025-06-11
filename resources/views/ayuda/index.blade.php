@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="titulo-principal">📖 Centro de Ayuda</h2>

    <div class="list-group mb-4">
        <a class="list-group-item list-group-item-action" data-bs-toggle="collapse" href="#ayuda1" role="button">
            📁 ¿Cómo subir una planificación?
        </a>
        <div class="collapse" id="ayuda1">
            <div class="card card-body">
                1. Ir al Portal de Funcionarios → Unidad Técnico Pedagógica → Planificaciones.<br>
                2. Navegar hasta la carpeta correspondiente (Ej: 2° Básico).<br>
                3. Click en “Subir archivo” y seleccionar el archivo Word o PDF.<br>
                <strong>Nota:</strong> El archivo debe tener nombre claro, como "Lenguaje Unidad 1".
            </div>
        </div>

        <a class="list-group-item list-group-item-action" data-bs-toggle="collapse" href="#ayuda2" role="button">
            📁 ¿Cómo marcar almuerzo?
        </a>
        <div class="collapse" id="ayuda2">
            <div class="card card-body">
                1. Ir al menú superior y hacer clic en “Marcar Almuerzo”.<br>
                2. Buscar al alumno por nombre o RUN.<br>
                3. Seleccionar la opción “Marcar asistencia” y confirmar.
            </div>
        </div>

        <!-- Puedes agregar más bloques similares -->
    </div>

    <div class="alert alert-info">
        ¿Tienes dudas que no aparecen aquí? Contacta a soporte@tucorreo.cl
    </div>
</div>
@endsection
