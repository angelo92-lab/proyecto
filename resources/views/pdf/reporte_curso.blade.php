<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Curso - {{ $curso }}</title>
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
            padding: 4px;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
        }
        .student-name {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>REPORTE DE ALMUERZOS</h1>
        <small>Curso: {{ $curso }} | Fecha: {{ $date }} | Tipo: {{ $dateFilterType == 'day' ? 'Diario' : 'Mensual' }}</small>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>RUT</th>
                <th>DV</th>
                <th>Celular</th>
                <th>Curso</th>
                @foreach($days as $day)
                    <th>{{ \Carbon\Carbon::parse($day)->format('d') }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
         @foreach($reportData as $row)
            <tr>
                <td class="student-name">{{ $row['Nombres'] }}</td>
                    <td>{{ $row['RUT'] }}</td>
                    <td>{{ $row['DigitoVer'] }}</td>
                    <td>{{ $row['Celular'] }}</td>
                    <td>{{ $row['Curso'] }}</td>
            @foreach($days as $day)
                @php
                    $fecha = \Carbon\Carbon::parse($day)->format('Y-m-d');
                @endphp
                <td>{{ $row['Dias'][$fecha] ?? '' }}</td>
            @endforeach
         </tr>
        @endforeach
    </tbody>
    </table>
</body>
</html>
