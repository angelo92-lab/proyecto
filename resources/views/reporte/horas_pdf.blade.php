<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Horas Trabajadas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Reporte de Horas Trabajadas</h2>
    <p>Del {{ $fechaInicio->format('d/m/Y') }} al {{ $fechaFin->format('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Funcionario</th>
                <th>Horas Trabajadas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resumen as $item)
                <tr>
                    <td>{{ $item['funcionario'] }}</td>
                    <td>{{ $item['horas_trabajadas'] }} hrs</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
