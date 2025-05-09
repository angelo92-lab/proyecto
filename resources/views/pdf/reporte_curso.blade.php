<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Almuerzos - Curso: {{ $curso }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 10px;
        }

        h1 {
            text-align: center;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            padding: 5px 0;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Reporte de Almuerzos del Curso: {{ $curso }} - {{ $date }}</h1>
        
        <table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>RUT</th>
            <th>Celular</th>
            <th>Curso</th>
            @foreach ($days as $day)
                <th>{{ $day->format('d-m-Y') }}</th> <!-- Muestra las fechas de los días -->
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($reportData as $data)
            <tr>
                <td>{{ $data['nombres'] }}</td>
                <td>{{ $data['rut'] }}</td>
                <td>{{ $data['celular'] }}</td>
                <td>{{ $data['curso'] }}</td>
                @foreach ($days as $day)
                    <td>{{ $data['dias'][$day->format('Y-m-d')] }}</td> <!-- Mostrar almuerzo para cada día -->
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
    </div>

    <div class="footer">
        <p>Generado por el sistema de almuerzos escolares.</p>
    </div>

</body>
</html>
