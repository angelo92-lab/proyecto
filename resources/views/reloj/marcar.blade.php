@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Marcar Entrada / Salida</h2>

    <!-- Token CSRF para seguridad en fetch POST -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Formulario visual (solo para escanear el RUT) -->
    <form id="formulario-marca" onsubmit="return false;">
        <div class="mb-3">
            <label for="funcionario_nombre" class="form-label">Funcionario</label>
            <input type="text" id="funcionario_nombre" class="form-control" readonly placeholder="Nombre del funcionario">
        </div>

        <div class="mb-3">
            <label for="barcode" class="form-label">Escanear Código de Barra (RUT)</label>
            <input type="text" id="barcode" class="form-control" placeholder="Escanea el RUT" autofocus>
        </div>
    </form>

    <!-- Mensaje de estado -->
    <div id="mensaje" class="alert mt-3 d-none"></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const barcodeInput = document.getElementById('barcode');
            const nombreInput = document.getElementById('funcionario_nombre');
            const mensajeDiv = document.getElementById('mensaje');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            let timeout;

            barcodeInput.addEventListener('input', () => {
                const rut = barcodeInput.value.trim();

                if (rut.length >= 7) {
                    clearTimeout(timeout);

                    timeout = setTimeout(() => {
                        mostrarMensaje('🔄 Buscando funcionario...', 'info');

                        fetch(`/buscar-funcionario/${rut}`)
                            .then(res => {
                                if (!res.ok) throw new Error("No se pudo buscar el funcionario");
                                return res.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    nombreInput.value = data.funcionario.nombre;
                                    registrarMarca(rut);
                                } else {
                                    mostrarMensaje('❌ Funcionario no encontrado.', 'danger');
                                    nombreInput.value = '';
                                }
                            })
                            .catch(() => {
                                mostrarMensaje('❌ Error de conexión con el servidor.', 'danger');
                            });

                        // Limpiar inputs tras 4 segundos
                        setTimeout(() => {
                            barcodeInput.value = '';
                            nombreInput.value = '';
                        }, 4000);
                    }, 400); // Espera breve por si el lector aún no termina
                }
            });

            function registrarMarca(rut) {
                fetch('/reloj-control', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ rut: rut })
                })
                .then(res => {
                    if (!res.ok) throw new Error("Error al registrar");
                    return res.json();
                })
                .then(data => {
                    if (data.success) {
                        mostrarMensaje(`✅ Marca registrada como ${data.message}.`, 'success');
                    } else {
                        mostrarMensaje(`❌ ${data.message || 'Error desconocido'}`, 'danger');
                    }
                })
                .catch(() => {
                    mostrarMensaje('❌ Error de conexión con el servidor.', 'danger');
                });
            }

            function mostrarMensaje(texto, tipo) {
                mensajeDiv.className = `alert alert-${tipo} mt-3`;
                mensajeDiv.textContent = texto;
                mensajeDiv.classList.remove('d-none');
                setTimeout(() => mensajeDiv.classList.add('d-none'), 4000);
            }
        });
    </script>
</div>
@endsection
