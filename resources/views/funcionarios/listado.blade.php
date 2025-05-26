<!DOCTYPE html>
<html>
<head>
    <title>Listado 21 de Mayo</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
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
    <h1>Listado de Estudiantes - 21 de Mayo</h1>

    <table>
        @foreach ($data as $index => $fila)
            <tr>
                @foreach ($fila as $celda)
                    @if ($index === 0)
                        <th>{{ $celda }}</th>
                    @else
                        <td>{{ $celda }}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
</body>
</html>
