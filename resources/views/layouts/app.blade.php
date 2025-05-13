<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Casino')</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
</head>
<body>

   
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-75 shadow-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-casino"></i> Casino
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="{{ url('alumnoscasino') }}" class="nav-link">Lista de Alumnos</a></li>
                    <li class="nav-item"><a href="{{ url('marcaralmuerzo') }}" class="nav-link">Marcar Almuerzo</a></li>
                    <li class="nav-item"><a href="{{ url('agregaranotacion') }}" class="nav-link">Agregar Anotación</a></li>
                    <li class="nav-item"><a href="{{ url('anotaciones') }}" class="nav-link">Anotaciones</a></li>
                    <li class="nav-item"><a href="{{ route('reportes.index') }}" class="nav-link">Reportes</a></li>
                    <li class="nav-item"><a href="{{ route('clima') }}" class="nav-link">Tiempo</a></li> <!-- Ruta del clima -->
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Extra smooth scroll for the navbar links on click
        document.querySelectorAll('.navbar-nav .nav-link').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });
    </script>
</body>
</html>

<!-- Custom CSS -->
<style>
    /* Navbar Transparency with Backdrop Blur */
    .navbar {
        background: rgba(0, 0, 0, 0.7); /* semi-transparent */
        backdrop-filter: blur(5px); /* optional blur effect */
    }

    /* Hover effects for navbar links */
    .navbar-nav .nav-link {
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #f8f9fa; /* lighter color */
        text-decoration: underline;
        transform: scale(1.05);
    }

    /* Highlight the active link */
    .navbar-nav .nav-item .active {
        color: #ffc107 !important;
        font-weight: bold;
    }

    /* Cerrar sesión button */
    #logout-form .btn {
        background-color: #dc3545;
        border-radius: 20px;
        padding: 8px 16px;
    }

    /* Custom smooth scroll for navigation */
    html {
        scroll-behavior: smooth;
    }
</style>
