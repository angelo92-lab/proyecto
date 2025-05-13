<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Temperatura Aire Monte Patria</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            color: #1e1e2f;
        }
        .card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2.5rem 3rem;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            text-align: center;
            animation: fadeIn 0.8s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h1 {
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
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
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        .wind {
            font-size: 1.1rem;
            color: #444a65;
            font-weight: 600;
        }
        .icon {
            font-size: 2rem;
            margin-right: 0.3rem;
        }
        .error {
            color: #ff4c4c;
            font-size: 1.2rem;
            font-weight: 700;
            margin-top: 1.5rem;
        }
        @media (max-width: 400px) {
            .card {
                padding: 2rem;
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
        <h1>🌡️ Temperatura Aire Monte Patria</h1>

        @if (isset($error))
            <div class="error">
                {{ $error }}
            </div>
        @else
            <div class="temperature">🌡️ {{ $temperature }}°C</div>
            <div class="label">Temperatura actual</div>
            <div class="wind">💨 Velocidad del viento: {{ $windSpeed }} km/h</div>
        @endif
    </div>
</body>
</html>
