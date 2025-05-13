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
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('funcionarios.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Subir archivo Excel:</label>
    <input type="file" name="file" required>
    <button type="submit">Importar</button>
</form>
    </body>
    </html>
