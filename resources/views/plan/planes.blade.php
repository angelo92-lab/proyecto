@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Planes de Acompañamiento</h1>
    <p>Aquí podrás ver o cargar información relacionada con planes de apoyo y acompañamiento a estudiantes.</p>

    {{-- Aquí puedes agregar una tabla o formulario más adelante --}}
</div>
<form action="{{ route('planes.importar') }}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="mb-3">
        <label for="archivo" class="form-label">Subir Excel</label>
        <input type="file" name="archivo" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Importar</button>
</form>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>Curso</th>
            <th>Nombre</th>
            <th>Procedencia</th>
            <th>Asignatura</th>
            <th>Asistencia</th>
            <th>Acompañamiento</th>
        </tr>
    </thead>
    <tbody>
        @foreach($planes as $plan)
        <tr>
            <td>{{ $plan->curso }}</td>
            <td>{{ $plan->nombre }}</td>
            <td>{{ $plan->procedencia }}</td>
            <td>{{ $plan->asignatura }}</td>
            <td>{{ $plan->asistencia }}</td>
            <td>{{ $plan->acompanamiento }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
