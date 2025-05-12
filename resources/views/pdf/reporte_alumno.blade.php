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
        <div style="text-align: center; margin-bottom: 20px;">
    <h2>REPORTE DE ALMUERZOS INDIVIDUAL</h2>
    <p>
        Alumno: {{ $student->Nombres }}<br>
        Mes: {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}
    </p>
</div>
        <small>{{ $student->Nombres }} | RUT: {{ $student->Run }}-{{ $student->{'Digito Ver'} }} | Mes: {{ \Carbon\Carbon::parse($month)->format('F Y') }}</small>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>¿Almorzó?</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData['lunchRecords'] as $record)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($record->fecha)->format('d-m-Y') }}</td>
                    <td>{{ $record->almorzo ? 'Sí' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
