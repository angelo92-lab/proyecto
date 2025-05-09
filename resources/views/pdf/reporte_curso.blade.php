<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Almuerzos - {{ $curso }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }
        .subheader {
            text-align: center;
            margin-bottom: 20px;
        }
        .subheader h3 {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: #d0e4f5;
        }
        .footer {
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        {{-- <img src="{{ public_path('imagenes/logo.jpg') }}" alt="Logo" height="50"> --}}
        <h1>COLEGIO REPÚBLICA DE CHILE</h1>
    </div>

    <div class="subheader">
        <h3>Reporte de Almuerzos</h3>
        <h3>Curso: {{ $curso }}</h3>
        <h3>Fecha: {{ $date }}</h3>
        <h3>Filtro: {{ $dateFilterType }}</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>RUT</th>
                <th>Dígito Verificador</th>
                <th>Celular</th>
                <th>Curso</th>
                <th>Almorzó</th>
            </tr>
        </thead>
        <tbody>
            @php $totalAlmorzaron = 0; @endphp
            @foreach($reportData as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data['nombres'] }}</td>
                    <td>{{ $data['rut'] }}</td>
                    <td>{{ $data['digito_ver'] }}</td>
                    <td>{{ $data['celular'] }}</td>
                    <td>{{ $data['curso'] }}</td>
                    <td>
                        @if(strtolower($data['almorzo']) == 'si')
                            ✓ @php $totalAlmorzaron++; @endphp
                        @else
                            ✗
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Total de alumnos: {{ count($reportData) }}<br>
        Total que almorzaron: {{ $totalAlmorzaron }}
    </div>

</body>
</html>
