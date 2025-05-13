<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperatura del Aire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            color: #333;
            text-align: center;
            padding: 2em;
            margin: 0;
        }
        .container {
            background: white;
            border-radius: 15px;
            padding: 2em;
            max-width: 350px;
            margin: auto;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
        }
        h1 {
            margin-bottom: 0.5em;
        }
        p {
            margin: 0.5em 0;
            font-size: 1.3em;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Temperatura del Aire</h1>
        @if (isset($error))
            <p class="error">{{ $error }}</p>
        @else
            <p>Temperatura actual: <strong>{{ $temperature }} °C</strong></p>
            <p>Velocidad del viento: <strong>{{ $windSpeed }} km/h</strong></p>
        @endif
    </div>
</body>
</html>