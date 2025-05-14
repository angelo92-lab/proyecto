@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Estado de Asistencia de Funcionarios – {{ \Carbon\Carbon::now()->format('d/m/Y') }}</h2>
        <div>
            <a href="{{ route('reporte.asistencia') }}" class="btn btn-outline-primary me-2">
                Generar Reporte
            </a>
            <a href="{{ url('/reloj-control') }}" class="btn btn-outline-secondary">
                Marcar Entrada/Salida
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Activos -->
        <div class="col-md-6">
            <div class="card border-success mb-4 shadow-sm">
                <div class="card-header bg-success text-white">
                    Funcionarios Activos
                </div>
                <div class="card-body">
                    @if($activos->isEmpty())
                        <p class="text-muted">No hay funcionarios activos hoy.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($activos as $funcionario)
                                <li class="list-group-item">{{ $funcionario->nombre }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <!-- Inactivos -->
        <div class="col-md-6">
            <div class="card border-danger mb-4 shadow-sm">
                <div class="card-header bg-danger text-white">
                    Funcionarios Inactivos
                </div>
                <div class="card-body">
                    @if($inactivos->isEmpty())
                        <p class="text-muted">Todos han registrado asistencia hoy.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($inactivos as $funcionario)
                                <li class="list-group-item">{{ $funcionario->nombre }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
