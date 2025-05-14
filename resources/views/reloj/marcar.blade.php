@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Marcar Entrada / Salida</h2>

    <form action="{{ url('/reloj-control') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="funcionario_id" class="form-label">Funcionario</label>
            <input type="text" id="funcionario_id" class="form-control" placeholder="Escanea el código de barras del funcionario (RUT)" readonly>
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
            <label for="barcode" class="form-label">Escanear Código de Barra (RUT)</label>
            <input type="text" id="barcode" class="form-control" placeholder="Escanea el RUT del funcionario" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Marca</button>
    </form>

    <script>
        // Detectar cuando se escanea un código de barras
        document.getElementById('barcode').addEventListener('input', function () {
            var rutEscaneado = this.value;

            // Si el RUT está en el campo, buscamos el funcionario
            if (rutEscaneado.length >= 7) { // Asumimos que el RUT tiene al menos 7 caracteres
                fetch(`/buscar-funcionario/${rutEscaneado}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Completar el nombre del funcionario
                            document.getElementById('funcionario_id').value = data.funcionario.nombre;
                        } else {
                            alert('Funcionario no encontrado');
                        }
                    });
            }
        });
    </script>
</div>
@endsection
