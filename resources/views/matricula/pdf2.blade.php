<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ficha Matrícula 2026</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            margin: 15px;
        }
        h1 {
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        th, td {
            padding: 2px 4px;
            text-align: left;
            vertical-align: top;
        }
        .section-title {
            background-color: #f2f2f2;
            font-weight: bold;
            padding: 4px;
        }
    </style>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
    <img src="{{ public_path('imagenes/logo.jpg') }}" alt="Logo" style="width: 80px;">
    <h1 style="margin: 0;">Ficha de Matrícula 2026</h1>
</div>


<h1>Ficha de Matrícula 2026</h1>

<table border="1">
    <tr><th colspan="4" class="section-title">👤 Estudiante</th></tr>
    <tr><td>Nombre</td><td colspan="3">{{ $matricula->nombres }} {{ $matricula->apellido_paterno }} {{ $matricula->apellido_materno }}</td></tr>
    <tr><td>RUN</td><td>{{ $matricula->run }}</td><td>Curso</td><td>{{ $matricula->curso }}</td></tr>
    <tr><td>Sexo</td><td>{{ $matricula->sexo }}</td><td>F. Nac.</td><td>{{ $matricula->fecha_nacimiento }}</td></tr>
    <tr><td>Edad al 31/03</td><td>{{ $matricula->edad_al_31_marzo }}</td><td>Nacionalidad</td><td>{{ $matricula->nacionalidad }}</td></tr>
    <tr><td>Dirección</td><td colspan="3">{{ $matricula->direccion }}</td></tr>
    <tr><td>Localidad</td><td>{{ $matricula->localidad }}</td><td>Comuna</td><td>{{ $matricula->comuna }}</td></tr>
    <tr><td>Locomoción</td><td>{{ $matricula->requiere_locomocion ? 'Sí' : 'No' }}</td><td>Pueblo originario</td><td>{{ $matricula->pueblos_originarios ? 'Sí' : 'No' }} @if ($matricula->pueblo_originario) ({{ $matricula->pueblo_originario }}) @endif</td></tr>
    <tr><td>PIE</td><td>{{ $matricula->programa_integracion ? 'Sí' : 'No' }}</td><td>Cursos Repetidos</td><td>{{ $matricula->cursos_repetidos }}</td></tr>
    <tr><td>Est. Procedencia</td><td colspan="3">{{ $matricula->establecimiento_procedencia }}</td></tr>
    <tr><td>Alergias</td><td>{{ $matricula->alergias ? 'Sí' : 'No' }}</td><td>Detalle</td><td>{{ $matricula->alergias_detalle }}</td></tr>
    <tr><td>Enfermedad</td><td colspan="3">{{ $matricula->enfermedad_diagnosticada }}</td></tr>

    <tr><th colspan="4" class="section-title">👨‍👩‍👧 Grupo Familiar</th></tr>
    <tr><td>Padre</td><td>{{ $matricula->padre_nombre }}</td><td>Educación</td><td>{{ $matricula->padre_nivel_educacional }}</td></tr>
    <tr><td>Madre</td><td>{{ $matricula->madre_nombre }}</td><td>Educación</td><td>{{ $matricula->madre_nivel_educacional }}</td></tr>
    <tr><td>Tutor Legal</td><td>{{ $matricula->tutor_nombre }}</td><td>Educación</td><td>{{ $matricula->tutor_nivel_educacional }}</td></tr>
    <tr><td>Vive con</td><td colspan="3">{{ $matricula->personas_con_quien_vive }}</td></tr>

    <tr><th colspan="4" class="section-title">🏠 Vivienda</th></tr>
    <tr><td>Tipo</td><td>{{ $matricula->tipo_vivienda }}</td><td>Luz</td><td>{{ $matricula->posee_luz ? 'Sí' : 'No' }}</td></tr>
    <tr><td>Alcantarillado</td><td colspan="3">{{ $matricula->posee_alcantarillado ? 'Sí' : 'No' }}</td></tr>

    <tr><th colspan="4" class="section-title">🧑‍⚖️ Apoderado</th></tr>
    <tr><td>Nombre</td><td>{{ $matricula->apoderado_nombre }}</td><td>Domicilio</td><td>{{ $matricula->apoderado_domicilio }}</td></tr>
    <tr><td>Teléfono</td><td>{{ $matricula->apoderado_telefono }}</td><td>Suplente</td><td>{{ $matricula->suplente_nombre }}</td></tr>
    <tr><td>Dom. Suplente</td><td>{{ $matricula->suplente_domicilio }}</td><td>Tel. Suplente</td><td>{{ $matricula->suplente_telefono }}</td></tr>
    <tr><td>¿Autoriza Suplente?</td><td colspan="3">{{ $matricula->autoriza_suplente ? 'Sí' : 'No' }}</td></tr>

    <tr><th colspan="4" class="section-title">🚨 Emergencia</th></tr>
    <tr><td>Nombre</td><td>{{ $matricula->emergencia_nombre }}</td><td>Celular</td><td>{{ $matricula->emergencia_celular }}</td></tr>

    <tr><th colspan="4" class="section-title">📝 Responsable Ficha</th></tr>
    <tr><td>Nombre</td><td>{{ $matricula->responsable_ficha }}</td><td>Firma</td><td>{{ $matricula->firma_responsable }}</td></tr>
    <tr><td>Fecha</td><td colspan="3">{{ $matricula->fecha_ficha }}</td></tr>
</table>

</body>
</html>
