<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Almuerzos por Curso</title>
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
    <h1>Reporte de Almuerzos por Curso</h1>
    <h2>Curso: {{ $curso }}</h2>
    <h3>Fecha: {{ $date }}</h3>
    <h3>Filtrar por: {{ $dateFilterType }}</h3>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>RUT</th>
                <th>Dígito Verificador</th>
                <th>Celular</th>
                <th>Curso</th>
                <th>Almorzó</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $data)
            <tr>
                <td>{{ $data['nombre'] }}</td>
                <td>{{ $data['rut'] }}</td>
                <td>{{ $data['digito ver'] }}</td>
                <td>{{ $data['celular'] }}</td>
                <td>{{ $data['curso'] }}</td>
                <td>{{ $data['almorzo'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>