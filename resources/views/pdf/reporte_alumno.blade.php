<!DOCTYPE html>
<html>
<head>
    <title>Reporte Alumno</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }

        h1, h2, h3 {
            margin: 0;
            padding: 4px 0;
        }
    </style>
</head>
<body>
    <h1>Reporte de Almuerzos</h1>
    <h2>Alumno: {{ $student->Nombres }}</h2>
    <h3>Curso: {{ $student->Curso }}</h3>
    <h3>Mes: {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}</h3>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>¿Almorzó?</th>
            </tr>
        </thead>
        <tbody>
            @php
                use Carbon\Carbon;
                $start = Carbon::parse($month)->startOfMonth();
                $end = Carbon::parse($month)->endOfMonth();
            @endphp

            @for ($date = $start->copy(); $date <= $end; $date->addDay())
                @php $formatted = $date->format('Y-m-d'); @endphp
                <tr>
                    <td>{{ $date->format('d-m-Y') }}</td>
                    <td>{{ !empty($lunchesByDate[$formatted]) ? 'Sí' : 'No' }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
</body>
</html>
