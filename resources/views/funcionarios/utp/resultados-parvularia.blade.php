@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">🧸 Resultados DIA - Inicial Educación Parvularia 2025</h1>

    <p class="mb-3">Aquí puedes visualizar o descargar el informe oficial de resultados para el nivel de Educación Parvularia.</p>

    <div class="mb-4">
        <a href="{{ asset('documentos/utp/informeEstablecimiento799_evaluacion_inicio DIA parvularia 2025.pdf') }}" target="_blank" class="btn btn-outline-primary">
            📥 Descargar PDF
        </a>
    </div>

    <div class="embed-responsive embed-responsive-4by3" style="height: 600px;">
        <iframe class="embed-responsive-item w-100" style="height: 100%;" 
                src="{{ asset('documentos/utp/informeEstablecimiento799_evaluacion_inicio DIA parvularia 2025.pdf') }}" 
                frameborder="0">
        </iframe>
    </div>
</div>
@endsection
