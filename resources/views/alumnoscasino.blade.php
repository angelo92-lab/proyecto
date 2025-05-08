@extends('layouts.app')

@section('title', 'Lista de Alumnos')

@section('content')
<h1 class="mb-4">Lista de Alumnos</h1>

<div class="d-flex justify-content-between mb-3">
    <a href="{{ url('anotaciones') }}" class="btn btn-primary">Ir a Anotaciones</a>
    <a href="{{ url('marcaralmuerzo') }}" class="btn btn-primary">Marcar Almuerzo</a>
</div>

<form method="get" action="{{ url('alumnoscasino') }}" class="row g-3 mb-4 align-items-center">
    <div class="col-auto">
        <label for="curso" class="col-form-label">Filtrar por curso:</label>
    </div>
    <div class="col-auto">
        <select name="curso" id="curso" class="form-select" onchange="this.form.submit()">
            <option value="">-- Todos los cursos --</option>
            @foreach ($cursos as $curso)
                <option value="{{ $curso }}" {{ $curso == $cursoSeleccionado ? 'selected' : '' }}>
                    {{ $curso }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-auto">
        <label for="fecha" class="col-form-label">Filtrar por fecha:</label>
    </div>
    <div class="col-auto">
        <input type="date" id="fecha" name="fecha" class="form-control" value="{{ $fechaSeleccionada }}" onchange="this.form.submit()">
    </div>
</form>

<table class="table table-bordered table-hover">
<thead class="table-dark">
    <tr>
        <th>Nombres</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Rut</th>
        <th>Digito Ver</th>
        <th>Curso</th>
        <th>Almorzó</th>
    </tr>
</thead>
<tbody>
    @foreach ($alumnos as $row)
        <tr>
            <td>{{ $row->Nombres }}</td>
            <td>{{ $row->ApellidoPaterno }}</td>
            <td>{{ $row->ApellidoMaterno }}</td>
            <td>{{ $row->Run }}</td>
            <td>{{ $row->DigitoVer }}</td>
            <td>{{ $row->Curso }}</td>
            <td class="{{ $row->almorzo_por_fecha === 'Sí' ? 'text-success' : 'text-danger' }}">
                {{ $row->almorzo_por_fecha }}
            </td>
        </tr>
    @endforeach
</tbody>

</table>
@endsection