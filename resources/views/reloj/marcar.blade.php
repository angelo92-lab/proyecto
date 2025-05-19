@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Marcar Entrada / Salida</h2>

    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF para AJAX --}}

    <!-- Formulario visual -->
    <form id="formulario-marca" onsubmit="return false;">
        <!-- Campo para mostrar el nombre del funcionario -->
        <div class="mb-3">
            <label for="funcionario_nombre" class="form-label">Funcionario</label>
            <input type="text" id="funcionario_nombre" class="form-control" placeholder="Nombre del funcionario" readonly>
        </div>

        <!-- Campo para escanear el RUT -->
        <div class="mb-3">
            <label for="barcode" class="form-label">Escanear Código de Barra (RUT)</label>
            <input type="text" id="barcode" class="form-control" placeholder="Escanea el RUT del funcionario" autofocus>
        </div>
    </form>

    <!-- Alertas -->
    <div id="mensaje" class="alert mt-3 d-none"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const barcodeInput = document.getElementById('barcode');
            const nombreInput = document.getElementById('funcionario_nombre');
            const mensajeDiv = document.getElementById('mensaje');

            let timeout;
            barcodeInput.addEventListener('input', function () {
                const rut = barcodeInput.value.trim();

                if (rut.length >= 7) {
                    clearTimeout(timeout);

                    timeout = setTimeout(function () {
                        mostrarMensaje('🔄 Buscando funcionario...', 'info');

                        // Buscar funcionario por RUT
                        fetch(`/buscar-funcionario/${rut}`)
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    nombreInput.value = data.funcionario.nombre;
                                    registrarMarca(rut);
                                } else {
                                    mostrarMensaje('❌ Funcionario no encontrado.', 'danger');
                                    nombreInput.value = '';
                                }
                            })
                            .catch(err => {
                                console.error(err);
                                mostrarMensaje('❌ Error de conexión con el servidor.', 'danger');
                            });

                        // Limpiar input después de unos segundos
                        setTimeout(() => {
                            barcodeInput.value = '';
                            nombreInput.value = '';
                        }, 3000);
                    }, 500);
                }
            });

            function registrarMarca(rut) {
                fetch('/reloj-control', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ rut: rut })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        mostrarMensaje(`✅ Marca registrada como ${data.message}`, 'success');
                    } else {
                        mostrarMensaje('❌ ' + (data.message || 'Error desconocido'), 'danger');
                    }
                })
                .catch(err => {
                    console.error(err);
                    mostrarMensaje('❌ Error de conexión con el servidor.', 'danger');
                });
            }

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
