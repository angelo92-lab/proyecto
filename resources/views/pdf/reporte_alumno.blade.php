<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Almuerzos por Alumno</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2, h3 {
            margin: 0;
        }
        .info {
            margin-top: 10px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .yes {
            color: green;
            font-weight: bold;
        }
        .no {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Reporte de Almuerzos por Alumno</h1>

    <div class="info">
        <h2>Alumno: {{ $student->Nombres }}</h2>
        <h3>Curso: {{ $student->Curso }}</h3>
        <h3>Mes: {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>¿Almorzó?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daysOfMonth as $day)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($day)->format('d-m-Y') }}</td>
                    <td>
                        @if (isset($lunchesByDate[$day]) && $lunchesByDate[$day])
                            <span class="yes">Sí</span>
                        @else
                            <span class="no">No</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="margin-top: 20px;">
        Total de días que almorzó: {{ collect($lunchesByDate)->filter()->count() }}
    </h3>
</body>
</html>
