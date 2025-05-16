<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Mensual de Asistencia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 4px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .asistio {
            background-color: #d4edda;
        }
        .no-asistio {
            background-color: #f8d7da;
        }
    </style>
</head>
<body>

    <h2>Detalle Mensual de Asistencia</h2>
    <p><strong>Desde:</strong> {{ $fechaInicio->format('d/m/Y') }} <strong>Hasta:</strong> {{ $fechaFin->format('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Funcionario</th>
                @foreach ($diasDelMes as $dia)
                    <th>{{ \Carbon\Carbon::parse($dia)->format('d') }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($reporte as $fila)
                <tr>
                    <td>{{ $fila['nombre'] }}</td>
                    @foreach ($diasDelMes as $dia)
                        @php
                            $datos = $fila['dias'][$dia];
                        @endphp
                        <td class="{{ $datos['asistio'] ? 'asistio' : 'no-asistio' }}">
                            {{ $datos['asistio'] ? $datos['horas'] . 'h' : '-' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
