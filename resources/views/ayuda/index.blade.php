@extends('layouts.app')

@section('title', 'Centro de Ayuda')

@section('content')
<div class="container py-4">
    <h2 class="titulo-principal">📖 Centro de Ayuda / Documentación Interna</h2>

    <div class="accordion" id="ayudaAccordion">

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
                3. Escribir la anotacion.<br>
                4. Apretar "Guardar Anotacion"<br>
                5. En anotaciones ver la lista de anotaciones de cada alumno.
            </div>
        </div>


        <!-- PREGUNTAS FRECUENTES: MATRÍCULA -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqMatricula">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMatricula" aria-expanded="true" aria-controls="collapseMatricula">
                    📌 Preguntas Frecuentes: Matrícula
                </button>
            </h2>
            <div id="collapseMatricula" class="accordion-collapse collapse show" aria-labelledby="faqMatricula" data-bs-parent="#ayudaAccordion">
                <div class="accordion-body">
                    <ul>
                        <li><strong>¿Dónde ingreso la matrícula de un nuevo estudiante?</strong><br>
                            Desde el menú principal → <code>Ingresar Matrícula</code>.
                        </li>
                        <li><strong>¿Puedo editar una matrícula luego de ingresarla?</strong><br>
                            Por ahora no. Si necesitas corregir datos, contacta a la UTP o responsable técnico.
                        </li>
                        <li><strong>¿Puedo ver un listado de todas las matrículas ingresadas?</strong><br>
                            Sí, desde <code>Reportes Matrículas</code>.
                        </li>
                        <li><strong>¿Qué hago si el apoderado cambia?</strong><br>
                            Ingresa una nueva matrícula con los datos corregidos o comunica al responsable.
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- MAPA DEL SITIO -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="mapaSitio">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMapaSitio" aria-expanded="false" aria-controls="collapseMapaSitio">
                    🗺️ Mapa del Sitio
                </button>
            </h2>
            <div id="collapseMapaSitio" class="accordion-collapse collapse" aria-labelledby="mapaSitio" data-bs-parent="#ayudaAccordion">
                <div class="accordion-body">
                    <ul>
                        <li><strong>🎲 Página principal:</strong> Inicio del sistema</li>
                        <li><strong>🍽️ Casino escolar:</strong>
                            <ul>
                                <li>Lista de Alumnos</li>
                                <li>Marcar Almuerzo</li>
                                <li>Reportes</li>
                            </ul>
                        </li>
                        <li><strong>📝 Anotaciones:</strong>
                            <ul>
                                <li>Agregar Anotación</li>
                                <li>Ver Anotaciones</li>
                            </ul>
                        </li>
                        <li><strong>⏰ Asistencia y reloj:</strong>
                            <ul>
                                <li>Marcar Asistencia</li>
                                <li>Estado Diario</li>
                                <li>Generar Reporte</li>
                            </ul>
                        </li>
                        <li><strong>🧑‍🏫 Portal Funcionarios:</strong>
                            <ul>
                                <li>Formatos, Evaluaciones, Planificaciones</li>
                                <li>Acompañamiento Docente</li>
                            </ul>
                        </li>
                        <li><strong>📋 Matrículas:</strong>
                            <ul>
                                <li>Ingresar Matrícula</li>
                                <li>Reportes Matrículas</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
