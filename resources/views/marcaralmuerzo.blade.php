@extends('layouts.app')

@section('title', 'Marcar Almuerzo')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-primary fw-bold">Marcar Almuerzo</h1>

    @if ($mensaje)
        <div id="manual-message" class="alert alert-info animate__animated animate__fadeInDown shadow-sm">
            {{ $mensaje }}
        </div>
    @endif

    <!-- Formulario manual -->
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body">
            <h5 class="card-title text-center mb-3 text-success">Ingreso Manual</h5>
            <form method="post" action="{{ route('marcaralmuerzo.store') }}" id="manualForm">
                @csrf
                <div class="mb-3 col-md-6 mx-auto">
                    <label for="rut" class="form-label">Ingrese RUT del alumno:</label>
                    <input type="text" id="rut" name="rut" class="form-control text-center" placeholder="Ej: 12345678-9" required autocomplete="off">
                </div>
                <div class="text-center">
                    <button type="submit" id="botonManual" class="btn btn-success btn-lg btn-animate shadow">
                        <span class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"></span>
                        Marcar Almuerzo
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Escaneo automático -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="card-title text-center mb-3 text-primary">Escaneo Automático</h5>
            <div class="mb-4 col-md-6 mx-auto">
                <label for="barcodeInput" class="form-label">Escanea el código de barra aquí:</label>
                <input type="text" id="barcodeInput" autofocus class="form-control text-center" placeholder="Esperando escaneo..." autocomplete="off" />
            </div>
            <div id="scan-message" class="alert text-center" style="display:none;"></div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ url('alumnoscasino') }}" class="btn btn-secondary shadow-sm">Volver a Lista de Alumnos</a>
    </div>
</div>

<style>
.message-fade {
    animation: fadeOut 6s forwards;
}
@keyframes fadeOut {
    0%, 80% {opacity: 1;}
    100% {opacity: 0;}
}
.btn-animate:hover {
    animation: pulse 1s infinite;
}
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}
</style>

<script>
document.getElementById('manualForm').addEventListener('submit', function(event) {
    const boton = document.getElementById('botonManual');
    const spinner = boton.querySelector('.spinner-border');
    boton.setAttribute('disabled', 'disabled');
    spinner.classList.remove('d-none');
});

const barcodeInput = document.getElementById('barcodeInput');
const mensajeDiv = document.getElementById('scan-message');
const soundSuccess = new Audio("{{ asset('sounds/success.mp3') }}");
const soundError = new Audio("{{ asset('sounds/error.mp3') }}");

function showMessage(text, isError = false) {
    mensajeDiv.className = `alert text-center animate__animated animate__fadeInDown ${isError ? 'alert-danger' : 'alert-success'}`;
    mensajeDiv.textContent = text;
    mensajeDiv.style.display = 'block';

    setTimeout(() => {
        mensajeDiv.classList.remove('animate__fadeInDown');
        mensajeDiv.classList.add('animate__fadeOutUp');
    }, 4000);

    mensajeDiv.addEventListener('animationend', () => {
        if (mensajeDiv.classList.contains('animate__fadeOutUp')) {
            mensajeDiv.style.display = 'none';
            mensajeDiv.classList.remove('animate__fadeOutUp');
        }
    }, {once: true});
}

function animateInputSuccess() {
    barcodeInput.classList.add('animate__animated', 'animate__bounce');
    barcodeInput.addEventListener('animationend', () => {
        barcodeInput.classList.remove('animate__animated', 'animate__bounce');
    }, {once: true});
}

barcodeInput.addEventListener('input', function(event) {
    const scannedValue = event.target.value.trim();

    if(scannedValue.length > 3) {
        fetch('/api/marcar-almuerzo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ rut: scannedValue })
        }).then(response => response.json())
          .then(data => {
            if(data.error) {
                showMessage(data.error, true);
                soundError.play();
            } else if(data.message) {
                showMessage(data.message, false);
                soundSuccess.play();
                animateInputSuccess();
            }
            event.target.value = ''; // limpiar
        })
        .catch(error => {
            console.error('Error al enviar escaneo:', error);
        });
    }
});
</script>
@endsection
