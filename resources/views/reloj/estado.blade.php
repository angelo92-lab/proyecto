@extends('layouts.app') {{-- O tu layout base --}}

@section('content')
<div class="container">
    <h2>Funcionarios Activos Hoy ({{ \Carbon\Carbon::now()->format('d/m/Y') }})</h2>
    @if($activos->isEmpty())
        <p>No hay funcionarios activos hoy.</p>
    @else
        <ul>
            @foreach ($activos as $funcionario)
                <li>{{ $funcionario->nombre }}</li>
            @endforeach
        </ul>
    @endif

    <h2 class="mt-4">Funcionarios Inactivos Hoy</h2>
    @if($inactivos->isEmpty())
        <p>Todos han registrado asistencia hoy.</p>
    @else
        <ul>
            @foreach ($inactivos as $funcionario)
                <li>{{ $funcionario->nombre }}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
