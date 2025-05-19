@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Marcar Asistencia</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form id="form-marca" action="{{ url('/reloj-control') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="rut" class="form-label">Escanea el RUT</label>
            <input type="text" id="rut" name="rut" class="form-control" placeholder="Escanea el RUT" required autofocus>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('rut');

            input.addEventListener('input', () => {
                const rut = input.value.trim();
                
                if (rut.length >= 7) {
                    // Espera medio segundo antes de enviar el formulario
                    setTimeout(() => {
                        document.getElementById('form-marca').submit();
                    }, 500);
                }
            });
        });
    </script>
</div>
@endsection
