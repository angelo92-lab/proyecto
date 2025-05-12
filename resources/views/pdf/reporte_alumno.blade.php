<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Alumno - {{ $student->Nombres }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
        }
        .header small {
            font-size: 14px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>REPORTE DE ALMUERZOS DEL ALUMNO</h1>
        <p>
            Alumno: <strong>{{ $student->Nombres }}</strong><br>
            RUT: {{ $student->Run }}-{{ $student->{'Digito Ver'} }}<br>
            Mes: {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>¿Almorzó?</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalSi = 0;
                $totalNo = 0;
            @endphp
            @foreach($days as $day)
                @php
                    $fecha = $day->format('Y-m-d');
                    $formato = $day->format('d-m-Y');
                    $almorzo = isset($almuerzoDias[$fecha]);
                    $tick = $almorzo ? '✓' : '✗';
                    if ($almorzo) {
                        $totalSi++;
                    } else {
                        $totalNo++;
                    }
                @endphp
                <tr>
                    <td>{{ $formato }}</td>
                    <td>{{ $tick }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total Sí</th>
                <td>{{ $totalSi }}</td>
            </tr>
            <tr>
                <th>Total No</th>
                <td>{{ $totalNo }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
