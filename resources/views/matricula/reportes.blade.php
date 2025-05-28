@extends('layouts.app')

@section('title', 'Reportes de Matrículas 2026')

@section('content')
<h1 class="mb-4 text-center text-primary fw-bold display-6">📊 Reportes de Matrículas 2026</h1>

@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

{{-- Buscador simple por nombre o curso --}}
<form method="GET" action="{{ route('matricula.reportes') }}" class="mb-4">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o curso" value="{{ request('search') }}">
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
