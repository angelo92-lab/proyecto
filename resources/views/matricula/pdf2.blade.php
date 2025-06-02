<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha de Matrícula 2026</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h1, h4 {
            color: #2c3e50;
        }
        .section {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .section h4 {
            margin-bottom: 10px;
            border-bottom: 1px solid #999;
            padding-bottom: 3px;
        }
        p {
            margin: 2px 0;
        }
    </style>
</head>
<body>
    <h1>📄 Ficha de Matrícula 2026</h1>

    {{-- Estudiante --}}
    <div class="section">
        <h4>👤 Datos del Estudiante</h4>
        <p><strong>Curso:</strong> {{ $matricula->curso }}</p>
        <p><strong>RUN:</strong> {{ $matricula->run }}</p>
        <p><strong>Nombre Completo:</strong> {{ $matricula->nombres }} {{ $matricula->apellido_paterno }} {{ $matricula->apellido_materno }}</p>
        <p><strong>Sexo:</strong> {{ $matricula->sexo }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $matricula->fecha_nacimiento }}</p>
        <p><strong>Edad al 31 de marzo:</strong> {{ $matricula->edad_al_31_marzo }}</p>
        <p><strong>Nacionalidad:</strong> {{ $matricula->nacionalidad }}</p>
        <p><strong>Dirección:</strong> {{ $matricula->direccion }}</p>
        <p><strong>Localidad:</strong> {{ $matricula->localidad }}</p>
        <p><strong>Comuna:</strong> {{ $matricula->comuna }}</p>
        <p><strong>Requiere locomoción:</strong> {{ $matricula->requiere_locomocion ? 'Sí' : 'No' }}</p>
        <p><strong>¿Pertenece a pueblo originario?:</strong> {{ $matricula->pueblos_originarios ? 'Sí' : 'No' }}</p>
        @if ($matricula->pueblo_originario)
            <p><strong>Pueblo originario:</strong> {{ $matricula->pueblo_originario }}</p>
        @endif
        <p><strong>Programa de integración:</strong> {{ $matricula->programa_integracion ? 'Sí' : 'No' }}</p>
        <p><strong>Cursos repetidos:</strong> {{ $matricula->cursos_repetidos }}</p>
        <p><strong>Establecimiento de procedencia:</strong> {{ $matricula->establecimiento_procedencia }}</p>
        <p><strong>¿Tiene alergias?:</strong> {{ $matricula->alergias ? 'Sí' : 'No' }}</p>
        @if ($matricula->alergias_detalle)
            <p><strong>Detalle de alergias:</strong> {{ $matricula->alergias_detalle }}</p>
        @endif
        <p><strong>Enfermedad diagnosticada:</strong> {{ $matricula->enfermedad_diagnosticada }}</p>
    </div>

    {{-- Grupo Familiar --}}
    <div class="section">
        <h4>👨‍👩‍👧 Grupo Familiar</h4>
        <p><strong>Nombre del padre:</strong> {{ $matricula->padre_nombre }}</p>
        <p><strong>Nivel educacional del padre:</strong> {{ $matricula->padre_nivel_educacional }}</p>
        <p><strong>Nombre de la madre:</strong> {{ $matricula->madre_nombre }}</p>
        <p><strong>Nivel educacional de la madre:</strong> {{ $matricula->madre_nivel_educacional }}</p>
        <p><strong>Nombre del tutor legal:</strong> {{ $matricula->tutor_nombre }}</p>
        <p><strong>Nivel educacional del tutor:</strong> {{ $matricula->tutor_nivel_educacional }}</p>
        <p><strong>Personas con las que vive:</strong> {{ $matricula->personas_con_quien_vive }}</p>
    </div>

    {{-- Vivienda --}}
    <div class="section">
        <h4>🏠 Vivienda</h4>
        <p><strong>Tipo de vivienda:</strong> {{ $matricula->tipo_vivienda }}</p>
        <p><strong>¿Posee luz eléctrica?:</strong> {{ $matricula->posee_luz ? 'Sí' : 'No' }}</p>
        <p><strong>¿Posee alcantarillado?:</strong> {{ $matricula->posee_alcantarillado ? 'Sí' : 'No' }}</p>
    </div>

    {{-- Apoderado --}}
    <div class="section">
        <h4>🧑‍⚖️ Apoderado</h4>
        <p><strong>Nombre:</strong> {{ $matricula->apoderado_nombre }}</p>
        <p><strong>Domicilio:</strong> {{ $matricula->apoderado_domicilio }}</p>
        <p><strong>Teléfono:</strong> {{ $matricula->apoderado_telefono }}</p>
        <p><strong>Apoderado suplente:</strong> {{ $matricula->suplente_nombre }}</p>
        <p><strong>Domicilio suplente:</strong> {{ $matricula->suplente_domicilio }}</p>
        <p><strong>Teléfono suplente:</strong> {{ $matricula->suplente_telefono }}</p>
        <p><strong>¿Autoriza al suplente?:</strong> {{ $matricula->autoriza_suplente ? 'Sí' : 'No' }}</p>
    </div>

    {{-- Emergencia --}}
    <div class="section">
        <h4>🚨 Contacto de Emergencia</h4>
        <p><strong>Nombre:</strong> {{ $matricula->emergencia_nombre }}</p>
        <p><strong>Celular:</strong> {{ $matricula->emergencia_celular }}</p>
    </div>

    {{-- Responsable --}}
    <div class="section">
        <h4>📝 Responsable del Llenado</h4>
        <p><strong>Nombre:</strong> {{ $matricula->responsable_ficha }}</p>
        <p><strong>Firma:</strong> {{ $matricula->firma_responsable }}</p>
        <p><strong>Fecha:</strong> {{ $matricula->fecha_ficha }}</p>
    </div>
</body>
</html>
