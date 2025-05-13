<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Temperatura Aire Monte Patria</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            color: #1e1e2f;
        }
        .card {
            background: #ffffffcc;
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2.5rem 3rem;
            max-width: 390px;
            width: 100%;
            box-shadow: 0 8px 20px rgba(102, 166, 255, 0.3);
            text-align: center;
        }
        h1 {
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 1.25rem;
            color: #1446a0;
        }
        .temperature {
            font-size: 3.5rem;
            font-weight: 800;
            color: #1e2a78;
            margin-bottom: 0.5rem;
        }
        .label {
            font-size: 1.1rem;
            color: #555a75;
            margin-bottom: 1.5rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .wind {
            font-size: 1.1rem;
            color: #444a65;
            font-weight: 600;
        }
        /* Mensaje error estilo */
        .error {
            color: #ff4c4c;
            font-size: 1.2rem;
            font-weight: 700;
            margin-top: 1.5rem;
        }
        @media (max-width: 400px) {
            .card {
                padding: 2rem 2rem;
                max-width: 100%;
            }

            .temperature {
                font-size: 2.8rem;
            }
            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Temperatura Aire Monte Patria</h1>

        @if (isset($error))
            <div class="error">
                {{ $error }}
            </div>
        @else
            <div class="temperature">{{ $temperature }}°C</div>
            <div class="label">Temperatura actual</div>
            <div class="wind">Velocidad del viento: {{ $windSpeed }} km/h</div>
        @endif
    </div>
</body>
</html>