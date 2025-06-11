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

        
        body.dark-mode,
        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3,
        body.dark-mode h4,
        body.dark-mode h5,
        body.dark-mode h6,
        body.dark-mode p,
        body.dark-mode span,
        body.dark-mode label,
        body.dark-mode table,
        body.dark-mode td,
        body.dark-mode th,
        body.dark-mode a,
        body.dark-mode li,
        body.dark-mode .form-control {
            color: #e0e0e0 !important;
                background-color: transparent;
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
        body.dark-mode .container,
        body.dark-mode .card {
            background-color: #1e1e1e;
        }
         .titulo-principal {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1rem;
        border-bottom: 2px solid #dee2e6;
        padding-bottom: 0.5rem;
    }

    .dark-mode .titulo-principal {
        border-color: #444;
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
                    <li class="nav-item">
                        <a href="{{ url('alumnoscasino') }}" class="nav-link">
                            <i class="bi bi-people-fill"></i> Lista de Alumnos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('marcaralmuerzo') }}" class="nav-link">
                            <i class="bi bi-check-square"></i> Marcar Almuerzo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reportes.index') }}" class="nav-link">
                            <i class="bi bi-bar-chart-line-fill"></i> Reportes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('agregaranotacion') }}" class="nav-link">
                            <i class="bi bi-pencil-square"></i> Agregar Anotación
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('anotaciones') }}" class="nav-link">
                            <i class="bi bi-journal-text"></i> Anotaciones
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('vistaMarcar') }}" class="nav-link">
                            <i class="bi bi-person-check-fill"></i> Marcar Asistencia
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reloj.estado') }}" class="nav-link">
                            <i class="bi bi-clock-history"></i> Estado Diario
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reporte.asistencia') }}" class="nav-link">
                            <i class="bi bi-file-earmark-bar-graph"></i> Generar Reporte
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('portal.funcionarios') }}" class="nav-link">
                            <i class="bi bi-person-badge-fill"></i> Portal Funcionarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('matricula.create') }}" class="nav-link">
                            <i class="bi bi-pencil-square"></i> Ingresar Matrícula
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('matricula.reportes') }}" class="nav-link">
                            <i class="bi bi-file-earmark-bar-graph"></i> Reportes Matrículas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ayuda') }}" class="nav-link">
                            <i class="bi bi-question-circle-fill"></i> Ayuda
                        </a>
                    </li>

                </ul>

                <!-- 🌗 Botón modo oscuro -->
                <button class="btn btn-outline-light me-2" onclick="toggleDarkMode()" title="Cambiar tema">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- 🌗 Script modo oscuro -->
    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('theme', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
        }

        // Al cargar, aplica la preferencia del usuario
        window.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark-mode');
            }
        });
    </script>
</body>
</html>
