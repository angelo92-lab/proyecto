    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reporte de Almuerzos - Curso: {{ $curso }}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
                padding: 10px;
            }

            h1 {
                text-align: center;
                font-size: 18px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            table, th, td {
                border: 1px solid black;
            }

            th, td {
                padding: 6px;
                text-align: center;
            }

            th {
                background-color: #f2f2f2;
            }

            .footer {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                text-align: center;
                font-size: 12px;
                padding: 5px 0;
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>

    <div class="container">
        <h1>Reporte de Almuerzos - Curso: {{ $curso }} - {{ $date }}</h1>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>RUT</th>
                    <th>Celular</th>
                    <th>Curso</th>
                    @if(isset($days))
                        @foreach ($days as $day)
                            <th>{{ $day->format('d/m') }}</th>
                        @endforeach
                    @else
                        <th>Error: Días no disponibles</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($reportData as $data)
                    <tr>
                         <td>{{ is_array($data) ? $data['nombres'] : $data->Nombres }}</td> <!-- Cambiar a 'nombres' -->
                         <td>{{ is_array($data) ? $data['rut'] : $data->RUT }}-{{ is_array($data) ? $data['digito_ver'] : $data->DigitoVer }}</td> <!-- Cambiar a 'rut' y 'digito_ver' -->
                         <td>{{ is_array($data) ? $data['celular'] : $data->Celular }}</td> <!-- Cambiar a 'celular' -->
                         <td>{{ is_array($data) ? $data['curso'] : $data->Curso }}</td> <!-- Cambiar a 'curso' -->
                @if(isset($days))
                @foreach ($days as $day)
                    <td>{{ is_array($data) ? ($data['Dias'][$day->format('Y-m-d')] ?? '✗') : ($data->Dias[$day->format('Y-m-d')] ?? '✗') }}</td>
                @endforeach
            @endif
        </tr>
    @endforeach
</tbody>

        </table>
    </div>

    <div class="footer">
        <p>Generado por el sistema de almuerzos escolares.</p>
    </div>

    </body>
    </html>
