@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reloj Control: Marcar Entrada / Salida</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/reloj-control') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="funcionario_id">Funcionario:</label>
            <select name="funcionario_id" class="form-control" required>
                <option value="">Seleccionar...</option>
                @foreach($funcionarios as $funcionario)
                    <option value="{{ $funcionario->id }}">{{ $funcionario->nombre }} ({{ $funcionario->rut }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tipo de marca:</label>
            <select name="tipo" class="form-control" required>
                <option value="entrada">Entrada</option>
                <option value="salida">Salida</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
@endsection
