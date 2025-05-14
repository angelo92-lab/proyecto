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
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Casino</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav me-auto">
    <li class="nav-item"><a href="{{ url('alumnoscasino') }}" class="nav-link">Lista de Alumnos</a></li>
    <li class="nav-item"><a href="{{ url('marcaralmuerzo') }}" class="nav-link">Marcar Almuerzo</a></li>
    <li class="nav-item"><a href="{{ route('reportes.index') }}" class="nav-link">Reportes</a></li>
    <li class="nav-item"><a href="{{ url('agregaranotacion') }}" class="nav-link">Agregar Anotación</a></li>
    <li class="nav-item"><a href="{{ url('anotaciones') }}" class="nav-link">Anotaciones</a></li>
    <li class="nav-item"><a href="{{ route('vistaMarcar') }}" class="nav-link">Marcar Asistencia</a></li>
    <li class="nav-item"><a href="{{ route('reloj.estado') }}" class="nav-link">Estado Diario</a></li>
    <li class="nav-item"><a href="{{ route('reporte.asistencia') }}" class="nav-link">Generar Reporte</a></li>
    <li class="nav-item"><a href="{{ route('clima') }}" class="nav-link">Tiempo</a></li>
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
</body>
</html>