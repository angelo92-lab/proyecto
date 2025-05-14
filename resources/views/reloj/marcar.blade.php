@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Marcar Entrada / Salida</h2>

    <form action="{{ url('/reloj-control') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="funcionario_id" class="form-label">Funcionario</label>
            <select name="funcionario_id" id="funcionario_id" class="form-control" required>
                <option value="">Seleccione un funcionario</option>
                @foreach ($funcionarios as $funcionario)
                    <option value="{{ $funcionario->id }}">{{ $funcionario->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Marca</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="entrada">Entrada</option>
                <option value="salida">Salida</option>
            </select>
        </div>

        <!-- Campo para Código de Barra -->
        <div class="mb-3">
            <label for="barcode" class="form-label">Escanear Código de Barra</label>
            <input type="text" id="barcode" class="form-control" placeholder="Escanea el código de barras" required>
        </div>

        <!-- Contenedor del Escáner -->
        <div class="mb-3">
            <button type="button" class="btn btn-secondary" id="startScanner">Iniciar Escáner</button>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Marca</button>
    </form>

    <!-- Contenedor para la vista de la cámara -->
    <div id="scanner-container" style="display:none;">
        <div id="scanner" style="width: 100%; height: 300px;"></div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

<script>
    // Inicializar el escáner
    document.getElementById('startScanner').addEventListener('click', function() {
        document.getElementById('scanner-container').style.display = 'block';

        Quagga.init({
            inputStream: {
                type: 'LiveStream',
                target: document.querySelector('#scanner'), // Div donde se mostrará la cámara
                constraints: {
                    facingMode: "environment" // Usa la cámara trasera
                }
            },
            decoder: {
                readers: ["code_128_reader", "ean_reader", "ean_13_reader", "upc_reader"] // Tipos de códigos de barra a leer
            }
        }, function(err) {
            if (err) {
                console.log(err);
                return;
            }
            Quagga.start();
        });

        // Cuando se detecte un código de barras
        Quagga.onDetected(function(data) {
            let barcode = data.codeResult.code;
            document.getElementById('barcode').value = barcode; // Poner el código en el input
            Quagga.stop(); // Detener el escáner
            document.getElementById('scanner-container').style.display = 'none'; // Ocultar la cámara
        });
    });
</script>
@endsection
