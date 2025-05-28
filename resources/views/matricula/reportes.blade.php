@extends('layouts.app')

@section('title', 'Reportes de Matrículas 2026')

@section('content')
<h1 class="mb-4 text-center text-primary fw-bold display-6">📊 Reportes de Matrículas 2026</h1>

@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

{{-- Buscador + filtro por curso --}}
<form method="GET" action="{{ route('matricula.reportes') }}" class="mb-4">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o curso" value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="curso" class="form-select">
                <option value="">-- Todos los cursos --</option>
                <option value="1° Básico" {{ request('curso') == '1° Básico' ? 'selected' : '' }}>1° Básico</option>
                <option value="2° Básico" {{ request('curso') == '2° Básico' ? 'selected' : '' }}>2° Básico</option>
                <option value="3° Básico" {{ request('curso') == '3° Básico' ? 'selected' : '' }}>3° Básico</option>
                <option value="4° Básico" {{ request('curso') == '4° Básico' ? 'selected' : '' }}>4° Básico</option>
                <option value="5° Básico" {{ request('curso') == '5° Básico' ? 'selected' : '' }}>5° Básico</option>
                <option value="6° Básico" {{ request('curso') == '6° Básico' ? 'selected' : '' }}>6° Básico</option>
                <option value="7° Básico A" {{ request('curso') == '7° Básico A' ? 'selected' : '' }}>7° Básico A</option>
                <option value="7° Básico B" {{ request('curso') == '7° Básico B' ? 'selected' : '' }}>7° Básico B</option>
                <option value="8° Básico A" {{ request('curso') == '8° Básico A' ? 'selected' : '' }}>8° Básico A</option>
                <option value="8° Básico B" {{ request('curso') == '8° Básico B' ? 'selected' : '' }}>8° Básico B</option>
                <option value="1° Medio A" {{ request('curso') == '1° Medio A' ? 'selected' : '' }}>1° Medio A</option>
                <option value="1° Medio B" {{ request('curso') == '1° Medio B' ? 'selected' : '' }}>1° Medio B</option>
                <option value="2° Medio A" {{ request('curso') == '2° Medio A' ? 'selected' : '' }}>2° Medio A</option>
                <option value="2° Medio B" {{ request('curso') == '2° Medio B' ? 'selected' : '' }}>2° Medio B</option>
                <option value="3° Medio A" {{ request('curso') == '3° Medio A' ? 'selected' : '' }}>3° Medio A</option>
                <option value="3° Medio B" {{ request('curso') == '3° Medio B' ? 'selected' : '' }}>3° Medio B</option>
                <option value="4° Medio A" {{ request('curso') == '4° Medio A' ? 'selected' : '' }}>4° Medio A</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('matricula.reportes') }}" class="btn btn-secondary w-100">Limpiar</a>
        </div>
    </div>
</form>

@if($matriculas->count() > 0)
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-hover bg-white rounded">
            <thead class="table-dark text-center">
                <tr>
                    <th>Run</th>
                    <th>Nombre Completo</th>
                    <th>Curso</th>
                    <th>Fecha Nac.</th>
                    <th>Comuna</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matriculas as $matricula)
                <tr>
                    <td class="text-center">{{ $matricula->run }}</td>
                    <td>{{ $matricula->nombres }} {{ $matricula->apellido_paterno }} {{ $matricula->apellido_materno }}</td>
                    <td class="text-center">{{ $matricula->curso ?? '-' }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($matricula->fecha_nacimiento)->format('d/m/Y') }}</td>
                    <td>{{ $matricula->comuna }}</td>
                    <td>{{ $matricula->direccion }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-info text-center">
        ℹ️ No se encontraron matrículas.
    </div>
@endif

@endsection
