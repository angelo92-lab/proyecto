<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Casino')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

    <style>
        body.dark-mode {
            background-color: #121212 !important;
            color: #e0e0e0;
        }

        body.dark-mode .navbar {
            background-color: #1f1f1f !important;
        }

        body.dark-mode .nav-link {
            color: #e0e0e0 !important;
        }

        body.dark-mode .btn-outline-light {
            border-color: #e0e0e0;
            color: #e0e0e0;
        }
    </style>
</head>
<body id="body">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            🎲 Pagina Escolar CRDC
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>   

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Tus enlaces anteriores -->
                <!-- ... -->
            </ul>

            <!-- 🌗 Botón modo oscuro -->
            <button class="btn btn-outline-light me-2" onclick="toggleDarkMode()" title="Modo oscuro/claro">
                🌓
            </button>

            <!-- Cierre de sesión -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</nav>

<main class="container my-4">
    @yield('content')
</main>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- 🌓 Script para modo oscuro -->
<script>
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('theme', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
    }

    // Aplica tema guardado al cargar
    window.addEventListener('DOMContentLoaded', () => {
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    });
</script>
</body>
</html>
