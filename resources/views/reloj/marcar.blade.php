@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Marcar Asistencia</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ url('/reloj-control') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="rut" class="form-label">Escanea el RUT</label>
            <input type="text" id="rut" name="rut" class="form-control" placeholder="Ej: 12345678K" required autofocus>
        </div>

        <button type="submit" class="btn btn-primary">Marcar Asistencia</button>
    </form>
</div>
@endsection
