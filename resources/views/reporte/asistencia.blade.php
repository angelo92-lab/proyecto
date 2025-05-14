@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Reporte de Asistencia</h2>

    <!-- Formulario para seleccionar rango de fechas -->
    <form method="GET" action="{{ route('reporte.asistencia') }}">
        @csrf
        <div class="row">
            <div class="col">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $fechaInicio->format('Y-m-d') }}">
            </div>
            <div class="col">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ $fechaFin->format('Y-m-d') }}">
            </div>
            <div class="col align-self-end">
                <button type="submit" class="btn btn-primary">Generar Reporte</button>
            </div>
        </div>
    </form>

    <div class="mt-4">
        <h3>Asistencia del {{ $fechaInicio->format('d/m/Y') }} al {{ $fechaFin->format('d/m/Y') }}</h3>

        @if($marcas->isEmpty())
            <p>No hay marcas de asistencia en este rango de fechas.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Funcionario</th>
                        <th>Tipo</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marcas as $marca)
                        <tr>
                            <td>{{ $marca->funcionario->nombre }}</td>
                            <td>{{ ucfirst($marca->tipo) }}</td>
                            <td>{{ $marca->fecha_hora->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Botón para descargar todos los reportes -->
<div class="mt-4">
    <a href="{{ route('reporte.exportar.todos') }}" class="btn btn-danger">
        Descargar Todos los Reportes
    </a>
</div>


            <!-- Botón para exportar a PDF -->
            <a href="{{ route('reporte.exportar', ['fecha_inicio' => $fechaInicio->format('Y-m-d'), 'fecha_fin' => $fechaFin->format('Y-m-d')]) }}" class="btn btn-danger mt-4" target="_blank">
                Exportar a PDF
            </a>
        @endif
    </div>
</div>
@endsection
