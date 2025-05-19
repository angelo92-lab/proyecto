@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Marcar Asistencia</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Formulario para marcar la asistencia -->
    <form id="form-marca" action="{{ route('reloj-control.marcar') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="rut" class="form-label">Escanea el RUT</label>
            <input type="text" id="rut" name="rut" class="form-control" placeholder="Escanea el RUT" required autofocus>
        </div>
    </form>

    <!-- Espacio para mostrar mensajes -->
    <div id="mensaje" class="alert mt-3 d-none"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('rut');
            const form = document.getElementById('form-marca');
            const mensajeDiv = document.getElementById('mensaje');
            let timeout;

            input.addEventListener('input', () => {
                const rut = input.value.trim();
                
                if (rut.length >= 7) {
                    // Prevenir envíos múltiples mientras se espera
                    clearTimeout(timeout);

                    // Mostrar un mensaje de "esperando"
                    mostrarMensaje('🔄 Esperando registro...', 'info');
                    
                    timeout = setTimeout(() => {
                        form.submit();  // Enviar el formulario automáticamente después de 500 ms
                    }, 500);
                }
            });

            function mostrarMensaje(texto, tipo) {
                mensajeDiv.className = `alert alert-${tipo} mt-3`;
                mensajeDiv.textContent = texto;
                mensajeDiv.classList.remove('d-none');
                setTimeout(() => mensajeDiv.classList.add('d-none'), 3000);
            }
        });
    </script>
</div>
@endsection
