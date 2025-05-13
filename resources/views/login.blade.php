<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iniciar Sesión - Colegio República de Chile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="text-center mb-4">
                    <img src="{{ asset('imagenes/logo.jpg') }}" alt="Logo Colegio" style="width: 120px;" class="animate__animated animate__fadeInDown mb-3">
                    <h3 class="fw-bold text-primary">Colegio República de Chile</h3>
                </div>
                <div class="card shadow border-0 animate__animated animate__fadeInUp">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4">Iniciar Sesión</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger message-fade">
                                {{ $errors->first('mensaje') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuario</label>
                                <input type="text" name="username" id="username" class="form-control" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
                            </button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-4 text-muted">
                    <small>&copy; {{ date('Y') }} Colegio República de Chile</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap y animaciones -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    .message-fade {
        animation: fadeOut 6s forwards;
    }
    @keyframes fadeOut {
        0%, 80% { opacity: 1; }
        100% { opacity: 0; }
    }
    </style>
</body>
</html>
