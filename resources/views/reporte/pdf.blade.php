<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asistencia</title>
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
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Reporte de Asistencia</h2>
        @isset($fechaInicio) 
            <p>Del {{ $fechaInicio->format('d/m/Y') }} al {{ $fechaFin->format('d/m/Y') }}</p>
        @else
            <p>Reporte Completo de Asistencia</p>
        @endisset
    </div>

    @if($marcas->isEmpty())
        <p>No hay marcas de asistencia para el periodo seleccionado.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Funcionario</th>
                    <th>Tipo</th>
                    <th>Fecha y Hora</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($marcas as $marca)
                    <tr>
                        <td>{{ $marca->funcionario->nombre }}</td>
                        <td>{{ ucfirst($marca->tipo) }}</td>
                        <td>{{ $marca->fecha_hora->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>
