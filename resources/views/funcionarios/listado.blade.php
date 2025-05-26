<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            @foreach ($encabezados as $enc)
                <th>{{ $enc }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($filas as $fila)
            <tr>
                <td>{{ $fila['nro'] }}</td>
                <td>{{ $fila['nombre'] }}</td>
                <td>{{ $fila['desfile'] }}</td>
                <td>{{ $fila['banda'] }}</td>
                <td>{{ $fila['lugar'] }}</td>
                <td>{{ $fila['asiste'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
