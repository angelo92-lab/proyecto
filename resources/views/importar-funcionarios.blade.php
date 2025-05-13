<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar Funcionarios</title>
</head>
<body>
    <h1>Importar Funcionarios</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('funcionarios.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="file">Selecciona el archivo Excel:</label>
            <input type="file" name="file" id="file" required>
        </div>
        <button type="submit">Importar</button>
    </form>
</body>
</html>
