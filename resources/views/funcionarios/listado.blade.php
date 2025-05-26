@extends('layouts.app') {{-- Asegúrate de tener tu layout base aquí --}}

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Alumnos que Desfilaron el 21 de Mayo</h2>

    @isset($error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endisset

    @if(count($alumnos) > 1)
        <table class="table table-striped">
            <thead>
                <tr>
                    @foreach($alumnos[0] as $columna)
                        <th>{{ $columna }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach(array_slice($alumnos, 1) as $fila)
                    <tr>
                        @foreach($fila as $celda)
                            <td>{{ $celda }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay datos para mostrar.</p>
    @endif
</div>
@endsection
