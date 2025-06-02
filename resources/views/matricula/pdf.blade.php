<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte Matrículas 2026</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
    <img src="{{ public_path('imagenes/logo.png') }}" alt="Logo" style="width: 80px;">
    <h1 style="margin: 0;">Ficha de Matrícula 2026</h1>
</div>

    <h2>📄 Reporte de Matrículas 2026</h2>
    <table>
        <thead>
            <tr>
                <th>Run</th>
                <th>Nombre Completo</th>
                <th>Curso</th>
                <th>Fecha Nac.</th>
                <th>Comuna</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matriculas as $matricula)
            <tr>
                <td>{{ $matricula->run }}</td>
                <td>{{ $matricula->nombres }} {{ $matricula->apellido_paterno }} {{ $matricula->apellido_materno }}</td>
                <td>{{ $matricula->curso ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($matricula->fecha_nacimiento)->format('d/m/Y') }}</td>
                <td>{{ $matricula->comuna }}</td>
                <td>{{ $matricula->direccion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
