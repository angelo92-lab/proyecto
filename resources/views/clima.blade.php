<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clima</title>
</head>
<body>
    <h1>Información del Clima</h1>
    <p>Temperatura: {{ $datosClima['main']['temp'] }} °C</p>
    <p>Descripción: {{ $datosClima['weather'][0]['description'] }}</p>
</body>
</html>
