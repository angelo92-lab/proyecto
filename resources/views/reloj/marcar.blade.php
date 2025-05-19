@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Marcar Entrada / Salida</h2>

   <form action="{{ url('/reloj-control') }}" method="POST">
    @csrf

    <!-- Este campo será visible, muestra el nombre -->
    <div class="mb-3">
        <label for="funcionario_nombre" class="form-label">Funcionario</label>
        <input type="text" id="funcionario_nombre" class="form-control" placeholder="Nombre del funcionario" readonly>
    </div>

    <!-- Campo oculto donde se guarda el ID del funcionario -->
    <input type="hidden" name="funcionario_id" id="funcionario_id">

    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo de Marca</label>
        <select name="tipo" id="tipo" class="form-control" required>
            <option value="entrada">Entrada</option>
            <option value="salida">Salida</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="barcode" class="form-label">Escanear Código de Barra (RUT)</label>
        <input type="text" id="barcode" name="rut" class="form-control" placeholder="Escanea el RUT del funcionario" required>
    </div>

    <button type="submit" class="btn btn-primary">Registrar Marca</button>
</form>
@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif



    <script>
        // Detectar cuando se escanea un código de barras
        document.getElementById('barcode').addEventListener('input', function () {
    var rutEscaneado = this.value;

    if (rutEscaneado.length >= 7) {
        fetch(`/buscar-funcionario/${rutEscaneado}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mostrar nombre del funcionario
                    document.getElementById('funcionario_nombre').value = data.funcionario.nombre;
                    // Guardar ID en el campo oculto
                    document.getElementById('funcionario_id').value = data.funcionario.id;
                } else {
                    alert('Funcionario no encontrado');
                }
            });
    }
});

    </script>
</div>
@endsection
