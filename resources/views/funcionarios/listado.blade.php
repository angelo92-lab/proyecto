@extends('layouts.app') {{-- O tu layout base --}}

@section('content')
    <h1>Listado de Estudiantes que Desfilaron</h1>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                @foreach ($encabezados as $titulo)
                    <th>{{ $titulo }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($datos as $fila)
                <tr>
                    @foreach ($fila as $celda)
                        <td>{{ $celda }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
