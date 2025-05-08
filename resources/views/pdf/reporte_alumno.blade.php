<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Almuerzos por Alumno</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte de Almuerzos por Alumno</h1>
    <h2>Alumno: {{ $student->Nombres }}</h2>
    <h3>Curso: {{ $student->Curso }}</h3>
    <h3>Mes: {{ $month }}</h3>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>¿Almorzó?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allDays as $day)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($day)->format('d-m-Y') }}</td>
                    <td>{{ $lunchesByDate[$day] ? 'Sí' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total días que almorzó: {{ collect($lunchesByDate)->filter()->count() }}</h3>
</body>
</html>
