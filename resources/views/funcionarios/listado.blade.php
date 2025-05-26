@extends('layouts.app') {{-- o el layout que estés usando --}}

@section('content')
    <h1>Listado de Estudiantes que Desfilaron</h1>

    <table border="1" cellpadding="5" cellspacing="0">
        @foreach ($datos as $fila)
            <tr>
                @foreach ($fila as $celda)
                    <td>{{ $celda }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
@endsection
