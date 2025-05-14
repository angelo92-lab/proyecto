@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Horas Trabajadas</h2>
    <p>Del {{ $fechaInicio->format('d/m/Y') }} al {{ $fechaFin->format('d/m/Y') }}</p>

    <!-- Formulario de selección de fechas -->
    <form method="GET" action="{{ route('reporte.horas') }}" class="row g-3 mb-4">
        <div class="col-auto">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $fechaInicio->format('Y-m-d') }}">
        </div>
        <div class="col-auto">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ $fechaFin->format('Y-m-d') }}">
        </div>
        <div class="col-auto align-self-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    <!-- Tabla con las horas -->
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
                    <td>{{ $item['horas_trabajadas'] }} hrs</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Botón para exportar a PDF -->
    <a href="{{ route('reporte.horas.pdf', ['fecha_inicio' => $fechaInicio->format('Y-m-d'), 'fecha_fin' => $fechaFin->format('Y-m-d')]) }}" class="btn btn-danger mt-3">
        Exportar a PDF
    </a>
</div>
@endsection
