@extends('layouts.app')

@section('title', 'Historial de Anotaciones')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary fw-bold">📖 Historial de Anotaciones</h1>

    <div class="mb-3">
        <h5><strong>Nombre:</strong> {{ $alumno->Nombres }} {{ $alumno->{'Apellido Paterno'} ?? '' }}</h5>
        <h6><strong>RUT:</strong> {{ $alumno->Run }}</h6>
    </div>

    @if ($anotaciones->count() > 0)
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>📝 Anotación</th>
                    <th>📅 Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anotaciones as $anotacion)
                <tr>
                    <td>{!! nl2br(e($anotacion->anotacion)) !!}</td>
                    <td>{{ \Carbon\Carbon::parse($anotacion->fecha)->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info text-center">No hay anotaciones para este alumno.</div>
    @endif

    <a href="{{ route('anotaciones.index') }}" class="btn btn-outline-secondary mt-3">← Volver al listado</a>
</div>
@endsection
