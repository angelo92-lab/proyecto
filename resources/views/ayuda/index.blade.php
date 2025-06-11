@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="titulo-principal">📖 Centro de Ayuda</h2>

    <div class="list-group mb-4">
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

        <a class="list-group-item list-group-item-action" data-bs-toggle="collapse" href="#ayuda2" role="button">
            📁 ¿Cómo agregar y ver anotaciones? 
        </a>
        <div class="collapse" id="ayuda2">
            <div class="card card-body">
                1. Ir al menú superior y hacer clic en “Anotaciones o en el boton anotacion de la lista de alumnos”.<br>
                2. Buscar al alumno por nombre<br>
                3. EScribir la anotacion.
                4. Apretar "Guardar Anotacion"
                5. En anotaciones ver la lista de anotaciones de cada alumno.
            </div>
        </div>

        <!-- Puedes agregar más bloques similares -->
    </div>

    <div class="alert alert-info">
        ¿Tienes dudas que no aparecen aquí? Contacta a angelokocortes@gmail.com
    </div>
</div>
@endsection
