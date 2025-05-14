@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Horas Trabajadas</h2>
    <p>Del {{ $fechaInicio->format('d/m/Y') }} al {{ $fechaFin->format('d/m/Y') }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Funcionario</th>
                <th>Horas Trabajadas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resumen as $item)
                <tr>
                    <td>{{ $item['funcionario'] }}</td>
                    <td>{{ $item['horas_trabajadas'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
