<!DOCTYPE html>
<html>
<head>
    <title>Reporte Alumno</title>
</head>
<body>
    <h1>Reporte de Almuerzos</h1>
    <h2>Alumno: {{ $student->Nombres }}</h2>
    <h3>Curso: {{ $student->Curso }}</h3>
    <h3>Mes: {{ $month }}</h3>

    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>¿Almorzó?</th>
            </tr>
        </thead>
        <tbody>
            @php
                use Carbon\Carbon;
                $start = Carbon::parse($month)->startOfMonth();
                $end = Carbon::parse($month)->endOfMonth();
            @endphp

            @while ($start <= $end)
                @php $date = $start->format('Y-m-d'); @endphp
                <tr>
                    <td>{{ $start->format('d-m-Y') }}</td>
                    <td>{{ !empty($lunchesByDate[$date]) ? 'Sí' : 'No' }}</td>
                </tr>
                @php $start->addDay(); @endphp
            @endwhile
        </tbody>
    </table>
</body>
</html>
