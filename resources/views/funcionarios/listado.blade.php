<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Estudiantes</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Listado de Estudiantes</h1>

    <table>
        @foreach ($filas as $fila)
            <tr>
                @foreach ($fila as $celda)
                    <td>{{ $celda }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>

</body>
</html>
