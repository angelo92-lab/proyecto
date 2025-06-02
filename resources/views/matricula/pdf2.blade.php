<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ficha de Matrícula</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h1 { text-align: center; font-size: 18px; }
        h3 { margin-top: 30px; color: #2d2d2d; }
        p { margin: 0 0 5px; }
        .section { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Ficha de Matrícula 2026</h1>

    <div class="section">
        <h3>Datos del Estudiante</h3>
        <p><strong>Nombre:</strong> {{ $matricula->nombres }} {{ $matricula->apellido_paterno }} {{ $matricula->apellido_materno }}</p>
        <p><strong>Curso:</strong> {{ $matricula->curso }}</p>
        <p><strong>RUN:</strong> {{ $matricula->run }}</p>
        <p><strong>Fecha Nacimiento:</strong> {{ $matricula->fecha_nacimiento }}</p>
        {{-- Agrega los demás campos según desees --}}
    </div>

    {{-- Repite para las otras secciones como grupo familiar, apoderado, etc. --}}
</body>
</html>
