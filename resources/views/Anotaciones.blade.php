@extends('layouts.app')

@section('title', 'Listado de Anotaciones')

@section('content')
<h1 class="mb-4 text-center text-primary fw-bold display-6">📋 Listado de Anotaciones</h1>

<div class="mb-4 d-flex justify-content-end gap-2">
    <a href="{{ url('alumnoscasino') }}" class="btn btn-outline-secondary shadow-sm">← Volver a los Alumnos</a>
    <a href="{{ url('agregaranotacion') }}" class="btn btn-primary shadow-sm">➕ Agregar Anotación</a>
</div>

@if ($anotaciones->count() > 0)
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-hover bg-white rounded">
            <thead class="table-dark text-center">
                <tr>
                    <th>👤 Nombre</th>
                    <th>🆔 RUT</th>
                    <th>📝 Anotación</th>
                    <th>📅 Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anotaciones as $anotacion)
                <tr>
                    <td>{{ $anotacion->nombres }} {{ $anotacion->{'apellido paterno'} }}</td>
                    <td>{{ $anotacion->rut }}</td>
                    <td>{!! nl2br(e($anotacion->anotacion)) !!}</td>
                    <td>{{ \Carbon\Carbon::parse($anotacion->fecha)->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-info text-center message-fade shadow-sm fw-semibold">
        ℹ️ No hay anotaciones registradas.
    </div>
@endif

<style>
body {
    background: linear-gradient(to right, #eef7ff, #e3f9ea);
}

.message-fade {
    animation: fadeOut 6s forwards;
}
@keyframes fadeOut {
    0%, 80% { opacity: 1; }
    100% { opacity: 0; }
}
.table td, .table th {
    vertical-align: middle;
}
</style>
@endsection
