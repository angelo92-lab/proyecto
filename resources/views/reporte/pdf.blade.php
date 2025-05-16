<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Asistencia</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Reporte de Asistencia</h2>
    <p>Desde: {{ $fechaInicio->format('d-m-Y') }} - Hasta: {{ $fechaFin->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha y Hora</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marcas as $marca)
                <tr>
                    <td>{{ $marca->funcionario->nombre }}</td>
                    <td>{{ \Carbon\Carbon::parse($marca->fecha_hora)->format('d-m-Y H:i') }}</td>
                    <td>{{ ucfirst($marca->tipo) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
