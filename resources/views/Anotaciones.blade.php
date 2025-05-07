@extends('layouts.app')

@section('title', 'Listado de Anotaciones')

@section('content')
<h1 class="mb-4 text-center">Listado de Anotaciones</h1>

<div class="mb-3 text-end">
    <a href="{{ url('alumnoscasino') }}" class="btn btn-secondary me-2">Volver A Los Alumnos</a>
    <a href="{{ url('agregaranotacion') }}" class="btn btn-primary">Agregar Anotación</a>
</div>

@if ($anotaciones->count() > 0)
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>RUT</th>
                <th>Anotación</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anotaciones as $anotacion)
            <tr>
                <td>{{ $anotacion->nombres }} {{ $anotacion->{'apellido paterno'} }}</td>
                <td>{{ $anotacion->rut }}</td>
                <td>{!! nl2br(e($anotacion->anotacion)) !!}</td>
                <td>{{ $anotacion->fecha }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-info text-center message-fade">No hay anotaciones registradas.</div>
@endif

<style>
.message-fade {
    animation: fadeOut 6s forwards;
}
@keyframes fadeOut {
    0%, 80% {opacity: 1;}
    100% {opacity: 0;}
}
</style>
@endsection