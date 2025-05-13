@extends('layouts.app')

@section('title', 'Lista de Alumnos')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center display-5 fw-bold text-primary">🎓 Lista de Alumnos</h1>

    <div class="d-flex justify-content-between mb-4">
        <a href="{{ url('anotaciones') }}" class="btn btn-outline-primary shadow-sm">
            📝 Ir a Anotaciones
        </a>
        <a href="{{ url('marcaralmuerzo') }}" class="btn btn-outline-success shadow-sm">
            🍽️ Marcar Almuerzo
        </a>
    </div>

    <form method="get" action="{{ url('alumnoscasino') }}" class="row g-3 mb-4 align-items-center bg-white p-3 rounded shadow-sm">
        <div class="col-md-3">
            <label for="curso" class="form-label">📚 Filtrar por curso:</label>
            <select name="curso" id="curso" class="form-select" onchange="this.form.submit()">
                <option value="">-- Todos los cursos --</option>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso }}" {{ $curso == $cursoSeleccionado ? 'selected' : '' }}>
                        {{ $curso }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="fecha" class="form-label">📅 Filtrar por fecha:</label>
            <input type="date" id="fecha" name="fecha" class="form-control" value="{{ $fechaSeleccionada }}" onchange="this.form.submit()">
        </div>
    </form>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>Nombres</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Rut</th>
                    <th>Digito Ver</th>
                    <th>Curso</th>
                    <th>🍽️ Almorzó</th>
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
                        <td class="{{ $row->almorzo_por_fecha === 'Sí' ? 'text-success fw-bold' : 'text-danger fw-bold' }}">
                            {{ $row->almorzo_por_fecha }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Estilos personalizados --}}
<style>
    body {
        background: linear-gradient(to right, #e0f7fa, #f1f8e9);
    }

    h1 {
        font-family: 'Segoe UI', sans-serif;
    }

    .form-label {
        font-weight: 600;
    }

    .btn-outline-primary,
    .btn-outline-success {
        font-weight: 600;
        font-size: 16px;
        padding: 8px 16px;
        border-radius: 8px;
        transition: 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }

    .btn-outline-success:hover {
        background-color: #198754;
        color: white;
    }

    .table {
        background-color: #fff;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    thead.table-primary {
        background-color: #0d6efd;
        color: white;
    }

    tbody tr:hover {
        background-color: #f0f8ff;
    }
</style>
@endsection
